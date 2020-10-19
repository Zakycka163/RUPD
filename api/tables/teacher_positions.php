<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "teacher_positions";

    /* JSON:
    {
        "teacher_id": "int",
        "position_id": "int",
        "main_position": "bool"
    }
    */
    public function json_validation($data){
        $data->main_position = !isset($data->main_position)?0:$data->main_position;
        return (isset($data->teacher_id)    and is_numeric($data->teacher_id)
          and   isset($data->position_id)   and is_numeric($data->position_id)
          and   isset($data->main_position) and is_bool($data->main_position)
        );
    }

    /**
     * Метод GET
     * Просмотр отдельной записи (primory_key = [teacher_id, position_id])
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
            return $this->response('Not Found row with '.$part_sql.'', 200);
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
                     AND position_id = ".$data->position_id."";
            $database = new Database();
            $link = $database->get_db_link();
            $sql = "SELECT * FROM `".$this->table_name."` 
                    WHERE ".$part_sql;
            if (mysqli_num_rows(mysqli_query($link, $sql)) > 0){
                $errors = $database->validate_input_data($this->table_name, $data);
                if (empty((array)$errors)) {
                    $sql = "UPDATE `".$this->table_name."` 
                            SET `description` = ".isset($data->description)?("'".$data->description."'"):("NULL")."
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
     * Удаление отдельной записи (по teacher_id и position_id)
     * http://ДОМЕН/${table_name}?teacher_id={}&competence_id=
     * @return string
     */
    public function deleteAction()
    {
        if(   isset($this->requestParams['teacher_id']) and is_numeric($this->requestParams['teacher_id'])
          and isset($this->requestParams['position_id']) and is_numeric($this->requestParams['position_id']) 
          ){     
            $part_sql = "teacher_id = ".trim($this->requestParams['teacher_id'])." 
                     AND position_id = ".trim($this->requestParams['position_id'])."";
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