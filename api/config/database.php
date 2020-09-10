<?php
    class Database {

        private $host = "localhost";
        private $db_name = "create_educational";
        private $username = "root";
        private $password = "";
        public $link;

        // получаем соединение с БД 
        public function get_db_link(){

            $this->link = null;

            try {
                $this->link = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                                             $this->username,
                                             $this->password);
                $this->link->exec("set names utf8");
            } catch(PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
            }

            return $this->link;
        }

        // закрываем соединение с БД 
        public function close_db_link(){

            $this->link = null;

            return $this->link;
        }

    }
?>