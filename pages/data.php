<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Данные</title>

        <?php require_once ($_SERVER['DOCUMENT_ROOT']."../front/links.php") ?>
        
    </head>
    <body>
		<center>
			<div class="p-3 bg-primary font-weight-bold text-white">
				<h3 id="page_title">Работа с данными</h3>
			</div>
		</center>
        
		<?php
			require_once ($_SERVER['DOCUMENT_ROOT']."../back/base.php");
			if (isset($_GET["page"])){
				$current_page = $_GET["page"];
				if (isset($_GET["id"])){
					$current_obj = $_GET["id"];
					if ($_GET["page"] == "fgos"){$page_title = "ФГОС";};
					if ($_GET["page"] == "teachers"){$page_title = "Преподватель";};
					require_once ($_SERVER['DOCUMENT_ROOT']."../back/body/object.php");
				} else {
					require_once ($_SERVER['DOCUMENT_ROOT']."../front/body/".$current_page.".php");
				};
			} else {
				require_once ($_SERVER['DOCUMENT_ROOT']."../front/body/cards.php");
			};
        ?>
		
    </body>
</html>