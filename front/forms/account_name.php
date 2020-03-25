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
							<input type="login" name="login" id="new_name" minlength="4" maxlength="16" class="form-control form-control-sm" data-toggle="popover" data-placement="right" data-content="Нужно заполнить! от 4 до 16 символов">
						</td>
					</tr>
					<tr>
						<td class="align-middle">Пароль</td>
						<td id="pass_column">
							<input type="password" name="password" id="pass_val" minlength="4" maxlength="32" class="form-control form-control-sm" data-toggle="popover" data-placement="right" data-content="Нужно заполнить! от 4 до 32 символов">
						</td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-primary" id="save_name_changes">Сохранить</button>
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>
<script>
	$("#save_name_changes").click(function(){
		let new_name = $("#new_name").val();
		let pass_val = $("#pass_val").val();

		if (new_name == '' || new_name.length < 4) {
			$('#new_name').addClass('error-pointer');
			$('#new_name').popover('show');
		} else if (pass_val == '' || pass_val.length < 4) {
			$('#pass_val').addClass('error-pointer');
			$('#pass_val').popover('show');
		} else {
			$.post(
			 	"/back/control/db_accounts.php", 
				 {functionname: 'pass_validate', acc_id: <?php echo $_GET["id"];?>
											   , password: pass_val}, 
			 	function(info){
					if (info == '1'){
						$.post(
							"/back/control/db_accounts.php", 
							{functionname: 'edit_acc_name', acc_id: <?php echo $_GET["id"];?>
																, account_name: new_name}, 
							function(info){
								if (info == '1'){
									$('#change_account_name_form').modal('hide');
									alert('Логин успешно обновлен');
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

	$("#new_name_column").mouseenter (function(){
		$('#new_name').removeClass('error-pointer');
		$('#new_name').popover('hide');
	});

	$("#pass_column").mouseenter (function(){
		$('#pass_val').removeClass('error-pointer');
		$('#pass_val').popover('hide');
	});
</script>