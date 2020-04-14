<script src="/front/js/checkEmailMask.js"></script>
<?php
	if (isset($_GET["id"])){
		require_once ($_SERVER['DOCUMENT_ROOT']."/front/body/single_obj/teacher.php");
		exit();
	}
?>

<div class="px-4 py-2 bg-primary font-weight-bold text-white container-fluid">
	<div class="row">
		<a class="btn btn-warning btn-sm back" href="/pages/data.php" style="height: 35px; width: 5rem; margin-left: 1rem" title="Назад" data-toggle="tooltip" data-placement="right">&#8592; Назад</a>
		<div class="h4" id="page_title" style="margin-left: 35%">Преподаватели</div>
	</div>
</div>
<div class="px-4 py-3 bg-light">
	<div class="alert alert-secondary col" style="height: 55px">
		<input class="btn btn-success btn-sm" type="button" id="create_teacher" value="Новый преподаватель">
	</div>
	<table class="table table-bordered table-striped table-sm">
		<thead>
			<tr>
				<th scope="col" style="width: 2rem">№</th>
				<th scope="col">ФИО</th>
				<th scope="col">Email</th>
				<th scope="col">Степень</th>
				<th scope="col">Звание</th>
				<th scope="col">Должность</th>
				<th scope="col">Аккаунт</th>
			</tr>
		</thead>
		<tbody>
			<?php
				connect();
				global $link;
				$sql = "SELECT `value` FROM `constants` WHERE `key` = 'limitObj'";
				$result = mysqli_query($link, $sql);
				$limit = mysqli_fetch_array($result);
				$counter = 0;
				$sql_count = "SELECT count(*) FROM teachers_presenter";
				$sql_count_result = mysqli_query($link, $sql_count);
				$count_obj = mysqli_fetch_array($sql_count_result);
				$sql = "SELECT * FROM teachers_presenter
						LIMIT ".$limit[0]."";
				$result = mysqli_query($link, $sql);
				while($row = mysqli_fetch_array($result)){
					$counter++;
					echo '<tr>'. "\n" . '<td>'.$counter .'</td>'."\n";
					echo '<td><a href="?page=teachers&id='.$row[0].'">'.$row[1].' '.$row[2].' '.$row[3].'</a></td>'. "\n";
					echo '<td>'.$row[4].'</td>'. "\n";
					echo '<td>'.$row[5].'</td>'. "\n";
					echo '<td>'.$row[6].'</td>'. "\n";
					echo '<td>'.$row[7].'</td>'. "\n";
					echo '<td><a href="/pages/control/users.php?id='.$row[8].'">'.$row[9].'</a></td>'. "\n";
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
			?>
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
				</li>
			<?php } ?>
		</ul>
	</nav>	
</div>

<?php require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/create_teacher.php"); ?>

<script>
	$("#create_teacher").click(function(){
		$('#create_teacher_form').modal('show');
	});
</script>