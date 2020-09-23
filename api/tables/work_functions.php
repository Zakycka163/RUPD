<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "work_functions";

    /* JSON:
    {
        "general_work_function_id": "int",
        "code": "string",
        "name": "string"
    } 
    */    
    public function json_validation($data){
        return (isset($data->general_work_function_id)  and is_numeric($data->general_work_function_id)
          and   isset($data->code)                      and is_string($data->code)
          and   isset($data->name)                      and is_string($data->name)
        );
    }
}