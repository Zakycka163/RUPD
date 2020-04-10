<?php  
	require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");

    switch($_POST["functionname"]){ 
		
		#-----------Создание ФГОС
		case 'create_fgos': 
			connect();
			global $link;
			$query = "INSERT INTO fgos (course_id, `number`, `date`, reg_number, reg_date) 
					  VALUES ('".mysqli_real_escape_string($link,$_POST["course"])."'
							, '".mysqli_real_escape_string($link,$_POST["number"])."'
							, '".mysqli_real_escape_string($link,$_POST["date"])."'
							, '".mysqli_real_escape_string($link,$_POST["reg_number"])."'
							, '".mysqli_real_escape_string($link,$_POST["reg_date"])."')";
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
			$id = $_POST['id'];

			connect();
			global $link;
			$result = mysqli_query($link, "SELECT `course_id`
												, `number`
												, `date`
												, reg_number
												, reg_date
                                           FROM fgos 
                                           WHERE fgos_id=".$id."");
			while($obj = mysqli_fetch_array($result)) {
				echo '{
					"course": "'.$obj[0].'",
					"number": "'.$obj[1].'",
					"date": "'.$obj[2].'",
					"reg_number": "'.$obj[3].'",
					"reg_date": "'.$obj[4].'"
				}';
			}
            close();
			break;

		#-----------Изменение ФГОС
		case 'edit_fgos': 
			$id = $_POST['id'];
			$course_id = $_POST['course'];
			$number = $_POST['number'];
			$date = $_POST['date'];
			$reg_number = $_POST['reg_number'];
			$reg_date = $_POST['reg_date'];

			connect();
			global $link;
			$query = "UPDATE fgos
			 		  SET `course_id`='".mysqli_real_escape_string($link, $course_id)."'
					    , `number`='".mysqli_real_escape_string($link, $number)."'
						, `date`='".mysqli_real_escape_string($link, $date)."'
						, `reg_number`='".mysqli_real_escape_string($link, $reg_number)."'
						, `reg_date`='".mysqli_real_escape_string($link, $reg_date)."'
					  WHERE fgos_id=".$id."";
			
			mysqli_query($link, $query);	
			if ($link->error) {
				try {   
					throw new Exception("MySQL error $link->error <br> Query:<br> $query", $link->errno);   
				} catch(Exception $e ) {
					echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
					echo nl2br($e->getTraceAsString());
				}
			} else {
				echo '1';
			}
			close();
			break;

		#-----------Удаление ФГОС
		case 'remove_fgos': 
			$id = $_POST['id'];

			connect();
			global $link;
			$query = "DELETE FROM fgos WHERE fgos_id=".$id."";
			mysqli_query($link,	$query);	
			if ($link->error) {
				try {   
					throw new Exception("MySQL error $link->error <br> Query:<br> $query", $link->errno);   
				} catch(Exception $e ) {
					echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
					echo nl2br($e->getTraceAsString());
				}
			} else {
				echo '1';
			}
			close();
			break;
	}
?>