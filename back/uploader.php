<?php
    if (isset($_FILES['userfile'])) {
        if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
            $uploaddir = '../documents/bulk/';
            $uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
            if (copy($_FILES['userfile']['tmp_name'], $uploadfile)){
                echo "<p><b>Имя загруженного файла: ".$_FILES['userfile']['name']."</b></p>";
            } else { 
                echo "<h4>Ошибка! Не удалось загрузить файл на сервер!</h4>";
                echo $_FILES['userfile']['error'];
            };
        } else {
            echo "<h4>УПС! Кажется мы потеряли файл!</h4>";
        };
    } else {
        echo "<h4>Подождите, идет загрузка...</h4>";
    };   
?>