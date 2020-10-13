<script src="/front/js/checkEmailMask.js"></script>
<?php
	if (isset($_GET["id"])){
		require_once ($_SERVER['DOCUMENT_ROOT']."/front/body/single_obj/teacher.php");
		exit();
	}
?>

<div class="px-4 py-2 bg-primary font-weight-bold text-white container-fluid">
	<div class="row">
		<a class="btn btn-warning btn-sm back" href="/pages/data.php" style="height: 35px; width: 5rem; margin-left: 1rem" title="Назад" data-toggle="tooltip" data-placement="right">&#8592; Назад</a>
		<div class="h4" id="page_title" style="margin-left: 35%">Преподаватели</div>
	</div>
</div>
<div class="px-4 py-3 bg-light">
	<div class="alert alert-secondary col" style="height: 55px">
		<input class="btn btn-success btn-sm" type="button" id="create_teacher" value="Новый преподаватель">
	</div>
	<table class="table table-bordered table-striped table-sm">
		<thead>
			<tr>
				<th scope="col" style="width: 2rem">№</th>
				<th scope="col">ФИО</th>
				<th scope="col">Email</th>
				<th scope="col">Степень</th>
				<th scope="col">Звание</th>
				<th scope="col">Должность</th>
				<th scope="col">Аккаунт</th>
			</tr>
		</thead>
		<tbody id="data"></tbody>
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
<script>
$(document).ready(function(){
	var total;
	var limit;
	var round;
	if ($_GET("round") && parseInt($_GET("round"))){
		round = $_GET("round");
	} else {
		round = 1;
	}
	var teachers = new Object();
	var table_body = '';
	$.ajax({
		url: "/api/view_teachers?round="+round, 
		type: "GET",
		success: function(response){
			total = response.total;
			limit = response.limit;
			teachers = response.view_teachers;
			for (var [key, teacher] of Object.entries(teachers)) {
				table_body += `<tr>
								<td>`+((key*1)+1)+`</td>
								<td><a href="?page=teachers&id=`+teacher.id+`">`+teacher.second_name+' '+teacher.first_name+' '+teacher.middle_name+`</td>
								<td>`+teacher.email+`</td>
								<td>`+teacher.deg_name+`</td>
								<td>`+teacher.ac_rank_name+`</td>
								<td>`+teacher.position+`</td>
								<td><a href="/pages/control/users.php?id=`+teacher.account_id+`">`+teacher.account+`</a></td>
							  </tr>`;
			}
			$("#data").html(table_body);

			var cnt_round = Math.ceil(total / limit) + 1;
			if (cnt_round > 1 && round != 1){
				let prev_round = (round * 1) - 1;
				$("#prev_round").removeClass("disabled");
				$("#prev_round").children().prop('href', "?page=teachers&round="+prev_round);
			}
			if (cnt_round > 1 && cnt_round != round){
				let next_round = (round * 1) +1;
				$("#next_round").removeClass("disabled");
				$("#next_round").children().prop('href', "?page=teachers&round="+next_round);
			}
			var round_list = '';
			for (var i = 1; i < (cnt_round + 1); i++) {
				var active = '';
				if (i == round){
					active = 'active';
				}
				round_list += `<li class="page-item `+ active +`">
								 <a class="page-link" href="?page=teachers&round=` + i + `">` + i + `</a>
							   </li>`;
			}
			$("#prev_round").after(round_list);
		}		
	});

	$("#create_teacher").click(function(){
		$('#create_teacher_form').modal('show');
	});
});
</script>