<?php
    if (isset($_FILES['userfile'])) {
        if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
            $uploaddir = '../documents/bulk/';
            $uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
            if (copy($_FILES['userfile']['tmp_name'], $uploadfile)){
                echo "<h3>Файл успешно загружен на сервер</h3>";
                echo "<h3>Информация о загруженном на сервер файле: </h3>";
                echo "<p><b>Оригинальное имя загруженного файла: ".$_FILES['userfile']['name']."</b></p>";
                echo "<p><b>Mime-тип загруженного файла: ".$_FILES['userfile']['type']."</b></p>";
                echo "<p><b>Размер загруженного файла в байтах: ".$_FILES['userfile']['size']."</b></p>";
                echo "<p><b>Временное имя файла: ".$_FILES['userfile']['tmp_name']."</b></p>";
            } else { 
                echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3>";
                echo $_FILES['userfile']['error'];
            };
        } else {
            echo "<h3>Потеряли файл!</h3>";
        };
    } else {
        echo "<h3>Еще ничего нет</h3>";
    };   
?>