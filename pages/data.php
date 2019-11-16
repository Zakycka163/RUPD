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
				switch($_GET["page"]){
					case 'fgos':
						require_once ($_SERVER['DOCUMENT_ROOT']."../front/body/fgos.php");
						
						break;
					case 'disciplines':
						
						break;
					
				};
			} else {
				require_once ($_SERVER['DOCUMENT_ROOT']."../front/body/cards.php");
			}
        ?>
		
    </body>
</html>