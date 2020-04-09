<div class="px-4 py-2 bg-primary font-weight-bold text-white container-fluid">
	<div class="row">
		<a class="btn btn-warning btn-sm back" href="/pages/data.php" style="height: 35px; width: 5rem; margin-left: 1rem" title="Назад" data-toggle="tooltip" data-placement="right">&#8592; Назад</a>
		<div class="h4" id="page_title" style="margin-left: 30%">Направления и Профили</div>
	</div>
</div>
<div class="px-4 py-3 bg-light">
	<div class="alert alert-secondary col" style="height: 55px">
	<a class="btn btn-success btn-sm" href="data.php?page=courses&action=create_course">Новое направление</a>
		<a class="btn btn-success btn-sm" href="data.php?page=courses&action=create_profile">Новый профиль</a>
	</div>
	<table class="table table-bordered table-striped table-sm">
		<thead>
			<tr>
				<th scope="col" style="width: 2rem">№</th>
				<th scope="col">Направление</th>
				<th scope="col">Квалификация</th>
				<th scope="col">Профиль</th>
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
				$sql_count = "SELECT count(*) FROM courses";
				$sql_count_result = mysqli_query($link, $sql_count);
				$count_obj = mysqli_fetch_array($sql_count_result);
				$sql = "SELECT    cour.course_id
								, cour.number
								, cour.name
								, qua.name
						FROM  `courses` cour
							, `qualifications` qua
						WHERE cour.qualification_id = qua.qualification_id
						LIMIT ".$limit[0]."";
				$result = mysqli_query($link, $sql);
				while($row = mysqli_fetch_array($result)){
					$counter++;
					echo '<tr>'."\n".'<td>'.$counter.'</td>'."\n";
					echo '<td><a href="?page=courses&id='.$row[0].'">'.$row[1].' '.$row[2].'</a></td>'."\n";
					echo '<td>'.$row[3].'</td>'."\n";
					$sql2 = "SELECT   prof.profile_id
									, prof.name
							FROM  `profiles` prof
							WHERE prof.course_id = ".$row[0]."";
					$result2 = mysqli_query($link, $sql2);
					$counter2 = 0;
					echo '<td>'."\n";
					while($prof = mysqli_fetch_array($result2)){
						$counter2++;
						echo ($counter2).'. <a href="?page=courses?profid='.$prof[0].'">'.$prof[1].'</a><br>'."\n";
					};	
					echo '</td>'."\n".'</tr>'."\n";
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