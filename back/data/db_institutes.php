<?php   
	require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");

    switch($_POST["functionname"]){ 
		
		#-----------Создание института
		case 'create_institute': 
			$name = htmlspecialchars(trim($_POST['name']));
			$description = htmlspecialchars(trim($_POST['description']));

			connect();
			global $link;
			$result = mysqli_query($link, "SELECT count(institute_id)
                                           FROM institutes 
                                           WHERE `name`='".mysqli_real_escape_string($link, $name)."'");
			while($count = mysqli_fetch_array($result)) {
				if ($count[0] > 0) {
					echo "Институт с указаным названием уже существует";
				} else {
					$query = "INSERT INTO institutes (`name`, `description`) 
							  values ('".$name."', '".$description."')";
					
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

		#-----------Инфо института
		case 'get_institute': 
			$id = $_POST['id'];

			connect();
			global $link;
			$result = mysqli_query($link, "SELECT `name`
												, `description`
                                           FROM institutes 
                                           WHERE institute_id=".$id."");
			while($obj = mysqli_fetch_array($result)) {
				echo '{
					"name": "'.$obj[0].'",
					"description": "'.$obj[1].'"
				}';
			}
			close();
			break;
			
		#-----------Изменение института
		case 'edit_institute': 
			$id = $_POST['id'];
			$name = htmlspecialchars(trim($_POST['name']));
			$description = htmlspecialchars(trim($_POST['description']));

			connect();
			global $link;
			$result = mysqli_query($link, "SELECT count(institute_id)
                                           FROM institutes 
                                           WHERE `name`='".mysqli_real_escape_string($link, $name)."'");
			while($count = mysqli_fetch_array($result)) {
				if ($count[0] > 0) {
					echo "Институт с указаным названием уже существует";
				} else {
					$query = "UPDATE institutes
					 		  SET `name`='".mysqli_real_escape_string($link, $name)."'
							    , `description`='".mysqli_real_escape_string($link, $description)."'
							  WHERE institute_id=".$id."";
					
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

		#-----------Удаление института
		case 'remove_institute': 
			$id = $_POST['id'];

			connect();
			global $link;
			$query = "DELETE FROM institutes WHERE institute_id=".$id."";
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