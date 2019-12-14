<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Аккаунты</title>

        <?php require_once ($_SERVER['DOCUMENT_ROOT']."/front/links.php"); ?>
        
    </head>
    <body>     
        <center>
			<div class="p-3 bg-primary font-weight-bold text-white"><h3>Аккаунты</h3></div>
		</center>
		<form>
			<div class="px-4 py-3 bg-light">
				<?php
					require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");
					if (isset($_GET["id"])){
						require_once ($_SERVER['DOCUMENT_ROOT']."/back/body/user.php");
					} else {
						require_once ($_SERVER['DOCUMENT_ROOT']."/front/body/users.php");
					}
				?>
			</div>
		</form>	
    </body>
</html>