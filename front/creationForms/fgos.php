<div class="modal fade" id="create_fgos" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Создание: Данные ФГОС</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-borderless">
					<tr>
						<td class="align-middle">Направление</td>
						<td width="75%">
							<input class="form-control-plaintext" id="get_course" readonly hidden><div id="course_id" hidden></div>
							<select class="form-control" id="empty_course" required hidden>
								<option selected style='display' disabled>Выбрать направление</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="align-middle">Дата утверждения</td>
						<td>
							<input class="form-control" type="date" id="input_date" min="2008-01-01" max="2025-12-31" required>
						</td>
					</tr>
					<tr>
						<td class="align-middle">Номер приказа</td>
						<td>
							<input class="form-control" type="number" id="input_number" max="99999" required>
						</td>
					</tr>
				</table>
				<div class="alert alert-danger" role="alert" id="error_params" hidden>
                    Все поля должны быть заполнены! 
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="save_fgos">Сохранить</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>
<script>
	$("#save_fgos").click(function(){
		$('#error_params').prop('hidden',true);
		var get_course_id = $("#course_id").text();
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
						function(info){
							$('#info_fgos_id').text(info); 
							$.post(
								"../back/switch_functions.php", 
								{functionname: 'get_prof_stand', param: info}, 
								function(info1){
									if (info1 !== null){
										$('#input_prof_stad').html(info1);
										$('#input_prof_stad').prop('disabled', false);
									}
								}
							);
						}
					);
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
		} else { $('#error_params').prop('hidden',false); };
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