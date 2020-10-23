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
	<table class="table table-bordered table-sm">
		<thead>
			<tr style="text-align:center">
				<th scope="col" style="width: 2rem">№</th>
				<th scope="col">Направление</th>
				<th scope="col">Квалификация</th>
				<th scope="col" style="width: 2rem">№</th>
				<th scope="col">Профиль</th>
			</tr>
		</thead>
		<tbody id="data">
			<tr>
				<td colspan="5" style="text-align:center">Пустой список</td>
			</tr>
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
	var data = new Object();
	if ($_GET("round") && parseInt($_GET("round"))){
		data.round = $_GET("round");
	} else {
		data.round = 1;
	}
	var table_body = '';
	var courses_id = '';
	$.ajax({
		url: "/api/view_courses?round="+data.round, 
		type: "GET",
		async: false,
		success: function(response){
			data.total = response.total;
			data.limit = response.limit;
			data.start = response.start;
			data.courses = response.view_courses;	
			data.courses.forEach(function(course){
				courses_id += course.id + ",";
			});
			courses_id = courses_id.substr(0, (courses_id.length - 1));
		}
	});
	$.ajax({
		url: "/api/profiles?filter=on&course_id="+courses_id, 
		type: "GET",
		async: false,
		success: function(response){
			response.profiles.forEach(function(profile){
				let y = data.courses.findIndex(course => course.id == profile.course_id);
				if (data.courses[y].profiles === undefined){
					data.courses[y].profiles = [profile];
				} else {
					data.courses[y].profiles.push(profile);
				}
				if (data.courses[y].rows === undefined){
					data.courses[y].rows = 1;
				} else {
					++data.courses[y].rows;
				}					
			});		
		}
	});
	for (var [x, course] of Object.entries(data.courses)) {
		table_body += `<tr>
						<td rowspan="`+course.rows+`">`+((x*1)+data.start)+`</td>
						<td rowspan="`+course.rows+`"><a href="?page=courses&id=`+course.id+`">`+course.name+`</td>
						<td rowspan="`+course.rows+`">`+course.qualification+`</td>`;
		if (course.profiles === undefined){
			table_body += `<td></td>
							<td></td>
							</tr><tr>`;
		} else {
			course.profiles.forEach(function(profile, index){
				table_body += `<td>`+((index*1)+1)+`</td>
								<td><a href="?page=courses&profid=`+profile.id+`">`+profile.name+`</a></td>
							</tr><tr>`;
			});
		}
		table_body = table_body.substr(0, (table_body.length - 4));
	}	
	$("#data").html(table_body);
	gen_pagination(data.total, data.limit, data.round);	
});
</script>