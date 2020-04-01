<table class="table table-borderless">
		
	<tr id="course_and_profile">
		<td class="align-middle">Направление</td>
		<td width="45%">
			<select class="form-control form-control-sm" id="input_course">
				<option selected disabled>Выбрать направление</option>
				<?php 
					options_present("SELECT course_id, CONCAT_WS(' ',number,name) as course FROM courses order by number");		
				?>
			</select>
		</td>
		<td class="align-middle">Профиль</td>
		<td width="50%">
			<select class="form-control form-control-sm" id="input_profile" disabled>
				<option selected disabled>Направление не определено</option>
			</select>
		</td>	
	</tr>
	
	<tr id="fgos_and_prof_stand">
		<td>ФГОС</td>
		<td>
			<div class="row">
				<div class="col" id="info_fgos_id" hidden></div>
				<div class="col" id="info_fgos">Направление не определено</div>
				<div class="col" id="div_create_info_fgos" hidden>
					<button class="btn btn-outline-primary btn-sm" id="create_info_fgos" type="button">Ввести данные ФГОС</button>
				</div>
			</div>
		</td>
		<td>Проффесинальный стандарт</td>
		<td>
			<select class="form-control form-control-sm" multiple id="input_prof_stad" style="height: 5rem" disabled></select>
		</td>	
	</tr>
	
	<tr id="otf_and_tf">
		<td>Обобщенные трудовые функции</td>
		<td> 
			<select class="form-control form-control-sm" multiple id="input_otf" style="height: 7rem;" disabled></select>
		</td>
		<td>Трудовые функции</td>
		<td>
			<table>
				<tr class="multiselection" id="t_functions">
					<td>
						<select class="selection_for_add form-control form-control-sm" multiple id="input_tf" style="height: 5rem; margin-left: -10px; margin-top: -10px;" disabled></select>
						<select class="element_for_add form-control form-control-sm" id="tf_for_add" disabled data-toggle="popover" data-placement="left" data-content="Нужно выбрать!" style="margin-left: -10px;">
							<option selected disabled>ОТФ не определены</option>
						</select>
					</td>
					<td width="1%">
						<span class="del_tf badge badge-danger" type="button" title="Удалить" style="height: 20px; margin-top: 20px; margin-left: -20px;"> &minus;</span>
						<span class="add_tf badge badge-success" type="button" title="Добавить" style="height: 20px; margin-top: 35px; margin-left: -20px;">&#43;</span>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	 
	<tr class="hr_section">
		<td colspan="4"><hr></td>
	</tr>
	
	<tr id="pulpit_and_discipline">
		<td class="align-middle">Кафедра</td>
		<td>
			<select class="form-control form-control-sm" id="input_pulpit">
				<option selected disabled>Выбрать кафедру</option>
				<?php 
					options_present("SELECT pulpit_id, name FROM pulpits order by institute_id");		
				?>
			</select>
		</td>
		<td class="align-middle">Дисциплина</td>
		<td>
			<select class="form-control form-control-sm" id="input_discipline" disabled>
				<option selected disabled>Кафедра не определена</option>
			</select>
		</td>
	</tr>	

	<tr id="institute_and_part_discipline">
		<td>Институт</td>
		<td>
			<div class="row">
				<div class="col" id="info_institute">Кафедра не определена</div>
			</div>
		</td>
		<td>Относится к</td>
		<td>
			<div class="row">
				<div class="col" id="info_part">Дисциплина не определена</div>
			</div>
		</td>
	</tr>
	
	<tr id="goal_and_mission">
		<td>Цель</td>
		<td>
			<textarea class="form-control form-control-sm" type="text" id="input_goal" style="height: 7rem" data-toggle="popover" data-placement="left" data-content="Нужно заполнить!"></textarea>
		</td>
		<td>Задачи</td>
		<td>
			<table>
				<tr class="multiselection">
					<td>
						<select class="selection_for_add form-control form-control-sm" id="input_mission" multiple style="height: 5rem; margin-left: -10px; margin-top: -10px;"></select>
						<div class="input-group input-group-sm">
							<input class="element_for_add form-control form-control-sm" type="text" data-toggle="popover" data-placement="left" data-content="Нужно заполнить!" style="margin-left: -10px; margin-right: 10px;">
						</div>
					</td>
					<td width="1%">
						<span class="del_button badge badge-danger" type="button" title="Удалить" style="height: 20px; margin-top: 20px; margin-left: -20px;"> &minus;</span>
						<span class="add_button badge badge-success" type="button" title="Добавить" style="height: 20px; margin-top: 35px; margin-left: -20px;">&#43;</span>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	
	<tr class="hr_section topic_section">
		<td class="text-center" colspan="4"><hr><h6>Содержание дисциплины, структурированное по темам (разделам)</h6><hr></td>
	</tr>
	
	<tr id="lecture_and_practical">
		<td>Содержание дисциплины</td>
		<td>
			<table>
				<tr class="multiselection">
					<td>
						<select class="selection_for_add form-control form-control-sm" id="input_lecture" multiple style="height: 7rem; margin-left: -10px; margin-top: -10px;"></select>
						<div class="input-group">
							<input class="element_for_add form-control form-control-sm" type="text" data-toggle="popover" data-placement="left" data-content="Нужно заполнить!" style="margin-left: -10px; margin-right: 10px;">
						</div>
					</td>
					<td width="1%">
						<span class="del_button badge badge-danger" type="button" title="Удалить" style="height: 20px; margin-top: 35px; margin-left: -20px;"> &minus;</span>
						<span class="add_button badge badge-success" type="button" title="Добавить" style="height: 20px; margin-top: 53px; margin-left: -20px;">&#43;</span>
					</td>
				</tr>
			</table>
		</td>
		<td>Содержание практических (семинарских) занятий</td>
		<td>
			<table>
				<tr class="multiselection">
					<td>
						<select class="selection_for_add form-control form-control-sm" id="input_practical" multiple style="height: 7rem; margin-left: -10px; margin-top: -10px;"></select>
						<div class="input-group">
							<input class="element_for_add form-control form-control-sm" type="text" data-toggle="popover" data-placement="left" data-content="Нужно заполнить!" style="margin-left: -10px; margin-right: 10px;">
						</div>
					</td>
					<td width="1%">
						<span class="del_button badge badge-danger" type="button" title="Удалить" style="height: 20px; margin-top: 35px; margin-left: -20px;"> &minus;</span>
						<span class="add_button badge badge-success" type="button" title="Добавить" style="height: 20px; margin-top: 53px; margin-left: -20px;">&#43;</span>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	
	<tr id="laboratory_and_individual">
		<td>Содержание лабораторных работ</td>
		<td>
			<table>
				<tr class="multiselection">
					<td>
						<select class="selection_for_add form-control form-control-sm" id="input_laboratory" multiple style="height: 7rem; margin-left: -10px; margin-top: -10px;"></select>
						<div class="input-group">
							<input class="element_for_add form-control form-control-sm" type="text" data-toggle="popover" data-placement="left" data-content="Нужно заполнить!" style="margin-left: -10px; margin-right: 10px;">
						</div>
					</td>
					<td width="1%">
						<span class="del_button badge badge-danger" type="button" title="Удалить" style="height: 20px; margin-top: 35px; margin-left: -20px;"> &minus;</span>
						<span class="add_button badge badge-success" type="button" title="Добавить" style="height: 20px; margin-top: 53px; margin-left: -20px;">&#43;</span>
					</td>
				</tr>
			</table>
		</td>
		<td>Содержание заданий для самостоятельной работы</td>
		<td>
			<table>
				<tr class="multiselection">
					<td>
						<select class="selection_for_add form-control form-control-sm" id="input_individual" multiple style="height: 7rem; margin-left: -10px; margin-top: -10px;"></select>
						<div class="input-group">
							<input class="element_for_add form-control form-control-sm" type="text" data-toggle="popover" data-placement="left" data-content="Нужно заполнить!" style="margin-left: -10px; margin-right: 10px;">
						</div>
					</td>
					<td width="1%">
						<span class="del_button badge badge-danger" type="button" title="Удалить" style="height: 20px; margin-top: 35px; margin-left: -20px;"> &minus;</span>
						<span class="add_button badge badge-success" type="button" title="Добавить" style="height: 20px; margin-top: 53px; margin-left: -20px;">&#43;</span>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	
	<tr id="course_work_and_project">
		<td>Содержание тем для курсовых работ</td>
		<td>
			<table>
				<tr class="multiselection">
					<td>
						<select class="selection_for_add form-control form-control-sm" id="input_course_work" multiple style="height: 7rem; margin-left: -10px; margin-top: -10px;"></select>
						<div class="input-group">
							<input class="element_for_add form-control form-control-sm" type="text" data-toggle="popover" data-placement="left" data-content="Нужно заполнить!" style="margin-left: -10px; margin-right: 10px;">
						</div>
					</td>
					<td width="1%">
						<span class="del_button badge badge-danger" type="button" title="Удалить" style="height: 20px; margin-top: 35px; margin-left: -20px;"> &minus;</span>
						<span class="add_button badge badge-success" type="button" title="Добавить" style="height: 20px; margin-top: 53px; margin-left: -20px;">&#43;</span>
					</td>
				</tr>
			</table>
		</td>
		<td>Содержание тем для курсовых проектов</td>
		<td>
			<table>
				<tr class="multiselection">
					<td>
						<select class="selection_for_add form-control form-control-sm" id="input_course_project" multiple style="height: 7rem; margin-left: -10px; margin-top: -10px;"></select>
						<div class="input-group">
							<input class="element_for_add form-control form-control-sm" type="text" data-toggle="popover" data-placement="left" data-content="Нужно заполнить!" style="margin-left: -10px; margin-right: 10px;">
						</div>
					</td>
					<td width="1%">
						<span class="del_button badge badge-danger" type="button" title="Удалить" style="height: 20px; margin-top: 35px; margin-left: -20px;"> &minus;</span>
						<span class="add_button badge badge-success" type="button" title="Добавить" style="height: 20px; margin-top: 53px; margin-left: -20px;">&#43;</span>
					</td>
				</tr>
			</table>
		</td>
	</tr>

</table>

<div class="alert alert-danger alert-dismissible" id="msg_errors" role="alert" hidden>
  <strong>Ошибка!&nbsp;</strong><text id="errors"></text>
</div>

<hr>
<div class="row" id="basic_buttons">
	<div class="col"></div>
	<div class="col" align="right" hidden>
		<input class="btn btn-primary btn-block" type="submit" value="Сохранить">
	</div>
	<div class="col" align="center">
		<input class="btn btn-success btn-block" type="button" id="alert_form_save_rup" value="Создать">
	</div>
	<div class="col" align="left">
		<a class="btn btn-warning btn-block" href="/">Остановить работу</a>
	</div>
	<div class="col"></div>
</div>
<?php 
	require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/create_fgos.php");		
	require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/rup.php");		
?>

<script>
$(document).ready(function() {
	
	$("#input_pulpit").change(function() {	
		$("#input_discipline").empty();
		$("#info_part").text('Дисциплина не определена');
		var pulpit_value = $("#input_pulpit").val();
		if ((pulpit_value == null) && (pulpit_value == '')){
			$("#input_discipline").empty();
			$('#input_discipline').prop('disabled', true);
		} else {
			$('#input_discipline').prop('disabled', false);
			$.post(
				"/back/switch_functions.php", 
				{functionname: 'get_discipline_list', param: pulpit_value}, 
				function(info){$('#input_discipline').html(info);}
			);
		}
		$.post(
			"/back/switch_functions.php", 
			{functionname: 'get_institute', param: pulpit_value}, 
			function(info){$('#info_institute').text(info);}
		);
	});
	
	$("#input_discipline").change(function() {	
		var discipline_value = $("#input_discipline").val();
		$.post(
			"/back/switch_functions.php", 
			{functionname: 'get_part', param: discipline_value}, 
			function(info){$('#info_part').text(info+' части');}
		);
	});
		
	$("#input_course").change(function() {	
		$("#input_profile").empty();
		var course_value = $("#input_course").val();
		if ((course_value === null) && (course_value === '')){
			$("#input_profile").empty();
			$('#input_profile').prop('disabled', true);
			$('#info_fgos').text('Направление не определено');
			$('#input_prof_stad').prop('disabled', true);
			$('#div_create_info_fgos').prop('hidden',true);
		} else {
			$('#input_profile').prop('disabled', false);	
			$.post(
				"/back/switch_functions.php", 
				{functionname: 'get_profile_list', param: course_value}, 
				function(info){$('#input_profile').html(info);}
			);
			$.post(
				"/back/switch_functions.php", 
				{functionname: 'get_fgos_id', param: course_value}, 
				function(info){
					if ((info !== null) && (info !== '')){
						$('#info_fgos_id').text(info);
						$('#input_tf').empty();
						$('#input_tf').prop('disabled', false);
						$('#tf_for_add').empty();
						$('#tf_for_add').prop('disabled', false);
						get_list_options('get_prof_stand_list',info,'#input_prof_stad');
						get_list_options('get_otf_list_by_group',info,'#input_otf');
						get_list_options('get_tf_list',info,'#tf_for_add');
					} else {
						$("#input_prof_stad").empty();
						$('#input_prof_stad').prop('disabled', true);
						$("#input_otf").empty();
						//$('#input_otf').html('<option style="display" disabled>Проффесинальный стандарт не определен</option>');
						$('#input_otf').prop('disabled', true);
						$("#tf_for_add").empty();
						$('#tf_for_add').html('<option selected style="display" disabled>ОТФ не определены</option>');
						$('#tf_for_add').prop('disabled', true);
						$("#input_tf").empty();
						//$('#input_tf').html('<option style="display" disabled>ОТФ не определены</option>');;
						$('#input_tf').prop('disabled', true);
					}
				}
			);
			$.post(
				"/back/switch_functions.php", 
				{functionname: 'get_fgos_info', param: course_value}, 
				function(info){
					if (info === ''){
						$('#info_fgos').text('ФГОС не найден');
						$('#div_create_info_fgos').prop('hidden',false);
					} else{
						$('#div_create_info_fgos').prop('hidden',true);
						$('#info_fgos').text(info);
					}
				}
			);
		};
	});
	
	$("#create_info_fgos").click(function(){
		var course_value = $("#input_course").val();
		if ((course_value !== '') && (course_value !== null)){
			$('#get_course').prop('hidden',false);
			var course_value = $("#input_course").val();
			$.post(
				"/back/switch_functions.php", 
				{functionname: 'get_course_list', param: course_value}, 
				function(info){$('#get_course').prop('value', info);}
			);
			$('#course_id').text(course_value);
		} else { 
			$('#get_course').prop('value', 'Направление не определено');
		}
		$('#create_fgos_form').modal('show');
	});
	
	$("#t_functions").on('click', '.add_tf', (function(){
		var element = $("#tf_for_add").val();
		if ((element !== '') && (element !== null)){
			var element_text = $("#tf_for_add option:selected").text();
			$("#input_tf").append("<option value="+element+">"+element_text+"</option>");
			$("#tf_for_add").val('');
		} else {
			$('#tf_for_add').addClass('error-pointer');
			$('#tf_for_add').popover('show');
		}
	}));
	 
	$(".multiselection").on('click', '.add_button', (function(){
		var element = $(this).parent().parent().find('.element_for_add').val();
		if ((element != '') && (element != null)){
			var check = $(this).parent().parent().find(".selection_for_add").length;
			if (check == 0){
				var ident = 1;
			} else {
				var counter = $(this).parent().parent().find(".selection_for_add option:last").val();
				var ident = (counter * 1) + 1;
			}
			$(this).parent().parent().find(".selection_for_add").append("<option id='"+ident+"'>"+element+"</option>");
			$(this).parent().parent().find(".element_for_add").val('');
		} else {
			$(this).parent().parent().find('.element_for_add').addClass('error-pointer');
			$(this).parent().parent().find('.element_for_add').popover('show');
		}
	}));
			
	$(".multiselection").on('click', '.del_button', (function(){
		$(this).parent().parent().find(".selection_for_add option:selected").remove();
	}));

	$(".element_for_add").mouseenter (function(){
		$('.element_for_add').removeClass('error-pointer');
		$('.element_for_add').popover('hide');
	});
	
	$(".tf_for_add").mouseenter (function(){
		$('.tf_for_add').removeClass('error-pointer');
		$('.tf_for_add').popover('hide');
	});
	
	$("#alert_form_save_rup").click(function(){
		$("#errors").empty();
		var errors = '';
		
		var course_value = $("#input_course").val();
		if ((course_value === null) || (course_value === '')){ errors += ("Направление не указано. "); };
		
		var profile_value = $("#input_profile").val();
		if ((profile_value === null) || (profile_value === '')){ errors += ("Профиль не указан. "); };
		
		var fgos_value = $("#info_fgos_id").text();
		if ((fgos_value === null) || (fgos_value === '')){ errors += ("ФГОС не указан. "); };
		
		var prof_stad_value = $("#input_prof_stad option").length;
		if (prof_stad_value === 0){
			errors += ("Проффесинальный стандарт не указан. "); 
		}else {
			$("#input_prof_stad").children().prop('selected',true);
		};
		
		var otf_value = $("#input_otf option").length;
		if (otf_value === 0){
			errors += ("ОТФ не указаны. "); 
		} else {
			$("#input_otf").find("option").prop('selected',true);
		};
		
		var tf_value = $("#input_tf option").length;
		if (tf_value === 0){
			errors += ("ТФ не указаны. ");
		} else {
			$("#input_tf").children().prop('selected',true);
		};
		
		var pulpit_value = $("#input_pulpit").val();
		if ((pulpit_value === null) || (pulpit_value === '')){ errors += ("Кафедра не указана. "); };
		
		var discipline_value = $("#input_discipline").val();
		if ((discipline_value === null) || (discipline_value === '')){ errors += ("Дисциплина не указана. "); };
		
		var goal_value = $("#input_goal").val();
		if ((goal_value === null) || (goal_value === '')){ errors += ("Цель не указана. ");  };
		
		var mission_value = $("#input_mission option").length;
		if (mission_value === 0){ 
			errors += ("Задачи не указаны. "); 
		} else {
			$("#input_mission").children().prop('selected',true);
		};
		
		var lecture_value = $("#input_lecture option").length;
		if (lecture_value === 0){
			errors += ("Содержание дисциплины не указано. "); 
		} else {
			$("#input_lecture").children().prop('selected',true);
		};
		
		var practical_value = $("#input_practical option").length;
		if (practical_value === 0){
			errors += ("Содержание практических занятий не указано. ");
		} else {
			$("#input_practical").children().prop('selected',true);
		};
		
		var laboratory_value = $("#input_laboratory option").length;
		if (laboratory_value === 0){
			errors += ("Содержание лабораторных работ не указано. "); 
		} else {
			$("#input_laboratory").children().prop('selected',true);
		};
		
		var individual_value = $("#input_individual option").length;
		if (individual_value === 0){
			errors += ("Содержание заданий для самостоятельной работ не указано. ");
		} else {
			$("#input_individual").children().prop('selected',true);
		};
		
		var course_work_value = $("#input_course_work option").length;
		if (course_work_value === 0){
			errors += ("Содержание тем для курсовых работ не указано. ");
		} else {
			$("#input_course_work").children().prop('selected',true);
		};
		
		var course_project_value = $("#input_course_project option").length;
		if (course_project_value === 0){
			errors += ("Содержание тем для курсовых проектов не указано. ");
		} else {
			$("#input_course_project").children().prop('selected',true);
		};
		
		if (errors !== '') {
			$("#errors").append(errors);
			$('#msg_errors').prop('hidden', false);
		} else {
			$('#msg_errors').prop('hidden', true);
			$('#create_rup').modal('show');
		}
	});
	
	function get_list_options(fun_name, input_param, element_id) {
		$.post(
			"/back/switch_functions.php", 
			{functionname: fun_name, param: input_param}, 
			function(info){
				if ((info !== null) && (info !== '')){
					$(''+element_id+'').html(info);
				}
			 }
		);
	}
	
});
</script>