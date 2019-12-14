<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Разработка</title>

        <?php
			    require_once ($_SERVER['DOCUMENT_ROOT']."/front/links.php");
        ?>
        
    </head>
    <body>
		<center>
			<div class="p-3 bg-primary font-weight-bold text-white"><h3>Главная</h3></div>
		</center>
		
		<?php
      require_once ($_SERVER['DOCUMENT_ROOT']."/back/detectors/tasks.php");
		?>
		
    </body>
</html>