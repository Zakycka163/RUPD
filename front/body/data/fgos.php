<div class="px-4 py-2 bg-primary font-weight-bold text-white container-fluid">
	<div class="row">
		<a class="btn btn-warning btn-sm back" href="/pages/data.php" 
			title="Назад" data-toggle="tooltip" data-placement="right">&#8592; Назад</a>
		<div class="h4" id="page_title" style="margin-left: 20%">Федеральные государственные образовательные стандарты</div>
	</div>
</div>
<div class="px-4 py-3 bg-light" style="margin-bottom: 4rem;">
	<div class="alert alert-secondary col" style="height: 55px">
		<input class="btn btn-success btn-sm" type="button" id="create_fgos_button" value="Новый стандарт">
	</div>
	<table class="table table-bordered table-sm">
		<thead>
			<tr style="text-align:center">
				<th scope="col" style="width: 2rem">№</th>
				<th scope="col">Направление</th>
				<th scope="col">Номер приказа</th>
				<th scope="col">Дата приказа</th>
				<th scope="col">Номер регистации</th>
				<th scope="col">Дата регистации</th>
			</tr>
		</thead>
		<tbody id="data">
			<tr>
				<td colspan="6" style="text-align:center">Пустой список</td>
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
<?php require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/fgos.php"); ?>
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
		url: "/api/view_fgos?round="+data.round, 
		type: "GET",
		success: function(response){
			data.total = response.total;
			data.limit = response.limit;
			data.start = response.start;
			data.fgoses = response.view_fgos;
			for (const [key, fgos] of Object.entries(data.fgoses)) {
				table_body += `<tr>
								<td>`+((key*1)+data.start)+`</td>
								<td><a href="?page=fgos&id=`+fgos.id+`">`+fgos.name+`</td>
								<td>`+fgos.number+`</td>
								<td>`+fgos.date+`</td>
								<td>`+fgos.reg_number+`</td>
								<td>`+fgos.reg_date+`</td>
							  </tr>`;
			}
			$("#data").html(table_body);

			gen_pagination(data.total, data.limit, data.round);
		}		
	});

	$("#create_fgos_button").click(function(){
		$.post(
			"/back/switch_functions.php", 
			{functionname: 'get_course_list'}, 
			function(info){
				$('#empty_course').html(info);
				$('#empty_course').prop('hidden', false);
			}
		);
		$('#fgos_form').modal('show');
	});

	if ($_GET('id')) {
		$.post(
			"/back/switch_functions.php", 
			{functionname: 'get_course_list'}, 
			function(info){
				$('#empty_course').html(info);
				$('#empty_course').prop('hidden', false);
			}
		);
		$('#form_title').text('ФГОС');

		let fgos_id = $_GET('id');
		$.post(
		 	"/back/data/db_fgos.php", 
			{functionname: 'get_fgos', id: fgos_id}, 
			function(info){
				var fgos = $.parseJSON(info);
				$('#empty_course option:selected').prop('selected', false);
				$('#empty_course').val(fgos.course).prop('selected', true);
				$('#input_number').val(fgos.number);
				$('#input_date').val(fgos.date);
				$('#reg_date').val(fgos.reg_date);
				$('#reg_number').val(fgos.reg_number);
			}
		);
		$('#fgos_form').modal('show');
	}

	$(".close_form").click(function(){
		location.href='data.php?page=fgos';
	});
});
</script>