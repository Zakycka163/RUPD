<?php
	connect();
	global $link;
	$sql = "SELECT second_name
				 , first_name
				 , middle_name
				 , email
				 , deg_name
				 , ac_rank_name
				 , position
				 , account_id
				 , account
			FROM teachers_presenter
			WHERE teacher_id = ".$_GET["id"]."";
	$result = mysqli_query($link, $sql);
	while($row = mysqli_fetch_array($result)){
		$second_name 	= $row[0];
		$first_name 	= $row[1];
		$middle_name 	= $row[2];
		$email 			= $row[3];
		$deg_name 		= $row[4];
		$ac_rank_name 	= $row[5];
		$position 		= $row[6];
		$acc_id 		= $row[7];
		$acc_name 		= $row[8];
		$page_title = 'Преподаватель: '.$second_name.' '.$first_name.' '.$middle_name;
	};
	close();
?>
<div class="px-4 py-3 bg-light">
	<div class="form-group">
		<h4 id="page_title"><?php echo $page_title; ?></h4>
	</div>
	<div class="form-group">
		<a class="btn btn-warning btn-sm" href="?page=teachers">Вернуться</a>
		<input class="btn btn-success btn-sm" type="button" id="edit_teach_name" value="Сохранить">
	</div>
	<table class="table table-borderless" style="width: 60rem">
		<tr>
			<td class="align-middle" style="width: 6rem">Фамилия<span style="color: red">*</span></td>
			<td>
				<div class="input-group input-group-sm" style="right: 15px;">
					<input class="form-control" type="text" id="second_name" value="<?php echo $second_name; ?>" maxlength="30" data-toggle="popover" data-placement="right" data-content="Не должно быть пустым! Не должно быть меньше 2 символов!">
				</div>
			</td>
			<td class="align-middle" style="width: 7rem">Отчество</td>
			<td>
				<div class="input-group input-group-sm" style="right: 15px;">
					<input class="form-control" type="text" id="middle_name" value="<?php echo $middle_name; ?>" maxlength="30" data-toggle="popover" data-placement="right" data-content="Не должно быть меньше 2 символов!">
				</div>
			</td>
		</tr>
		<tr>
			<td class="align-middle">Имя<span style="color: red">*</span></td>
			<td>
				<div class="input-group input-group-sm" style="right: 15px;">
					<input class="form-control" type="text" id="first_name" value="<?php echo $first_name; ?>" maxlength="30" data-toggle="popover" data-placement="right" data-content="Не должно быть пустым! Не должно быть меньше 2 символов!">
				</div>
			</td>
			<td class="align-middle">Email</td>
			<td>
				<div class="input-group input-group-sm" style="right: 15px;">
					<input class="form-control" type="email" id="email" value="<?php echo $email; ?>" maxlength="30" data-toggle="popover" data-placement="right" data-content="Не должно быть пустым! Email должен быть валидным!">
				</div>
			</td>
		</tr>
		<tr class="hr_section">
			<td colspan="4"><hr></td>
		</tr>
		<tr>
			<td class="align-middle">Степень</td>
			<td>
				<div class="input-group input-group-sm" style="right: 15px;">
					<input class="form-control" type="text" id="deg_name" title="<?php echo $deg_name; ?>" value="<?php echo $deg_name; ?>" readonly>
					<div class="input-group-append">
						<button class="btn btn-outline-primary" id="change_deg_name" type="button">Изменить</button>
					</div>
				</div>
			</td>
			<td class="align-middle">Должность</td>
			<td>
				<div class="input-group input-group-sm" style="right: 15px;">
					<input class="form-control" type="text" id="position" title="<?php echo $position; ?>" value="<?php echo $position; ?>" readonly>
					<div class="input-group-append">
						<button class="btn btn-outline-primary" id="change_position" type="button">Изменить</button>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td class="align-middle">Звание</td>
			<td>
				<div class="input-group input-group-sm" style="right: 15px;">
					<input class="form-control" type="text" id="ac_rank_name" title="<?php echo $ac_rank_name; ?>" value="<?php echo $ac_rank_name; ?>" readonly>
					<div class="input-group-append">
						<button class="btn btn-outline-primary" id="change_ac_rank_name" type="button">Изменить</button>
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
			<td class="align-middle">Аккаунт</td>
			<td>
				<?php if ($acc_id !== '') : ?>
					<div class="input-group input-group-sm" style="right: 15px;">
						<a href="/pages/control/users.php?id=<?php echo $acc_id; ?>"><?php echo $acc_name; ?></a>
					</div>
				<?php else : ?>
					<input class="btn btn-success btn-sm" type="button" id="create_account" value="Создать">
				<?php endif; ?>
			</td>
			<td class="align-middle"></td>
			<td></td>
		</tr>
	</table>
</div>
<?php 
	require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/create_account.php");			
?>
<script>
function checkEmailMask(str) {
	var lastAtPos = str.lastIndexOf('@');
	var lastDotPos = str.lastIndexOf('.');
	return (lastAtPos < lastDotPos 
		 && lastAtPos > 0 
		 && str.indexOf('@@') == -1 
		 && lastDotPos > 2 
		 && (str.length - lastDotPos) > 2
	);
}

$(document).ready(function() {
	$("#create_account").click(function(){
		$('#create_account_form').modal('show');
	});

	$("#edit_teach_name").click(function(){
		let second_name = $("#second_name").val();
		let first_name = $("#first_name").val();
		let middle_name = $("#middle_name").val();
		let email = $("#email").val(); 

		if (second_name == '' || second_name.length < 2) {
			$('#second_name').addClass('error-pointer');
			$('#second_name').popover('show');
		} else if (first_name == '' || first_name.length < 2) {
			$('#first_name').addClass('error-pointer');
			$('#first_name').popover('show');
		} else if (middle_name !== '' && middle_name.length < 2) {
			$('#middle_name').addClass('error-pointer');
			$('#middle_name').popover('show');
		} else if (email == '' || !checkEmailMask(email)) {
			$('#email').addClass('error-pointer');
			$('#email').popover('show');
		} else {
			$.post(
			 	"/back/data/db_teachers.php", 
				{functionname: 'edit_teach_name', acc_id: <?php echo $_GET["id"];?>
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

	$("#middle_name").mouseenter (function(){
		$('#middle_name').removeClass('error-pointer');
		$('#middle_name').popover('hide');
	});

	$("#email").mouseenter (function(){
		$('#email').removeClass('error-pointer');
		$('#email').popover('hide');
	});
});
</script>