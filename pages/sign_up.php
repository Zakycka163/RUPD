<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Создание пользователя</title>

        <?php require_once ($_SERVER['DOCUMENT_ROOT']."../front/links.php"); ?>
        
        <link href="../front/css/sign.css" rel="stylesheet" type="text/css">
        <link href="../front/css/background.css" rel="stylesheet" type="text/css">
        
        <style type="text/css">
            body {
                padding-top: 100px;
                padding-bottom: 315px; 
			}
        </style>
        
    </head>
    <body>
        <div class="container">
		
            <form class="form-signin" method="post">
                <center><h3 class="form-signin-heading">Создать аккаунт</h3></center>
                <br>
				<div class="input-group">
                    <span class="input-group-text" id="basic-addon1">-></span>
                    <input lang="en" type="login" name="login" minlength="4" maxlength="16" class="form-control" placeholder="Логин" aria-describedby="basic-addon1" required>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">-></span>
                    <input type="password" name="password" minlength="4" maxlength="32" class="form-control" placeholder="Пароль" aria-describedby="basic-addon1" required>
                </div>
				<br>
                <div class="input-group">
					<select class="form-control" id="teacher" name="teacher" required>
                        <option selected disabled style="display:none;">Выбрать преподавателя</option>
						
						<?php 
							require_once ($_SERVER['DOCUMENT_ROOT']."../back/base.php");
                            options_present("SELECT teacher_id, CONCAT_WS(' ',second_name,CONCAT(LEFT(first_name,1),'.'),CONCAT(LEFT(middle_name,1),'.')) as teacher FROM teachers");
						?>
						
					</select>
                </div>
				<br>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="admin" value=1> Права администратора
                    </label>
                </div>            
                <center>
                    <button class="btn btn-success" name="submit" type="submit">Создать</button>
                    <a class="btn btn-danger" href="../pages/users.php">Вернуться</a>
                </center>
            </form>
            
			<?php require_once ($_SERVER['DOCUMENT_ROOT']."../back/security/register.php"); ?> 
            
        </div>
    </body>
</html>