<?php 
    require_once ($_SERVER['DOCUMENT_ROOT']."../blocks/base.php");
            
    if(!empty($_SESSION["id"])){
        connect();
        $id=$_SESSION["id"];
        $admin = mysqli_query($link, "SELECT grant_id FROM accounts WHERE account_id='".$id."'");
        $admin=implode(mysqli_fetch_assoc($admin));
        close();
        
        if($admin=="2"){
            require_once ($_SERVER['DOCUMENT_ROOT']."../blocks/navBars/navAdm.php");
        }
        if($admin=="1"){
            require_once ($_SERVER['DOCUMENT_ROOT']."../blocks/navBars/navWork.php");
        }
    } else {
		if($_SERVER['REQUEST_URI']<>"/index.php"){
			if($_SERVER['REQUEST_URI']<>"/pages/about.php"){
				header("Location: ../index.php");
			}
		}
    }
?>