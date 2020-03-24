<div class="modal fade" id="account_form" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Создание аккаунта</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-borderless">
					<tr>
						<td class="align-middle">Логин</td>
						<td width="70%">
							<input lang="en" id="name_acc" minlength="4" maxlength="16" class="form-control form-control-sm" data-toggle="popover" data-placement="right" data-content="Нужно заполнить! от 4 до 16 символов">
						</td>
					</tr>
					<tr>
						<td class="align-middle">Пароль</td>
						<td>
							<input type="password" id="pass_val" minlength="4" maxlength="32" class="form-control form-control-sm" data-toggle="popover" data-placement="right" data-content="Нужно заполнить! от 4 до 32 символов">
						</td>
					</tr>
					<tr>
						<td class="align-middle">Преподаватель</td>
						<td>
							<select class="form-control form-control-sm" id="teacher" data-toggle="popover" data-placement="right" data-content="Нужно выбрать!">
								<option selected disabled style="display:none;">Выбрать преподавателя</option>
								
								<?php 
									require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");
									options_present("SELECT teacher_id
														  , CONCAT_WS(' '
														  			  ,second_name
																	  ,CONCAT(LEFT(first_name,1),'.')
																	  ,CONCAT(LEFT(middle_name,1),'.')
																	) as teacher 
													 FROM teachers_presenter 
													 WHERE account is null 
													 ORDER BY teacher");
								?>
							
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="input-group checkbox">
								<label>
									<input type="checkbox" id="admin"> Права администратора
								</label>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-primary" id="save_name_changes">Создать</button>
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>
<script>
	$("#save_name_changes").click(function(){
		let name_acc = $("#name_acc").val();
		let pass_val = $("#pass_val").val();
		let teacher = $("#teacher").val();
		let admin = $("#admin").val();

		if (name_acc == '' || name_acc.length < 4) {
			$('#name_acc').addClass('error-pointer');
			$('#name_acc').popover('show');
		} else if (pass_val == '' || pass_val.length < 4) {
			$('#pass_val').addClass('error-pointer');
			$('#pass_val').popover('show');
		} else if (teacher == '') {
			$('#teacher').addClass('error-pointer');
			$('#teacher').popover('show');
		} else {
			
		}
	});

	$("#name_acc").mouseenter (function(){
		$('#name_acc').removeClass('error-pointer');
		$('#name_acc').popover('hide');
	});

	$("#pass_val").mouseenter (function(){
		$('#pass_val').removeClass('error-pointer');
		$('#pass_val').popover('hide');
	});

	$("#teacher").mouseenter (function(){
		$('#teacher').removeClass('error-pointer');
		$('#teacher').popover('hide');
	});
</script>