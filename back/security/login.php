<?php
    require_once ($_SERVER['DOCUMENT_ROOT']."../back/base.php");
    
    if(isset($_POST['submit'])){
        connect();
        #$query = mysqli_query($link, "SELECT account_id FROM accounts WHERE login='".mysqli_real_escape_string($link, htmlspecialchars(trim($_POST['login'])))."' AND password='".mysqli_real_escape_string($link, htmlspecialchars(trim($_POST['password'])))."'");
		$query = mysqli_query($link, "SELECT account_id FROM accounts WHERE login='".mysqli_real_escape_string($link, htmlspecialchars(trim($_POST['login'])))."' AND password='".mysqli_real_escape_string($link, htmlspecialchars(md5(md5(trim($_POST['password'])))))."'");
        if(mysqli_num_rows($query) == 1){
            session_start(); 
            $_SESSION["id"]=implode(mysqli_fetch_assoc($query));
            header("Location: ../index.php"); 
            #exit();
        } else {
			require_once ($_SERVER['DOCUMENT_ROOT']."../front/dialogs/loginFail.php");
		}
        close();
    }
?>