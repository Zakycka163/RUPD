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
			$query = mysqli_query($link, "SELECT count(account_id)
                                          FROM accounts 
                                          WHERE teacher_id='".mysqli_real_escape_string($link, $teacher)."'");
			while($count = mysqli_fetch_array($query)) {
				if ($count[0] > 0) {
					echo "Преподаватель уже имеет аккаунт. ";
				}
			}
			$query = mysqli_query($link, "SELECT count(account_id)
												FROM accounts
												WHERE `login`='".mysqli_real_escape_string($link, $login)."'");
			while($count = mysqli_fetch_array($query)) {
				if ($count[0] > 0) {
					echo 'Логин уже используется! Попробуйте ввести другой';
				} else {
					$query = "INSERT INTO accounts (`login`, `password`, teacher_id, grant_id) 
							  values ('".$login."', '".$password."', '".$teacher."', '".$admin."')";
								
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
			if ($link->error) {
				try {   
					throw new Exception("MySQL error $link->error <br> Query:<br> $query", $link->errno);   
				} catch(Exception $e ) {
					echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
					echo nl2br($e->getTraceAsString());
				}
			} else {
			   	while($row = mysqli_fetch_array($result)){
					echo $row[0];
				}
			}
			close();
			break;	

		#-----------Изменение аккаунта
		case 'edit_acc_name': 
			connect();
			global $link;
			mysqli_query($link, "UPDATE accounts 
								 SET `login`='".mysqli_real_escape_string($link, htmlspecialchars(trim($_POST["account_name"])))."'
								 WHERE account_id=".$_POST['acc_id']."");
			
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
				mysqli_query($link, "UPDATE accounts 
									 SET `password`='".mysqli_real_escape_string($link, htmlspecialchars(md5(md5(trim($_POST["account_pass"])))))."'
									 WHERE account_id=".$_POST['acc_id']."");
				
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
		
		#-----------Изменение преподавателя
		case 'update_teach_name': 
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