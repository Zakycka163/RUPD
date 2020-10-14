<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "academic_degrees";

    /* JSON:
    {
        "full_name": "string",
        "short_name": "string"
    } 
    */
    public function json_validation($data){
        return (isset($data->full_name)    and is_string($data->full_name)
            and isset($data->short_name)   and is_string($data->short_name)
        );
    }
}