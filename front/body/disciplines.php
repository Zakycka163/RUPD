<form>
	<div class="px-4 py-3 bg-light">
		<div class="form-group">
			<h4 id="page_title">Дисциплины</h3>
		</div>
		<div class="form-group">
			<input class="btn btn-success btn-sm" type="button" id="create_discipline" value="Добавить">
		</div>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th scope="col" style="width: 2rem">№</th>
					<th scope="col">Кафедра</th>
					<th scope="col">Название дисциплины</th>
					<th scope="col">Индекс</th>
					<th scope="col">Модуль</th>
					<th scope="col">Образовательная часть</th>
					<th scope="col">Нагрузка, ч</th>
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
					$sql = "select    kaf.pulpit_id
									, kaf.name
									, dis.discipline_id
									, dis.name
									, dis.index_info
									, module.name
									, part.name
									, dis.time
							FROM  `disciplines` dis
								, `pulpits` kaf
								, `modules` module
								, `parts` part
							WHERE 	dis.pulpit_id = kaf.pulpit_id
								and dis.module_id = module.module_id
								and dis.part_id = part.part_id
							LIMIT ".$limit[0]."";
					$result = mysqli_query($link, $sql);
					while($row = mysqli_fetch_array($result)){
						$counter++;
						echo '<tr>'."\n".'<td>'.$counter.'</td>'."\n";
						echo '<td><a href="?page=institutes&kafid='.$row[0].'">'.$row[1].'</a><br>'."\n";
						echo '<td><a href="?page=disciplines&id='.$row[2].'">'.$row[3].'</a></td>'. "\n";
						echo '<td>'.$row[4].'</td>'."\n";
						echo '<td>'.$row[5].'</td>'."\n";
						echo '<td>'.$row[6].'</td>'."\n";
						echo '<td>'.$row[7].'</td>'."\n";
						echo '</tr>'."\n";
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
</form>	