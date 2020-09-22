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