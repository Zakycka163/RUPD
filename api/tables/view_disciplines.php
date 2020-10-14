<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "view_disciplines";

    /* JSON:
    {
        "name": "string",
        "index_info": "string",
        "kaf_id": "int",
        "kaf": "string",
        "module_id": "int",
        "module": "string",
        "part_id": "int",
        "part": "string",
        "time": "int"
    } 
    */
    public function json_validation($data){
        
    }

    /**
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/${table_name} + JSON
     * @return string
     */
    public function createAction()
    {
        return $this->response('Method Not Allowed', 405);
    }

    /**
     * Метод PUT
     * Обновление отдельной записи (по ее id)
     * http://ДОМЕН/${table_name}?id= + JSON
     * @return string
     */
    public function updateAction()
    {
        return $this->response('Method Not Allowed', 405);
    }

    /**
     * Метод DELETE
     * Удаление отдельной записи (по ее id)
     * http://ДОМЕН/${table_name}?id=
     * @return string
     */
    public function deleteAction()
    {
        return $this->response('Method Not Allowed', 405);
    }
}