<?php   
	require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");

    switch($_POST["functionname"]){ 
		
		#-----------Создание кафедры
		case 'create_pulpit': 
			$institute = $_POST['instid'];
			$name = htmlspecialchars(trim($_POST['name']));
			$description = htmlspecialchars(trim($_POST['description']));

			connect();
			global $link;
			$result = mysqli_query($link, "SELECT count(pulpit_id)
                                           FROM pulpits 
                                           WHERE `name`='".mysqli_real_escape_string($link, $name)."'");
			while($count = mysqli_fetch_array($result)) {
				if ($count[0] > 0) {
					echo "Кафедра с указаным названием уже существует";
				} else {
					$query = "INSERT INTO pulpits (`institute_id`, `name`, `description`) 
							  values (".$institute.", '".$name."', '".$description."')";
					
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
				}
			}
			close();
			break;

		#-----------Инфо кафедры
		case 'get_pulpit': 
			$id = $_POST['id'];

			connect();
			global $link;
			$result = mysqli_query($link, "SELECT institute_id
												, `name`
												, `description`
                                           FROM pulpits 
                                           WHERE pulpit_id=".$id."");
			while($obj = mysqli_fetch_array($result)) {
				echo '{
					"institute_id": "'.$obj[0].'",
					"name": "'.$obj[1].'",
					"description": "'.$obj[2].'"
				}';
			}
			close();
			break;
			
		#-----------Изменение кафедры
		case 'edit_pulpit': 
			$id = $_POST['id'];
			$institute = $_POST['instid'];
			$name = htmlspecialchars(trim($_POST['name']));
			$description = htmlspecialchars(trim($_POST['description']));

			connect();
			global $link;
			$result = mysqli_query($link, "SELECT count(pulpit_id)
                                           FROM pulpits 
                                           WHERE pulpit_id <> ".$id."
										   	 and `name`='".mysqli_real_escape_string($link, $name)."'");
			while($count = mysqli_fetch_array($result)) {
				if ($count[0] > 0) {
					echo "Кафедра с указаным названием уже существует";
				} else {
					$query = "UPDATE pulpits
					 		  SET institute_id='".mysqli_real_escape_string($link, $institute)."'
							    , `name`='".mysqli_real_escape_string($link, $name)."'
							    , `description`='".mysqli_real_escape_string($link, $description)."'
							  WHERE pulpit_id=".$id."";
					
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
				}
			}
			close();
			break;

    }   
?>