<?php
    if (isset($_FILES['userfile'])) {
        if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
            $dir = '../Documents/bulk/';
            $uploadfile = $dir.$_POST['file_type'].'_'.basename($_FILES['userfile']['name']);
            if (copy($_FILES['userfile']['tmp_name'], $uploadfile)){               
                require_once ($_SERVER['DOCUMENT_ROOT']."/back/reader.php");
                read($uploadfile, $_POST['file_type']);
            } else { 
                echo "<h4>Ошибка! Не удалось загрузить файл на сервер!</h4>";
                echo $_FILES['userfile']['error'];
            };
        } else {
            echo "<h4>УПС! Кажется мы не нашли файл!</h4>";
        };
    } else {
        echo "<h4>Подождите, идет загрузка...</h4>";
    };   
?>
