<?php
    if(isset($_POST['submit'])){
        require_once "../blocks/base.php";
        connect();
        
        if (isset($_POST['group']) or $_POST['nameGr']!=null){ 
            if ($_POST['nameGr']!=null){
                $groupName = htmlspecialchars(trim($_POST['nameGr']));                             
                if (isset($_POST['commentGr'])){
                    $groupComment = htmlspecialchars(trim($_POST['commentGr']));
                    mysqli_query($link,"INSERT INTO groups SET name='".$groupName."', comment='".$groupComment."'");                     
                } else {
                    mysqli_query($link,"INSERT INTO groups SET name='".$groupName."'");
                } 
                $query = mysqli_query($link,"SELECT LAST_INSERT_ID()");
                $group_id = implode(mysqli_fetch_assoc($query));
            } else {
                $group_id = $_POST['group'];
            }
        }
        
        if (isset($_POST['type']) and isset($_POST['task']) and $_POST['name']!=null){
            connect();
            $type = $_POST['type'];
            $task = $_POST['task'];
            $date = date('Y-m-d');
            $name = htmlspecialchars(trim($_POST['name']));
            $status = 1;
            
            if(isset($group_id) and $_POST['commentWork']!=null){
                $comment = htmlspecialchars(trim($_POST['commentWork']));
                mysqli_query($link,"INSERT INTO works SET type_id='".$type."', task_id='".$task."', group_id='".$group_id."', name='".$name."', comment='".$comment."', created_date='".$date."', modified_date='".$date."', status_id='".$status."'");
            } elseif (isset($group_id)){
                mysqli_query($link,"INSERT INTO works SET type_id='".$type."', task_id='".$task."', group_id='".$group_id."', name='".$name."', created_date='".$date."', modified_date='".$date."', status_id='".$status."'");
            } elseif ($_POST['commentWork']!=null){
                $comment = $_POST['commentWork'];
                mysqli_query($link,"INSERT INTO works SET type_id='".$type."', task_id='".$task."', name='".$name."', comment='".$comment."', created_date='".$date."', modified_date='".$date."', status_id='".$status."'");
            } else {
                mysqli_query($link,"INSERT INTO works SET type_id='".$type."', task_id='".$task."', name='".$name."', created_date='".$date."', modified_date='".$date."', status_id='".$status."'");
            }
            
            $query = mysqli_query($link,"SELECT LAST_INSERT_ID()");
            $_SESSION["ymr_id"] = implode(mysqli_fetch_assoc($query));
            mysqli_query($link,"UPDATE tasks SET status_id=6 WHERE task_id='".$task."'");
            } else {
                print "<div class='alert alert-danger alert-dismissible' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                            <strong>Не спешите!</strong> Вы не выбрали тип разработки или задачу, повторите ввод данных снова
                        </div>";
            }
    }
?>