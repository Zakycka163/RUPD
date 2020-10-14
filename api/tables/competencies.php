<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "competencies";

    /* JSON:
    {
        "fgos_id": "int",
        "competence_type_id": "int",
        "number": "string",
        "name": "string"
    }
    */
    public function json_validation($data){
        return (isset($data->fgos_id)             and is_numeric($data->fgos_id)
            and isset($data->competence_type_id)  and is_numeric($data->competence_type_id)
            and isset($data->number)              and is_string($data->number)
            and isset($data->name)                and is_string($data->name)
        );
    }
}