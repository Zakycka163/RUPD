<?php

abstract class Api
{

    protected $method = ''; //GET|POST|PUT|DELETE

    public $requestParams = [];

    protected $action = ''; //Название метод для выполнения

    protected $table_name;


    public function __construct() {
        #header("Access-Control-Allow-Orgin: *");
        #header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");

        //Массив GET параметров
        $this->requestParams = $_REQUEST;

        //Определение метода запроса
        $this->method = $_SERVER['REQUEST_METHOD'];
        if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $this->method = 'DELETE';
            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                $this->method = 'PUT';
            } else {
                throw new Exception("Unexpected Header");
            }
        }
    }

    public function run() {
        //Определение действия для обработки
        $this->action = $this->getAction();

        //Если метод(действие) определен в дочернем классе API
        if (method_exists($this, $this->action)) {
            return $this->{$this->action}();
        } else {
            throw new RuntimeException('Invalid Method', 405);
        }
    }

    protected function response($data, $status = 500) {
        header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    private function requestStatus($code) {
        $status = array(
            200 => 'OK',
            201 => 'Created',
            204 => 'No Content',
            400 => 'Bad Request',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        return ($status[$code])?$status[$code]:$status[500];
    }

    protected function getAction()
    {
        $method = $this->method;
        switch ($method) {
            case 'GET':
                if(isset($this->requestParams['id']) or isset($this->requestParams['key'])){
                    return 'viewAction';
                } else {
                    return 'indexAction';
                }
                break;
            case 'POST':
                return 'createAction';
                break;
            case 'PUT':
                return 'updateAction';
                break;
            case 'DELETE':
                return 'deleteAction';
                break;
            default:
                return null;
        }
    }

    /**
     * Метод GET
     * Вывод списка всех записей
     * http://ДОМЕН/${table_name}
     * http://ДОМЕН/${table_name}?round=
     * @return string
     */
    public function indexAction()
    {
        if (isset($this->requestParams['round']) and is_numeric($this->requestParams['round'])){
            $round = htmlspecialchars(trim($this->requestParams['round'])) ?? 1;
        } else { $round = 1; }
        $database = new Database();
        $link = $database->get_db_link();
        $limit = $database->get_db_limit();
		$start = ($round - 1) * $limit;
		$sql = "SELECT * FROM `".$this->table_name."` LIMIT ".$start.",".$limit."";
		$result = mysqli_query($link, $sql);
        
        if ( mysqli_num_rows($result) > 0) {
            $response_body = array('total' => (int)mysqli_num_rows($result), 'limit' => (int)$limit,'round' => (int) $round);
            $sql_columns = "SHOW COLUMNS FROM `".$this->table_name."`";   
            $result_columns = mysqli_query($link, $sql_columns);
            while($row = mysqli_fetch_array($result_columns)){
                $columns[] = $row['Field'];
            }
            $number = 1;
            while($row = mysqli_fetch_array($result)){
                for($i = 0, $size = count($columns); $i < $size; ++$i) {
                    if(is_numeric($row[$i])){
                        $row[$i] = $row[$i] * 1;
                    }
                    $obj[$columns[$i]] = $row[$i];
                }
                $number++;
                $objs[] = $obj;
            }
            $response_body[$this->table_name] = $objs;
            return $this->response($response_body, 200);
        }
        $link = $database->close_db_link();
        return $this->response('Not Found objects', 404);
    }

    /**
     * Метод GET
     * Просмотр отдельной записи (по id)
     * http://ДОМЕН/${table_name}?id=
     * @return string
     */
    public function viewAction()
    {
        if( isset($this->requestParams['id']) and is_numeric($this->requestParams['id']) ){

            $id = htmlspecialchars(trim($this->requestParams['id'] ?? ''));

            $database = new Database();
            $link = $database->get_db_link();
            
            if ($database->exist_in_table($id, $this->table_name)) {
                $sql = "SELECT * FROM `".$this->table_name."` WHERE id = ".$id."";
                $result = mysqli_query($link, $sql);

                $sql_columns = "SHOW COLUMNS FROM `".$this->table_name."`";
                $result_columns = mysqli_query($link, $sql_columns);

                while($row = mysqli_fetch_array($result_columns)){
                    $columns[] = $row['Field'];
                }
                while($row = mysqli_fetch_array($result)){
                    for($i = 0, $size = count($columns); $i < $size; ++$i) {
                        if(is_numeric($row[$i])){
                            $row[$i] = $row[$i] * 1;
                        }
                        $obj[$columns[$i]] = $row[$i];
                    }
                }
                return $this->response($obj, 200);
            } return $this->response('Not Found object with id = '.$id.'', 404);
            $link = $database->close_db_link();
        }
        return $this->response('Bad Request', 400);
    }

    /*
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/${table_name} + JSON
     * 
    {
        "name": "string"
    }
     * 
     * @return string
     */
    public function createAction()
    {
        $data = json_decode(file_get_contents("php://input"));
        
        if( isset($data->name) ){

            $name = htmlspecialchars($data->name) ?? '';
        
            $database = new Database();
            $link = $database->get_db_link();

            $errors = $database->validate_input_data($this->table_name, $data);

            if (empty($errors)) {
                $sql = "INSERT INTO `".$this->table_name."` (`name`) VALUES ('".$name."')";
                if (mysqli_query($link, $sql)){
                    return $this->response('Object created', 201);
                }
                return $this->response(mysqli_error($link), 500);
            }
            return $this->response($errors, 400);
            $link = $database->close_db_link();
        } 
        return $this->response("Bad Request", 400);
    }

    /*
     * Метод PUT
     * Обновление отдельной записи (по ее id)
     * http://ДОМЕН/${table_name}?id= + JSON
     * 
    { 
        "name": "string"
    }
     * 
     * @return string
     */
    public function updateAction()
    {
        $data = json_decode(file_get_contents("php://input"));

        if( isset($this->requestParams['id']) and is_numeric($this->requestParams['id']) and isset($data->name)){

            $id = htmlspecialchars(trim($this->requestParams['id'] ?? ''));
            $name = htmlspecialchars($data->name) ?? '';

            $database = new Database();
            $link = $database->get_db_link();

            $errors = $database->validate_input_data($this->table_name, $data);

            if (empty($errors)) {
                if ($database->exist_in_table($id, $this->table_name)){                 
                    $sql = "UPDATE `".$this->table_name."` SET `name` = '".$name."' WHERE id = ".$id."";
                    if (mysqli_query($link, $sql)) {
                        return $this->response('Object updated.', 200);
                    }
                    return $this->response(mysqli_error($link), 500);
                } 
                return $this->response('Not Found object with id = '.$id.'', 204);
            }
            return $this->response($errors, 400);
            $link = $database->close_db_link();
        }
        return $this->response('Bad Request', 400);
    }

    /**
     * Метод DELETE
     * Удаление отдельной записи (по ее id)
     * http://ДОМЕН/${table_name}?id=
     * @return string
     */
    public function deleteAction()
    {
        if( isset($this->requestParams['id']) and is_numeric($this->requestParams['id']) ){
            
            $id = htmlspecialchars(trim($this->requestParams['id'])) ?? '';
        
            $database = new Database();
            $link = $database->get_db_link();

            if ($database->exist_in_table($id, $this->table_name)){
                $sql = "DELETE FROM `".$this->table_name."` WHERE id = ".$id."";
                if (mysqli_query($link, $sql)){
                    return $this->response('Object deleted', 200);
                }
                return $this->response('Internal Server Error', 500);
            }
            return $this->response('Not Found object with id = '.$id.'', 204);

            $link = $database->close_db_link();
        }
        return $this->response('Bad Request', 400);
    }
    
}