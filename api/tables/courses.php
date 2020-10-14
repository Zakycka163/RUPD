<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "courses";

    /* JSON:
    {
        "number": "string",
        "name": "string",
        "qualification_id": "int"
    } 
    */
    public function json_validation($data){
        return (isset($data->number)            and is_string($data->number)
            and isset($data->name)              and is_string($data->name)
            and isset($data->qualification_id)  and is_numeric($data->qualification_id)
        );
    }
}