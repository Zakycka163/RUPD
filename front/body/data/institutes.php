<div class="px-4 py-3 bg-light">
	<div class="form-group">
		<h4 id="page_title">Институты и Кафедры</h4>
	</div>
	<div class="form-group">
		<a class="btn btn-warning btn-sm" href="/pages/data.php">Назад</a>
		<a class="btn btn-success btn-sm" href="data.php?page=institutes&action=create_institute">Добавить институт</a>
		<a class="btn btn-success btn-sm" href="data.php?page=institutes&action=create_pulpit">Добавить кафедру</a>
	</div>
	<table class="table table-bordered table-striped table-sm">
		<thead>
			<tr>
				<th scope="col" style="width: 2rem">№</th>
				<th scope="col" style="width: 40%">Институт</th>
				<th scope="col">Кафедры</th>
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
				$sql_count = "select count(*) FROM institutes";
				$sql_count_result = mysqli_query($link, $sql_count);
				$count_obj = mysqli_fetch_array($sql_count_result);
				$sql = "SELECT    institute_id
								, `name`
						FROM  institutes
						ORDER BY institute_id
						LIMIT ".$limit[0]."";
				$result = mysqli_query($link, $sql);
				while($row = mysqli_fetch_array($result)){
					$counter++;
					echo '<tr>'. "\n" . '<td>'.$counter .'</td>'."\n";
					echo '<td><a href="?page=institutes&insid='.$row[0].'">'.$row[1].'</a></td>'. "\n";
					$sql2 = "SELECT   kaf.pulpit_id
									, kaf.name
							 FROM  `institutes` inst
								 , `pulpits` kaf
							 WHERE 	inst.institute_id = ".$row[0]."
								and inst.institute_id = kaf.institute_id";
					$result2 = mysqli_query($link, $sql2);
					$counter2 = 0;
					echo '<td>'."\n";
					while($kaf = mysqli_fetch_array($result2)){
						$counter2++;
						echo ($counter2).'. <a href="?page=institutes&kafid='.$kaf[0].'">'.$kaf[1].'</a><br>'."\n";
					};	
					echo '</td>'."\n".'</tr>'. "\n";
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
	require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/institute.php");
	require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/pulpit.php"); 
?> 
<script>
	function $_GET(key) {
		var s = window.location.search;
		s = s.match(new RegExp(key + '=([^&=]+)'));
		return s ? s[1] : false;
	}
	
	$(document).ready(function() {
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
	});
</script>