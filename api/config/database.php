<?php
    class Database {

        private $host = "localhost";
        private $db_name = "create_educational";
        private $username = "root";
        private $password = "";
        public $link;
        public $limit;

        // получаем соединение с БД 
        public function get_db_link(){

            $this->link = null;

            $this->link = mysqli_connect($this->host, $this->username,$this->password, $this->db_name) or die ('Connection error');
            mysqli_query($this->link, "SET NAMES utf8");

            return $this->link;
        }

        // закрываем соединение с БД 
        public function close_db_link(){

            $this->link = null;

            return $this->link;
        }

        // достаем лимит на отображение
        public function get_db_limit(){
            $database = new Database();
            $link = $database->get_db_link();

            $sql = "SELECT MAX(`value`) FROM `constants` WHERE `key` = 'limitObj'";
            $limit_request = mysqli_query($link, $sql);
            $limit_arr = mysqli_fetch_array($limit_request);
            
            $link = $database->close_db_link();
            $this->limit = $limit_arr[0];

            return $this->limit;

        }

        // проверка существования в таблице
        public function exist_in_table(int $id, string $table_name){
            $database = new Database();
            $link = $database->get_db_link();
            $sql = "SELECT 1 FROM `".$table_name."` WHERE id = ".$id."";
            $result = mysqli_num_rows(mysqli_query($link, $sql));
            if ($result == 1) {
                return TRUE;
            } else { return FALSE; }
        }

        // достаем foreign_keys для полей в таблице
        private function get_foreign_keys(string $table_name){
            $database = new Database();
            $link = $database->get_db_link();
            $foreign_keys = array();
            $sql = "SELECT COLUMN_NAME, REFERENCED_TABLE_NAME 
                    FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
                    WHERE TABLE_NAME = '".$table_name."'
                    AND REFERENCED_TABLE_NAME is not null";
            if ($result = mysqli_query($link, $sql)) {
                while($row = mysqli_fetch_array($result)){
                    $foreign_keys += array($row[0] => $row[1]);
                }
            }
            return $foreign_keys;
        }

        // достаем max_length для полей в таблице
        private function get_max_length_for_fields_in_table(string $table_name){
            $database = new Database();
            $link = $database->get_db_link();
            $length = array();
            $sql_length = "SELECT COLUMN_NAME as 'Field', COALESCE(CHARACTER_MAXIMUM_LENGTH, NUMERIC_PRECISION) as 'Length'
                           FROM INFORMATION_SCHEMA.COLUMNS 
                           WHERE table_name = '".$table_name."'";
            if ($result_length = mysqli_query($link, $sql_length)) {
                while($row = mysqli_fetch_array($result_length)){
                    $length += array($row[0] => $row[1]);
                }
            }
            return $length;
            $link = $database->close_db_link();
        }

        // Проверяем, что инфа соответсвует
        public function validate_input_data(string $table_name, $data){             
            $arr_errors = (object) array();
            // Проверка существования внешних ключей
            $foreign_keys = $this->get_foreign_keys($table_name);
            if (isset($foreign_keys)){
                foreach ($foreign_keys as $key => $table){
                    if (isset($data->$key) and !$this->exist_in_table($data->$key, $table)){
                        $arr_errors->$key = "Not Found object with id = ".$data->$key."!";
                    }
                }
            }
            // Проверка лимита длины входных данных
            $arr_length = $this->get_max_length_for_fields_in_table($table_name);
            foreach($arr_length as $key => $value){ 
                if (isset($data->$key) and strlen($data->$key) > $value){
                    $arr_errors->$key = "Value length must be less than ". $value ."!";
                }
            }
            return $arr_errors;
        }

        // Инсерт данных по полям
        public function insert_data_to_table($data, string $table_name){            
            $database = new Database();
            $link = $database->get_db_link();         
            $sql_fields = "SELECT COLUMN_NAME as 'Field'
                           FROM INFORMATION_SCHEMA.COLUMNS 
                           WHERE table_name = '".$table_name."'";
            $fields = mysqli_query($link, $sql_fields);
            $arr_fields = array();
            while($row = mysqli_fetch_array($fields)){
                $arr_fields += array($row[0] => null);
            }
            $fields_to_insert = '';
            $data_to_insert = '';
            foreach($data as $field => $value){ 
                if (array_key_exists($field, $arr_fields)){
                    $arr_fields[$field] = $value;
                    if (empty($fields_to_insert)){
                        $fields_to_insert .= '`'.$field.'`';
                        $data_to_insert .= isset($value)?("'".$value."'"):("NULL");
                    } else {
                        $fields_to_insert .= ', `'.$field.'`';
                        $data_to_insert .= isset($value)?(", '".$value."'"):(", NULL");
                    }
                }
            }
            $sql = "INSERT INTO `".$table_name."` (".$fields_to_insert.") VALUES (".$data_to_insert.")";
            if(mysqli_query($link, $sql)){
                return "ok";
            }
            return $sql.' - '.mysqli_error($link);
            $link = $database->close_db_link();
        }

        // Обновление данных по полям
        public function update_data_to_table(int $id, $data, string $table_name){            
            $database = new Database();
            $link = $database->get_db_link();         
            $sql_fields = "SELECT COLUMN_NAME as 'Field'
                           FROM INFORMATION_SCHEMA.COLUMNS 
                           WHERE table_name = '".$table_name."'";
            $fields = mysqli_query($link, $sql_fields);
            $arr_fields = array();
            while($row = mysqli_fetch_array($fields)){
                $arr_fields += array($row[0] => null);
            }
            $data_to_update = '';
            foreach($data as $field => $value){ 
                if (array_key_exists($field, $arr_fields)){
                    if (empty($data_to_update)){
                        $data_to_update .= '`'.$field.'` = ';
                        $data_to_update .= isset($value)?("'".$value."'"):("NULL").'';
                    } else {
                        $data_to_update .= ', `'.$field.'` = ';
                        $data_to_update .= isset($value)?("'".$value."'"):("NULL").'';
                    }
                }
            }
            $sql = "UPDATE `".$table_name."` SET ".$data_to_update." WHERE id = ".$id."";
            if(mysqli_query($link, $sql)){
                return "ok";
            }
            return $sql.' - '.mysqli_error($link);
            $link = $database->close_db_link();
        }
    }
?>