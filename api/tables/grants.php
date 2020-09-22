<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "grants";

    /* JSON:
    { 
        "access": "string",
        "description": "string"
    }
    */
    public function json_validation($data){
        if ( isset($data->access)       and is_string($data->access) 
        and (isset($data->description)  and is_string($data->description) or (!isset($data->description)))){
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Метод PUT
     * Обновление отдельной записи (по ее id)
     * http://ДОМЕН/${table_name}?id= + JSON
     * @return string
     */
    public function updateAction(){
        $data = json_decode(file_get_contents("php://input"));
        if (isset($this->requestParams['id']) and is_string($this->requestParams['id']) and $this->json_validation($data)){
            $id = htmlspecialchars(trim($this->requestParams['id'] ?? ''));
            $data->description = (isset($data->description))?htmlspecialchars($data->description):null;
            $database = new Database();
            $errors = $database->validate_input_data($this->table_name, $data);
            if (empty($errors)) {
                if ($database->exist_in_table($id, $this->table_name)){   
                    $result = $database->update_data_to_table($id, $data, $this->table_name);
                    if ($result == 'ok'){
                        return $this->response('Object updated', 200);
                    }
                    return $this->response($result, 500); 
                } 
                return $this->response('Not Found object with id = '.$id.'', 404);
            }
            return $this->response($errors, 400);
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