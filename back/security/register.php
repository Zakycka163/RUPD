<?php  
    if(isset($_POST['submit'])){
        $err = "";
        
        connect();
		if(isset($_POST['teacher'])){
			$teacher = $_POST['teacher'];
			$login = htmlspecialchars(trim($_POST['login']));
			$query = mysqli_query($link, "SELECT account_id FROM accounts WHERE login='".mysqli_real_escape_string($link, $login)."'");
			if(mysqli_num_rows($query) > 0){
				$err .= "Логин уже используется. ";
			}
			$query = mysqli_query($link, "SELECT account_id FROM accounts WHERE teacher_id='".mysqli_real_escape_string($link, $teacher)."'");
			if(mysqli_num_rows($query) > 0){
				$err .= "Преподаватель уже имеет аккаунт.";
			}	
		} else {
			$err = "Преподаватель не выбран";	
		}

        if($err==""){
            $login = htmlspecialchars(trim($_POST['login']));
            $password = htmlspecialchars(md5(md5(trim($_POST['password']))));
            
            if($_POST['admin']=null){
                $admin=1;
            } else {
                $admin=2;
            }
            
            mysqli_query($link,"INSERT INTO accounts (login, password, teacher_id, grant_id) values ('".$login."', '".$password."', '".$teacher."', '".$admin."'");
            print "<div class='alert alert-success alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <strong>Успешно!</strong> Пользователь ".$admin." создан
                    </div>";
        } else {
            print "<div class='alert alert-danger alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <strong>Ошибка!</strong> ".$err."
                    </div>";
        }
        close();
    }
?>