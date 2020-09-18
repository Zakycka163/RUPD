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

        // проверка существования списка id в последовательном списке таблиц
        public function ids_exists_in_tables(array $ids, array $table_names){
            $data_to_validation = array_combine($table_names, $ids); 
            $result = array();
            foreach ($data_to_validation as $table => $id){
                if ($this->exist_in_table($id, $table)){
                    $result += array($table => "Not Found object with key = '.$id.'");
                }
            }
            return $result;
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

        // Проверяем, что инфа не превышает max_length для поля
        public function validate_input_data(string $table_name, $data){            
            $arr_length = $this->get_max_length_for_fields_in_table($table_name);
            $arr_errors = array();
            foreach($arr_length as $key => $value){ 
                if (isset($data->$key) and strlen($data->$key) <= $value){
                    $arr_errors += array($key => "Value length must be less than " . $value . "!");
                }
            }
            return $arr_errors;
        }
    }
?>