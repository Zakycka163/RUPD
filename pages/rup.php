<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>РУПД</title>

        <?php require_once ($_SERVER['DOCUMENT_ROOT']."/front/links.php"); ?>
		
		<link href="../front/css/pointer.css" rel="stylesheet" type="text/css">
        
    </head>
    <body>
		<?php 
			require_once ($_SERVER['DOCUMENT_ROOT']."/back/mandatoryBlock.php");
			require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");
		?>
		<center>
			<div class="p-3 bg-primary font-weight-bold text-white">
				<h3>Разработка РУП</h3>
			</div>
		</center>
        
		<form class="input-group-fluid" method="post" charset="utf-8">
			<div class="px-4 py-3 bg-light">
				<?php require_once ($_SERVER['DOCUMENT_ROOT']."/front/body/rup.php"); ?>
			</div>
		</form>	
    </body>
</html>