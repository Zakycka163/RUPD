<script src="/front/js/checkEmailMask.js"></script>
<?php
	if (isset($_GET["id"])){
		require_once ($_SERVER['DOCUMENT_ROOT']."/front/body/single_obj/teacher.php");
		exit();
	}
?>

<div class="px-4 py-2 bg-primary font-weight-bold text-white container-fluid">
	<div class="row">
		<a class="btn btn-warning btn-sm back" href="/pages/data.php" 
			title="Назад" data-toggle="tooltip" data-placement="right">&#8592; Назад</a>
		<div class="h4" id="page_title" style="margin-left: 35%">Преподаватели</div>
	</div>
</div>
<div class="px-4 py-3 bg-light" style="margin-bottom: 4rem;">
	<div class="alert alert-secondary col" style="height: 55px">
		<input class="btn btn-success btn-sm" type="button" id="create_teacher" value="Новый преподаватель">
	</div>
	<table class="table table-bordered table-sm">
		<thead>
			<tr style="text-align:center">
				<th scope="col" style="width: 2rem">№</th>
				<th scope="col">ФИО</th>
				<th scope="col">Email</th>
				<th scope="col">Степень</th>
				<th scope="col">Звание</th>
				<th scope="col">Должность</th>
				<th scope="col">Аккаунт</th>
			</tr>
		</thead>
		<tbody id="data">
			<tr>
				<td colspan="7" style="text-align:center">Пустой список</td>
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

<?php require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/create_teacher.php"); ?>
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
	$.ajax({
		url: "/api/view_teachers?round="+data.round, 
		type: "GET",
		success: function(response){
			data.total = response.total;
			data.limit = response.limit;
			data.start = response.start;
			data.teachers = response.view_teachers;
			for (var [key, teacher] of Object.entries(data.teachers)) {
				table_body += `<tr>
								<td>`+((key*1)+data.start)+`</td>
								<td><a href="?page=teachers&id=`+teacher.id+`">`+teacher.second_name+' '+teacher.first_name+' '+teacher.middle_name+`</td>
								<td>`+teacher.email+`</td>
								<td>`+teacher.deg_name+`</td>
								<td>`+teacher.ac_rank_name+`</td>
								<td>`+teacher.position+`</td>
								<td><a href="/pages/control/users.php?id=`+teacher.account_id+`">`+teacher.account+`</a></td>
							  </tr>`;
			}
			$("#data").html(table_body);
			gen_pagination(data.total, data.limit, data.round);
		}		
	});

	$("#create_teacher").click(function(){
		$('#create_teacher_form').modal('show');
	});
});
</script>