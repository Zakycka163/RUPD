<div class="px-4 py-2 bg-primary font-weight-bold text-white container-fluid">
    <div class="row">
        <a class="btn btn-warning btn-sm back" href="/pages/data.php"
            title="Назад" data-toggle="tooltip" data-placement="right">&#8592; Назад</a>
        <div class="h4" id="page_title" style="margin-left: 35%">Дисциплины</div>
    </div>
</div>
<div class="px-4 py-3 bg-light" style="margin-bottom: 4rem;">
    <div class="alert alert-secondary col" style="height: 55px">
        <input class="btn btn-success btn-sm" type="button" id="create_discipline" value="Новая дисциплина">
    </div>
    <table class="table table-bordered table-sm">
        <thead>
            <tr style="text-align:center">
                <th scope="col" style="width: 2rem">№</th>
                <th scope="col">Название дисциплины</th>
                <th scope="col">Кафедра</th>
                <th scope="col">Индекс</th>
                <th scope="col">Модуль</th>
                <th scope="col">Образовательная часть</th>
                <th scope="col">Нагрузка, ч</th>
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
<?php 
	require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/pulpit.php");
	require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/discipline.php");
?>
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
		url: "/api/view_disciplines?round="+data.round, 
		type: "GET",
		success: function(response){
			data.total = response.total;
			data.limit = response.limit;
            data.start = response.start;
			data.disciplines = response.view_disciplines;
			for (var [key, discipline] of Object.entries(data.disciplines)) {
				table_body += `<tr>
								<td>`+((key*1)+data.start)+`</td>
								<td><a href="?page=disciplines&disid=`+discipline.id+`">`+discipline.name+`</td>
								<td><a href="?page=disciplines&kafid=`+discipline.kaf_id+`">`+discipline.kaf+`</td>
								<td>`+discipline.index_info+`</td>
								<td>`+discipline.module+`</td>
								<td>`+discipline.part+`</td>
								<td>`+discipline.time+`</td>
							  </tr>`;
			}
			$("#data").html(table_body);

			gen_pagination(data.total, data.limit, data.round);
		}		
	});
    $(".close_form").click(function() {
        location.href = 'data.php?page=disciplines';
    });
    $("#create_discipline").click(function() {
        $('#discipline_form').modal('show');;
    });

    if ($_GET('kafid')) {
        $('#delete_pulpit').prop('hidden', true);
        $('#add_parent_inst_name').prop('hidden', true);
        $('#save_pulpit').prop('hidden', true);
        $('#pul_name').prop('readonly', true);
        $('#pul_description').prop('readonly', true);

        $('#pulpit_form').modal('show');
        $('#pulpit_form_title').text('Кафедра:');
        let pul_id = $_GET('kafid');
        $.post(
            "/back/data/db_pulpits.php", {
                functionname: 'get_pulpit',
                id: pul_id
            },
            function(info) {
                var pul = $.parseJSON(info);
                $('#pulpit_form_title').after(pul.name);
                $('#inst_val option:selected').prop('selected', false);
                $('#inst_val').val(pul.institute_id).prop('selected', true);
                $('#pul_name').val(pul.name);
                $('#pul_description').text(pul.description);

                $("#add_parent_inst_name_form").find("#inst_val option:selected").text()
                var inst_text = $("#inst_val :selected").text();
                $("#parent_inst_name").val(inst_text);
                $("#parent_inst_name").prop('title', inst_text);
                $("#add_parent_inst_name").removeClass('btn-outline-success');
                $("#add_parent_inst_name").addClass('btn-outline-primary');
                $("#add_parent_inst_name").text('Изменить');
            }
        );
    }
}); 
</script>