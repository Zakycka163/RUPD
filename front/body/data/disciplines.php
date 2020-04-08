<?php
	if (isset($_GET["id"])){
		require_once ($_SERVER['DOCUMENT_ROOT']."/front/body/single_obj/discipline.php");
		exit();
	}
?>
<div class="px-4 py-2 bg-primary font-weight-bold text-white container-fluid">
	<div class="row">
		<a class="btn btn-warning btn-sm back" href="/pages/data.php" style="height: 35px; width: 5rem; margin-left: 1rem" title="Назад" data-toggle="tooltip" data-placement="right">&#8592; Назад</a>
		<div class="h4" id="page_title" style="margin-left: 35%">Дисциплины</div>
	</div>
</div>
<div class="px-4 py-3 bg-light">
	<div class="alert alert-secondary col" style="height: 55px">
		<input class="btn btn-success btn-sm" type="button" id="create_discipline" value="Новая дисциплина">
	</div>
	<table class="table table-bordered table-striped table-sm">
		<thead>
			<tr>
				<th scope="col" style="width: 2rem">№</th>
				<th scope="col">Название дисциплины</th>
				<th scope="col">Кафедра</th>
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
				$sql = "SELECT `value` FROM `constants` WHERE `key` = 'limitObj'";
				$result = mysqli_query($link, $sql);
				$limit = mysqli_fetch_array($result);
				$counter = 0;
				$sql_count = "SELECT count(*) FROM disciplines";
				$sql_count_result = mysqli_query($link, $sql_count);
				$count_obj = mysqli_fetch_array($sql_count_result);
				$sql = "SELECT    kaf.pulpit_id
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
					echo '<td><a href="?page=disciplines&id='.$row[2].'">'.$row[3].'</a></td>'. "\n";
					echo '<td><a href="?page=institutes&kafid='.$row[0].'">'.$row[1].'</a><br>'."\n";
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