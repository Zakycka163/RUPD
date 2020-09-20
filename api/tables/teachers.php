<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "teachers";

    /* JSON:
    {
        "first_name": "string",
        "middle_name": "string",
        "second_name": "string",
        "email": "string",
        "academic_degree_id": "int",
        "academic_rank_id": "int"
    }
    */
    public function json_validation($data){
        if (  isset($data->first_name)           and is_string($data->first_name)
        and   isset($data->second_name)          and is_string($data->second_name)
        and   isset($data->email)                and is_string($data->email)
        and ((isset($data->middle_name)          and is_string($data->middle_name))         or !isset($data->middle_name))
        and ((isset($data->academic_degree_id)   and is_numeric($data->academic_degree_id)) or !isset($data->academic_degree_id))
        and ((isset($data->academic_rank_id)     and is_numeric($data->academic_rank_id))   or !isset($data->academic_rank_id))){
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
            $data->middle_name = (!isset($data->middle_name))?'':htmlspecialchars($data->middle_name);  
            $database = new Database();
            $errors = $database->validate_input_data($this->table_name, $data); 
            if (empty($errors)) {
                $errors = $database->ids_exists_in_tables(array($data->academic_degree_id, $data->academic_rank_id)
                                                         ,array("academic_degrees",          "academic_ranks"));
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
            $data->middle_name = (!isset($data->middle_name))?'':htmlspecialchars($data->middle_name);
            $database = new Database();
            if ($database->exist_in_table($id, $this->table_name)){
                $errors = $database->validate_input_data($this->table_name, $data);
                if (empty($errors)) {
                    $errors = $database->ids_exists_in_tables(array($data->academic_degree_id, $data->academic_rank_id)
                                                             ,array("academic_degrees",          "academic_ranks"));
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