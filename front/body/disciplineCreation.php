<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Данные</title>

        <?php 
            require_once ($_SERVER['DOCUMENT_ROOT']."../blocks/links.php");
			require_once ($_SERVER['DOCUMENT_ROOT']."../blocks/base.php");			           
        ?>
        
    </head>
    <body>
		<center>
			<div class="p-3 bg-primary font-weight-bold text-white"><h3>Создание дисциплины</h3></div>
		</center>
        
        <?php
            if(isset($_SESSION["IdDiscipline"])){        
                echo "<div class='panel panel-success'>
                        <div class='panel-heading'>";            
                connect();
                $id = $_SESSION["ymr_id"];
                $result = mysqli_query($link, "SELECT ty.type, w.name, ta.task, w.comment FROM types ty, works w, tasks ta WHERE w.work_id='".$id."' AND ty.type_id=w.type_id AND ta.task_id=w.task_id");
            } else {
                
            }
        ?>
    </body>
</html>