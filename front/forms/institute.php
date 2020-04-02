<div class="modal fade" id="institute_form" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="institute_form_title">Создание института</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-borderless table-sm">
					<tr>
						<td class="align-middle">Название<span style="color: red">*</span></td>
						<td width="70%">
							<input type="text" id="inst_name" maxlength="60" class="form-control form-control-sm" data-toggle="popover" data-placement="right" data-content="Нужно заполнить!">
						</td>
					</tr>
					<tr>
						<td class="align-middle">Описание</td>
						<td>
							<textarea type="text" id="inst_description" maxlength="60" class="form-control form-control-sm"></textarea>
						</td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<?php if (isset($_GET["id"])) { ?>
					<button type="button" class="btn btn-sm btn-primary" id="save_institute">Сохранить</button>
				<?php } else { ?>
					<button type="button" class="btn btn-sm btn-primary" id="add_new_institute">Создать</button>
				<?php }; ?>
				<button type="button" class="btn btn-sm btn-secondary" id="close" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>
<script>
	function $_GET(key) {
		var s = window.location.search;
		s = s.match(new RegExp(key + '=([^&=]+)'));
		return s ? s[1] : false;
	}

	$("#close").click(function(){
		location.href='data.php?page=institutes';
	});

	$("#inst_name").mouseenter (function(){
		$('#inst_name').removeClass('error-pointer');
		$('#inst_name').popover('hide');
	});

	$("#add_new_institute").click(function(){
		let inst_name = $("#inst_name").val();
		let inst_description = $("#inst_description").val();

		if (inst_name == '') {
			$('#inst_name').addClass('error-pointer');
			$('#inst_name').popover('show');
		} else {
			$.post(
			 	"/back/data/db_institutes.php", 
				{functionname: 'create_institute', name: inst_name
												 , description: inst_description}, 
				function(info){
					if (info !== '1') {
						alert(info);
					} else {
						$('#institute_form').modal('hide');
						alert('Институт создан');
						location.href='data.php?page=institutes';
					}
				}
			);
		}
	});

	$("#save_institute").click(function(){
		let inst_name = $("#inst_name").val();
		let inst_description = $("#inst_description").val();

		if (inst_name == '') {
			$('#inst_name').addClass('error-pointer');
			$('#inst_name').popover('show');
		} else {
			$.post(
			 	"/back/data/db_institutes.php", 
				{functionname: 'edit_institute', id: $_GET('id')
											   , name: inst_name
											   , description: inst_description}, 
				function(info){
					if (info !== '1') {
						alert(info);
					} else {
						$('#institute_form').modal('hide');
						alert('Институт обновлен');
						location.href='data.php?page=institutes';
					}
				}
			);
		}
	});
</script>