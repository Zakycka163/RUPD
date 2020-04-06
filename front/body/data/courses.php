<div class="px-4 py-3 bg-light">
	<div class="form-group">
		<h4 id="page_title">Направления и Профили</h4>
	</div>
	<div class="form-group">
		<a class="btn btn-warning btn-sm" href="/pages/data.php">Назад</a>
		<input class="btn btn-success btn-sm" type="button" id="create_course" value="Добавить направление">
		<input class="btn btn-success btn-sm" type="button" id="create_profile" value="Добавить профиль">
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
				$sql = "select value from `constants` where `key` = 'limitObj'";
				$result = mysqli_query($link, $sql);
				$limit = mysqli_fetch_array($result);
				$counter = 0;
				$sql = "select    cour.course_id
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
					$sql2 = "select   prof.profile_id
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
			<?php if (isset($_GET["limit"])){
			
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