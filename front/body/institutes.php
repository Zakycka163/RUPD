<form>
	<div class="px-4 py-3 bg-light">
		<div class="form-group">
			<h4 id="page_title">Институты и Кафедры</h3>
		</div>
		<div class="form-group">
			<input class="btn btn-success btn-sm" type="button" id="create_institute" value="Добавить институт">
			<input class="btn btn-success btn-sm" type="button" id="create_pulpit" value="Добавить кафедру">
		</div>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th scope="col" style="width: 2rem">№</th>
					<th scope="col">Институт</th>
					<th scope="col">Кафедры</th>
				</tr>
			</thead>
			<tbody>
				<?php
					connect();
					global $link;
					$sql = "select value from `constants` where `key` = 'limitObj'";
					$result = mysqli_query($link, $sql);
					$limit = mysqli_fetch_array($result);
					$counter = 0;
					$sql = "select    inst.institute_id
									, inst.name
							FROM  `institutes` inst
							LIMIT ".$limit[0]."";
					$result = mysqli_query($link, $sql);
					while($row = mysqli_fetch_array($result)){
						$counter++;
						echo '<tr>'. "\n" . '<td>'.$counter .'</td>'."\n";
						echo '<td> <a href="?page=institutes&id='.$row[0].'">'.$row[1].'</a></td>'. "\n";
						$sql2 = "select    kaf.pulpit_id
										, kaf.name
								FROM  `institutes` inst
									, `pulpits` kaf
								WHERE inst.institute_id = ".$row[0]."
									and  inst.institute_id = kaf.institute_id";
						$result2 = mysqli_query($link, $sql2);
						$counter2 = 0;
						echo '<td>'."\n";
						while($kaf = mysqli_fetch_array($result2)){
							$counter2++;
							echo ($counter2).'. <a href="?id='.$kaf[0].'">'.$kaf[1].'</a><br>'."\n";
						};	
						echo '</td>'."\n".'</tr>'. "\n";
					};
					close();
				?>
			</tbody>
		</table>
		<nav>
			<ul class="pagination pagination-sm">
				<?php if (isset($_GET["limit"])){
				
				} else {
					echo '
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
					</li>' . "\n"; 
				}
				?>
			</ul>
		</nav>	
	</div>
</form>	