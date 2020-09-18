<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "institutes";

    /*
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/institutes + JSON
     * 
    {
        "name": "string",
        "description": "string"
    }
     * 
     * @return string
     */
    public function createAction()
    {
        $data = json_decode(file_get_contents("php://input"));

        if (     
                isset($data->name)          and is_string($data->name) 
            and ( 
                (isset($data->description)  and is_string($data->description) ))
                or (!isset($data->description))
            ){

            if (!isset($data->description)){
                $data->description = '';
            }
            
            $database = new Database();
            $link = $database->get_db_link();
            $errors = $database->validate_input_data($this->table_name, $data);

            if (empty($errors)) {
                $sql = "INSERT INTO `".$this->table_name."` (`name`, `description`) VALUES ('".$data->name."', '".$data->description."')";
                if (mysqli_query($link, $sql)){
                    return $this->response('Object created', 201);
                } else {
                    return $this->response(mysqli_error($link), 500);
                }
            }
            return $this->response($errors, 400);
            $link = $database->close_db_link();
        } else {
            return $this->response("Bad Request", 400);
        }
    }

    /*
     * Метод PUT
     * Обновление отдельной записи (по ее id)
     * http://ДОМЕН/institutes?id= + JSON
     * 
    { 
        "name": "string",
        "description": "string"
    }
     * 
     * @return string
     */
    public function updateAction()
    {
        $id = $this->requestParams['id'] ?? '';
        $data = json_decode(file_get_contents("php://input"));

        if( isset($this->requestParams['id']) and is_numeric($this->requestParams['id']) ){

            $database = new Database();
            $link = $database->get_db_link();

            if ($database->exist_in_table($id, $this->table_name)){
                
                $sql = "UPDATE `".$this->table_name."` SET `name` = '".$data->name."', `description` = '".$data->description."' WHERE id = ".$id."";
                if (mysqli_query($link, $sql)) {
                    return $this->response('Object updated.', 200);
                }
                return $this->response(mysqli_error($link), 500);
               
            } 
            return $this->response('Not Found object with id = '.$id.'', 404);

            $link = $database->close_db_link();
        }
        return $this->response('Bad Request', 400);
    }
}