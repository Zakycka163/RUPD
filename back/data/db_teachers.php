<?php   
	require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");

    switch($_POST["functionname"]){ 
		
		#-----------Изменение преподавателя
		case 'edit_teach_name': 
			connect();
			global $link;
			$data_in_base = mysqli_query($link, "SELECT second_name
													  , first_name 
													  , middle_name
												 FROM users_presenter
												 WHERE account_id=".$_POST['acc_id']."");
			while($data = mysqli_fetch_array($data_in_base)){
				if ($data[0] == $_POST['second_name'] && $data[1] == $_POST['first_name'] && $data[2] == $_POST['middle_name']) {
					echo 'Изменений не было!';
				} else {
					mysqli_query($link, "UPDATE users_presenter
										 SET second_name='".mysqli_real_escape_string($link, htmlspecialchars(trim($_POST["second_name"])))."'
										   , first_name='".mysqli_real_escape_string($link, htmlspecialchars(trim($_POST["first_name"])))."'
										   , middle_name='".mysqli_real_escape_string($link, htmlspecialchars(trim($_POST["middle_name"])))."'
										 WHERE account_id=".$_POST['acc_id']."");
					
					if ($link->error) {
						try {   
							throw new Exception("MySQL error $link->error <br> Query:<br> $query", $link->errno);   
						} catch(Exception $e ) {
							echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
							echo nl2br($e->getTraceAsString());
						}
					} else {
						echo 'Данные обновлены';
					}
				}
			}
			close();
			break;
    }   
?>