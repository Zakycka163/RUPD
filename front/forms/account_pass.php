<div class="modal fade" id="change_account_pass_form" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Изменение аккаунта: Пароль</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-borderless">
					<tr>
						<td class="align-middle">Старый пароль</td>
						<td width="60%">
							<input type="password" name="password" id="old_pass" minlength="4" maxlength="32" class="form-control form-control-sm">
						</td>
					</tr>
					<tr>
						<td class="align-middle">Новый пароль</td>
						<td>
							<input type="password" name="password" id="new_pass" minlength="4" maxlength="32" class="form-control form-control-sm">
						</td>
					</tr>
					<tr>
						<td class="align-middle">Повторите пароль</td>
						<td>
							<input type="password" name="password" id="repeat_pass" minlength="4" maxlength="32" class="form-control form-control-sm">
						</td>
					</tr>
				</table>
				<div class="alert alert-danger" role="alert" id="error_params" hidden>
                    Все поля должны быть заполнены! 
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="save_changes">Сохранить</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>
<script>
	$("#save_changes").click(function(){
		$('#error_params').prop('hidden',true);
		var old_pass = $("#old_pass").text();
		var new_pass = $("#new_pass").text();
		var repeat_pass = $("#repeat_pass").text();
		
		if (old_pass !== '' && new_pass !== '' && repeat_pass !== ''){
			var fgos_number = $("#input_number").val();
			var fgos_reg_number = $("#reg_number").val();
			$.post(
				"../back/switch_functions.php", 
				{functionname: 'create_fgos', course: get_course_id
											, date: fgos_date
											, number: fgos_number
											, reg_date: fgos_reg_date
											, reg_number: fgos_reg_number}, 
				function(){}
			);
			
			$.post(
				"../back/switch_functions.php", 
				{functionname: 'get_fgos_info', param: course_value}, 
				function(info){
						$('#div_create_info_fgos').prop('hidden',true);
						$('#info_fgos').text(info);
				}
			);

			$('#change_account_pass_form').modal('hide');
			alert('Логин изменен успешно');
		} else { $('#error_params').prop('hidden',false); };
	});
</script>