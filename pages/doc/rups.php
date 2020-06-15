<?php session_start() ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>РУПД</title>

    <?php require_once ($_SERVER['DOCUMENT_ROOT']."/front/links.php"); ?>

</head>

<body>
    <?php require_once ($_SERVER['DOCUMENT_ROOT']."/back/mandatoryBlock.php"); ?>

    <center>
        <div class="p-2 bg-primary font-weight-bold text-white">
            <h4 id="page_title">Рабочие учебные программы</h4>
        </div>
    </center>
    <div class="px-4 py-3 bg-light">
        <div class="form-group">
            <div class="btn-group btn-group-sm" role="group">
                <button type="button" class="btn btn-success">Добавить</button>
            </div>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col" style="width: 2rem">№</th>
                    <th scope="col">-</th>
                    <th scope="col">-</th>
                    <th scope="col">-</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">1</td>
                    <td><a href="#">-</a></td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td scope="row">2</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            </tbody>
        </table>
        <nav>
            <ul class="pagination pagination-sm">
                <li class="page-item disabled">
                    <a class="page-link" href="#">Предыдущая</a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">Следующая</a>
                </li>
            </ul>
        </nav>
    </div>
</body>

</html>