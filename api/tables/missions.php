<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "missions";

    /* JSON:
    {
        "task_id": "int",
        "document_id": "int",
        "status_id": "int",
        "description": "string"
    } 
    */    
    public function json_validation($data){
        return (isset($data->task_id)       and is_numeric($data->task_id)
          and   isset($data->document_id)   and is_numeric($data->document_id)
          and   isset($data->status_id)     and is_numeric($data->status_id)
          and ((isset($data->description)   and is_string($data->description)) or !isset($data->description))
        );
    }
}