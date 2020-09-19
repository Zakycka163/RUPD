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
        if (  isset($data->activity_type_id)  and is_numeric($data->activity_type_id)
        and   isset($data->name)              and is_string($data->name)
        and ((isset($data->work_function_id)  and is_numeric($data->work_function_id)) or (!isset($data->work_function_id)))
        and ((isset($data->competence_id)     and is_numeric($data->competence_id)) or (!isset($data->competence_id)))
            ){
            $database = new Database();
            $link = $database->get_db_link();
            $errors = $database->validate_input_data($this->table_name, $data);
            if (empty($errors)) {
                $errors = $database->ids_exists_in_tables(array($data->activity_type_id, $data->work_function_id, $data->competence_id)
                                                         ,array("activity_types",        "work_functions",        "competencies"));
                if (empty($errors)) {
                    $sql = "INSERT INTO `".$this->table_name."` ( `activity_type_id`
                                                                , `work_function_id`
                                                                , `name`
                                                                , `competence_id`) 
                            VALUES                              (".$data->activity_type_id."
                                                                ,".(!isset($data->work_function_id)?"NULL":$data->work_function_id)."
                                                                ,'".$data->name."'
                                                                ,".(!isset($data->competence_id)?"NULL":$data->competence_id).")";
                    if (mysqli_query($link, $sql)){
                        return $this->response('Object created', 201);
                    }
                    return $this->response(mysqli_error($link), 500);
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
        if(   isset($this->requestParams['id']) and is_numeric($this->requestParams['id'])
        and   isset($data->activity_type_id)    and is_numeric($data->activity_type_id)
        and   isset($data->name)                and is_string($data->name)
        and ((isset($data->work_function_id)    and is_numeric($data->work_function_id)) or (!isset($data->work_function_id)))
        and ((isset($data->competence_id)       and is_numeric($data->competence_id)) or (!isset($data->competence_id)))
            ){
            $id = htmlspecialchars(trim($this->requestParams['id'])) ?? '';
            $database = new Database();
            $link = $database->get_db_link();
            if ($database->exist_in_table($id, $this->table_name)){
                $errors = $database->validate_input_data($this->table_name, $data);
                if (empty($errors)) {
                    $errors = $database->ids_exists_in_tables(array($data->activity_type_id, $data->work_function_id, $data->competence_id)
                                                             ,array("activity_types",        "work_functions",        "competencies"));
                    if (empty($errors)) {
                        $sql = "UPDATE `".$this->table_name."` 
                                SET `activity_type_id`  = ".$data->activity_type_id."
                                  , `name`              = '".$data->name."'
                                  , `work_function_id`  = ".(!isset($data->work_function_id)?"NULL":$data->work_function_id)."
                                  , `competence_id`     = ".(!isset($data->competence_id)?"NULL":$data->competence_id)."
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