<!DOCTYPE html>
<?php 
    session_start();
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Список задач</title>

        <?php 
            require_once "../blocks/links.php"; 
            require_once "../security/valid.php";
            require_once "../blocks/base.php";
        ?>
        
    </head>
    <body>
        <center><h3>Задачи</h3></center>
            <?php
                connect();
                $result = mysqli_query($link, "SELECT u.kafedra, u.first_name, u.second_name, u.email, t.task, t.due_date, s.status FROM tasks t, statuses s, users u WHERE t.user_id=u.user_id AND t.status_id=s.status_id ORDER BY u.kafedra, u.email, s.status, t.due_date");
                if($result){
                    echo "<table class='table table-bordered'><tr class='active'><td>№</td><td>Кафедра</td><td>Пользователь</td><td>Задача</td><td>Дата завершения</td><td>Статус задачи</td></tr>";
                    $i = 1; 
                    while($row = mysqli_fetch_row($result)){
                        echo "<tr><td>".$i."</td><td>".$row[0]."</td><td>".$row[1]." ".$row[2]." (".$row[3].")</td><td>".$row[4]."</td><td>".$row[5]."</td><td>".$row[6]."</td></tr>";
                        $i++;
                    }
                    echo "</table>";
                } else {
                    print "<div class='alert alert-info alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <strong>Задачи не определены!  </strong><a class='btn btn-primary' href='../pages/createMission.php' type='button'>Определить</a></div>";
                }
                close();
            ?>
    </body>
</html>