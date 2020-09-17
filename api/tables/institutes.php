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
        "name": string,
        "description": string
    }
     * 
     * @return string
     */
    public function createAction()
    {
        $data = json_decode(file_get_contents("php://input"));

        if(!empty($data->name)){

            if (!isset($data->description)){
                $data->description = '';
            }
            
            $database = new Database();
            $link = $database->get_db_link();
            $sql = "INSERT INTO `".$this->table_name."` (`name`, `description`) VALUES ('".$data->name."', )";
            if (mysqli_query($link, $sql)){
                return $this->response('Object created', 200);
            } else {
                return $this->response(mysqli_error($link), 500);
            }
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
        "name": string,
        "description": string 
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

            if ($database->exist_in_table($id, $this->table_name)){
                
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