<?php
	connect();
	global $link;
	$sql = "select * from users_presenter
			WHERE account_id = ".$_GET["id"]."";
	$result = mysqli_query($link, $sql);
	while($row = mysqli_fetch_array($result)){
		$second_name = $row[3];
		$first_name = $row[4];
		$middle_name = $row[5];
		$page_title = 'Преподаватель: '.$second_name.' '.$first_name.' '.$middle_name;
		$login = $row[1];
		if ($row[2] = 2){
			$admin = "checked";
			$grant_to_edit_account_name = "";
		} else {
			$admin = "";
			$grant_to_edit_account_name = "hidden";
		}		
	};
	close();
?>

<link href="/front/css/pointer.css" rel="stylesheet" type="text/css">
<div class="form-group">
	<h4 id="page_title"><?php echo $page_title; ?></h4>
</div>
<div class="form-group">
	<div class="btn-group btn-group-sm" role="group">
		<input class="btn btn-success btn-mg" type="button" id="save_teach_changes" value="Сохранить">
	</div>
</div>
<table class="table table-borderless" style="width: 50rem">
	<tr>
		<td class="align-middle" style="width: 7rem">Фамилия</td>
		<td>
			<div class="input-group input-group-sm" style="right: 15px;">
				<input class="form-control" type="text" id="second_name" value="<?php echo $second_name; ?>" maxlength="30" data-toggle="popover" data-placement="top" data-content="Не должно быть пустым!">
			</div>
		</td>
		<td class="align-middle"></td>
		<td></td>
	</tr>
	<tr>
		<td class="align-middle">Имя</td>
		<td>
			<div class="input-group input-group-sm" style="right: 15px;">
				<input class="form-control" type="text" id="first_name" value="<?php echo $first_name; ?>" maxlength="30" data-toggle="popover" data-placement="top" data-content="Не должно быть пустым!">
			</div>
		</td>
		<td class="align-middle"></td>
		<td></td>
	</tr>
	<tr>
		<td class="align-middle">Отчество</td>
		<td>
			<div class="input-group input-group-sm" style="right: 15px;">
				<input class="form-control" type="text" id="middle_name" value="<?php echo $middle_name; ?>" maxlength="30">
			</div>
		</td>
		<td class="align-middle"></td>
		<td></td>
	</tr>
	<tr class="hr_section">
		<td colspan="4"><hr></td>
	</tr>
	<tr>
		<td class="align-middle">Логин</td>
		<td>
			<div class="input-group input-group-sm" style="right: 15px;">
				<input class="form-control" type="text" id="login" value="<?php echo $login; ?>" readonly>
				<div class="input-group-append" <?php echo $grant_to_edit_account_name; ?> >
					<button class="btn btn-outline-primary" id="change_account_name" type="button">Изменить</button>
				</div>
			</div>
		</td>
		<td class="align-middle" style="width: 7rem">Администратор</td>
		<td style="width: 7rem">
			<div class="custom-control custom-switch" style="top: 5px">
				<input type="checkbox" class="custom-control-input" <?php echo $admin; ?> id="switch">
				<label class="custom-control-label"></label>
			</div>
		</td>
	</tr>
	<tr>
		<td class="align-middle">Пароль</td>
		<td>
			<div class="input-group input-group-sm" style="right: 15px;">
				<input class="form-control" type="text" id="pass" value="************" readonly>
				<div class="input-group-append" <?php echo $grant_to_edit_account_name; ?> >
					<button class="btn btn-outline-primary" id="change_account_pass" type="button">Изменить</button>
				</div>
			</div>
		</td>
		<td class="align-middle"></td>
		<td></td>
	</tr>
</table>
<?php 
	require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/account_name.php");		
	require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/account_pass.php");		
?>
<script>
$(document).ready(function() {
	$("#change_account_name").click(function(){
		$('#change_account_name_form').modal('show');
	});

	$("#change_account_pass").click(function(){
		$('#change_account_pass_form').modal('show');
	});

	$("#save_teach_changes").click(function(){
		let second_name = $("#second_name").val();
		let first_name = $("#first_name").val();
		let middle_name = $("#middle_name").val();

		if (second_name == '') {
			$('#second_name').addClass('error-pointer');
			$('#second_name').popover('show');
		} else if (first_name == '') {
			$('#first_name').addClass('error-pointer');
			$('#first_name').popover('show');
		} else {
			$.post(
			 	"/back/editing_users.php", 
				{functionname: 'update_teach_name', acc_id: <?php echo $_GET["id"];?>
												  , second_name: second_name
												  , first_name: first_name
												  , middle_name: middle_name}, 
				function(info){
					alert(info);
					location.reload();
				}
			);
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
});
</script>