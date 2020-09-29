<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "connections_opop";

    /* JSON:
    {
        "general_work_function_id": "int",
        "competence_id": "int",
        "description": "string"
    }
    */
    public function json_validation($data){
        return (isset($data->general_work_function_id) and is_numeric($data->general_work_function_id)
          and   isset($data->competence_id)            and is_numeric($data->competence_id)
          and ((isset($data->description)              and is_string($data->description)) or !isset($data->description))
        );
    }

    /**
     * Метод GET
     * Просмотр отдельной записи (primory_key = [general_work_function_id, competence_id])
     * http://ДОМЕН/${table_name}?{primory_key}=
     * http://ДОМЕН/${table_name}?{primory_key}={}&{primory_key}=
     * @return string
     */
    public function viewAction()
    {
        $params = array();
        if (isset($this->requestParams['general_work_function_id']) and is_numeric($this->requestParams['general_work_function_id'])){
            $params += array('general_work_function_id' => trim($this->requestParams['general_work_function_id']));
        }
        if (isset($this->requestParams['competence_id']) and is_numeric($this->requestParams['competence_id'])){
            $params += array('competence_id' => trim($this->requestParams['competence_id']));
        }
        if( !empty($params) ){
            $database = new Database();
            $link = $database->get_db_link();           
            $sql = "SELECT * FROM `".$this->table_name."` WHERE ";
            $part_sql = '';
            foreach ($params as $field => $value){
                $part_sql .= $field." = ".$value." AND ";
            }
            $part_sql = substr($part_sql, 0, -5);
            $sql .= $part_sql;
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
            $database = new Database();
            $link = $database->get_db_link();
            $sql = "SELECT * FROM `".$this->table_name."` 
                    WHERE general_work_function_id = ".$data->general_work_function_id." 
                    AND competence_id = ".$data->competence_id."";
            if (mysqli_num_rows(mysqli_query($link, $sql)) > 0){
                $errors = $database->validate_input_data($this->table_name, $data);
                if (empty((array)$errors)) {
                    $sql = "UPDATE `".$this->table_name."` 
                            SET `description` = ".isset($data->description)?("'".$data->description."'"):("NULL")."
                            WHERE `general_work_function_id` = ".$data->general_work_function_id." 
                            AND `competence_id` = ".$data->competence_id."";
                    if ($result = mysqli_query($link, $sql)){
                        return $this->response('Object updated', 200);
                    }
                    return $this->response($result, 500); 
                } 
                return $this->response($errors, 400);
            }
            return $this->response('Not Found object with general_work_function_id = '.$data->general_work_function_id.'
            AND competence_id = '.$data->competence_id.'', 404);
        }
        return $this->response('Bad Request', 400);
    }

    /**
     * Метод DELETE
     * Удаление отдельной записи (по general_work_function_id и competence_id)
     * http://ДОМЕН/${table_name}?general_work_function_id={}&competence_id=
     * @return string
     */
    public function deleteAction()
    {
        if(   isset($this->requestParams['general_work_function_id']) and is_numeric($this->requestParams['general_work_function_id'])
          and isset($this->requestParams['competence_id']) and is_numeric($this->requestParams['competence_id']) 
          ){     
            $gwf_id = trim($this->requestParams['general_work_function_id']);
            $c_id = trim($this->requestParams['competence_id']);
            $database = new Database();
            $link = $database->get_db_link();
            $sql = "SELECT 1 FROM `".$this->table_name."` 
                    WHERE general_work_function_id = ".$gwf_id." 
                    AND competence_id = ".$c_id."";
            if (mysqli_num_rows(mysqli_query($link, $sql)) > 0){
                $sql = "DELETE FROM `".$this->table_name."` 
                        WHERE general_work_function_id = ".$gwf_id." 
                        AND competence_id = ".$c_id."";
                if ($result = mysqli_query($link, $sql)){
                    return $this->response('Object deleted', 200);
                }
                return $this->response($result, 500);
            }
            return $this->response('Not Found object with general_work_function_id = '.$gwf_id.' 
            AND competence_id = '.$c_id.'', 404);
            $link = $database->close_db_link();
        }
        return $this->response('Bad Request', 400);
    }
}