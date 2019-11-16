<div class="modal fade" id="create_rup" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Создание: Рабочая учебная программа</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-borderless">
					<tr>
						<td class="align-middle">Название документа</td>
						<td>
							<input class="form-control" type="text" id="rup_name">
						</td>
					</tr>
				</table>
				<div class="alert alert-danger" role="alert" id="error_param" hidden>
                    Все поля должны быть заполнены! 
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="save_rup">Подтвердить</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="complete_cretion" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Успешно!</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="success">
				Ваш документ сохранен.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>
<script>
	$("#save_rup").click(function(){
		$('#error_param').prop('hidden',true);
		$('#success').empty();
		var course_value = $("#input_course option:selected").val(),
			profile_value = $("#input_profile option:selected").val(),
			fgos_value = $("#info_fgos_id").text(),
			prof_stad_value = $("#input_prof_stad").val(),
			input_otf_value = $("#input_otf").val(),
			input_tf_value = $("#input_tf").val(),
			pulpit_value = $("#input_pulpit option:selected").val(),
			discipline_value = $("#input_discipline").val(),
			goal_value = $("#input_goal").val(),
			mission_value = $("#input_mission").val(),
			lecture_value = $("#input_lecture").val(),
			practical_value = $("#input_practical").val(),
			laboratory_value = $("#input_laboratory").val(),
			individual_value = $("#input_individual").val(),
			course_work_value = $("#input_course_work").val(),
			course_project_value = $("#input_course_project").val(),
			current_date = new Date(),
			current_year = current_date.getFullYear(),
			document_name = $("#rup_name").val(),
			document_name_on_server = course_value + profile_value + discipline_value +'_'+ current_date.getDate() +'-'+ current_date.getMonth() +'-'+ current_year +'-'+ current_date.getHours() +'-'+ current_date.getMinutes();

		if ((document_name !== '') && (document_name !== null)){
			$.post(
				"../back/phpWordUse.php", 
				{functionname: 'fill_parameters', pulpit: pulpit_value
												, discipline: discipline_value
												, course: course_value
												, profile: profile_value
												, fgos: fgos_value
												, prof_stad: prof_stad_value
												, otf: input_otf_value
												, tf_list: input_tf_value
												, goal: goal_value
												, mission: mission_value
												, lecture: lecture_value
												, practical: practical_value
												, laboratory: laboratory_value
												, individual: individual_value
												, course_work: course_work_value
												, course_project: course_project_value
												, doc_name: document_name_on_server
												, year: current_year
				}, 
				function(info){ 
					if ($.trim(info) == 'Сохранено') {
						$('#create_rup').modal('hide');
						$('#complete_cretion').modal('show');
						$('#success').append('Ваш документ сохранен на сервер как '+document_name_on_server+'.docx');
						var link = document.createElement('a');
						link.setAttribute('href','../Documents/'+document_name_on_server+'.docx');
						link.setAttribute('download',''+document_name+'.docx');
						onload=link.click();

					} else {
						alert (info);
					}
				}
			);
		} else {
			$('#error_param').prop('hidden',false);
		}
		/* var get_course_id = $("#course_id").text();
		if (get_course_id === ''){
			var get_course_id = $("#empty_course").val();
		};
		
		if (get_course_id !== ''){
			
			if($("#input_date").val() !== ''){
				var fgos_date = $("#input_date").val();
				
				if($("#input_number").val() !== ''){
					var fgos_number = $("#input_number").val();
					$.post(
						"../back/switch_functions.php", 
						{functionname: 'create_fgos', course: get_course_id , date: fgos_date, number: fgos_number}, 
						function(){}
					);
					
					$('#create_fgos').modal('hide');
					
					var course_value = $("#input_course").val();
					$.post(
						"../back/switch_functions.php", 
						{functionname: 'get_fgos_id', param: course_value}, 
						function(info){$('#info_fgos_id').text(info); });
					$.post(
						"../back/switch_functions.php", 
						{functionname: 'get_fgos_info', param: course_value}, 
						function(info){
								$('#div_create_info_fgos').prop('hidden',true);
								$('#info_fgos').text(info);
						}
					);
				} else { $('#error_params').prop('hidden',false); };
			} else { $('#error_params').prop('hidden',false); };
		} else { $('#error_params').prop('hidden',false); }; */
	});
	
	$("#rup_name").mouseenter (function(){
		$('#error_param').prop('hidden',true);
	});
</script>

<!-- $("#create_info_fgos").click(function(){
			$('#get_course').prop('hidden',true);
			$('#empty_course').prop('hidden',true);
			var course_value = $("#input_course").val();
			if (course_value !== ''){
				$('#empty_course').prop('hidden',false);
				$('#get_course').prop('hidden',true);
				$("#get_course").empty();
				$.post(
					"../back/switch_functions.php", 
					{functionname: 'get_course_list'}, 
					function(info){$('#empty_course').html(info);}
				);
			} else {
				$('#empty_course').prop('hidden',true);
				$("#empty_course").empty();
				$('#get_course').prop('hidden',false);
				var course_value = $("#input_course").val();
				$.post(
					"../back/switch_functions.php", 
					{functionname: 'get_course_list', param: course_value}, 
					function(info){$('#get_course').prop('value', info);}
				);
			}
			$('#myModal').show();
		}); -->