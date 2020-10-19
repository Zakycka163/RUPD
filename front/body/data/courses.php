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
				<th scope="col" style="width: 2rem">№</th>
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
				$sql = "SELECT    cour.id
								, cour.number
								, cour.name
								, qua.name
						FROM  `courses` cour
							, `qualifications` qua
						WHERE cour.qualification_id = qua.id
						LIMIT ".$limit[0]."";
				$result = mysqli_query($link, $sql);
				while($row = mysqli_fetch_array($result)){
					$counter++;
					echo '<tr>'."\n".'<td>'.$counter.'</td>'."\n";
					echo '<td><a href="?page=courses&id='.$row[0].'">'.$row[1].' '.$row[2].'</a></td>'."\n";
					echo '<td>'.$row[3].'</td>'."\n";
					$sql2 = "SELECT   prof.id
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
			<li class="page-item disabled" id="prev_round">
				<a class="page-link" href>Предыдущая</a>
			</li>
			<li class="page-item disabled" id="next_round">
				<a class="page-link" href>Следующая</a>
			</li>
		</ul>
	</nav>	
</div>
<script src="/front/js/_GET.js"></script>
<script src="/front/js/pagination.js"></script>
<script>
$(document).ready(function(){
	var total;
	var limit;
	var round;
	var rows;
	var start;
	if ($_GET("round") && parseInt($_GET("round"))){
		round = $_GET("round");
	} else {
		round = 1;
	}
	var courses = new Object();
	var profiles = new Object();
	var table_body = '';
	$.ajax({
		url: "/api/view_courses?round="+round, 
		type: "GET",
		success: function(data){
			total = data.total;
			limit = data.limit;
			start = ((round-1)*limit)+1;
			courses = data.view_courses;	
		}
	}).done(function() {
		for (var [key, course] of Object.entries(courses)) {
			$.ajax({
				url: "/api/profiles?filter=on&course_id="+course.id, 
				type: "GET",
				async: false,
				success: function(response){
					rows = (response.total > 0)?response.total:1;
					profiles = response.profiles;
				}
			}).done(function() {
				table_body += `<tr>
								<td rowspan="`+rows+`">`+((key*1)+start)+`</td>
								<td rowspan="`+rows+`"><a href="?page=institutes&insid=`+institute.id+`">`+institute.name+`</td>`;
				for (var [ind, pulpit] of Object.entries(pulpits)) {
					table_body += `<td>`+((ind*1)+1)+`</td>
									<td><a href="?page=institutes&kafid=`+pulpit.id+`">`+pulpit.name+`</a></td>
								  </tr><tr>`;
				}
				table_body = table_body.substr(0, (table_body.length - 4));
			});
		}			
		$("#data").html(table_body);
		gen_pagination(total, limit, round);	
	});
});
</script>