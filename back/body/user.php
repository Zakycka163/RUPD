<?php
			connect();
			global $link;
			$sql = "select    acc.login
							, acc.grant_id
							, teach.second_name
							, teach.first_name
							, teach.middle_name
					FROM  `accounts` acc
						, `teachers` teach 
					WHERE acc.account_id = ".$_GET["id"]."";
			$result = mysqli_query($link, $sql);
			while($row = mysqli_fetch_array($result)){
				$page_title = ''.$row[2].' '.$row[3].' '.$row[4].'';
				$second_name = $row[2];
				$first_name = $row[3];
				$middle_name = $row[4];
				$login = $row[0];
				if ($row[1] = 2){
					$admin = "Да";
				} else {
					$admin = "Нет";
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
<table class="table table-borderless" style="width: 80rem">
	<tr>
		<tr>
		<td class="align-middle">Фамилия</td>
		<td>
			<div class="row">
				<div class="col" id="second_name"><?php echo $second_name; ?></div>
			</div>
		</td>
		<td class="align-middle"></td>
		<td></td>
	</tr>
	<tr id="login">
		<td class="align-middle">Имя</td>
		<td>
			<div class="row">
				<div class="col" id="first_name"><?php echo $first_name; ?></div>
			</div>
		</td>
		<td class="align-middle">Отчество</td>
		<td>
			<div class="row">
				<div class="col" id="middle_name"><?php echo $middle_name; ?></div>
			</div>
		</td>
	</tr>
	<tr id="login">
		<td class="align-middle">Логин</td>
		<td>
			<div class="row">
				<div class="col" id="login"><?php echo $login; ?></div>
			</div>
		</td>
		<td class="align-middle">Права администратора</td>
		<td>
			<div class="row">
				<div class="col" id="grant"><?php echo $admin; ?></div>
			</div>
		</td>
	</tr>
	<tr>
		<td class="align-middle">Старый пароль</td>
		<td>
			<div class="row">
				<div class="col" id="password"></div>
			</div>
		</td>
		<td class="align-middle"></td>
		<td></td>
	</tr>
	<tr>
		<td class="align-middle">Новый пароль</td>
		<td>
			<div class="row">
				<div class="col" id="new_pass"></div>
			</div>
		</td>
		<td class="align-middle"></td>
		<td></td>
	</tr>
	<tr>
		<td class="align-middle">Повторите пароль</td>
		<td>
			<div class="row">
				<div class="col" id="repl_pass"></div>
			</div>
		</td>
		<td class="align-middle"></td>
		<td></td>
	</tr>
</table>

<script>
$(document).ready(function() {
	
}
</script>