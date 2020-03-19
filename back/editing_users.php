<?php   
	require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");

    switch($_POST["functionname"]){ 
		
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

		#-----------Обновления аккаунта
		case 'update_account_name': 
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

			case 'update_account_pass': 
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
    }   
?>