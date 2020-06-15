<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>В разработке</title>
    <?php require_once ($_SERVER['DOCUMENT_ROOT']."/front/links.php"); ?>
</head>

<body>
    <?php require_once ($_SERVER['DOCUMENT_ROOT']."/back/mandatoryBlock.php"); ?>
    <div class="px-4 py-2 bg-primary font-weight-bold text-white container-fluid">
        <div class="row">
            <a class="btn btn-warning btn-sm back" href="javascript:history.go(-1)"
                style="height: 35px; width: 5rem; margin-left: 1rem" title="Назад" data-toggle="tooltip"
                data-placement="right">&#8592; Назад</a>
            <div class="h4" id="page_title" style="margin-left: 30%">Данная страница (функция) в разработке</div>
        </div>
    </div>
    <div class="d-flex justify-content-center py-2">
        <img src="/front/img/onHold.png" title="404">
    </div>
</body>

</html>