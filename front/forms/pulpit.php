<div class="modal fade" id="pulpit_form" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div>
					<h5 class="modal-title" id="pulpit_form_title">Создание кафедры</h5>
				</div>
				<button type="button" class="close close_form" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-borderless table-sm">
					<tr>
						<td class="align-middle">Институт<span style="color: red">*</span></td>
						<td>
							<div class="input-group input-group-sm" id="parent_inst" data-toggle="popover" data-placement="right" data-content="Нужно выбрать!">
								<input type="text" id="parent_inst_name" class="form-control form-control-sm" value="Отсутствует" data-toggle="tooltip" data-placement="top" readonly>
								<div class="input-group-append">
									<button class="btn btn-outline-success btn-sm" id="add_parent_inst_name" type="button">Выбрать</button>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td class="align-middle">Название<span style="color: red">*</span></td>
						<td width="70%">
							<input type="text" id="pul_name" maxlength="60" class="form-control form-control-sm" data-toggle="popover" data-placement="right" data-content="Нужно заполнить!">
						</td>
					</tr>
					<tr>
						<td class="align-middle">Описание</td>
						<td>
							<textarea type="text" id="pul_description" maxlength="60" class="form-control form-control-sm"></textarea>
						</td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">	
				<?php if (isset($_GET["kafid"])) { ?>
					<button type="button" class="btn btn-sm btn-danger" id="delete_pulpit">Удалить</button>
					<button type="button" class="btn btn-sm btn-primary" id="save_pulpit">Сохранить</button>
				<?php } else { ?>
					<button type="button" class="btn btn-sm btn-primary" id="add_new_pulpit">Создать</button>
				<?php }; ?>
				<button type="button" class="btn btn-sm btn-secondary close_form" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="add_parent_inst_name_form" tabindex="-2" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">Институты</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-borderless table-sm">
					<tr>
						<td>
							<select class="form-control form-control-sm" id="inst_val">
								<option selected value="null">Отсутствует</option>
								
								<?php 
									require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");
									options_present("SELECT institute_id
														  , `name`
													 FROM institutes  
													 ORDER BY institute_id");
								?>
							
							</select>
						</td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-success" id="save_parent_inst_name_button">Сохранить</button>
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>

<script>
	$("#pul_name").mouseenter (function(){
		$('#pul_name').removeClass('error-pointer');
		$('#pul_name').popover('hide');
	});

	$("#parent_inst_name").mouseenter (function(){
		$('#parent_inst').removeClass('error-pointer');
		$('#parent_inst').popover('hide');
	});

	$("#parent_inst_name").mouseenter (function(){
		$('#parent_inst_name').tooltip('show');
	});

	$("#add_parent_inst_name").click(function(){
		$("#add_parent_inst_name_form").modal('show');
	});

	$("#save_parent_inst_name_button").click(function(){
		var inst_id = $("#inst_val").val();
		var inst_text = $("#inst_val option:selected").text();
		$("#parent_inst_name").val(inst_text);
		$("#parent_inst_name").prop('title',inst_text);

		if (inst_id !== "null"){
			$("#add_parent_inst_name").removeClass('btn-outline-success');
			$("#add_parent_inst_name").addClass('btn-outline-primary');
			$("#add_parent_inst_name").text('Изменить');
		} else {
			$("#add_parent_inst_name").removeClass('btn-outline-primary');
			$("#add_parent_inst_name").addClass('btn-outline-success');
			$("#add_parent_inst_name").text('Выбрать');
		}
		$("#add_parent_inst_name_form").modal('hide');
	});

	$("#add_new_pulpit").click(function(){
		let pul_name = $("#pul_name").val();
		let pul_description = $("#pul_description").val();
		let inst_id = $("#inst_val").val();

		if (inst_id == "null") {
			$('#parent_inst').addClass('error-pointer');
			$('#parent_inst').popover('show');
		} else if (pul_name == '') {
			$('#pul_name').addClass('error-pointer');
			$('#pul_name').popover('show');
		} else {
			$.post(
			 	"/back/data/db_pulpits.php", 
				{functionname: 'create_pulpit', instid: inst_id
											  , name: pul_name
											  , description: pul_description}, 
				function(info){
					if (info !== '1') {
						alert(info);
					} else {
						$('#pulpit_form').modal('hide');
						alert('Кафедра создана');
						location.href='data.php?page=institutes';
					}
				}
			);
		}
	});

	$("#save_pulpit").click(function(){
		let pul_name = $("#pul_name").val();
		let pul_description = $("#pul_description").val();
		let inst_id = $("#inst_val").val();

		if (inst_id == "null") {
			$('#parent_inst').addClass('error-pointer');
			$('#parent_inst').popover('show');
		} else if (pul_name == '') {
			$('#pul_name').addClass('error-pointer');
			$('#pul_name').popover('show');
		} else {
			$.post(
			 	"/back/data/db_pulpits.php", 
				{functionname: 'edit_pulpit', id: $_GET('kafid')
											, instid: inst_id
											, name: pul_name
											, description: pul_description}, 
				function(info){
					if (info !== '1') {
						alert(info);
					} else {
						$('#pulpit_form').modal('hide');
						alert('Кафедра обновлена');
						location.href='data.php?page=institutes';
					}
				}
			);
		}
	});

	$("#delete_pulpit").click(function(){
		let pul_name = $("#pul_name").val();
		let pulpit_form_title =$('#pulpit_form_title').text();

		if (confirm('Вы действительно хотите удалить объект '+pulpit_form_title+' "'+pul_name+'"?')) {
			$.post(
			 	"/back/data/db_pulpits.php", 
				{functionname: 'remove_pulpit', id: $_GET('kafid')}, 
				function(info){
					if (info !== '1') {
						alert(info);
					} else {
						$('#pulpit_form').modal('hide');
						alert('Кафедра удалена');
						location.href='data.php?page=institutes';
					}
				}
			);
		}
	});
</script>