<div class="modal fade" id="change_account_name_form" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Изменение аккаунта: Логин</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-borderless">
					<tr>
						<td class="align-middle">Старый логин</td>
						<td width="60%">
							<input class="form-control form-control-sm" id="old_name" readonly value="<?php echo $login; ?>">
						</td>
					</tr>
					<tr>
						<td class="align-middle">Новый логин</td>
						<td id="new_name_column">
							<input lang="en" type="login" name="login" id="new_name" minlength="4" maxlength="16" class="form-control form-control-sm">
						</td>
					</tr>
					<tr>
						<td class="align-middle">Пароль</td>
						<td id="pass_column">
							<input type="password" name="password" id="pass_val" minlength="4" maxlength="32" class="form-control form-control-sm">
						</td>
					</tr>
				</table>
				<div class="alert alert-danger alert-sm" role="alert" id="error_params" hidden>
                    Все поля должны быть заполнены! 
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-primary " id="save_changes">Сохранить</button>
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>
<script>
	$("#save_changes").click(function(){
		$('#error_params').prop('hidden',true);
		var new_name = $("#new_name").val();
		var pass_val = $("#pass_val").val();
		
		if ( (new_name !== null) && (pass_val !== null) ) {
			$.post(
			 	"../back/security/login.php", 
			 	{functionname: 'pass_validate', pass: pass_val}, 
			 	function(info){
					if (info == '1'){
						alert('Логин изменен успешно');
					}
				}
			);

			// $('#change_account_name_form').modal('hide');
			// alert('Логин изменен успешно2');
		} else { $('#error_params').prop('hidden',false); }

	});

	$("#new_name_column").mouseenter (function(){
		$('#error_params').prop('hidden',true);
	});

	$("#pass_column").mouseenter (function(){
		$('#error_params').prop('hidden',true);
	});
</script>