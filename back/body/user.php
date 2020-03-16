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
		$page_title = $second_name.' '.$first_name.' '.$middle_name;
		$login = $row[1];
		if ($row[2] = 2){
			$admin = "checked";
			$grant_to_edit_account_name = "";
		} else {
			$admin = "";
			$grant_to_edit_account_name = "disabled";
		}		
	};
	close();
?>

<div class="form-group">
	<h4 id="page_title"><?php echo $page_title; ?></h3>
</div>
<div class="form-group">
	<div class="btn-group btn-group-sm" role="group">
		<input class="btn btn-success btn-mg" type="button" value="Сохранить">
	</div>
</div>
<table class="table table-borderless" style="width: 65rem">
	<tr>
		<td class="align-middle" style="width: 15rem">Фамилия</td>
		<td>
			<div class="input-group" style="right: 15px;">
				<input class="form-control" type="text" id="second_name" value="<?php echo $second_name; ?>">
			</div>
		</td>
		<td class="align-middle"></td>
		<td></td>
	</tr>
	<tr>
		<td class="align-middle">Имя</td>
		<td>
			<div class="input-group" style="right: 15px;">
				<input class="form-control" type="text" id="first_name" value="<?php echo $first_name; ?>">
			</div>
		</td>
		<td class="align-middle"></td>
		<td></td>
	</tr>
	<tr>
		<td class="align-middle">Отчество</td>
		<td>
			<div class="input-group" style="right: 15px;">
				<input class="form-control" type="text" id="middle_name" value="<?php echo $middle_name; ?>">
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
			<div class="input-group" style="right: 15px;">
				<input class="form-control" type="text" id="login" value="<?php echo $login; ?>" <?php echo $grant_to_edit_account_name; ?> >
			</div>
		</td>
		<td class="align-middle" style="width: 13rem">Права администратора</td>
		<td style="width: 12rem">
			<div class="custom-control custom-switch" style="top: 10px">
				<input type="checkbox" class="custom-control-input" <?php echo $admin; ?> id="switch">
				<label class="custom-control-label"></label>
			</div>
		</td>
	</tr>
	<tr>
		<td class="align-middle">Старый пароль</td>
		<td>
			<div class="input-group" style="right: 15px;">
				<input class="form-control" type="text" id="pass">
			</div>
		</td>
		<td class="align-middle"></td>
		<td></td>
	</tr>
	<tr>
		<td class="align-middle">Новый пароль</td>
		<td>
			<div class="input-group" style="right: 15px;">
				<input class="form-control" type="text" id="new_pass">
			</div>
		</td>
		<td class="align-middle"></td>
		<td></td>
	</tr>
	<tr>
		<td class="align-middle">Повторите пароль</td>
		<td>
			<div class="input-group" style="right: 15px;">
				<input class="form-control" type="text" id="repl_pass">
			</div>
		</td>
		<td class="align-middle"></td>
		<td></td>
	</tr>
</table>

<script>
$(document).ready(function() {
	
});
</script>