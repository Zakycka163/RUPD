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
		<input class="btn btn-success btn-sm" type="button" id="save_teach_changes" value="Сохранить">
	</div>
	<table class="table table-borderless" style="width: 60rem">
		<tr>
			<td class="align-middle" style="width: 6rem">Фамилия</td>
			<td>
				<div class="input-group input-group-sm" style="right: 15px;">
					<input class="form-control" type="text" id="second_name" value="<?php echo $second_name; ?>" maxlength="30" data-toggle="popover" data-placement="top" data-content="Не должно быть пустым!">
				</div>
			</td>
			<td class="align-middle" style="width: 12rem"></td>
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
			<td class="align-middle">Email</td>
				<td>
					<div class="input-group input-group-sm" style="right: 15px;">
						<input class="form-control" type="text" id="email" title="<?php echo $email; ?>" value="<?php echo $email; ?>" readonly>
						<div class="input-group-append">
							<button class="btn btn-outline-primary" id="change_email" type="button">Изменить</button>
						</div>
					</div>
				</td>
			<td class="align-middle">Основная должность</td>
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
			<td class="align-middle">Степень</td>
			<td>
				<div class="input-group input-group-sm" style="right: 15px;">
					<input class="form-control" type="text" id="deg_name" title="<?php echo $deg_name; ?>" value="<?php echo $deg_name; ?>" readonly>
					<div class="input-group-append">
						<button class="btn btn-outline-primary" id="change_deg_name" type="button">Изменить</button>
					</div>
				</div>
			</td>
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
	require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/account_name.php");			
?>
<script>
$(document).ready(function() {
	$("#change_account_name").click(function(){
		$('#change_account_name_form').modal('show');
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