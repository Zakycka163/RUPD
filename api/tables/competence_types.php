<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "competence_types";

    /*
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/${table_name} + JSON
     * 
    {
        "name": "string",
        "code": "string"
    }
     * 
     * @return string
     */
    public function createAction()
    {
        $data = json_decode(file_get_contents("php://input"));

        if (     
            isset($data->name)     and is_int($data->name)
        and isset($data->code)     and is_int($data->code)
            ){
            
            $database = new Database();
            $link = $database->get_db_link();

            $errors = $database->validate_input_data($this->table_name, $data);
            
            if (empty($errors)) {
                $sql = "INSERT INTO `".$this->table_name."` ( `name`
                                                            , `code`) 
                        VALUES                              ('".$data->name."'
                                                            ,'".$data->part_id."')";
                if (mysqli_query($link, $sql)){
                    return $this->response('Object created', 201);
                } else {
                    return $this->response(mysqli_error($link), 500);
                }
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
        "name": "string",
        "code": "string"
    }
     * 
     * @return string
     */
    public function updateAction()
    {
        
        $data = json_decode(file_get_contents("php://input"));

        if( 
            isset($this->requestParams['id'])   and is_numeric($this->requestParams['id'])
        and isset($data->name)                  and is_int($data->name)
        and isset($data->code)                  and is_int($data->code)
            ){

            $id = htmlspecialchars(trim($this->requestParams['id'])) ?? '';
            $database = new Database();
            $link = $database->get_db_link();

            if ($database->exist_in_table($id, $this->table_name)){
                
                $errors = $database->validate_input_data($this->table_name, $data);
                if (empty($errors)) {
                    $sql = "UPDATE `".$this->table_name."` 
                            SET `name`  = '".$data->name."'
                              , `code`  = '".$data->code."'
                            WHERE id = ".$id."";
                    if (mysqli_query($link, $sql)) {
                        return $this->response('Object updated.', 200);
                    }
                    return $this->response(mysqli_error($link), 500);
                }
                return $this->response($errors, 400);
            } 
            return $this->response('Not Found object with id = '.$id.'', 404);
            $link = $database->close_db_link();
        }
        return $this->response('Bad Request', 400);
    }
    
}