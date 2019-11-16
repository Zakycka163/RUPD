<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>РУПД</title>

        <?php require_once ($_SERVER['DOCUMENT_ROOT']."../front/links.php"); ?>
        
    </head>
    <body>     
        <center>
			<div class="p-3 bg-primary font-weight-bold text-white"><h3>Рабочие учебные программы</h3></div>
		</center>
		<form>
			<div class="px-4 py-3 bg-light">
				<div class="form-group">
					<div class="btn-group btn-group-sm" role="group">
						<button type="button" class="btn btn-success">Добавить</button>
						<button type="button" class="btn btn-primary">Изменить</button>
						<button type="button" class="btn btn-danger">Удалить</button>
					</div>
				</div>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th scope="col" style="width: 2rem">№</th>
							<th scope="col">Имя</th>
							<th scope="col">Фамилия</th>
							<th scope="col">Username</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td scope="row">1</td>
							<td><a href="#">Mark</a></td>
							<td>Otto</td>
							<td>@mdo</td>
						</tr>
						<tr>
							<td scope="row">2</td>
							<td>Jacob</td>
							<td>Thornton</td>
							<td>@fat</td>
						</tr>
						<tr>
							<td scope="row">3</td>
							<td>Larry</td>
							<td>the Bird</td>
							<td>@twitter</td>
						</tr>
					</tbody>
				</table>
				<nav>
					<ul class="pagination pagination-sm">
						<li class="page-item disabled">
							<a class="page-link" href="#">Предыдущая</a>
						</li>
						<li class="page-item active">
							<a class="page-link" href="#">1</a>
						</li>
						<li class="page-item">
							<a class="page-link" href="#">2</a>
						</li>
						<li class="page-item">
							<a class="page-link" href="#">3</a>
						</li>
						<li class="page-item">
							<a class="page-link" href="#">Следующая</a>
						</li>
					</ul>
				</nav>	
			</div>
		</form>
    </body>
</html>