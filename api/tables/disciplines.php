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

            $errors = $database->validate_input_data($this->table_name, $data);
            
            if (empty($errors)) {

                $check_exist = array("pulpit_id = ".$data->pulpit_id."" => $database->exist_in_table($data->pulpit_id, "pulpits"));
                $check_exist += array("part_id = ".$data->part_id."" => $database->exist_in_table($data->part_id, "parts"));
                $check_exist += array("module_id = ".$data->module_id."" => $database->exist_in_table($data->module_id, "modules"));

                foreach ($check_exist as $key => $val){
                    if ($val){
                        unset($check_exist[$key]);
                    } else {
                        $check_exist[$key] = "Object not found";
                    }
                }
                if (empty($check_exist)) {
                    $sql = "INSERT INTO `".$this->table_name."` (  `pulpit_id`
                                                                , `part_id`
                                                                , `module_id`
                                                                , `index_info`
                                                                , `name`
                                                                , `time`) 
                            VALUES                              ('".$data->pulpit_id."'
                                                                ,'".$data->part_id."'
                                                                ,'".$data->module_id."'
                                                                ,'".$data->index_info."'
                                                                ,'".$data->name."'
                                                                ,'".$data->time."')";
                    if (mysqli_query($link, $sql)){
                        return $this->response('Object created', 201);
                    } else {
                        return $this->response(mysqli_error($link), 500);
                    }
                }
                return $this->response($check_exist, 400);
            }
            $link = $database->close_db_link();
            return $this->response($errors, 400);
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
        
        $data = json_decode(file_get_contents("php://input"));

        if( 
            isset($this->requestParams['id'])   and is_numeric($this->requestParams['id'])
        and isset($data->pulpit_id)             and is_int($data->pulpit_id)
        and isset($data->part_id)               and is_int($data->part_id)
        and isset($data->module_id)             and is_int($data->module_id)
        and isset($data->index_info)            and is_string($data->index_info)
        and isset($data->name)                  and is_string($data->name)
        and isset($data->time)                  and is_int($data->time)
            ){

            $id = htmlspecialchars(trim($this->requestParams['id'])) ?? '';
            $database = new Database();
            $link = $database->get_db_link();

            if ($database->exist_in_table($id, $this->table_name)){
                
                $errors = $database->validate_input_data($this->table_name, $data);
                if (empty($errors)) {

                    $check_exist = array("pulpit_id = ".$data->pulpit_id."" => $database->exist_in_table($data->pulpit_id, "pulpits"));
                    $check_exist += array("part_id = ".$data->part_id."" => $database->exist_in_table($data->part_id, "parts"));
                    $check_exist += array("module_id = ".$data->module_id."" => $database->exist_in_table($data->module_id, "modules"));

                    foreach ($check_exist as $key => $val){
                        if ($val){
                            unset($check_exist[$key]);
                        } else {
                            $check_exist[$key] = "Object not found";
                        }
                    }
                    if (empty($check_exist)) {
                        $sql = "UPDATE `".$this->table_name."` SET `pulpit_id` = '".$data->pulpit_id."'
                                                                 , `part_id` = '".$data->part_id."'
                                                                 , `module_id` = '".$data->module_id."'
                                                                 , `index_info` = '".$data->index_info."'
                                                                 , `name` = '".$data->name."'
                                                                 , `time` = '".$data->time."'
                                                                WHERE id = ".$id."";
                        if (mysqli_query($link, $sql)) {
                            return $this->response('Object updated.', 200);
                        }
                        return $this->response(mysqli_error($link), 500);
                    }
                    return $this->response($check_exist, 400);

                }
                return $this->response($errors, 400);
            } 
            return $this->response('Not Found object with id = '.$id.'', 204);
            $link = $database->close_db_link();
        }
        return $this->response('Bad Request', 400);
    }

    
}