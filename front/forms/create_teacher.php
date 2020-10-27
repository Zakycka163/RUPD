<div class="modal fade" id="create_teacher_form" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Создание преподавателя</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body container">
				<div class="row justify-content-center">
					<label class="col-3">Фамилия<span style="color: red">*</span></label>
					<input type="text" id="second_name" maxlength="30" class="form-control form-control-sm col-8" data-toggle="popover" 
						data-placement="right" data-content="Нужно заполнить! Должно быть больше 2 символов!">
					<label class="col-3">Имя<span style="color: red">*</span></label>
					<input type="text" id="first_name" maxlength="30" class="form-control form-control-sm col-8" data-toggle="popover" 
						data-placement="right" data-content="Нужно заполнить! Должно быть больше 2 символов!">
					<label class="col-3">Отчество</label>
					<input type="text" id="middle_name" maxlength="30" class="form-control form-control-sm col-8" data-toggle="popover" 
						data-placement="right" data-content="Должно быть больше 2 символов!">
					<label class="col-3">Email</label>
					<input type="email" id="email" maxlength="50" class="form-control form-control-sm col-8" data-toggle="popover" 
						data-placement="right" data-content="Нужно заполнить! Email должен быть валидным!">
					<label class="col-3">Степень</label>
					<input type="text" id="deg_name" class="form-control form-control-sm col-5" value="Отсутствует" readonly>
					<button class="btn btn-outline-success btn-sm col-3" id="add_deg_name" type="button">Установить</button>
					<label class="col-3">Звание</label>
					<input type="text" id="ac_rank_name" class="form-control form-control-sm col-5" value="Отсутствует" readonly>
					<button class="btn btn-outline-success btn-sm col-3" id="add_ac_rank_name" type="button">Установить</button>
					<label class="col-3">Должность</label>
					<input type="text" id="position" class="form-control form-control-sm col-5" value="Отсутствует" readonly>
					<button class="btn btn-outline-success btn-sm col-3" id="add_position" type="button">Установить</button>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-primary" id="create_teach">Создать</button>
				<button type="button" class="btn btn-sm btn-secondary" id="close" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="add_deg_name_form" tabindex="-2" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">Аккадемическая степень</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<select class="form-control form-control-sm" id="deg_name_val">
					<script> 
						$.ajax({
							url: "/api/academic_degrees?filter=on&limit=off", 
							type: "GET",
							success: function(response){
								let option = '<option selected value="null">Отсутствует</option>';
								if (response.academic_degrees !== undefined) {
									response.academic_degrees.forEach(function(deg){
										option += `<option value="`+deg.id+`">`+deg.full_name+`</option>`;
									});
								}
								$("#deg_name_val").html(option);
							}
						});
					</script>
				</select>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-success" id="save_deg_name_button">Сохранить</button>
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="add_ac_rank_name_form" tabindex="-2" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">Аккадемическое звание</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<select class="form-control form-control-sm" id="ac_rank_name_val">
					<script> 
						$.ajax({
							url: "/api/academic_ranks?filter=on&limit=off", 
							type: "GET",
							success: function(response){
								let option = '<option selected value="null">Отсутствует</option>';
								if (response.academic_ranks !== undefined) {
									response.academic_ranks.forEach(function(rank){
										option += `<option value="`+rank.id+`">`+rank.full_name+`</option>`;
									});
								}
								$("#ac_rank_name_val").html(option);
							}
						});
					</script>
				</select>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-success" id="save_ac_rank_name_button">Сохранить</button>
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="add_position_form" tabindex="-2" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">Должность</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<select class="form-control form-control-sm" id="position_val">
					<script> 
						$.ajax({
							url: "/api/positions?filter=on&limit=off", 
							type: "GET",
							success: function(response){
								let option = '<option selected value="null">Отсутствует</option>';
								if (response.positions !== undefined) {
									response.positions.forEach(function(pos){
										option += `<option value="`+pos.id+`">`+pos.name+`</option>`;
									});
								}
								$("#position_val").html(option);
							}
						});
					</script>						
				</select>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-success" id="save_position_button">Сохранить</button>
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>

<script>
	$("#add_deg_name").click(function(){
		$("#add_deg_name_form").modal('show');
	});

	$("#add_ac_rank_name").click(function(){
		$("#add_ac_rank_name_form").modal('show');
	});

	$("#add_position").click(function(){
		$("#add_position_form").modal('show');
	});

	$("#save_deg_name_button").click(function(){
		var deg_name_val = $("#deg_name_val").val();
		var deg_name_text = $("#deg_name_val option:selected").text();
		$("#deg_name").val(deg_name_text);

		if (deg_name_val !== "null"){
			$("#add_deg_name").removeClass('btn-outline-success');
			$("#add_deg_name").addClass('btn-outline-primary');
			$("#add_deg_name").text('Изменить');
		} else {
			$("#add_deg_name").removeClass('btn-outline-primary');
			$("#add_deg_name").addClass('btn-outline-success');
			$("#add_deg_name").text('Установить');
		}
		$("#add_deg_name_form").modal('hide');
	});

	$("#save_ac_rank_name_button").click(function(){
		var ac_rank_name_val = $("#ac_rank_name_val").val();
		var ac_rank_name_text = $("#ac_rank_name_val option:selected").text();
		$("#ac_rank_name").val(ac_rank_name_text);

		if (ac_rank_name_val !== "null"){
			$("#add_ac_rank_name").removeClass('btn-outline-success');
			$("#add_ac_rank_name").addClass('btn-outline-primary');
			$("#add_ac_rank_name").text('Изменить');
		} else {
			$("#add_ac_rank_name").removeClass('btn-outline-primary');
			$("#add_ac_rank_name").addClass('btn-outline-success');
			$("#add_ac_rank_name").text('Установить');
		}
		$("#add_ac_rank_name_form").modal('hide');
	});

	$("#save_position_button").click(function(){
		var position_val = $("#position_val").val();
		var position_text = $("#position_val option:selected").text();
		$("#ac_rank_name").val(position_text);

		if (position_val !== "null"){
			$("#add_position").removeClass('btn-outline-success');
			$("#add_position").addClass('btn-outline-primary');
			$("#add_position").text('Изменить');
		} else {
			$("#add_position").removeClass('btn-outline-primary');
			$("#add_position").addClass('btn-outline-success');
			$("#add_position").text('Установить');
		}
		$("#add_position_form").modal('hide');
	});

	$("#create_teach").click(function(){
		let second_name = $("#second_name").val();
		let first_name = $("#first_name").val();
		let middle_name = $("#middle_name").val();
		let email = $("#email").val(); 
		let deg_id = $("#deg_name_val").val();
		let ac_rank_id = $("#ac_rank_name_val").val();
		let position_id = $("#position_val").val();
		let position_name = ''; //--------------------- TODO "create new position"

		if (second_name == '' || second_name.length < 2) {
			$("#second_name").addClass('error-pointer');
			$("#second_name").popover('show');
		} else if (first_name == '' || first_name.length < 2) {
			$("#first_name").addClass('error-pointer');
			$("#first_name").popover('show');
		} else if (middle_name !== '' && middle_name.length < 2) {
			$("#middle_name").addClass('error-pointer');
			$("#middle_name").popover('show');
		} else if (email == '' || !checkEmailMask(email)) {
			$("#email").addClass('error-pointer');
			$("#email").popover('show');
		} else {
			$.post(
			 	"/back/data/db_teacher.php", 
				{functionname: 'create_teacher', second_name: second_name
											   , first_name: first_name
											   , middle_name: middle_name
											   , email: email
											   , deg_id: deg_id
											   , ac_rank_id: ac_rank_id
											   , position_id: position_id
											   , position_name: position_name}, 
				function(info){
					if (info !== '1') {
						if (info == 'Предупреждение! Преподаватель с указанными ФИО уже существует!') {
							if (confirm(info)) {
								
								$.post(
									"/back/data/db_teacher.php", 
									{functionname: 'create_teacher', second_name: second_name
																   , first_name: first_name
																   , middle_name: middle_name
																   , email: email
																   , deg_id: deg_id
																   , ac_rank_id: ac_rank_id
																   , position_id: position_id
																   , position_name: position_name
																   , confirm: '1'}, 
									function(info){
										if (info !== '1') {
											alert(info);
										} else {
											$("#create_teacher_form").modal('hide');
											alert('Преподаватель создан');
											location.reload();
										}
									}
								);
							}
						} else {
							alert(info);
						}
					} else {
						$("#create_teacher_form").modal('hide');
						alert('Преподаватель создан');
						location.reload();
					}
				}
			);
		}
	});

	$("#close").click(function(){
		$('#create_techer_form').modal('hide');
	});

	$("#second_name").mouseenter (function(){
		$("#second_name").removeClass('error-pointer');
		$("#second_name").popover('hide');
	});

	$("#first_name").mouseenter (function(){
		$("#first_name").removeClass('error-pointer');
		$("#first_name").popover('hide');
	});

	$("#middle_name").mouseenter (function(){
		$("#middle_name").removeClass('error-pointer');
		$("#middle_name").popover('hide');
	});

	$("#email").mouseenter (function(){
		$("#email").removeClass('error-pointer');
		$("#email").popover('hide');
	});
</script>