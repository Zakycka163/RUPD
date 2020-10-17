<div class="px-4 py-2 bg-primary font-weight-bold text-white container-fluid">
	<div class="row">
		<a class="btn btn-warning btn-sm back" href="/pages/data.php" style="margin-left: 1rem" title="Назад" data-toggle="tooltip" data-placement="right">&#8592; Назад</a>
		<div class="h4" id="page_title" style="margin-left: 30%">Институты и Кафедры</div>
	</div>
</div>
<div class="px-4 py-3 bg-light" style="margin-bottom: 4rem;">
	<div class="alert alert-secondary col" style="height: 55px">
		<a class="btn btn-success btn-sm" href="data.php?page=institutes&action=create_institute">Новый институт</a>
		<a class="btn btn-success btn-sm" href="data.php?page=institutes&action=create_pulpit">Новая кафедра</a>
	</div>
	<table class="table table-bordered table-striped table-sm">
		<thead>
			<tr>
				<th scope="col" style="width: 2rem">№</th>
				<th scope="col" style="width: 40%">Институт</th>
				<th scope="col" style="width: 2rem">№</th>
				<th scope="col">Кафедры</th>
			</tr>
		</thead>
		<tbody id="data">
			<tr>
				<td colspan="4" style="text-align:center">Пустой список</td>
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
<?php 
	require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/institute.php");
	require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/pulpit.php"); 
?> 
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
	var institutes = new Object();
	var pulpits = new Object();
	var table_body = '';
	$.ajax({
		url: "/api/institutes?round="+round, 
		type: "GET",
		success: function(data){
			total = data.total;
			limit = data.limit;
			start = ((round-1)*limit)+1;
			institutes = data.institutes;	
		}
	}).done(function() {
		for (var [key, institute] of Object.entries(institutes)) {
			$.ajax({
				url: "/api/pulpits?filter=on&institute_id="+institute.id, 
				type: "GET",
				async: false,
				success: function(response){
					rows = response.total;
					pulpits = response.pulpits;
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

	if ($_GET('action')=="create_institute"){
		$('#institute_form').modal('show');
	} else if ($_GET('action')=="create_pulpit"){
		$('#pulpit_form').modal('show');
	}

	if ($_GET('insid')) {
		$('#institute_form').modal('show');
		$('#institute_form_title').text('Институт:');
		let inst_id = $_GET('insid');
		$.post(
		 	"/back/data/db_institutes.php", 
			{functionname: 'get_institute', id: inst_id}, 
			function(info){
				var inst = $.parseJSON(info);
				$('#institute_form_title').after(inst.name);
				$('#inst_name').val(inst.name);
				$('#inst_description').text(inst.description);
			}
		);
	}

	if ($_GET('kafid')) {
		$('#pulpit_form').modal('show');
		$('#pulpit_form_title').text('Кафедра:');
		let pul_id = $_GET('kafid');
		$.post(
		 	"/back/data/db_pulpits.php", 
			{functionname: 'get_pulpit', id: pul_id}, 
			function(info){
				var pul = $.parseJSON(info);
				$('#pulpit_form_title').after(pul.name);
				$('#inst_val option:selected').prop('selected', false);
				$('#inst_val').val(pul.institute_id).prop('selected', true);
				$('#pul_name').val(pul.name);
				$('#pul_description').text(pul.description);
				
				$("#add_parent_inst_name_form").find("#inst_val option:selected").text()
				var inst_text = $("#inst_val :selected").text();
				$("#parent_inst_name").val(inst_text);
				$("#parent_inst_name").prop('title',inst_text);
				$("#add_parent_inst_name").removeClass('btn-outline-success');
				$("#add_parent_inst_name").addClass('btn-outline-primary');
				$("#add_parent_inst_name").text('Изменить');
			}
		);
	}

	$(".close_form").click(function(){
		location.href='data.php?page=institutes';
	});

	$(".close").click(function(){
		location.href='data.php?page=institutes';
	});
});
</script>