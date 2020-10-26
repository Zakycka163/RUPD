<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "accounts";

    /* JSON:
    {
        "login": "string",
        "password": "string",
        "teacher_id": "int",
        "grant_id": "int"
    }
    */
    public function json_validation($data){
        return (isset($data->login)       and is_string($data->login)
          and   isset($data->password)    and is_string($data->password)
          and   isset($data->teacher_id)  and is_numeric($data->teacher_id)
          and   isset($data->grant_id)    and is_string($data->grant_id)
        );
    }
}