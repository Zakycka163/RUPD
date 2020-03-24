<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Данные</title>
        <?php require_once ($_SERVER['DOCUMENT_ROOT']."/front/links.php") ?>
		<link href="/front/css/pointer.css" rel="stylesheet" type="text/css">
    </head>
    <body>
		<?php require_once ($_SERVER['DOCUMENT_ROOT']."/back/mandatoryBlock.php"); ?>
		<center>
			<div class="p-3 bg-primary font-weight-bold text-white">
				<h3 id="page_title">Работа с данными</h3>
			</div>
		</center>
        
		<?php
			require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");
			if (isset($_GET["page"])){
				$current_page = $_GET["page"];
				require_once ($_SERVER['DOCUMENT_ROOT']."/front/body/data/".$current_page.".php");
			} else {
				require_once ($_SERVER['DOCUMENT_ROOT']."/front/body/cards.php");
			};
        ?>
		
    </body>
</html>