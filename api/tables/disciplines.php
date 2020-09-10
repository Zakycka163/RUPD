<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "disciplines";

    /*
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/disciplines + параметры запроса name, email
     * @return string
     */
    public function createAction()
    {
        $data = json_decode(file_get_contents("php://input"));

        if(!empty($data->name)){
            
            $database = new Database();
            $link = $database->get_db_link();
            
            #TODO
            return $this->response('Data saved.', 200);
            $link = $database->close_db_link();
        }
        return $this->response("Saving error", 500);
    }

    /**
     * Метод PUT
     * Обновление отдельной записи (по ее id)
     * http://ДОМЕН/users/1 + параметры запроса name, email
     * @return string
     */
    public function updateAction()
    {
        $parse_url = parse_url($this->requestUri[0]);
        $userId = $parse_url['path'] ?? null;

        $database = new Database();
        $link = $database->get_db_link();

        $name = $this->requestParams['name'] ?? '';
        $email = $this->requestParams['email'] ?? '';

        if($name && $email){
            #TODO
            return $this->response('Data updated.', 200);
        }
        $link = $database->close_db_link();
        return $this->response("Update error", 400);
    }
    
}