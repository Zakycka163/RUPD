<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "prof_standards";

    /* JSON:
    {
        "fgos_id": "int",
        "code": "string",
        "name": "string",
        "number": "string",
        "date": "date",
        "reg_number": "string",
        "reg_date": "date"
    }
    */
    public function json_validation($data){
        $database = new Database();
        return (isset($data->fgos_id)    and is_numeric($data->fgos_id)
            and isset($data->code)       and is_string($data->code)
            and isset($data->name)       and is_string($data->name)
            and isset($data->number)     and is_string($data->number)
            and isset($data->date)       and $database->is_date($data->date)
            and isset($data->reg_number) and is_string($data->reg_number)
            and isset($data->reg_date)   and $database->is_date($data->reg_date)
        );
    }
}