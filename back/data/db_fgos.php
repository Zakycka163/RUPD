<?php  
	require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");

    switch($_POST["functionname"]){ 
		
		#-----------Создание ФГОС
		case 'create_fgos': 
			connect();
			global $link;
			$query = "INSERT INTO fgos (course_id, `number`, `date`, reg_number, reg_date) 
					  VALUES ('".$_POST["course"]."'
							, '".$_POST["number"]."'
							, '".$_POST["date"]."'
							, '".$_POST["reg_number"]."'
							, '".$_POST["reg_date"]."')";
			mysqli_query($link,$query);
			if ($link->error) {
				try {   
					throw new Exception("MySQL error $link->error <br> Query:<br> $query", $link->errno);   
				} catch(Exception $e ) {
					echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
					echo nl2br($e->getTraceAsString());
				}
			}
            close();
			break;

		#-----------Инфо ФГОС
		case 'get_fgos': 
			connect();
			global $link;
			$query = "INSERT INTO fgos (course_id, `number`, `date`, reg_number, reg_date) 
					  VALUES ('".$_POST["course"]."'
							, '".$_POST["number"]."'
							, '".$_POST["date"]."'
							, '".$_POST["reg_number"]."'
							, '".$_POST["reg_date"]."')";
			mysqli_query($link,$query);
			if ($link->error) {
				try {   
					throw new Exception("MySQL error $link->error <br> Query:<br> $query", $link->errno);   
				} catch(Exception $e ) {
					echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
					echo nl2br($e->getTraceAsString());
				}
			}
            close();
			break;
	}
?>