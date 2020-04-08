<div class="form-group">
	<h4 id="page_title">Список аккаунтов</h3>
</div>
<div class="form-group">
	<input class="btn btn-success btn-sm" id="create_account" type="button" value="Создать">
</div>
<table class="table table-bordered table-striped table-sm">
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
		<?php
			connect();
			global $link;
			$sql = "select value from `constants` where `key` = 'limitObj'";
			$result = mysqli_query($link, $sql);
			$limit = mysqli_fetch_array($result);
			$counter = 0;
			$sql_count = "select count(*) FROM users_presenter";
			$sql_count_result = mysqli_query($link, $sql_count);
			$count_obj = mysqli_fetch_array($sql_count_result);
			$sql = "select * from users_presenter
					LIMIT ".$limit[0]."";
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
	</tbody>
</table>
<nav>
	<ul class="pagination pagination-sm">
		<?php if ($count_obj < $limit){
		
		} else {
			echo '
			<li class="page-item disabled">
				<a class="page-link" href="#">Предыдущая</a>
			</li>
			<li class="page-item active">
				<a class="page-link" href="#">1</a>
			</li>
			<li class="page-item disabled">
				<a class="page-link" href="#">2</a>
			</li>
			<li class="page-item disabled">
				<a class="page-link" href="#">3</a>
			</li>
			<li class="page-item disabled">
				<a class="page-link" href="#">Следующая</a>
			</li>' . "\n"; 
		}
		?>
	</ul>
</nav>
<?php require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/create_account.php"); ?> 
<script src="/front/js/_GET.js"></script>
<script>
	$(document).ready(function() {
		if ($_GET('action')=="create"){
			$('#create_account_form').modal('show');
		};
		
		$("#create_account").click(function(){
			location.href='/pages/control/users.php?action=create';
		});

	});
</script>