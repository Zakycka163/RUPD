<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "documents";

    /* JSON:
    {
        "document_type_id": "int",
        "discipline_id": "int",
        "profile_id": "int",
        "goal": "string",
        "path": "string"
    } 
    */    
    public function json_validation($data){
        return (isset($data->document_type_id)  and is_numeric($data->document_type_id)
          and   isset($data->discipline_id)     and is_numeric($data->discipline_id)
          and   isset($data->profile_id)        and is_numeric($data->profile_id)
          and   isset($data->goal)              and is_string($data->goal)
          and ((isset($data->path)              and is_dir($data->path)) or !isset($data->path))
        );
    }
}