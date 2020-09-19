<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "activities";

    /*
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/${table_name} + JSON
     * 
    {
        "activity_type_id": "int",
        "work_function_id": "int",
        "name": "string",
        "competence_id": "int"
    }
     * 
     * @return string
     */
    public function createAction()
    {
        $data = json_decode(file_get_contents("php://input"));

        if (     
            isset($data->pulpit_id)     and is_numeric($data->pulpit_id)
        and isset($data->part_id)       and is_numeric($data->part_id)
        and isset($data->module_id)     and is_numeric($data->module_id)
        and isset($data->index_info)    and is_string($data->index_info)
        and isset($data->name)          and is_string($data->name)
        and isset($data->time)          and is_numeric($data->time)
            ){
            
            $database = new Database();
            $link = $database->get_db_link();

            $errors = $database->validate_input_data($this->table_name, $data);
            
            if (empty($errors)) {

                $errors = $database->ids_exists_in_tables(array($data->pulpit_id, $data->part_id, $data->module_id)
                                                         ,array("pulpits",          "parts",        "modules"));

                if (empty($errors)) {
                    $sql = "INSERT INTO `".$this->table_name."` ( `pulpit_id`
                                                                , `part_id`
                                                                , `module_id`
                                                                , `index_info`
                                                                , `name`
                                                                , `time`) 
                            VALUES                              (".$data->pulpit_id."
                                                                ,".$data->part_id."
                                                                ,".$data->module_id."
                                                                ,'".$data->index_info."'
                                                                ,'".$data->name."'
                                                                ,'".$data->time."')";
                    if (mysqli_query($link, $sql)){
                        return $this->response('Object created', 201);
                    } else {
                        return $this->response(mysqli_error($link), 500);
                    }
                }
                return $this->response($errors, 400);
            }
            $link = $database->close_db_link();
            return $this->response($errors, 400);
        }
        return $this->response("Bad Request", 400);
    }

    /*
     * Метод PUT
     * Обновление отдельной записи (по ее id)
     * http://ДОМЕН/${table_name}?id= + JSON
     * 
    {
        "activity_type_id": "int",
        "work_function_id": "int",
        "name": "string",
        "competence_id": "int"
    }
     * 
     * @return string
     */
    public function updateAction()
    {
        
        $data = json_decode(file_get_contents("php://input"));

        if( 
            isset($this->requestParams['id'])   and is_numeric($this->requestParams['id'])
        and isset($data->pulpit_id)             and is_numeric($data->pulpit_id)
        and isset($data->part_id)               and is_numeric($data->part_id)
        and isset($data->module_id)             and is_numeric($data->module_id)
        and isset($data->index_info)            and is_string($data->index_info)
        and isset($data->name)                  and is_string($data->name)
        and isset($data->time)                  and is_numeric($data->time)
            ){

            $id = htmlspecialchars(trim($this->requestParams['id'])) ?? '';
            $database = new Database();
            $link = $database->get_db_link();

            if ($database->exist_in_table($id, $this->table_name)){
                
                $errors = $database->validate_input_data($this->table_name, $data);
                if (empty($errors)) {

                    $errors = $database->ids_exists_in_tables(array($data->pulpit_id, $data->part_id, $data->module_id)
                                                             ,array("pulpits",          "parts",        "modules"));

                    if (empty($errors)) {
                        $sql = "UPDATE `".$this->table_name."` 
                                SET `pulpit_id`     = ".$data->pulpit_id."
                                  , `part_id`       = ".$data->part_id."
                                  , `module_id`     = ".$data->module_id."
                                  , `index_info`    = '".$data->index_info."'
                                  , `name`          = '".$data->name."'
                                  , `time`          = '".$data->time."'
                                WHERE id = ".$id."";
                        if (mysqli_query($link, $sql)) {
                            return $this->response('Object updated.', 200);
                        }
                        return $this->response(mysqli_error($link), 500);
                    }
                    return $this->response($errors, 400);

                }
                return $this->response($errors, 400);
            } 
            return $this->response('Not Found object with id = '.$id.'', 404);
            $link = $database->close_db_link();
        }
        return $this->response('Bad Request', 400);
    }
    
}