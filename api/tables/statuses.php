<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "statuses";

    /*
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/statuses + JSON
     * 
    {
        "value": string
    }
     * 
     * @return string
     */
    public function createAction()
    {
        $data = json_decode(file_get_contents("php://input"));

        if(!empty($data->value)){
            
            $database = new Database();
            $link = $database->get_db_link();
            $sql = "INSERT INTO `".$this->table_name."` (`value`) VALUES ('".$data->value."')";
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
     * http://ДОМЕН/statuses?id= + JSON
     * 
    { 
        "value": string 
    }
     * 
     * @return string
     */
    public function updateAction()
    {
        $id = $this->requestParams['id'] ?? '';
        $data = json_decode(file_get_contents("php://input"));

        if( is_numeric($id) and !empty($data->value)){

            $database = new Database();
            $link = $database->get_db_link();
            $sql_check = "SELECT 1 FROM `".$this->table_name."` WHERE id = ".$id."";
            $result_check = mysqli_query($link, $sql_check);

            if (mysqli_num_rows($result_check) == 1){
                
                $sql = "UPDATE `".$this->table_name."` SET `value` = '".$data->value."' WHERE id = ".$id."";
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