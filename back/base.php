<?php
    $link=false;
	
    function connect(){
        global $link;
        $link=mysqli_connect("localhost", "root", "", "create_educational") or die ('Не удалось соединиться с БД');
        mysqli_query($link, "SET NAMES utf8");
    }
    
    function close(){
        global $link;
        $link->close(); 
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