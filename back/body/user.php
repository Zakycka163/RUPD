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
		<input class="btn btn-success btn-mg" onclick="location.href='../pages/sign_up.php'" type="button" value="Добавить">
	</div>
</div>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th scope="col" style="width: 2rem">№</th>
			<th scope="col">Логин</th>
			<th scope="col">Пароль</th>
			<th scope="col">Админ</th>
			<th scope="col">Фамилия</th>
			<th scope="col">Имя</th>
			<th scope="col">Отчество</th>
		</tr>
	</thead>
	<tbody>
	
	</tbody>
</table>