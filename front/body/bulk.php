<div class="px-4 py-3" <?php echo ((isset($_FILES['userfile'])) ? 'hidden' : '');?> >
	<div class="row">
		<div class="col">
			<div class="card border-primary form-group" style="width: 35rem; height: 11rem">
				<div class="card-body">
					<h5 class="card-title">Массовое создание</h5>
                    <div class="input-group input-group-sm" style="width: 30rem;">
                        <select class="custom-select" id="bulk_type">
                            <option value="0">Выбрать тип массового создания</option>
                            <option value="teachers">Преподаватели</option>
                            <option value="disciplines">Дисциплины</option>
                            <option value="courses_fgos_profstandards">Направления</option>
                            <option value="profstandards_otf_tf_activities">Трудовые функции</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-sm" id="get_template" type="button" disabled style="width: 9rem;">Получить шаблон</button>
                        </div>
                    </div>
                </div>
				<div class="card-footer btn-group" id="file_loader" hidden>
                    <form method="post" enctype="multipart/form-data">
                        <input type="text" id="file_type" name="file_type" value="" hidden>
                        <input type="text" id="file_type_ru" name="file_type_ru" value="" hidden>
                        <p class="btn-group" role="group" style="width: 30rem;">
                            <input type="file" id="user_file_name" name="userfile" accept=".xlsx" class="btn btn-secondary btn-sm">
                            <input type="submit" value="Загрузить" id="start_upload" class="btn btn-success btn-sm">
                        </p>
                    </form>
                </div>
			</div>
		</div>	
	</div>
</div>
<form id="content_form" <?php echo ((isset($_FILES['userfile'])) ? '' : 'hidden');?> >
	<div class="px-4 py-3 bg-light">
        <div class='alert alert-success' style="height: 5rem">
            <div class="row justify-content-start" style="height: 2rem">
                <div class="col-2"><strong>Категория данных:</strong></div>
                <div class="col-2"><?php echo $_POST['file_type_ru']; ?></div>
            </div>
            <div class="row" style="height: 2rem">
                <div class="col-2"><strong>Имя файла:</strong></div>
                <div class="col-2"><?php echo $_FILES['userfile']['name']; ?></div>
            </div>
        </div>     
        <div class="form-group">
            <?php require_once ($_SERVER['DOCUMENT_ROOT']."/back/uploader.php"); ?>
        </div>
    </div>
</form>
<?php 
	require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/loader_form.php");	
?>
<script>
    $(document).ready(function() {
        $("#bulk_type").change(function() {
            var bulk_type = $("#bulk_type").val();
            var bulk_type_ru = $("#bulk_type option:selected").text();
            if (bulk_type == 0) {
                $('#get_template').prop('disabled', true);
                $('#file_loader').prop('hidden', true);
            } else {
                $('#file_loader').prop('hidden', false);
                $("#file_type").val(bulk_type);
                $("#file_type_ru").val(bulk_type_ru);
                $('#get_template').prop('disabled', false);
                $("#get_template").click(function() {
                    location.href = "../templates/bulk_templates/"+bulk_type+".xlsx";
                });
            };
        });

        $("#save").click(function() {
            var file_on_server = <?php echo ((isset($_FILES['userfile'])) ? "'".$uploadfile."'" : "''");  ?>;
            var file_type_on_server = <?php echo ((isset($_FILES['userfile'])) ? "'".$_POST['file_type']."'" : "''");  ?>;
            $('#loader_form').modal('show');
            $('#save').prop('hidden', true);
            $('#cancel').prop('hidden', true);
            $('#alert_presenter').prop('hidden', true);
			$.post(
				"../back/writer.php", 
				{file_type: file_type_on_server, uploadfile: file_on_server}, 
				function(info){
					if (info == "") {
                        $('#success_presenter').prop('hidden', false);
                        $('#loader_form').modal('hide');
                        $('#cancel').prop('hidden', false);
                        alert("Успешно");
					} else {
                        $('#error_presenter').prop('hidden', false);
                        $('#cancel').prop('hidden', false);
                        $('#loader_form').modal('hide');
                        $('#text_error').text(info);
						alert(info);
					}
				}
			);
        });

        $("#cancel").click(function() {
            location.href = "/pages/data.php?page=bulk";
        });
    });
</script>
