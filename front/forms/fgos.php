<div class="modal fade" id="fgos_form" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="form_title">Создание ФГОС</h5>
				<button type="button" class="close close_form" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-borderless table-sm">
					<tr>
						<td class="align-middle">Направление<span style="color: red">*</span></td>
						<td width="65%" data-toggle="popover" data-placement="right" data-content="Нужно заполнить!">
							<input class="form-control-plaintext form-control-sm" id="get_course" readonly hidden><div id="course_id" hidden></div>
							<select class="form-control form-control-sm" id="empty_course" hidden>
								<option selected disabled>Выбрать направление</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="align-middle">Дата утверждения<span style="color: red">*</span></td>
						<td>
							<input class="form-control form-control-sm" type="date" id="input_date" min="2008-01-01" max="2025-12-31" data-toggle="popover" data-placement="right" data-content="Нужно заполнить!">
						</td>
					</tr>
					<tr>
						<td class="align-middle">Номер приказа<span style="color: red">*</span></td>
						<td>
							<input class="form-control form-control-sm" type="number" id="input_number" max="99999" data-toggle="popover" data-placement="right" data-content="Нужно заполнить!">
						</td>
					</tr>
					<tr>
						<td class="align-middle">Дата регистрации<span style="color: red">*</span></td>
						<td>
							<input class="form-control form-control-sm" type="date" id="reg_date" min="2008-01-01" max="2025-12-31" data-toggle="popover" data-placement="right" data-content="Нужно заполнить!">
						</td>
					</tr>
					<tr>
						<td class="align-middle">Номер регистрации<span style="color: red">*</span></td>
						<td>
							<input class="form-control form-control-sm" type="number" id="reg_number" max="99999" data-toggle="popover" data-placement="right" data-content="Нужно заполнить!">
						</td>
					</tr>
				</table>
				<div class="alert alert-danger" role="alert" id="error_params" hidden>
                    Все поля должны быть заполнены! 
                </div>
			</div>
			<div class="modal-footer">
				<?php if (isset($_GET["id"])) { ?>
					<button type="button" class="btn btn-sm btn-danger" id="delete_fgos">Удалить</button>
					<button type="button" class="btn btn-sm btn-primary" id="edit_fgos">Сохранить</button>
				<?php } else { ?>
					<button type="button" class="btn btn-sm btn-primary" id="save_fgos">Создать</button>
				<?php }; ?>
				<button type="button" class="btn btn-sm btn-secondary close_form" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>
<script>
	$("#course_error").mouseenter (function(){
		$('#course_error').removeClass('error-pointer');
		$('#course_error').popover('hide');
	});	
	$("#input_date").mouseenter (function(){
		$('#input_date').removeClass('error-pointer');
		$('#input_date').popover('hide');
	});	
	$("#input_number").mouseenter (function(){
		$('#input_number').removeClass('error-pointer');
		$('#input_number').popover('hide');
	});
	$("#reg_date").mouseenter (function(){
		$('#reg_date').removeClass('error-pointer');
		$('#reg_date').popover('hide');
	});
	$("#reg_number").mouseenter (function(){
		$('#reg_number').removeClass('error-pointer');
		$('#reg_number').popover('hide');
	});

	$("#save_fgos").click(function(){
		$('#error_params').prop('hidden',true);
		var get_course_id = $("#course_id").text();
		if (get_course_id == ''){
			var get_course_id = $("#empty_course option:selected").val();
		};

		if (get_course_id !== ''){
			var fgos_date = $("#input_date").val();
			var fgos_reg_date = $("#reg_date").val();
			var fgos_number = $("#input_number").val();
			var fgos_reg_number = $("#reg_number").val();

			if (fgos_date == ''){
				$('#input_date').addClass('error-pointer');
				$('#input_date').popover('show');
			} else if (fgos_number == ''){
				$('#input_number').addClass('error-pointer');
				$('#input_number').popover('show');
			} else if (fgos_reg_date == ''){
				$('#reg_date').addClass('error-pointer');
				$('#reg_date').popover('show');
			} else if (fgos_reg_number == '') {
				$('#reg_number').addClass('error-pointer');
				$('#reg_number').popover('show');
			} else {
				$.post(
					"/back/data/db_fgos.php", 
					{functionname: 'create_fgos', course: get_course_id
												, date: fgos_date
												, number: fgos_number
												, reg_date: fgos_reg_date
												, reg_number: fgos_reg_number}, 
					function(info){
						if (info == '') { 
							$('#fgos_form').modal('hide');
						}
					}
				);
				var course_value = $("#input_course").val();
				$.post(
					"/back/switch_functions.php", 
					{functionname: 'get_fgos_id', param: course_value}, 
					function(info){
						$('#info_fgos_id').text(info); 
						$.post(
							"/back/switch_functions.php", 
							{functionname: 'get_prof_stand', param: info}, 
							function(info1){
								if (info1 !== null){
									$('#input_prof_stad').html(info1);
									$('#input_prof_stad').prop('disabled', false);
								}
							}
						);
					}
				);
				$.post(
					"/back/switch_functions.php", 
					{functionname: 'get_fgos_info', param: course_value}, 
					function(info){
							$('#div_create_info_fgos').prop('hidden',true);
							$('#info_fgos').text(info);
					}
				);
			}
		} else { $('#error_params').prop('hidden',false); };
	});

	$("#edit_fgos").click(function(){
		$('#error_params').prop('hidden',true);
		var get_course_id = $("#course_id").text();
		if (get_course_id == ''){
			var get_course_id = $("#empty_course option:selected").val();
		};

		if (get_course_id !== ''){
			var fgos_date = $("#input_date").val();
			var fgos_reg_date = $("#reg_date").val();
			var fgos_number = $("#input_number").val();
			var fgos_reg_number = $("#reg_number").val();

			if (fgos_date == ''){
				$('#input_date').addClass('error-pointer');
				$('#input_date').popover('show');
			} else if (fgos_number == ''){
				$('#input_number').addClass('error-pointer');
				$('#input_number').popover('show');
			} else if (fgos_reg_date == ''){
				$('#reg_date').addClass('error-pointer');
				$('#reg_date').popover('show');
			} else if (fgos_reg_number == '') {
				$('#reg_number').addClass('error-pointer');
				$('#reg_number').popover('show');
			} else {
				$.post(
					"/back/data/db_fgos.php", 
					{functionname: 'edit_fgos', id: $_GET('id')
											  , course: get_course_id
											  , date: fgos_date
											  , number: fgos_number
											  , reg_date: fgos_reg_date
											  , reg_number: fgos_reg_number},  
					function(info){
						if (info !== '1') {
							alert(info);
						} else {
							$('#fgos_form').modal('hide');
							alert('ФГОС обновлен');
							location.href='data.php?page=fgos';
						}
					}
				);
			}
		} else { $('#error_params').prop('hidden',false); };
	});

	$("#delete_fgos").click(function(){
		let pul_name = $("#empty_course").val();
		let pulpit_form_title = $('#pulpit_form_title').text();

		if (confirm('Вы действительно хотите удалить объект?')) {
			$.post(
			 	"/back/data/db_fgos.php", 
				{functionname: 'remove_fgos', id: $_GET('id')}, 
				function(info){
					if (info !== '1') {
						alert(info);
					} else {
						$('#fgos_form').modal('hide');
						alert('ФГОС удален');
						location.href='data.php?page=fgos';
					}
				}
			);
		}
	});
</script>