<div class="modal fade" id="edit_account_pass_form" tabindex="-1" role="dialog" aria-hidden="true">
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
							<input type="password" name="password" id="old_pass" minlength="4" maxlength="32" class="form-control form-control-sm" data-toggle="popover" data-placement="right" data-content="Нужно заполнить! от 4 до 32 символов">
						</td>
					</tr>
					<tr>
						<td class="align-middle">Новый пароль</td>
						<td>
							<input type="password" name="password" id="new_pass" minlength="4" maxlength="32" class="form-control form-control-sm" data-toggle="popover" data-placement="right" data-content="Нужно заполнить! от 4 до 32 символов">
						</td>
					</tr>
					<tr>
						<td class="align-middle">Повторите пароль</td>
						<td>
							<input type="password" name="password" id="repeat_pass" minlength="4" maxlength="32" class="form-control form-control-sm" data-toggle="popover" data-placement="right" data-content="Нужно заполнить! от 4 до 32 символов">
						</td>
					</tr>
				</table>
				<div class="alert alert-danger" role="alert" id="error_params" hidden>
                    Пароли не совпадают!
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-primary " id="save_pass_changes">Сохранить</button>
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>
<script>
	$("#save_pass_changes").click(function(){
		$('#error_params').prop('hidden',true);

		let old_pass = $("#old_pass").val();
		let new_pass = $("#new_pass").val();
		let repeat_pass = $("#repeat_pass").val();

		if (old_pass == '' || old_pass.length < 4) {
			$('#old_pass').addClass('error-pointer');
			$('#old_pass').popover('show');
		} else if (new_pass == '' || new_pass.length < 4) {
			$('#new_pass').addClass('error-pointer');
			$('#new_pass').popover('show');
		} else if (repeat_pass == '' || repeat_pass.length < 4) {
			$('#repeat_pass').addClass('error-pointer');
			$('#repeat_pass').popover('show');
		} else if (new_pass !== repeat_pass) {
			$('#error_params').prop('hidden',false);
		} else {
			$.post(
			 	"/back/control/db_accounts.php", 
				 {functionname: 'pass_validate', acc_id: <?php echo $_GET["id"];?>
											   , password: old_pass}, 
			 	function(info){
					if (info == '1'){
						$.post(
							"/back/control/db_accounts.php", 
							{functionname: 'edit_acc_pass', acc_id: <?php echo $_GET["id"];?>
																, account_pass: new_pass}, 
							function(info){
								if (info == '1'){
									$('#edit_account_pass_form').modal('hide');
									alert('Пароль успешно обновлен');
									location.reload();
								} else {
									alert('Ошибка: '+info);
								}
							}
						);
					} else {
						alert('Неверно введен Пароль '+info);
					}
				}
			);
		}
	});

	$("#old_pass").mouseenter (function(){
		$('#old_pass').removeClass('error-pointer');
		$('#old_pass').popover('hide');
	});

	$("#new_pass").mouseenter (function(){
		$('#new_pass').removeClass('error-pointer');
		$('#new_pass').popover('hide');
		$('#error_params').prop('hidden',true);
	});

	$("#repeat_pass").mouseenter (function(){
		$('#repeat_pass').removeClass('error-pointer');
		$('#repeat_pass').popover('hide');
		$('#error_params').prop('hidden',true);
	});
</script>