<?php 
    require_once ($_SERVER['DOCUMENT_ROOT']."../blocks/base.php");
            
    if(!empty($_SESSION["id"])){
        require_once ($_SERVER['DOCUMENT_ROOT']."../blocks/buttons/exit.php");
    } else {
		require_once ($_SERVER['DOCUMENT_ROOT']."../blocks/buttons/sign_in.php");
    }
?>