<!DOCTYPE html>
<?php session_start(); ?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Определение задачи</title>

        <?php 
            require_once "../blocks/links.php";
            require_once "../security/validSignUp.php";
        ?>
        
        <link href="../css/sign.css" rel="stylesheet" type="text/css">
        <link href="../css/background.css" rel="stylesheet" type="text/css">
        
        <style type="text/css">
            body {
                padding-top: 100px;
                padding-bottom: 49px;    
        </style>
        
    </head>
    <body>
        <div class="container">
            <form class="form-signin" method="post" charset="utf-8">
                <center><h3 class="form-signin-heading">Определить задачу</h3></center>
                <div class="input-group">
                    <label for="user">Преподаватель</label>
                    <select class='form-control' required name="user_id">
                        <option selected disabled style="display:none;">Выбрать пользователя</option>
                        <?php 
                            require_once ($_SERVER['DOCUMENT_ROOT']."/MyProg/blocks/base.php");
                            connect();
                            $result = mysqli_query($link, "SELECT user_id, first_name, second_name, email FROM users");
                            while($row = mysqli_fetch_array($result)){
                                echo "<option value='".$row['user_id']."' title='".$row['email']."'>".$row['first_name']." ".$row['second_name']."</option>";
                            }
                            close();                    
                        ?>
                    </select>
                    
                </div><br>
                <div class="input-group">
                    <label for="task">Задача</label>
                    <textarea placeholder="Описание задачи" wrap="soft" rows="4" minlength=2 maxlength="100" required class="form-control" name="task"></textarea>
                </div><br>
                <div class="input-group">
                    <label for="due_date">Дата завершения</label>
                    <input type="date" required class="form-control" name="due_date">
                </div><br>         
                <center>
                    <input class="btn btn-success" name="submit" type="submit" value="Определить">
                    <a class="btn btn-primary" href="../index.php" type="button">Вернуться</a>
                </center>
            </form>
            
            <?php require_once "../blocks/createMiss.php" ?>
                        
        </div> <!-- /container -->
    </body>
</html>