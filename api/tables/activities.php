<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "activities";

    /* JSON:
    {
        "activity_type_id": "int",
        "work_function_id": "int",
        "name": "string",
        "competence_id": "int"
    }
    */
    public function json_validation($data){
        if (  isset($data->activity_type_id)  and is_numeric($data->activity_type_id)
        and   isset($data->name)              and is_string($data->name)
        and ((isset($data->work_function_id)  and is_numeric($data->work_function_id)) or (!isset($data->work_function_id)))
        and ((isset($data->competence_id)     and is_numeric($data->competence_id)) or (!isset($data->competence_id)))){
            return TRUE;
        }
        return FALSE;
    }
}