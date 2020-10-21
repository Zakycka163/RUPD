<div class="px-4 py-2 bg-primary font-weight-bold text-white container-fluid">
	<div class="row">
		<a class="btn btn-warning btn-sm back" href="/pages/data.php" style="height: 35px; width: 5rem; margin-left: 1rem" title="Назад" data-toggle="tooltip" data-placement="right">&#8592; Назад</a>
		<div class="h4" id="page_title" style="margin-left: 30%">ОТФ, ТФ и Активности</div>
	</div>
</div>
<div class="px-4 py-3 bg-light" style="margin-bottom: 4rem;">
	<div class="alert alert-info row" style="height: 55px;">
		<input class="btn btn-outline-danger btn-sm form-control-sm" type="button" id="clear" value="Сбросить">
		<label for="fgos" class="form-control-sm">ФГОС: </label>
		<select class="form-control form-control-sm col-sm-3" id="fgos"></select>
		<label for="prof" class="form-control-sm">Проф стандарт: </label>
		<select class="form-control form-control-sm col-sm-3" id="prof" disabled></select>
	</div>
	<div class="alert alert-secondary col" style="height: 55px" hidden id="work_panel">
		<input class="btn btn-success btn-sm" type="button" id="create_otf" value="Новая ОТФ">
		<input class="btn btn-success btn-sm" type="button" id="create_tf" value="Новая ТФ">
		<input class="btn btn-success btn-sm" type="button" id="create_activity" value="Новая Активность">
	</div>
	<table class="table table-bordered table-striped table-sm">
		<thead>
			<tr>
				<th scope="col" style="width: 2rem">№</th>
				<th scope="col">Проф стандарт</th>
				<th scope="col" style="width: 2rem">№</th>
				<th scope="col">ОТФ</th>
				<th scope="col">Уровень квалификации</th>
				<th scope="col" style="width: 2rem">№</th>
				<th scope="col">ТФ</th>
				<th scope="col">Тип активности</th>
				<th scope="col" style="width: 2rem">№</th>
				<th scope="col">Активность</th>
			</tr>
		</thead>
		<tbody id="data">
			<tr>
				<td colspan="10" style="text-align:center">Пустой список</td>
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
	$.ajax({
		url: "/api/view_fgos", 
		type: "GET",
		success: function(response){
			var fgos_option = '<option value="0"></option>';
			for (var [key, fgos] of Object.entries(response.view_fgos)) {
				var state = '';
				if ($_GET("fgos_id") && $_GET("fgos_id") == fgos.id){
					state = 'selected';
				}
				fgos_option += `<option value="`+fgos.id+`"`+state+`>`+fgos.name+`</option>`;
			}
			$("#fgos").html(fgos_option);
		}
	});
	if ($_GET("fgos_id") && parseInt($_GET("fgos_id"))){
		$("#fgos").trigger("change");
		if ($_GET("prof_id") && parseInt($_GET("prof_id"))){
			$("#prof").trigger("change");
		}
	}
	
	
	/*
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
			for (var [y, profile] of Object.entries(course.profiles)) {
				table_body += `<td>`+((y*1)+1)+`</td>
								<td><a href="?page=courses&profid=`+profile.id+`">`+profile.name+`</a></td>
							</tr><tr>`;
			}
			
		}
		table_body = table_body.substr(0, (table_body.length - 4));
	}	
	$("#data").html(table_body);
	gen_pagination(data.total, data.limit, data.round);	*/
});

$("#fgos").change(function() {
	$('#data').html('<tr><td colspan="10" style="text-align:center">Пустой список</td></tr>');
	$('#prof').html('<option value="0"></option>');
	$('#work_panel').prop('hidden', true);
	window.history.pushState('', '',window.location.href.replace(/&fgos_id=\d{1,}/g, ""));
	window.history.pushState('', '',window.location.href.replace(/&prof_id=\d{1,}/g, ""));
	var fgos_id = '';
	fgos_id = $("#fgos").val();
	if (fgos_id !== undefined) {
		if ($_GET("fgos_id") && parseInt($_GET("fgos_id"))) {
			fgos_id = $_GET("fgos_id");
		}
	}
	if (fgos_id == 0 || fgos_id === null) {
		$('#prof').prop('disabled', true);
	} else {
		window.history.pushState('', '', window.location.href+'&fgos_id='+fgos_id);
		$.ajax({
			url: "/api/view_profs?filter=on&fgos_id="+fgos_id, 
			type: "GET",
			success: function(response){
				var prof_option = '<option value="0"></option>';
				if (response.view_profs !== undefined){
					for (var [key, prof] of Object.entries(response.view_profs)) {
						var state = '';
						if ($_GET("prof_id") && $_GET("prof_id") == prof.id){
							state = 'selected';
						}
						prof_option += `<option value="`+prof.id+`"`+state+`>`+prof.name+`</option>`;
					}
				}
				$("#prof").html(prof_option);
				$('#prof').prop('disabled', false);
			}
		});
	}
});

$("#prof").change(function() {
	$('#work_panel').prop('hidden', true);
	window.history.pushState('', '',window.location.href.replace(/&prof_id=\d{1,}/g, ""));
	var prof_id = '';
	var fgos_id = '';
	if ($_GET("fgos_id") && parseInt($_GET("fgos_id"))) {
		fgos_id = $_GET("fgos_id");
	} else { fgos_id = $("#fgos").val(); }
	
	if ($_GET("prof_id") && parseInt($_GET("prof_id"))) {
		prof_id = $_GET("prof_id");
	} else { prof_id = $("#prof").val(); }

	if (prof_id == 0 || prof_id === null) {
		$('#data').html('<tr><td colspan="10" style="text-align:center">Пустой список</td></tr>');
	} else {
		window.history.pushState('', '', window.location.href+'&prof_id='+prof_id);
		var data = new Object();
		var table_body = '';
		var tfs_id = '';
		$.ajax({
			url: "/api/view_tfuns?filter=on&prof_id="+prof_id, 
			type: "GET",
			async: false,
			success: function(response){
				data.total = response.total;
				data.tfuns = response.view_tfuns;
				for (var [key, tfun] of Object.entries(data.tfuns)) {
					if (tfun.tf_id !== null && !tfs_id.includes(tfun.tf_id)){
						tfs_id += tfun.tf_id + ",";
					}
				}
				tfs_id = tfs_id.substr(0, (tfs_id.length - 1));
			}
		});
		$.ajax({
			url: "/api/view_acts?filter=on&tf_id="+tfs_id, 
			type: "GET",
			async: false,
			success: function(response){
				for (var [key, tfun] of Object.entries(data.tfuns)) {
					for (var [x, act] of Object.entries(response.view_acts)) {
						if (tfun.id == act.work_function_id){
							if (data.tfuns[key].acts === undefined){
								data.tfuns[key].acts = [act];
							} else {
								data.tfuns[key].acts.push(act);
							}
							if (data.tfuns[key].rows === undefined){
								data.tfuns[key].rows = 1;
							} else {
								++data.tfuns[key].rows;
							}
						}
					}
				}		
			}
		});
		for (var [x, tfun] of Object.entries(data.tfuns)) {
			table_body += `<tr>
							<td rowspan="`+tfun.rows+`">`+((x*1)+data.start)+`</td>
							<td rowspan="`+tfun.rows+`"><a href="?page=courses&id=`+tfun.id+`">`+tfun.name+`</td>
							<td rowspan="`+tfun.rows+`">`+tfun.qualification+`</td>`;
			if (tfun.acts === undefined){
				table_body += `<td></td>
								<td></td>
								</tr><tr>`;
			} else {
				for (var [y, act] of Object.entries(tfun.acts)) {
					table_body += `<td>`+((y*1)+1)+`</td>
									<td><a href="?page=courses&profid=`+act.id+`">`+act.name+`</a></td>
								</tr><tr>`;
				}
				
			}
			table_body = table_body.substr(0, (table_body.length - 4));
		}
		//$("#data").html(table_body);
		$('#work_panel').prop('hidden', false);
		$("#data").text(JSON.stringify(data));
		gen_pagination(data.total, data.limit, data.round);
	}
});

$("#clear").click(function() {
	window.history.pushState('', '',window.location.href.replace(/&fgos_id=\d{1,}/g, ""));
	window.history.pushState('', '',window.location.href.replace(/&prof_id=\d{1,}/g, ""));
	$('#data').html('<tr><td colspan="10" style="text-align:center">Пустой список</td></tr>');
	$('#work_panel').prop('hidden', true);
	$('#prof').html('<option value="0"></option>');
	$('#prof').prop('disabled', true);
	$("#fgos").val(0).prop('selected', true);
});
</script>