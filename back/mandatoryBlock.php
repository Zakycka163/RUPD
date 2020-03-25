<!-- Mandatory Blocks -->
<?php 
	require_once ($_SERVER['DOCUMENT_ROOT']."/back/security/validator.php");
	if($_SERVER['REQUEST_URI']<>"/pages/sign_in.php" and $_SERVER['REQUEST_URI']<>"/pages/sign_up.php"){
		require_once ($_SERVER['DOCUMENT_ROOT']."/front/navBar.php");
		require_once ($_SERVER['DOCUMENT_ROOT']."/front/footer.php");
	}	
?>