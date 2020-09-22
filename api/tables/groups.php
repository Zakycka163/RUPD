<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "groups";

    /* JSON:
    {
        "name": "string",
        "profile_id": "int",
        "study_form_id": "int",
        "description": "string"
    } 
    */
    public function json_validation($data){
        if ( isset($data->name)           and is_string($data->name)
        and  isset($data->profile_id)     and is_numeric($data->name)
        and  isset($data->study_form_id)  and is_numeric($data->study_form_id)
        and (isset($data->description)    and is_string($data->description) or (!isset($data->description)))){
            return TRUE;
        }
        return FALSE;
    }
}