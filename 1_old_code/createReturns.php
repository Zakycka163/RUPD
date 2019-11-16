<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Возврат УМР</title>

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
                <center><h3 class="form-signin-heading">Создание возврата</h3></center>
                <div class="input-group">
                    <label for="ymr">УМР</label>
                    <select class='form-control' required name="work_id">
                        <option selected disabled style="display:none;">Выбрать разработку</option>
                        <?php 
                            require_once ($_SERVER['DOCUMENT_ROOT']."../blocks/base.php");
                            connect();
                            $result = mysqli_query($link, "SELECT w.work_id, ta.task, w.name, ty.type, s.status FROM works w, tasks ta, types ty, statuses s WHERE w.task_id=ta.task_id AND w.type_id=ty.type_id AND w.status_id=s.status_id");
                            while($row = mysqli_fetch_array($result)){
                                echo "<option value='".$row[0]."' title='Задача: ".$row[1]."; Статус: ".$row[4]."'>".$row[2]." (".$row[3].")</option>";
                            }
                            close();                    
                        ?>
                    </select>
                    
                </div><br>
                <div class="input-group">
                    <label for="task">Замечания</label>
                    <textarea rows="4" minlength=2 maxlength="100" required class="form-control" name="comment"></textarea>
                </div><br>
                <center>
                    <input class="btn btn-success" name="submit" type="submit" value="Создать">
                    <a class="btn btn-primary" href="../index.php" type="button">Вернуться</a>
                </center>
            </form>
            
            <?php require_once "../blocks/createRet.php" ?>
                        
        </div> <!-- /container -->
    </body>
</html>