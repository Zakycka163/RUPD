    <?php
        require_once "base.php";

        if(isset($_POST['submit'])){
            connect();
            
            $comment = htmlspecialchars(trim($_POST['comment']));
            $return_date = date('Y-m-d');
            $user_id = $_SESSION["id"];

            if(isset($_POST['work_id'])){
                $work_id = $_POST['work_id'];
                mysqli_query($link,"INSERT INTO returns SET work_id='".$work_id."', comment='".$comment."', return_date='".$return_date."', user_id='".$user_id."'");
                print "<div class='alert alert-success alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <strong>Успешно!</strong> Возврат создан
                    </div>";
                mysqli_query($link,"UPDATE works SET status_id=3 WHERE
                work_id='".$work_id."'");
            } else {
            print "<div class='alert alert-danger alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <strong>Ошибка!</strong> Необходимо выбрать УМР
                    </div>";
            }  
            close();
        }
        
    ?>