<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Аккаунты</title>
        <?php require_once ($_SERVER['DOCUMENT_ROOT']."/front/links.php"); ?>
		
		<link href="/front/css/pointer.css" rel="stylesheet" type="text/css">  
    </head>
    <body>
		<?php 
			require_once ($_SERVER['DOCUMENT_ROOT']."/back/mandatoryBlock.php"); 
			require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");
			if (isset($_GET["id"])){
				require_once ($_SERVER['DOCUMENT_ROOT']."/front/body/single_obj/user.php");
			} else {
				require_once ($_SERVER['DOCUMENT_ROOT']."/front/body/control/users.php");
			}
		?>
    </body>
</html>