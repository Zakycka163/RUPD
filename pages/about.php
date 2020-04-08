<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>О система</title>
        <?php require_once ($_SERVER['DOCUMENT_ROOT']."/front/links.php"); ?>
    </head>
    <body>
		<?php require_once ($_SERVER['DOCUMENT_ROOT']."/back/mandatoryBlock.php"); ?>
		<center>
			<div class="p-2 bg-primary font-weight-bold text-white">
				<h4 id="page_title">О системе</h4>
			</div>
		</center>
		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h4 class="display-6">
					<div class="row">
						<div class="col-6 order-1">Разработчик:</div>
						<div class="col-6 order-1">Ставинский Д.А.</div>
						<div class="col-6 order-1">Научный Руководитель:</div>
						<div class="col-6 order-1">Яницкая Т.С.</div>
					</div>
				</h4></br>
				<?php require_once ($_SERVER['DOCUMENT_ROOT']."/README.md"); ?>
			</div>
		</div>
    </body>
</html>