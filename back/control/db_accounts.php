<?php   
	require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");

    switch($_POST["functionname"]){ 
		
		#-----------Создание аккаунта
		case 'create_acc': 
			$login = htmlspecialchars(trim($_POST['login']));
			$password = htmlspecialchars(md5(md5(trim($_POST['password']))));
			$teacher = $_POST['teacher_id'];
			$admin = $_POST['grant'];

			connect();
			global $link;
			$result = mysqli_query($link, "SELECT count(account_id)
                                           FROM accounts 
                                           WHERE teacher_id='".mysqli_real_escape_string($link, $teacher)."'");
			while($count = mysqli_fetch_array($result)) {
				if ($count[0] > 0) {
					echo "Преподаватель уже имеет аккаунт. ";
				}
			}
			$result = mysqli_query($link, "SELECT count(account_id)
										   FROM accounts
										   WHERE `login`='".mysqli_real_escape_string($link, $login)."'");
			while($count = mysqli_fetch_array($result)) {
				if ($count[0] > 0) {
					echo 'Логин уже используется! Попробуйте ввести другой';
				} else {
					$query = "INSERT INTO accounts (`login`, `password`, teacher_id, grant_id) 
							  values ('".$login."', '".$password."', '".$teacher."', '".$admin."')";
					
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

		#-----------Проверка пароля
		case 'pass_validate': 
			connect();
			global $link;
			$result = mysqli_query($link, "SELECT 1 
										   FROM accounts 
										   WHERE account_id=".$_POST['acc_id']."
										   AND   `password`='".mysqli_real_escape_string($link, htmlspecialchars(md5(md5(trim($_POST["password"])))))."'");

			while($row = mysqli_fetch_array($result)){
				echo $row[0];
			}
			close();
			break;	

		#-----------Изменение аккаунта
		case 'edit_acc_name': 
			connect();
			global $link;
			$query = "UPDATE accounts 
					  SET `login`='".mysqli_real_escape_string($link, htmlspecialchars(trim($_POST["account_name"])))."'
					  WHERE account_id=".$_POST['acc_id']."";
			
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

			case 'edit_acc_pass': 
				connect();
				global $link;
				$query = "UPDATE accounts 
						  SET `password`='".mysqli_real_escape_string($link, htmlspecialchars(md5(md5(trim($_POST["account_pass"])))))."'
						  WHERE account_id=".$_POST['acc_id']."";
				
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
		
		#-----------Удаление аккаунта
		case 'remove_acc': 
			$id = $_POST['id'];

			connect();
			global $link;
			$query = "DELETE FROM accounts WHERE account_id=".$id."";
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