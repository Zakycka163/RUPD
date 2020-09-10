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
    }
?>