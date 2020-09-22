<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "disciplines";

    /* JSON:
    {
        "pulpit_id": "int",
        "part_id": "int",
        "module_id": "int",
        "index_info": "string",
        "name": "string",
        "time": "int"
    } 
    */    
    public function json_validation($data){
        if (isset($data->pulpit_id)     and is_numeric($data->pulpit_id)
        and isset($data->part_id)       and is_numeric($data->part_id)
        and isset($data->module_id)     and is_numeric($data->module_id)
        and isset($data->index_info)    and is_string($data->index_info)
        and isset($data->name)          and is_string($data->name)
        and isset($data->time)          and is_numeric($data->time)){
            return TRUE;
        }
        return FALSE;
    }
}