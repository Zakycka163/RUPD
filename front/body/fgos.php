<form>
	<div class="px-4 py-3 bg-light">
		<div class="form-group">
			<h4 id="page_title">ФГОС</h3>
		</div>
		<div class="form-group">
			<div class="btn-group btn-group-sm" role="group">
				<a type="button" class="btn btn-success">Добавить</a>
				<script>
				$("#create_info_fgos").click(function(){
					var course_value = $("#input_course").val();
					if ((course_value !== '') && (course_value !== null)){
						$('#get_course').prop('hidden',false);
						var course_value = $("#input_course").val();
						$.post(
							"../back/switch_functions.php", 
							{functionname: 'get_course_list', param: course_value}, 
							function(info){$('#get_course').prop('value', info);}
						);
						$('#course_id').text(course_value);
					} else {
						$('#get_course').prop('value', 'Направление не определено');
					}
					$('#create_fgos').modal('show');
				});
			</script>	
			</div>
		</div>
		<table class="table table-bordered table-striped">
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
					$sql = "select    course.number
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
						echo '<tr>'. "\n" . '<td>'.$counter .'</td>'."\n";
						echo '<td> <a href="?page=fgos&id='.$row[0].'">'.$row[0].'</a></td>'. "\n";
						echo '<td>'.$row[1].'</td>'. "\n";
						echo '<td>'.$row[2].'</td>'. "\n";
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