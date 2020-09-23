<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "tasks";

    /* JSON:
    {
        "objective": "string",
        "due_date": "date",
        "status_id": "int",
        "account_id": "int"
    }
    */
    public function json_validation($data){
        $database = new Database();
        return (isset($data->objective)     and is_string($data->objective)
            and isset($data->due_date)      and $database->is_date($data->due_date)
            and isset($data->status_id)     and is_numeric($data->status_id)
            and isset($data->account_id)    and is_numeric($data->account_id)
        );
    }
}