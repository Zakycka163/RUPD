<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "topics";

    /* JSON:
    {
        "topic_type_id": "int",
        "discipline_id": "int",
        "name": "string",
        "description": "string"
    }
    */
    public function json_validation($data){
        return (isset($data->topic_type_id)     and is_numeric($data->topic_type_id)
          and   isset($data->discipline_id)     and is_numeric($data->discipline_id)
          and   isset($data->name)              and is_string($data->name)
          and ((isset($data->description)       and is_string($data->description)) or !isset($data->description))
        );
    }
}