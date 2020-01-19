<?php
    if (isset($_FILES['userfile'])) {
        if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
            $dir = '../documents/bulk/';
            $uploadfile = $dir.$_POST['file_type'].'_'.basename($_FILES['userfile']['name']);
            if (copy($_FILES['userfile']['tmp_name'], $uploadfile)){
                echo "  <div class='alert alert-warning'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                                <strong>Внимательно проверь данные!</strong>
                                Затем сохрани данные на сервере!
                        </div>";
                echo "  <div class='alert alert-success'>
                            <table class='table table-borderless'>
                                <tr>
                                    <td width='200'><strong>Категория данных:</strong></td>
                                    <td>".$_POST['file_type_ru']."</td>
                                </tr>
                                <tr>
                                    <td><strong>Имя файла:</strong></td>
                                    <td>".$_FILES['userfile']['name']."</td>
                                </tr>
                            </table>
                        </div>";
                
                require_once ($_SERVER['DOCUMENT_ROOT']."/back/reader.php");
                read($uploadfile, $_POST['file_type']);
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