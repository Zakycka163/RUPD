<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "study_plan";

    /* JSON:
    {
        "seminar_id": "int",
        "discipline_id": "int",
        "study_form_id": "int",
        "individual_time": "int",
        "lecture_time": "int",
        "laboratory_time": "int",
        "practical_time": "int",
        "course_work": "bool",
        "course_project": "bool",
        "control_work": "bool",
        "control_form_id": "int"
    }
    */
    public function json_validation($data){
        return (isset($data->seminar_id)      and is_numeric($data->seminar_id)
          and   isset($data->discipline_id)   and is_numeric($data->discipline_id)
          and   isset($data->study_form_id)   and is_numeric($data->study_form_id)
          and ((isset($data->individual_time) and is_numeric($data->individual_time)) or !isset($data->individual_time))
          and ((isset($data->lecture_time)    and is_numeric($data->lecture_time))    or !isset($data->lecture_time))
          and ((isset($data->laboratory_time) and is_numeric($data->laboratory_time)) or !isset($data->laboratory_time))
          and ((isset($data->practical_time)  and is_numeric($data->practical_time))  or !isset($data->practical_time))
          and ((isset($data->course_work)     and is_bool($data->course_work))        or !isset($data->course_work))
          and ((isset($data->course_project)  and is_bool($data->course_project))     or !isset($data->course_project))
          and ((isset($data->control_work)    and is_bool($data->control_work))       or !isset($data->control_work))
          and   isset($data->control_form_id) and is_numeric($data->control_form_id)
        );
    }

    /**
     * Метод GET
     * Просмотр отдельной записи (primory_key = [seminar_id, discipline_id, study_form_id])
     * http://ДОМЕН/${table_name}?{primory_key}=
     * http://ДОМЕН/${table_name}?{primory_key}={}&{primory_key}=
     * http://ДОМЕН/${table_name}?{primory_key}={}&{primory_key}={}&{primory_key}=
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
            $part_sql = "seminar_id = ".$data->seminar_id." 
                     AND discipline_id = ".$data->discipline_id."
                     AND study_form_id = ".$data->study_form_id."";
            $database = new Database();
            $link = $database->get_db_link();
            $sql = "SELECT * FROM `".$this->table_name."` 
                    WHERE ".$part_sql;
            if (mysqli_num_rows(mysqli_query($link, $sql)) > 0){
                $errors = $database->validate_input_data($this->table_name, $data);
                if (empty((array)$errors)) {
                    $sql = "UPDATE `".$this->table_name."` 
                            SET ";
                    $sql .= "individual_time = ".isset($data->individual_time)?("".trim($data->individual_time).""):0;
                    $sql .= "lecture_time = ".isset($data->lecture_time)?("".trim($data->lecture_time).""):0;
                    $sql .= "laboratory_time = ".isset($data->laboratory_time)?("".trim($data->laboratory_time).""):0;
                    $sql .= "practical_time = ".isset($data->practical_time)?("".trim($data->practical_time).""):0;
                    $sql .= "course_work = ".isset($data->course_work)?("".$data->course_work.""):0;
                    $sql .= "course_project = ".isset($data->course_project)?("".$data->course_project.""):0;
                    $sql .= "control_work = ".isset($data->control_work)?("".$data->control_work.""):0;
                    $sql .= "control_form_id = ".trim($data->control_form_id);
                    $sql .= " WHERE ".$part_sql;
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
     * Удаление отдельной записи (по seminar_id, discipline_id и study_form_id)
     * http://ДОМЕН/${table_name}?seminar_id={}&discipline_id={}&study_form_id=
     * @return string
     */
    public function deleteAction()
    {
        if(   isset($this->requestParams['seminar_id']) and is_numeric($this->requestParams['seminar_id'])
          and isset($this->requestParams['discipline_id']) and is_numeric($this->requestParams['discipline_id']) 
          and isset($this->requestParams['study_form_id']) and is_numeric($this->requestParams['study_form_id'])
          ){     
            $part_sql = "seminar_id = ".trim($this->requestParams['seminar_id'])." 
                     AND discipline_id = ".trim($this->requestParams['discipline_id'])."
                     AND study_form_id = ".trim($this->requestParams['study_form_id'])."";
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