<?php  
	function checkEmail($str) {
		$str = filter_var($str, FILTER_SANITIZE_EMAIL);

		if (filter_var($str, FILTER_VALIDATE_EMAIL)) {
			return $str;
		} else {
			return "1";
		}
	}
		
	require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");

    switch($_POST["functionname"]){ 
		
		#-----------Создание преподавателя
		case 'create_teacher': 
			$email = htmlspecialchars(trim($_POST['email']));
			checkEmail($email);
			if ($email == "1") {
				echo "Email не валидный!";
				break;
			}
			$second_name = htmlspecialchars(trim($_POST['second_name']));
			$first_name = htmlspecialchars(trim($_POST['first_name']));
			$middle_name = htmlspecialchars(trim($_POST['middle_name']));

			connect();
			global $link;
			// TODO
			$query = "INSERT INTO teachers (`first_name`, `middle_name`, `second_name`, `email`, `academic_degree_id`, `academic_rank_id`)
					  VALUES ('".mysqli_real_escape_string($link, $first_name)."'
				  			, '".mysqli_real_escape_string($link, $middle_name)."'
				  			, '".mysqli_real_escape_string($link, $second_name)."'
				  			, '".mysqli_real_escape_string($link, $email)."'
				  			, 1
				  			, 1)";
			$check = mysqli_query($link, "SELECT count(teacher_id)
										  FROM teachers
										  WHERE second_name='".$second_name."'
										    and first_name='".$first_name."'
										    and middle_name='".$middle_name."'");
			while($data = mysqli_fetch_array($check)){
				if (!isset($_POST['confirm'])){
					if ($data[0] > 0) {
						echo 'Предупреждение! Преподаватель с указанными ФИО уже существует!';
					} else {
						
						mysqli_query($link, $query);
						if ($link->error) {
							try {   
								throw new Exception("MySQL error $link->error <br> Query:<br> $query", $link->errno);   
							} catch(Exception $e ) {
								echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
								echo nl2br($e->getTraceAsString());
							}
						}
					}
				} else {
					mysqli_query($link, $query);
					if ($link->error) {
						try {   
							throw new Exception("MySQL error $link->error <br> Query:<br> $query", $link->errno);   
						} catch(Exception $e ) {
							echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
							echo nl2br($e->getTraceAsString());
						}
					}
				}
			}
			close();
			break;

		#-----------Изменение преподавателя
		case 'edit_teach_name': 
			connect();
			global $link;
			$data_in_base = mysqli_query($link, "SELECT second_name
													  , first_name 
													  , middle_name
												 FROM teachers_presenter
												 WHERE account_id=".$_POST['acc_id']."");
			while($data = mysqli_fetch_array($data_in_base)){
				if ($data[0] == $_POST['second_name'] && $data[1] == $_POST['first_name'] && $data[2] == $_POST['middle_name']) {
					echo 'Изменений не было!';
				} else {
					$query = "UPDATE teachers_presenter
							  SET second_name='".mysqli_real_escape_string($link, htmlspecialchars(trim($_POST["second_name"])))."'
					  			, first_name ='".mysqli_real_escape_string($link, htmlspecialchars(trim($_POST["first_name"])))."'
					  			, middle_name='".mysqli_real_escape_string($link, htmlspecialchars(trim($_POST["middle_name"])))."'
							  WHERE account_id=".$_POST['acc_id'].""
					
					mysqli_query($link, $query);
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
		
		#-----------Удаление преподавателя
		case 'remove_teacher': 
			$id = $_POST['id'];

			connect();
			global $link;
			$query = "DELETE FROM teachers WHERE teacher_id=".$id."";
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