<div class="px-4 py-2 bg-primary font-weight-bold text-white container-fluid">
    <div class="row">
        <a class="btn btn-warning back" href="/pages/data.php"
            style="margin-left: 1rem" title="Назад" data-toggle="tooltip"
            data-placement="right">&#8592; Назад</a>
        <div class="h4" id="page_title" style="margin-left: 35%">Дисциплины</div>
    </div>
</div>
<div class="px-4 py-3 bg-light">
    <div class="alert alert-secondary col" style="height: 55px">
        <input class="btn btn-success btn-sm" type="button" id="create_discipline" value="Новая дисциплина">
    </div>
    <table class="table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th scope="col" style="width: 2rem">№</th>
                <th scope="col">Название дисциплины</th>
                <th scope="col">Кафедра</th>
                <th scope="col">Индекс</th>
                <th scope="col">Модуль</th>
                <th scope="col">Образовательная часть</th>
                <th scope="col">Нагрузка, ч</th>
            </tr>
        </thead>
        <tbody>
            <?php
				connect();
				global $link;
				$sql = "SELECT `value` FROM `constants` WHERE `key` = 'limitObj'";
				$result = mysqli_query($link, $sql);
				$limit = mysqli_fetch_array($result);
				$counter = 0;
				$sql_count = "SELECT count(*) FROM view_disciplines";
				$sql_count_result = mysqli_query($link, $sql_count);
				$count_obj = mysqli_fetch_array($sql_count_result);
				$sql = "SELECT    pulpit_id
								, kaf
								, discipline_id
								, `name`
								, index_info
								, module
								, part
								, `time`
						FROM  view_disciplines
						LIMIT ".$limit[0]."";
				$result = mysqli_query($link, $sql);
				while($row = mysqli_fetch_array($result)){
					$counter++;
					echo '<tr>'."\n".'<td>'.$counter.'</td>'."\n";
					echo '<td><a href="?page=disciplines&disid='.$row[2].'">'.$row[3].'</a></td>'. "\n";
					echo '<td><a href="?page=disciplines&kafid='.$row[0].'">'.$row[1].'</a><br>'."\n";
					echo '<td>'.$row[4].'</td>'."\n";
					echo '<td>'.$row[5].'</td>'."\n";
					echo '<td>'.$row[6].'</td>'."\n";
					echo '<td>'.$row[7].'</td>'."\n";
					echo '</tr>'."\n";
				};
				close();
			?>
        </tbody>
    </table>
    <nav>
        <ul class="pagination pagination-sm">
            <?php if ($count_obj < $limit){
				
			} else {
			?>
            <li class="page-item disabled">
                <a class="page-link" href="#">Предыдущая</a>
            </li>
            <li class="page-item active">
                <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item disabled">
                <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item disabled">
                <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item disabled">
                <a class="page-link" href="#">Следующая</a>
            </li>
            <?php } ?>
        </ul>
    </nav>
</div>
<?php 
	require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/pulpit.php");
	require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/discipline.php");
?>
<script>
$(".close_form").click(function() {
    location.href = 'data.php?page=disciplines';
});
$("#create_discipline").click(function() {
    $('#discipline_form').modal('show');;
});
create_discipline

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
</script>