<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "teacher_educations";

    /* JSON:
    {
        "teacher_id": "int",
        "education_id": "int",
        "start_date": "date",
        "end_date": "date",
        "description": "string"
    }
    */
    public function json_validation($data){
        $database = new Database();
        return (isset($data->teacher_id)    and is_numeric($data->teacher_id)
          and   isset($data->education_id)  and is_numeric($data->education_id)
          and   isset($data->start_date)    and $database->is_date($data->start_date)
          and   isset($data->end_date)      and $database->is_date($data->end_date)
          and ((isset($data->description)   and is_string($data->description)) or !isset($data->description))
        );
    }

    /**
     * Метод GET
     * Просмотр отдельной записи (primory_key = [teacher_id, education_id])
     * http://ДОМЕН/${table_name}?{primory_key}=
     * http://ДОМЕН/${table_name}?{primory_key}={}&{primory_key}=
     * @return string
     */
    public function viewAction()
    {
        $database = new Database();
        $primory_keys = $database->get_primory_keys($this->table_name);
        $part_sql = '';
        foreach($this->requestParams as $field => $value){
            if(in_array($field, $primory_keys)){
                if (is_numeric($value)){
                    $part_sql .= $field." = ".trim($value)." AND ";
                }
            }
        }
        if( !empty($part_sql) ){
            $part_sql = substr($part_sql, 0, -5);
            $link = $database->get_db_link();           
            $sql = "SELECT * FROM `".$this->table_name."` WHERE ".$part_sql;
            $result = mysqli_query($link, $sql);
            if (mysqli_num_rows($result) > 0) {
                $sql_columns = "SHOW COLUMNS FROM `".$this->table_name."`";
                $result_columns = mysqli_query($link, $sql_columns);
                while($row = mysqli_fetch_array($result_columns)){
                    $columns[] = $row['Field'];
                }
                while($row = mysqli_fetch_array($result)){
                    for($i = 0, $size = count($columns); $i < $size; ++$i) {
                        if(is_numeric($row[$i])){
                            $row[$i] = $row[$i] * 1;
                        }
                        $obj[$columns[$i]] = $row[$i];
                    }
                }
                return $this->response($obj, 200);
            } 
            return $this->response('Not Found row with '.$part_sql.'', 404);
            $link = $database->close_db_link();
        }
        return $this->response('Bad Request', 400);
    }

    /**
     * Метод PUT
     * Обновление отдельной записи + JSON
     * http://ДОМЕН/${table_name}
     * @return string
     */
    public function updateAction()
    {
        $data = json_decode(file_get_contents("php://input"));
        if($this->json_validation($data)){
            $part_sql = "teacher_id = ".$data->teacher_id." 
                     AND education_id = ".$data->education_id."";
            $database = new Database();
            $link = $database->get_db_link();
            $sql = "SELECT * FROM `".$this->table_name."` 
                    WHERE ".$part_sql;
            if (mysqli_num_rows(mysqli_query($link, $sql)) > 0){
                $errors = $database->validate_input_data($this->table_name, $data);
                if (empty((array)$errors)) {
                    $sql = "UPDATE `".$this->table_name."` 
                            SET `start_date`  = ".$data->start_date."
                              , `end_date`    = ".$data->end_date."
                              , `description` = ".isset($data->description)?("'".$data->description."'"):("NULL")."
                            WHERE ".$part_sql;
                    if ($result = mysqli_query($link, $sql)){
                        return $this->response('Object updated', 200);
                    }
                    return $this->response($result, 500); 
                } 
                return $this->response($errors, 400);
            }
            return $this->response('Not Found row with '.$part_sql.'', 404);
        }
        return $this->response('Bad Request', 400);
    }

    /**
     * Метод DELETE
     * Удаление отдельной записи (по teacher_id и education_id)
     * http://ДОМЕН/${table_name}?teacher_id={}&education_id=
     * @return string
     */
    public function deleteAction()
    {
        if(   isset($this->requestParams['teacher_id']) and is_numeric($this->requestParams['teacher_id'])
          and isset($this->requestParams['education_id']) and is_numeric($this->requestParams['education_id']) 
          ){     
            $part_sql = "teacher_id = ".trim($this->requestParams['teacher_id'])." 
                     AND education_id = ".trim($this->requestParams['education_id'])."";
            $database = new Database();
            $link = $database->get_db_link();
            $sql = "SELECT 1 FROM `".$this->table_name."` 
                    WHERE ".$part_sql;
            if (mysqli_num_rows(mysqli_query($link, $sql)) > 0){
                $sql = "DELETE FROM `".$this->table_name."` 
                        WHERE ".$part_sql;
                if ($result = mysqli_query($link, $sql)){
                    return $this->response('Object deleted', 200);
                }
                return $this->response($result, 500);
            }
            return $this->response('Not Found row with '.$part_sql.'', 404);
            $link = $database->close_db_link();
        }
        return $this->response('Bad Request', 400);
    }
}