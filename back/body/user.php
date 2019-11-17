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
				$counter++;
				if ($row[2] = 2){
					$admin = "Да";
				} else {
					$admin = "";
				}
				echo '<tr>'. "\n" . '<td>'.$counter .'</td>'."\n";
				echo '<td><a href="?id='.$row[0].'" title="Открыть аккаунт">'.$row[1].'</td>'. "\n";
				echo '<td>********</td>'. "\n";
				echo '<td>'.$admin.'</td>'. "\n";
				echo '<td>'.$row[3].'</td>'. "\n";
				echo '<td>'.$row[4].'</td>'. "\n";
				echo '<td>'.$row[5].'</td>'. "\n";
				echo '</tr>'. "\n";
			};
			close();
?>

<div class="form-group">
	<h4 id="page_title">Аккаунт для </h3>
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