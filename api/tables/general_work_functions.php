<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "general_work_functions";

    /* JSON:
    {
        "prof_standard_id": "int",
        "code": "string",
        "name": "string",
        "level": "int"
    } 
    */    
    public function json_validation($data){
        return (isset($data->prof_standard_id)  and is_numeric($data->prof_standard_id)
          and   isset($data->code)              and is_string($data->code)
          and   isset($data->name)              and is_string($data->name)
          and ((isset($data->level)             and is_numeric($data->level)) or !isset($data->level))
        );
    }
}