<div class="px-4 py-2 bg-primary font-weight-bold text-white container-fluid">
	<div class="row">
		<a class="btn btn-warning btn-sm back" href="/pages/data.php" style="height: 35px; width: 5rem; margin-left: 1rem" title="Назад" data-toggle="tooltip" data-placement="right">&#8592; Назад</a>
		<div class="h4" id="page_title" style="margin-left: 20%">Федеральные государственные образовательные стандарты</div>
	</div>
</div>
<?php
	if (isset($_GET["id"])){
		require_once ($_SERVER['DOCUMENT_ROOT']."/front/body/single_obj/fgos.php");
		exit();
	}
?>

<div class="px-4 py-3 bg-light">
	<div class="alert alert-secondary col" style="height: 55px">
		<input class="btn btn-success btn-sm" type="button" id="create_fgos_button" value="Новый стандарт">
	</div>
	<table class="table table-bordered table-striped table-sm">
		<thead>
			<tr>
				<th scope="col" style="width: 2rem">№</th>
				<th scope="col">Код направления</th>
				<th scope="col">Направление</th>
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
				$sql = "select value from `constants` where `key` = 'limitObj'";
				$result = mysqli_query($link, $sql);
				$limit = mysqli_fetch_array($result);
				$counter = 0;
				$sql = "select    fgos.fgos_id
								, course.number
								, course.name
								, fgos.number
								, fgos.date
								, fgos.reg_number
								, fgos.reg_date 
						FROM  `courses` course
							, `fgos` fgos 
						WHERE fgos.course_id = course.course_id 
						LIMIT ".$limit[0]."";
				$result = mysqli_query($link, $sql);
				while($row = mysqli_fetch_array($result)){
					$counter++;
					echo '<tr>'."\n".'<td>'.$counter.'</td>'."\n";
					echo '<td><a href="?page=fgos&id='.$row[0].'">'.$row[1].'</a></td>'."\n";
					echo '<td>'.$row[2].'</td>'."\n";
					echo '<td>'.$row[3].'</td>'."\n";
					echo '<td>'.$row[4].'</td>'."\n";
					echo '<td>'.$row[5].'</td>'."\n";
					echo '<td>'.$row[6].'</td>'."\n";
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
<?php require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/create_fgos.php"); ?>
<script>
	$("#create_fgos_button").click(function(){
		$.post(
			"/back/switch_functions.php", 
			{functionname: 'get_course_list'}, 
			function(info){
				$('#empty_course').html(info);
				$('#empty_course').prop('hidden', false);
			}
		);
		$('#create_fgos_form').modal('show');
	});
</script>