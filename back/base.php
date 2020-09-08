<?php
	$link = false;
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$db_name = 'create_educational';
	
    function connect(){
		global $link;
		global $host;
		global $user;
		global $password;
		global $db_name;
        $link = mysqli_connect($host, $user, $password, $db_name) or die ('Не удалось соединиться с БД');
        mysqli_query($link, "SET NAMES utf8");
    }

    function close(){
        global $link;
        mysqli_close($link);
    }
	
	function options_present($sql){
		connect();
		global $link;
		$result = mysqli_query($link, $sql);
		while($row = mysqli_fetch_array($result)){
			echo "<option value='".$row[0]."'>".$row[1]."</option>"."\n";
		}
		close();
	}
	
	function get_result($sql){
		connect();
		global $link;
		$result = mysqli_query($link, $sql);
		while($row = mysqli_fetch_array($result)){
			echo $row[0];
		}
		close();
	}
?>