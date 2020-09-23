<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "pulpits";

    /* JSON:
    {
        "institute_id": "int",
        "name": "string",
        "description": "string"
    }
    */
    public function json_validation($data){
        return (isset($data->institute_id)  and is_numeric($data->institute_id)
          and   isset($data->name)          and is_string($data->name)
          and ((isset($data->description)   and is_string($data->description)) or (!isset($data->work_function_id)))
        );
    }
}