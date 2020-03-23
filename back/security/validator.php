<?php 
	if(empty($_SESSION["id"])){
		if( $_SERVER['REQUEST_URI']<>"/pages/home.php"
		and $_SERVER['REQUEST_URI']<>"/pages/sign_in.php"
		and $_SERVER['REQUEST_URI']<>"/pages/about.php"){
			header("Location: ../pages/home.php");
		} 
    }
?>