<?php
	require_once ($_SERVER['DOCUMENT_ROOT']."/pages/404.php");
	exit();
?>
<div class="px-4 py-2 bg-primary font-weight-bold text-white container-fluid">
	<div class="row">
		<a class="btn btn-warning btn-sm back" href="/pages/data.php" style="height: 35px; width: 5rem; margin-left: 1rem" title="Назад" data-toggle="tooltip" data-placement="right">&#8592; Назад</a>
		<div class="h4" id="page_title" style="margin-left: 30%">ОТФ, ТФ и Активности</div>
	</div>
</div>
<div class="px-4 py-3 bg-light">
	<div class="alert alert-secondary col" style="height: 55px">
		<input class="btn btn-success btn-sm" type="button" id="create_otf" value="Новая ОТФ">
		<input class="btn btn-success btn-sm" type="button" id="create_tf" value="Новая ТФ">
		<input class="btn btn-success btn-sm" type="button" id="create_activity" value="Новая Активность">
	</div>
	<table class="table table-bordered table-striped table-sm">
		<thead>
			<tr>
				<th scope="col" style="width: 2rem">№</th>
				<th scope="col">ФГОС</th>
				<th scope="col">Профессиональный стандарт</th>
				<th scope="col">Номер приказа</th>
				<th scope="col">Дата приказа</th>
				<th scope="col">Номер регистации</th>
				<th scope="col">Дата регистации</th>
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
				$sql_count = "SELECT count(*) FROM general_work_functions";
				$sql_count_result = mysqli_query($link, $sql_count);
				$count_obj = mysqli_fetch_array($sql_count_result);
				$sql = "SELECT prof.prof_standard_id
							 , CONCAT_WS(' ',prof.code,prof.name)
							 , otf.general_work_function_id
						     , otf.code
						     , otf.name
						     , otf.level
						     , tf.work_function_id
						     , tf.code
						     , tf.name
						     , act.activity_id
						     , act_t.name
						     , act.name
						     , act.competence_id
						FROM prof_standards prof
						   , general_work_functions otf
						LEFT JOIN work_functions tf 
							on otf.general_work_function_id = tf.general_work_function_id
						LEFT JOIN activities act 
							on tf.work_function_id = act.work_function_id
						LEFT JOIN activity_types act_t 
							on act.activity_type_id = act_t.activity_type_id 
						LIMIT ".$limit[0]."";
				$result = mysqli_query($link, $sql);
				while($row = mysqli_fetch_array($result)){
					$counter++;
					echo '<tr>'."\n".'<td>'.$counter.'</td>'."\n";
					echo '<td><a href="?page=fgos&id='.$row[0].'">'.$row[1].' '.$row[2].'</a></td>'."\n";
					echo '<td><a href="?page=prof&id='.$row[3].'">'.$row[4].' '.$row[5].'</td>'."\n";
					echo '<td>'.$row[6].'</td>'."\n";
					echo '<td>'.$row[7].'</td>'."\n";
					echo '<td>'.$row[8].'</td>'."\n";
					echo '<td>'.$row[9].'</td>'."\n";
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