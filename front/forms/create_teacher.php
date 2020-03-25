<div class="modal fade" id="create_teacher_form" tabindex="-1" role="dialog" aria-hidden="true">
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
						<td colspan="2">
							<div class="input-group checkbox" style="left: 7rem; top: 1rem;">
								<label>
									<input type="checkbox" id="admin"> Права администратора
								</label>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-primary" id="create_new_acc">Создать</button>
				<button type="button" class="btn btn-sm btn-secondary" id="close" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>
<script>
	$("#create_new_acc").click(function(){
		let name_acc = $("#name_acc").val();
		let pass_val = $("#pass_val").val();
		let teacher = $("#teacher").val();
		let admin = $("#admin:checked").val(); 

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
			if (admin=="on") { 
				var grant_acc = "2";
			} else {
				var grant_acc = "1";
			}
			$.post(
			 	"/back/data/db_teacher.php", 
				{functionname: 'create_teacher', login: name_acc
												, password: pass_val
												, teacher_id: teacher
												, grant: grant_acc}, 
				function(info){
					if (info !== '1') {
						alert(info);
					} else {
						$('#create_teacher_form').modal('hide');
						alert('Преподаватель создан');
						location.reload();
					}
				}
			);
		}
	});

	$("#close").click(function(){
		location.reload();
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