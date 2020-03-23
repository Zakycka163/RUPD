<?php  
    $text1 = '';
    $text2 = '';
    $type = '';
    if(isset($_POST['submit'])){
        $err = "";
        
        connect();
		if(isset($_POST['teacher'])){
			$teacher = $_POST['teacher'];
			$login = htmlspecialchars(trim($_POST['login']));
			$query = mysqli_query($link, "SELECT account_id 
                                          FROM accounts 
                                          WHERE login='".mysqli_real_escape_string($link, $login)."'");
			if(mysqli_num_rows($query) > 0){
				$err .= "Логин должен быть уникальным. ";
			}
			$query = mysqli_query($link, "SELECT account_id 
                                          FROM accounts 
                                          WHERE teacher_id='".mysqli_real_escape_string($link, $teacher)."'");
			if(mysqli_num_rows($query) > 0){
				$err .= "Преподаватель уже имеет аккаунт. ";
			}	
		} else {
			$err = "Преподаватель не выбран";	
		}

        if($err==""){
            $login = htmlspecialchars(trim($_POST['login']));
            $password = htmlspecialchars(md5(md5(trim($_POST['password']))));
            
            if(isset($_POST['admin'])){
                $admin=2;
            } else {
                $admin=1;
            }
            
            $query = "INSERT INTO accounts (`login`, `password`, teacher_id, grant_id) 
                      values ('".$login."', '".$password."', '".$teacher."', '".$admin."')";
            mysqli_query($link, $query);
            $text1 = "Успешно! ";
            $text2 = "Пользователь ".$login." создан";
            $type = "alert alert-success alert-dismissible";
        } else { 
            $text1 = "Ошибка! ";
            $text2 = $err;
            $type = "alert alert-danger alert-dismissible";
        }
        unset($_POST);
        close();
    }
?>

<div class='<?php echo $type; ?>' role="alert">
    <button type="button" class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong><?php echo $text1; ?></strong><?php echo $text2; ?>
</div>