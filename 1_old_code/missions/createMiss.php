    <?php
        require_once "base.php";

        if(isset($_POST['submit'])){
            connect();
            
            $task = htmlspecialchars(trim($_POST['task']));
            $due_date = $_POST['due_date'];
            
            $status = 5;
            if(isset($_POST['user_id'])){
                $user_id = $_POST['user_id'];
                mysqli_query($link,"INSERT INTO tasks SET user_id='".$user_id."', task='".$task."', due_date='".$due_date."', status_id='".$status."'");
                print "<div class='alert alert-success alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <strong>Успешно!</strong> Задача определена
                    </div>";
            } else {
            print "<div class='alert alert-danger alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <strong>Ошибка!</strong> Пользователь не определен
                    </div>";
            }  
            close();
        }
        
    ?>