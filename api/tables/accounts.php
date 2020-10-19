<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "accounts";

    /* JSON:
    {
        "login": "string",
        "password": "string",
        "teacher_id": "int",
        "grant_id": "int"
    }
    */
    public function json_validation($data){
        return (isset($data->login)       and is_string($data->login)
          and   isset($data->password)    and is_string($data->password)
          and   isset($data->teacher_id)  and is_numeric($data->teacher_id)
          and   isset($data->grant_id)    and is_string($data->grant_id)
        );
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
        $count_sql = "SELECT count(*) FROM `".$this->table_name."`";
        $count_rows = mysqli_fetch_array(mysqli_query($link, $count_sql))[0];
        if ( $count_rows > 0) {
            $sql = "SELECT * FROM `".$this->table_name."` LIMIT ".$start.",".$limit."";
		    $result = mysqli_query($link, $sql);   
            $response_body = array('total' => (int)$count_rows, 'limit' => (int)$limit,'round' => (int) $round);
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
                    if($columns[$i] == 'password'){
                        $obj[$columns[$i]] = null;
                    } else {
                        $obj[$columns[$i]] = $row[$i];
                    }
                }
                $number++;
                $objs[] = $obj;
            }
            $response_body[$this->table_name] = $objs;
            return $this->response($response_body, 200);
        }
        $link = $database->close_db_link();
        return $this->response('Not Found objects in '.$this->table_name, 200);
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
                        if($columns[$i] == 'password'){
                            $obj[$columns[$i]] = null;
                        } else {
                            $obj[$columns[$i]] = $row[$i];
                        }
                    }
                }
                return $this->response($obj, 200);
            } return $this->response('Not Found object with id = '.$id.'', 200);
            $link = $database->close_db_link();
        }
        return $this->response('Bad Request', 400);
    }

    /**
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/${table_name} + JSON
     * @return string
     */
    public function createAction()
    {
        $data = json_decode(file_get_contents("php://input"));  
        if($this->json_validation($data)){
            $data->password = htmlspecialchars(md5(md5(trim($data->password))));
            $database = new Database();
            $errors = $database->validate_input_data($this->table_name, $data);
            if (empty((array)$errors)) {
                $result = $database->insert_data_to_table($data, $this->table_name);
                if ($result == 'ok'){
                    return $this->response('Object created', 201);
                }
                return $this->response($result, 500);
            }
            return $this->response($errors, 400);
        } 
        return $this->response("Bad Request", 400);
    }

    /**
     * Метод PUT
     * Обновление отдельной записи (по ее id)
     * http://ДОМЕН/${table_name}?id= + JSON
     * @return string
     */
    public function updateAction()
    {
        $data = json_decode(file_get_contents("php://input"));
        if(isset($this->requestParams['id']) and is_numeric($this->requestParams['id']) and $this->json_validation($data)){
            $id = htmlspecialchars(trim($this->requestParams['id'] ?? ''));
            $data->password = htmlspecialchars(md5(md5(trim($data->password))));
            $database = new Database();
            if ($database->exist_in_table($id, $this->table_name)){
                $errors = $database->validate_input_data($this->table_name, $data);
                if (empty((array)$errors)) {
                    $result = $database->update_data_to_table($id, $data, $this->table_name);
                    if ($result == 'ok'){
                        return $this->response('Object updated', 200);
                    }
                    return $this->response($result, 500); 
                } 
                return $this->response($errors, 400);
            }
            return $this->response('Not Found object with id = '.$id.'', 404);
        }
        return $this->response('Bad Request', 400);
    }

}