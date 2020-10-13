<div class="px-4 py-2 bg-primary font-weight-bold text-white container-fluid">
	<div class="row">
		<div class="h4" id="page_title" style="margin-left: 40%">Аккаунты</div>
	</div>
</div>
<div class="px-4 py-3 bg-light">
	<div class="alert alert-secondary col" style="height: 55px">
		<input class="btn btn-success btn-sm" id="create_account" type="button" value="Новый аккаунт">
	</div>
	<table class="table table-bordered table-striped table-sm">
		<thead>
			<tr>
				<th scope="col" style="width: 2rem">№</th>
				<th scope="col">Логин</th>
				<th scope="col">Пароль</th>
				<th scope="col">Админ</th>
				<th scope="col">Фамилия</th>
				<th scope="col">Имя</th>
				<th scope="col">Отчество</th>
			</tr>
		</thead>
		<tbody id="accounts">
			<tr>
				<td colspan="7" style="text-align:center">Пустой список</td>
			</tr>
		</tbody>
	</table>
	<nav>
		<ul class="pagination pagination-sm">
				<li class="page-item disabled" id="next_round">
					<a class="page-link" href="#">Предыдущая</a>
				</li>
				<li class="page-item rounds">
					<a class="page-link" href="?round=1">1</a>
				</li>
				<li class="page-item disabled" id="prev_round">
					<a class="page-link" href="#">Следующая</a>
				</li>
		</ul>
	</nav>
</div>
<?php require_once ($_SERVER['DOCUMENT_ROOT']."/front/forms/create_account.php"); ?> 
<script src="/front/js/_GET.js"></script>
<script>
$(document).ready(function(){
	var total;
	var limit;
	var round;
	var cnt_page;
	if ($_GET("round") && Number.isInteger($_GET("round"))){
		round = $_GET("round");
	} else {
		round = 1;
	}
	var users = new Object();
	var table_body = '';
	$.ajax({
		url: "/api/view_users?round="+round, 
		type: "GET",
		success: function(response){
			total = response.total;
			limit = response.limit;
			round = response.round;
			users = response.view_users;
			for (const [key, user] of Object.entries(users)) {
				if (user.grant_id == 2){
						user.admin = "Да";
					} else {
						user.admin = "Нет";
					}
				table_body += `<tr>
								<td>`+((key*1)+1)+`</td>
								<td><a href="?id=`+user.id+`" title="Открыть аккаунт">`+user.login+`</td>
								<td>********</td>
								<td>`+user.admin+`</td>
								<td>`+user.second_name+`</td>
								<td>`+user.first_name+`</td>
								<td>`+user.middle_name+`</td>
							  </tr>`;
			}
			$("#accounts").html(table_body);

			cnt_round = Math.ceil(total / limit);
			if (cnt_round > 1){
				let round_list;
				for (var i = 0; i < cnt_round; i++) {
					round_list += `<li data-page=` + i * cnt + "  id=\"page" + (i + 1) + "\">" + (i + 1) + "</span>";
				}
				<li class="page-item">
						<a class="page-link" href="#">Предыдущая</a>
					</li>

				$(".rounds").html(round_list);
			}
		}		
	});
	
	if ($_GET('action')=="create"){
		$('#create_account_form').modal('show');
	};
	
	$("#create_account").click(function(){
		location.href='/pages/control/users.php?action=create';
	});
});	
</script>