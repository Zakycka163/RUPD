<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "fgos";

    /* JSON:
    {
        "course_id": "int",
        "number": "string",
        "date": "date",
        "reg_number": "string",
        "reg_date": "date"
    }
    */
    public function json_validation($data){
        $database = new Database();
        return (isset($data->course_id)  and is_numeric($data->course_id)
            and isset($data->number)     and is_string($data->number)
            and isset($data->date)       and $database->is_date($data->date)
            and isset($data->reg_number) and is_string($data->reg_number)
            and isset($data->reg_date)   and $database->is_date($data->reg_date)
        );
    }
}