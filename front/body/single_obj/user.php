<div class="px-4 py-2 bg-primary font-weight-bold text-white container-fluid">
	<div class="row">
		<a class="btn btn-warning btn-sm back" href="javascript:history.go(-1)" style="height: 35px; width: 5rem; margin-left: 1rem" title="Назад" data-toggle="tooltip" data-placement="right">&#8592; Назад</a>
		<div class="h4" id="page_title" style="margin-left: 35%">Аккаунты</div>
	</div>
</div>
<div class="px-4 py-3 bg-light" style="min-width: 52rem;">
	<div class="alert alert-info" style="height: 55px"><b>Аккаунт:</b><text id="title"></text></div> 
	<table class="table table-borderless table-sm" style="width: 40rem">
		<tr>
			<td class="align-middle">Логин</td>
			<td>
				<div class="input-group input-group-sm" style="right: 15px;">
					<input class="form-control" type="text" id="login" value="" readonly>
					<div class="input-group-append check_grant" hidden>
						<button class="btn btn-outline-primary" id="edit_account_login" type="button">Изменить</button>
					</div>
				</div>
			</td>
			<td class="align-middle" style="width: 7rem">Администратор</td>
			<td style="width: 3rem">
				<div class="custom-control custom-switch" style="top: 5px">
					<input type="checkbox" class="custom-control-input" id="switch">
					<label class="custom-control-label"></label>
				</div>
			</td>
		</tr>
		<tr>
			<td class="align-middle">Пароль</td>
			<td>
				<div class="input-group input-group-sm" style="right: 15px;">
					<input class="form-control" type="text" id="pass" value="************" readonly>
					<div class="input-group-append check_grant" hidden>
						<button class="btn btn-outline-primary" id="edit_account_pass" type="button">Изменить</button>
					</div>
				</div>
			</td>
			<td class="align-middle"></td>
			<td></td>
		</tr>
		<tr class="hr_section">
			<td colspan="4"><hr></td>
		</tr>
		<tr>
			<td class="align-middle" style="width: 7rem">Фамилия<span style="color: red">*</span></td>
			<td>
				<div class="input-group input-group-sm" style="right: 15px;">
					<input class="form-control" type="text" id="second_name" value="" maxlength="30" data-toggle="popover" data-placement="right" data-content="Не должно быть пустым! Не должно быть меньше 2 символов!">
				</div>
			</td>
			<td class="align-middle"></td>
			<td></td>
		</tr>
		<tr>
			<td class="align-middle">Имя<span style="color: red">*</span></td>
			<td>
				<div class="input-group input-group-sm" style="right: 15px;">
					<input class="form-control" type="text" id="first_name" value="" maxlength="30" data-toggle="popover" data-placement="right" data-content="Не должно быть пустым! Не должно быть меньше 2 символов!">
				</div>
			</td>
			<td class="align-middle"></td>
			<td></td>
		</tr>
		<tr>
			<td class="align-middle">Отчество</td>
			<td>
				<div class="input-group input-group-sm" style="right: 15px;">
					<input class="form-control" type="text" id="middle_name" value="" maxlength="30" data-toggle="popover" data-placement="right" data-content="Не должно быть меньше 2 символов!">
				</div>
			</td>
			<td class="align-middle"></td>
			<td></td>
		</tr>
	</table>
	<div class="alert alert-secondary" style="height: 55px;">		
		<input class="btn btn-success btn-sm" type="button" id="save_teach_changes" value="Сохранить">
	</div>
</div>
<?php 
	require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/edit_account_login.php");		
	require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/edit_account_pass.php");		
?>
<script src="/front/js/_GET.js"></script>
<script>
$(document).ready(function(){
	var account = new Object();
	var teacher = new Object();
	$.ajax({
		url: "/api/accounts?id="+$_GET("id"), 
		type: "GET",
		success: function(response){
			account = response;
			delete account.id;
			$("#login").val(account.login);
			if (account.grant_id == 2) {
				$("#switch").prop("checked", true);
				$(".check_grant").prop("hidden", false);
			}
			$.ajax({
				url: "/api/teachers?id="+account.teacher_id,
				type: "GET",
				success: function(response){
					teacher = response;
					delete teacher.id;
					$("#second_name").val(teacher.second_name);
					$("#first_name").val(teacher.first_name);
					$("#middle_name").val(teacher.middle_name);
					$("#title").text(' '+teacher.second_name+' '+ teacher.first_name+' '+teacher.middle_name);
				}
			});
    	}
	});
	
	$("#edit_account_login").click(function(){
		$('#edit_account_login_form').modal('show');
	});

	$("#edit_account_pass").click(function(){
		$('#edit_account_pass_form').modal('show');
	});

	$("#save_teach_changes").click(function(){
		if ($("#second_name").val() == '' || $("#second_name").val().length < 2) {
			$('#second_name').addClass('error-pointer');
			$('#second_name').popover('show');
		} else if ($("#first_name").val() == '' || $("#first_name").val().length < 2) {
			$('#first_name').addClass('error-pointer');
			$('#first_name').popover('show');
		} else if ($("#middle_name").val() !== '' && $("#middle_name").val().length < 2) {
			$('#middle_name').addClass('error-pointer');
			$('#middle_name').popover('show');
		} else {
			teacher.second_name = $("#second_name").val();
			teacher.middle_name = $("#middle_name").val();
			teacher.first_name = $("#first_name").val();
			$.ajax({
				url: "/api/teachers?id="+account.teacher_id, 
				type: "PUT",
				data: JSON.stringify(teacher),
				success: function(){
					alert('Данные обновлены');
					location.reload()
				}
			});
		}
	});

	$("#second_name").mouseenter (function(){
		$('#second_name').removeClass('error-pointer');
		$('#second_name').popover('hide');
	});

	$("#first_name").mouseenter (function(){
		$('#first_name').removeClass('error-pointer');
		$('#first_name').popover('hide');
	});

	$("#middle_name").mouseenter (function(){
		$('#middle_name').removeClass('error-pointer');
		$('#middle_name').popover('hide');
	});
});
</script>