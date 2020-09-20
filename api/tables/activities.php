<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "activities";

    /* JSON:
    {
        "activity_type_id": "int",
        "work_function_id": "int",
        "name": "string",
        "competence_id": "int"
    }
    */
    public function json_validation($data){
        if (  isset($data->activity_type_id)  and is_numeric($data->activity_type_id)
        and   isset($data->name)              and is_string($data->name)
        and ((isset($data->work_function_id)  and is_numeric($data->work_function_id)) or (!isset($data->work_function_id)))
        and ((isset($data->competence_id)     and is_numeric($data->competence_id)) or (!isset($data->competence_id)))){
            return TRUE;
        }
        return FALSE;
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
        if ($this->json_validation($data)){
            $database = new Database();
            $errors = $database->validate_input_data($this->table_name, $data);
            if (empty($errors)) {
                $errors = $database->ids_exists_in_tables(array($data->activity_type_id, $data->work_function_id, $data->competence_id)
                                                         ,array("activity_types",        "work_functions",        "competencies"));
                if (empty($errors)) {
                    $result = $database->insert_data_to_table($data, $this->table_name);
                    if ($result == 'ok'){
                        return $this->response('Object created', 201);
                    }
                    return $this->response($result, 500);
                }
                return $this->response($errors, 400);
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
            $id = htmlspecialchars(trim($this->requestParams['id'])) ?? '';
            $database = new Database();
            if ($database->exist_in_table($id, $this->table_name)){
                $errors = $database->validate_input_data($this->table_name, $data);
                if (empty($errors)) {
                    $errors = $database->ids_exists_in_tables(array($data->activity_type_id, $data->work_function_id, $data->competence_id)
                                                             ,array("activity_types",        "work_functions",        "competencies"));
                    if (empty($errors)) {
                        $result = $database->update_data_to_table($id, $data, $this->table_name);
                        if ($result == 'ok'){
                            return $this->response('Object updated', 200);
                        }
                        return $this->response($result, 500);
                    }
                    return $this->response($errors, 400);
                }
                return $this->response($errors, 400);
            } 
            return $this->response('Not Found object with id = '.$id.'', 404);
        }
        return $this->response('Bad Request', 400);
    }
}