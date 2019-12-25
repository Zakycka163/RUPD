<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>В разработке</title>
    <?php require_once ($_SERVER['DOCUMENT_ROOT']."/front/links.php"); ?>
  </head>
  <body>
    <?php require_once ($_SERVER['DOCUMENT_ROOT']."/back/mandatoryBlock.php"); ?>
    <center>
      <div class="p-3 bg-primary font-weight-bold text-white">
        <h3>Данная страница (функция) в разработке</h3>
      </div>
    </center>
    <br><br><br>
    <center><img src="/front/img/onHold.png" alt="404" title="404"></center>
  </body>
</html>