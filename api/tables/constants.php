<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "constants";

    /* JSON:
    { 
        "text_val": "string",
        "int_val": "int"
    }
    */
    public function json_validation($data){
        return ((isset($data->int_val)    and is_numeric($data->int_val)) 
             or (isset($data->text_val)   and is_string($data->text_val))
        );
    }

    /**
     * Метод GET
     * Вывод списка всех записей
     * http://ДОМЕН/${table_name}
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
        return $this->response('Not Found objects in '.$this->table_name, 200);
    }

    /**
     * Метод GET
     * Просмотр отдельной записи (по key)
     * http://ДОМЕН/${table_name}?key=
     * @return string
     */
    public function viewAction(){   

        if( isset($this->requestParams['key']) and is_string($this->requestParams['key']) ){
            $key = htmlspecialchars(trim($this->requestParams['key'] ?? ''));
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
            } return $this->response('Not Found object with key = '.$key.'', 200);
            $link = $database->close_db_link();
        }
        return $this->response('Bad Request', 400);

    }

    /**
     * Метод PUT
     * Обновление отдельной записи (по ее key)
     * http://ДОМЕН/${table_name}?key= + JSON
     * @return string
     */
    public function updateAction(){
        $data = json_decode(file_get_contents("php://input"));
        if (isset($this->requestParams['key']) and is_string($this->requestParams['key']) and $this->json_validation($data)){
            $key = htmlspecialchars(trim($this->requestParams['key'] ?? ''));
            if ( isset($data->int_val) ){
                $data->text_val = null;
            } elseif ( isset($data->text_val) ){
                $data->int_val = null;
            }
            $filter = "`key` = '".$key."'";
            $database = new Database();
            $link = $database->get_db_link();
            if ($database->exist_in_table_by_filter($filter, $this->table_name)) {
                $errors = $database->validate_input_data($this->table_name, $data);
                if (empty((array)$errors)) {           
                        $sql = "UPDATE `".$this->table_name."` 
                                SET int_val = ";
                        $sql .= isset($data->int_val)?($data->int_val):("NULL");
                        $sql .= ", text_val = ";
                        $sql .= isset($data->text_val)?("'".$data->text_val."'"):("NULL");
                        $sql .= " WHERE `key` = '".$key."'";
                        if (mysqli_query($link, $sql)) {
                            return $this->response('Object updated.', 200);
                        }
                        return $this->response(mysqli_error($link), 500);
                } return $this->response($errors, 400); 
            } 
            $link = $database->close_db_link();
            return $this->response('Not Found object with '.$filter.'', 404);
        }
        return $this->response('Bad Request', 400);
    }

    /**
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/${table_name} + JSON
     * @return string
     */
    public function createAction(){
        return $this->response('Method Not Allowed', 405);
    }

    /**
     * Метод DELETE
     * Удаление отдельной записи (по ее key)
     * http://ДОМЕН/${table_name}?key=
     * @return string
     */
    public function deleteAction(){
        return $this->response('Method Not Allowed', 405);
    }
}