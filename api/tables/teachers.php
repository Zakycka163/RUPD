<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    protected $table_name = "teachers";

    /*
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/${table_name} + JSON
     * 
    {
        "first_name": "string",
        "middle_name": "string",
        "second_name": "string",
        "email": "string",
        "academic_degree_id": "int",
        "academic_rank_id": "int"
    }
     * 
     * @return string
     */
    public function createAction()
    {
        $data = json_decode(file_get_contents("php://input"));

        if (     
              isset($data->first_name)           and is_string($data->first_name)
        and   isset($data->second_name)          and is_string($data->second_name)
        and   isset($data->email)                and is_string($data->email)
        and ((isset($data->middle_name)          and is_string($data->middle_name))     or !isset($data->middle_name))
        and ((isset($data->academic_degree_id)   and is_int($data->academic_degree_id)) or !isset($data->academic_degree_id))
        and ((isset($data->academic_rank_id)     and is_int($data->academic_rank_id))   or !isset($data->academic_rank_id))
            ){
            
            $data->middle_name = (!isset($data->middle_name))?'':htmlspecialchars($data->middle_name);
            
            $database = new Database();
            $link = $database->get_db_link();

            $errors = $database->validate_input_data($this->table_name, $data);
            
            if (empty($errors)) {

                $errors = $database->ids_exists_in_tables(array($data->academic_degree_id, $data->academic_rank_id)
                                                         ,array("academic_degrees",          "academic_ranks"));

                if (empty($errors)) {
                    $sql = "INSERT INTO `".$this->table_name."` ( `first_name`
                                                                , `middle_name`
                                                                , `second_name`
                                                                , `email`
                                                                , `academic_degree_id`
                                                                , `academic_rank_id`) 
                            VALUES                              ('".$data->first_name."'
                                                                ,'".$data->middle_name."'
                                                                ,'".$data->second_name."'
                                                                ,'".$data->email."'
                                                                ,".(!isset($data->academic_degree_id)?"NULL":$data->academic_degree_id)."
                                                                ,".(!isset($data->academic_rank_id)?"NULL":$data->academic_rank_id).")";
                    if (mysqli_query($link, $sql)){
                        return $this->response('Object created', 201);
                    } else {
                        return $this->response($sql. '\n'.mysqli_error($link), 500);
                    }
                }
                return $this->response($errors, 400);
            }
            $link = $database->close_db_link();
            return $this->response($errors, 400);
        }
        return $this->response("Bad Request", 400);
    }

    /*
     * Метод PUT
     * Обновление отдельной записи (по ее id)
     * http://ДОМЕН/${table_name}?id= + JSON
     * 
    {
        "pulpit_id": "int",
        "part_id": "int",
        "module_id": "int",
        "index_info": "string",
        "name": "string",
        "time": "int" 
    }
     * 
     * @return string
     */
    public function updateAction()
    {
        
        $data = json_decode(file_get_contents("php://input"));

        if( 
              isset($this->requestParams['id'])  and is_numeric($this->requestParams['id'])
        and   isset($data->first_name)           and is_string($data->first_name)
        and   isset($data->second_name)          and is_string($data->second_name)
        and   isset($data->email)                and is_string($data->email)
        and ((isset($data->middle_name)          and is_string($data->middle_name))     or !isset($data->middle_name))
        and ((isset($data->academic_degree_id)   and is_int($data->academic_degree_id)) or !isset($data->academic_degree_id))
        and ((isset($data->academic_rank_id)     and is_int($data->academic_rank_id))   or !isset($data->academic_rank_id))
            ){

            $id = htmlspecialchars(trim($this->requestParams['id'])) ?? '';
            if (!isset($data->middle_name)){
                $data->middle_name = '';
            }
            if (!isset($data->academic_degree_id)){
                $data->academic_degree_id = null;
            }
            if (!isset($data->academic_rank_id)){
                $data->academic_rank_id = null;
            }

            $database = new Database();
            $link = $database->get_db_link();

            if ($database->exist_in_table($id, $this->table_name)){
                
                $errors = $database->validate_input_data($this->table_name, $data);
                if (empty($errors)) {

                    $errors = $database->ids_exists_in_tables(array($data->academic_degree_id, $data->academic_rank_id)
                                                             ,array("academic_degrees",          "academic_ranks"));

                    if (empty($errors)) {
                        $sql = "UPDATE `".$this->table_name."` 
                                SET `first_name`            = '".$data->first_name."'
                                  , `middle_name`           = '".$data->middle_name."'
                                  , `second_name`           = '".$data->second_name."'
                                  , `email`                 = '".$data->email."'
                                  , `academic_degree_id`    = ".(!isset($data->academic_degree_id)?"NULL":$data->academic_degree_id)."
                                  , `academic_rank_id`      = ".(!isset($data->academic_rank_id)?"NULL":$data->academic_rank_id)."
                                WHERE id = ".$id."";
                        if (mysqli_query($link, $sql)) {
                            return $this->response('Object updated.', 200);
                        }
                        return $this->response(mysqli_error($link), 500);
                    }
                    return $this->response($errors, 400);

                }
                return $this->response($errors, 400);
            } 
            return $this->response('Not Found object with id = '.$id.'', 404);
            $link = $database->close_db_link();
        }
        return $this->response('Bad Request', 400);
    }
    
}