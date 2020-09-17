<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "disciplines";

    /*
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/disciplines + JSON
     * 
    {
        "pulpit_id": "int",
        "part_id": "int",
        "module_id": "int",
        "index_info": "string",
        "name": "string",
        "time": "int"
    }
     * 
     * @return string
     */
    public function createAction()
    {
        $data = json_decode(file_get_contents("php://input"));

        if (     
            isset($data->pulpit_id)     and is_int($data->pulpit_id)
        and isset($data->part_id)       and is_int($data->part_id)
        and isset($data->module_id)     and is_int($data->module_id)
        and isset($data->index_info)    and is_string($data->index_info)
        and isset($data->name)          and is_string($data->name)
        and isset($data->time)          and is_int($data->time)
            ){
            
            $database = new Database();
            $link = $database->get_db_link();

            $arr_length = $database->get_max_length_for_fields_in_table($this->table_name);

            // Проблемное место

            $arr_fields = array_keys($arr_length);
            $arr_error = array();

            while($row = $arr_fields){ 
                
                if (!(strlen($data->$row[0]) > 0 and strlen($data->$row[0]) <= $arr_length[$row[0]])){
                    $arr_error += array($row[0] => "Value length must be less than " . $arr_length[$row[0]] . "!");
                    return $this->response('Object created', 201);
                }
            }
            
            if (empty($arr_error)) {

                return $this->response('Object created', 201);
                /*$sql = "INSERT INTO `".$this->table_name."` (`name`) VALUES ('".$data->name."')";
                if (mysqli_query($link, $sql)){
                    return $this->response('Object created', 201);
                } else {
                    return $this->response(mysqli_error($link), 500);
                }*/
 
            }
            $link = $database->close_db_link();
            return $this->response($arr_error, 400);
        }
        return $this->response("Bad Request", 400);
    }

    /*
     * Метод PUT
     * Обновление отдельной записи (по ее id)
     * http://ДОМЕН/disciplines?id= + JSON
     * 
    {
        "pulpit_id": "int",
        "part_id": "int",
        "module_id": "int",
        "index_info": "string",
        "name": "string",
        "time": "int" 
    }
     * 
     * @return string
     */
    public function updateAction()
    {
        $id = $this->requestParams['id'] ?? '';
        $data = json_decode(file_get_contents("php://input"));

        if( is_numeric($id) and !empty($data->name)){

            $database = new Database();
            $link = $database->get_db_link();
            $sql_check = "SELECT 1 FROM `".$this->table_name."` WHERE id = ".$id."";
            $result_check = mysqli_query($link, $sql_check);

            if (mysqli_num_rows($result_check) == 1){
                
                $sql = "UPDATE `".$this->table_name."` SET `name` = '".$data->name."' WHERE id = ".$id."";
                if (mysqli_query($link, $sql)) {
                    return $this->response('Object updated.', 200);
                }
                return $this->response(mysqli_error($link), 500);
               
            } 
            return $this->response('Not Found object with id = '.$id.'', 204);

            $link = $database->close_db_link();
        }
        return $this->response('Bad Request', 400);
    }

    
}