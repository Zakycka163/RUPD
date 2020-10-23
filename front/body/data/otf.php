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
	<table class="table table-bordered table-sm">
		<thead>
			<tr style="text-align:center">
				<th scope="col" style="width: 2rem">№</th>
				<th scope="col">ОТФ <input class="btn btn-outline-success btn-sm work_buttons" type="button" id="create_otf" value="Новая ОТФ"></th>
				<th scope="col">Уровень квалификации</th>
				<th scope="col" style="width: 2rem">№</th>
				<th scope="col">ТФ <input class="btn btn-outline-success btn-sm work_buttons" type="button" id="create_tf" value="Новая ТФ"></th>
				<th scope="col">Тип активности</th>
				<th scope="col" style="width: 2rem">№</th>
				<th scope="col">Активность <input class="btn btn-outline-success btn-sm work_buttons" type="button" id="create_activity" value="Новая Активность"></th>
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
	get_fgos();
	if ($_GET("fgos_id") && parseInt($_GET("fgos_id"))){
		get_prof_by_fgos($_GET("fgos_id"));
		if ($_GET("prof_id") && parseInt($_GET("prof_id"))){
			get_data_by_prof($_GET("prof_id"));
		} else { del_prof_href(); }
	} else { 
		del_prof_href();
		del_fgos_href();
	}

});

$("#fgos").change(function() {
	prof_reset();
	table_reset();
	
	var fgos_id = '';
	fgos_id = $("#fgos").val();
	if (fgos_id == 0 || fgos_id === null) {
		del_fgos_href();
	} else {
		if (window.location.search.search('&fgos_id=') > -1){
			window.history.pushState('fgos_id', '',window.location.href.replace(/&fgos_id=[^&\n]{1,}/g, '&fgos_id='+fgos_id+''));
		} else {
			window.history.pushState('', '', window.location.href+'&fgos_id='+fgos_id);
		}
		get_prof_by_fgos(fgos_id);
	}
});

$("#prof").change(function() {
	table_reset();
	var prof_id = '';
	prof_id = $("#prof").val();
	
	if (prof_id == 0 || prof_id === null) {
		del_prof_href();
	} else {
		if (window.location.search.search('&prof_id=') > -1){
			window.history.pushState('prof_id', '',window.location.href.replace(/&prof_id=[^&\n]{1,}/g, '&prof_id='+prof_id+''));
		} else {
			window.history.pushState('', '', window.location.href+'&prof_id='+prof_id);
		}
		get_data_by_prof(prof_id);
	}
});

$("#clear").click(function() {
	del_fgos_href();
	$('#fgos').val(0).prop('selected', true);

	prof_reset();
	$('#prof').prop('disabled', true);

	table_reset();
});

function get_fgos(){
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
			if (fgos_option.search('selected') == -1){
				del_fgos_href();
				del_prof_href();
			}
			$("#fgos").html(fgos_option);
		}
	});
}

function get_prof_by_fgos(fgos_id){
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
function get_data_by_prof(prof_id){
	var data = new Object();
	if ($_GET("round") && parseInt($_GET("round"))){
		data.round = $_GET("round");
	} else {
		data.round = 1;
	}
	var table_body = '';
	var otfs_id = '';
	$.ajax({
		url: "/api/general_work_functions?filter=on&prof_standard_id="+prof_id, 
		type: "GET",
		async: false,
		success: function(response){
			data.total = response.total;
			data.limit = response.limit;
			data.start = response.start;
			data.otfuns = response.general_work_functions;
			if (data.otfuns !== undefined) {
				for (var [key, otfun] of Object.entries(data.otfuns)) {
					otfs_id += otfun.id + ",";
				}
				otfs_id = otfs_id.substr(0, (otfs_id.length - 1));
			}
		}
	});
	if (otfs_id != '') {
		var tfs_id = '';
		$.ajax({
			url: "/api/work_functions?filter=on&general_work_function_id="+otfs_id, 
			type: "GET",
			async: false,
			success: function(response){
				for (var [key, otfun] of Object.entries(data.otfuns)) {
					for (var [x, tfun] of Object.entries(response.work_functions)) {
						tfs_id += tfun.id + ",";
						if (otfun.id == tfun.general_work_function_id){
							if (data.otfuns[key].tfuns === undefined){
								data.otfuns[key].tfuns = [tfun];
							} else {
								data.otfuns[key].tfuns.push(tfun);
							}
							if (data.otfuns[key].rows === undefined){
								data.otfuns[key].rows = 1;
							} else {
								++data.otfuns[key].rows;
							}
						}
					}
				}
				tfs_id = tfs_id.substr(0, (tfs_id.length - 1));	
			}
		});
		if (tfs_id != '') {
			$.ajax({
				url: "/api/view_acts?filter=on&work_function_id="+tfs_id, 
				type: "GET",
				async: false,
				success: function(response){
					var act_types = new Array();
					for (var [y, act] of Object.entries(response.view_acts)) {
						if (act_types === undefined) {
							act_types = [{"type_id": act.type_id, "type": act.type}];
						} else if (act_types.findIndex(element => element.type_id == act.type_id) == -1){
							act_types.push({"type_id": act.type_id, "type": act.type});
						}
					}
					for (var [key, otfun] of Object.entries(data.otfuns)) {
						if (otfun.tfuns !== undefined){
							for (var [x, tfun] of Object.entries(otfun.tfuns)) {
								for (var [y, act] of Object.entries(response.view_acts)) {
									if (tfun.id == act.work_function_id){
										if (data.otfuns[key].tfuns[x].act_types === undefined) {
											data.otfuns[key].tfuns[x].act_types = act_types;
										} 
										for (var [z, act_type] of Object.entries(data.otfuns[key].tfuns[x].act_types)){
											if (act.type_id == act_type.type_id){
												if (act_type.acts === undefined){
													data.otfuns[key].tfuns[x].act_types[z].acts = [act];
												} else {
													data.otfuns[key].tfuns[x].act_types[z].acts.push(act);
												}
												if (data.otfuns[key].tfuns[x].act_types[z].rows === undefined){
													data.otfuns[key].tfuns[x].act_types[z].rows = 1;
												} else {
													++data.otfuns[key].tfuns[x].act_types[z].rows;
												}
											}			
										}
										if (data.otfuns[key].tfuns[x].rows === undefined){
											data.otfuns[key].tfuns[x].rows = 1;
										} else {
											++data.otfuns[key].tfuns[x].rows;
										}
										++data.otfuns[key].rows;
									}
								}
							}
						}
					}
				}
			});
		}

		for (var [x, otfun] of Object.entries(data.otfuns)) {
			table_body += `<tr>
							<td rowspan="`+otfun.rows+`">`+((x*1)+data.start)+`</td>
							<td rowspan="`+otfun.rows+`"><a href="?page=otf&id=`+otfun.id+`">`+otfun.full_name+`</td>
							<td rowspan="`+otfun.rows+`">`+otfun.level+`</td>`;
			if (otfun.tfuns === undefined){
				table_body += `<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								</tr><tr>`;
			} else {
				for (var [y, tfun] of Object.entries(otfun.tfuns)) {
					table_body += `<td rowspan="`+tfun.rows+`">`+((y*1)+1)+`</td>
									<td rowspan="`+tfun.rows+`"><a href="?page=otf&tfid=`+tfun.id+`">`+tfun.name+`</a></td>`;
					if (tfun.act_types === undefined){
						table_body += `<td></td>
								<td></td>
								<td></td>
								</tr><tr>`;
					} else {
						for (var [z, act_type] of Object.entries(tfun.act_types)) {
							table_body += `<td rowspan="`+act_type.rows+`">`+act_type.type+`</td>`;
							for (var [u, act] of Object.entries(act_type.acts)) {
								table_body += `<td rowspan="`+act.rows+`">`+((u*1)+1)+`</td>
												<td rowspan="`+act.rows+`"><a href="?page=otf&tfid=`+act.id+`">`+act.name+`</a></td>
											</tr><tr>`;
							}
						}
					}
				}
				
			}
		}
		table_body = table_body.substr(0, (table_body.length - 4));
		$("#data").html(table_body);
		gen_pagination(data.total, data.limit, data.round);
	}
	$('.work_buttons').prop('hidden', false);
}

function del_prof_href(){
	window.history.pushState('', '',window.location.href.replace(/&prof_id=[^&\n]{1,}/g, ""));
}
function del_fgos_href(){
	window.history.pushState('', '',window.location.href.replace(/&fgos_id=[^&\n]{1,}/g, ""));
}

function prof_reset(){
	$('#prof').html('<option value="0"></option>');
	del_prof_href();
}

function table_reset(){
	pagination_reset();
	$('.work_buttons').prop('hidden', true);
	$('#data').html(`<tr>
						<td colspan="10" style="text-align:center">Пустой список</td>
					 </tr>`);
}	
</script>