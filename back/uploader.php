<?php
    if (isset($_FILES['userfile'])) {
        if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
            $dir = '../documents/bulk/';
            $uploadfile = $dir.$_POST['file_type'].'_'.basename($_FILES['userfile']['name']);
            if (copy($_FILES['userfile']['tmp_name'], $uploadfile)){
                echo "<p><b>Имя файла:</b> ".$_FILES['userfile']['name']."; <b>Категория данных:</b> ".$_POST['file_type_ru'].".</p>";
                echo "<p>Внимательно проверь данные! Затем сохрани данные на сервере!</p>";
                
                require_once ($_SERVER['DOCUMENT_ROOT']."/back/phpExcelUse.php");
                ($_POST['file_type'] == "teachers" && $_POST['file_type'] == "disciplines") ? 'G' : (($_POST['file_type'] == "profstandards_otf_tf_activities") ? 'L' : 'M');
                read($uploadfile,'G');
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