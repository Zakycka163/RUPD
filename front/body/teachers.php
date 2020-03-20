<form>
	<div class="px-4 py-3 bg-light">
		<div class="form-group">
			<h4 id="page_title">Преподаватели</h3>
		</div>
		<div class="form-group">
			<input class="btn btn-success btn-sm" type="button" id="create_teacher" value="Добавить">
		</div>
		<table class="table table-bordered table-striped table-sm">
			<thead>
				<tr>
					<th scope="col" style="width: 2rem">№</th>
					<th scope="col">ФИО</th>
					<th scope="col">Email</th>
					<th scope="col">Степень</th>
					<th scope="col">Звание</th>
					<th scope="col">Основная должность</th>
					<th scope="col">Аккаунт</th>
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

					$sql_count = "select count(*) FROM teachers_presenter";
					$sql_count_result = mysqli_query($link, $sql_count);
					$count_obj = mysqli_fetch_array($sql_count_result);

					$sql = "select * FROM teachers_presenter
							LIMIT ".$limit[0]."";
					$result = mysqli_query($link, $sql);
					while($row = mysqli_fetch_array($result)){
						$counter++;
						echo '<tr>'. "\n" . '<td>'.$counter .'</td>'."\n";
						echo '<td><a href="/pages/users.php?id='.$row[0].'">'.$row[1].' '.$row[2].' '.$row[3].'</a></td>'. "\n";
						echo '<td>'.$row[4].'</td>'. "\n";
						echo '<td>'.$row[5].'</td>'. "\n";
						echo '<td>'.$row[6].'</td>'. "\n";
						echo '<td>'.$row[7].'</td>'. "\n";
						echo '<td><a href="/pages/users.php?id='.$row[0].'">'.$row[8].'</a></td>'. "\n";
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
	</div>
</form>	