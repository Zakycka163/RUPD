<?php session_start(); ?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Разработка</title>
    <?php require_once ($_SERVER['DOCUMENT_ROOT']."/front/links.php"); ?>
</head>

<body>
    <?php require_once ($_SERVER['DOCUMENT_ROOT']."/back/mandatoryBlock.php"); ?>
    <center>
        <div class="p-2 bg-primary font-weight-bold text-white">
            <h4 id="page_title">Главная</h4>
        </div>
    </center>
    <?php require_once ($_SERVER['DOCUMENT_ROOT']."/front/body/tasks.php"); ?>
</body>

</html>