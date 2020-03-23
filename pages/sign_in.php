<?php 
    session_start();
    session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Авторизация</title>

        <?php require_once ($_SERVER['DOCUMENT_ROOT']."/front/links.php"); ?>
        
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
                <center><h3 class="form-signin-heading">Авторизация</h3></center>
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
                <center>
                    <button class="btn btn-success" name="submit" type="submit">Вход</button>
                    <a class="btn btn-danger" href="/pages/home.php">Отмена</a>
                </center>
            </form>
            <?php require_once ($_SERVER['DOCUMENT_ROOT']."/back/security/login.php"); ?> 
        </div>
    </body>
</html>