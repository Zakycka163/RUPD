<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "study_forms";

    /* JSON:
    {
        "name": "string"
    } 
    */    
    public function json_validation($data){
        return (isset($data->name) and is_string($data->name));
    }
}