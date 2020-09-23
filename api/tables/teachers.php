<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "teachers";

    /* JSON:
    {
        "first_name": "string",
        "middle_name": "string",
        "second_name": "string",
        "email": "string",
        "academic_degree_id": "int",
        "academic_rank_id": "int"
    }
    */
    public function json_validation($data){
        return (isset($data->first_name)           and is_string($data->first_name)
          and   isset($data->second_name)          and is_string($data->second_name)
          and   isset($data->email)                and is_string($data->email)
          and ((isset($data->middle_name)          and is_string($data->middle_name))         or !isset($data->middle_name))
          and ((isset($data->academic_degree_id)   and is_numeric($data->academic_degree_id)) or !isset($data->academic_degree_id))
          and ((isset($data->academic_rank_id)     and is_numeric($data->academic_rank_id))   or !isset($data->academic_rank_id))
        );
    }
}