<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    public $table_name;
    public $views = array("view_users"
                        , "view_courses"
                        , "view_disciplines"
                        , "view_fgos"
                        , "view_profs"
                        , "view_teachers"
                        , "view_tfuns"
                        , "view_acts");
    public function json_validation($data){}

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