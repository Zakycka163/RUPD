<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "constants";

    /**
     * Метод GET
     * Вывод списка всех записей
     * http://ДОМЕН/constants
     * @return string
     */
    public function indexAction(){
        $database = new Database();
        $link = $database->get_db_link();
		$sql = "SELECT * FROM `".$this->table_name."`";
		$result = mysqli_query($link, $sql);
        
        if ( mysqli_num_rows($result) > 0) {
            $response_body = array('total' => (int)mysqli_num_rows($result));
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
     * Просмотр отдельной записи (по key)
     * http://ДОМЕН/constants?key=
     * @return string
     */
    public function viewAction(){

        $key = htmlspecialchars(trim($this->requestParams['key'] ?? ''));

        if( is_string($key) ){

            $database = new Database();
            $link = $database->get_db_link();
            $sql = "SELECT * FROM `".$this->table_name."` WHERE `key` = '".$key."'";
            $result = mysqli_query($link, $sql);

            if (mysqli_num_rows($result) == 1) {
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
            } return $this->response('Not Found object with key = '.$key.'', 404);
            $link = $database->close_db_link();
        }
        return $this->response('Bad Request', 400);

    }

     /*
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/constants + JSON
     * 
    {
        "key": string
        "value": string
    }
     * 
     * @return string
     */
    public function createAction(){
        return $this->response('Method Not Allowed', 405);
    }

    /*
     * Метод PUT
     * Обновление отдельной записи (по ее key)
     * http://ДОМЕН/constants?key= + JSON
     * 
    { 
        "value": string 
    }
     * 
     * @return string
     */
    public function updateAction(){
        $key = htmlspecialchars(trim($this->requestParams['key'] ?? ''));
        $data = json_decode(file_get_contents("php://input"));
        $value = $data->value ?? '';

        if( is_string($key) and !empty($value)){

            $database = new Database();
            $link = $database->get_db_link();
            $sql_check = "SELECT 1 FROM `".$this->table_name."` WHERE `key` = '".$key."'";
            $result_check = mysqli_query($link, $sql_check);

            if (mysqli_num_rows($result_check) == 1){
                
                $sql = "UPDATE `".$this->table_name."` SET `value` = '".$value."' WHERE `key` = '".$key."'";
                if (mysqli_query($link, $sql)) {
                    return $this->response('Object updated.', 200);
                }
                return $this->response(mysqli_error($link), 500);
               
            } 
            return $this->response('Not Found object with key = '.$key.'', 404);

            $link = $database->close_db_link();
        }
        return $this->response('Bad Request', 400);
    }

    /**
     * Метод DELETE
     * Удаление отдельной записи (по ее key)
     * http://ДОМЕН/constants?key=
     * @return string
     */
    public function deleteAction(){
        return $this->response('Method Not Allowed', 405);
    }
}