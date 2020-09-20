<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "competence_types";

    /* JSON:
    {
        "name": "string",
        "code": "string"
    } 
    */    
    public function json_validation($data){
        if (isset($data->name)     and is_string($data->name)
        and isset($data->code)     and is_string($data->code)){
            return TRUE;
        }
        return FALSE;
    }
}