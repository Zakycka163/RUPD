<center>
	<div class="p-2 bg-primary font-weight-bold text-white">
		<h4 id="page_title">Компетенции</h4>
	</div>
</center>
<?php
	if (isset($_GET["id"])){
		require_once ($_SERVER['DOCUMENT_ROOT']."/front/body/single_obj/competence.php");
		exit();
	}
?>

<div class="px-5 py-3 bg-light row">
	<a class="btn btn-warning alert alert-warning" href="/pages/data.php" style="height: 5rem; width: 5rem">
		<h6>&#8592;</h6>Назад
	</a>
	<div class="alert alert-secondary col" style="height: 5rem">
		<h6 id="page_title">Список компетенций</h6>
		<input class="btn btn-success btn-sm" type="button" id="create_new_teacher" value="Новая компетенция">
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
				$sql = "select value from `constants` where `key` = 'limitObj'";
				$result = mysqli_query($link, $sql);
				$limit = mysqli_fetch_array($result);
				$counter = 0;
				$sql = "select    fgos.fgos_id
								, course.number
								, course.name
								, prof.prof_standard_id
								, prof.code
								, prof.name
								, prof.number
								, prof.date
								, prof.reg_number
								, prof.reg_date 
						FROM  `prof_standards` prof
							, `fgos` fgos
							, `courses` course
						WHERE prof.fgos_id = fgos.fgos_id 
						  and fgos.course_id = course.course_id 
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
<?php require_once ($_SERVER['DOCUMENT_ROOT']."/front/creationForms/fgos.php"); ?>
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
		$('#create_fgos').modal('show');
	});
</script>