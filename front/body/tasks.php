<?php  
    if(!empty($_SESSION["id"])){
        connect();
        $id=$_SESSION["id"];
        $admin = mysqli_query($link, "SELECT grant_id FROM accounts WHERE account_id='".$id."'");
        $admin=implode(mysqli_fetch_assoc($admin));
        close();
		
?>
	<div class="px-4 py-3" id="personal_task">		
		<table class="table table-borderless">
			<tr>
				<td>
					<div class="card">
					<div class="card-header"><h5>Мои задачи</h5></div>
					<div class="card-body">
						<p class="card-text">Тут будут личные задачи.</p>
					</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
			
<?php if($admin=="2") : ?>
    <div class="px-4 py-3" id="table_admin">		
		<table class="table table-borderless">        
			<tr>
				<td>
					<div class="card">
						<div class="card-header"><h5>Все задачи</h5></div>
						<div class="card-body">
							<a class="btn btn-success btn-sm" href="/pages/404.php">Создать</a>
							<br><br>
							<p class="card-text">Тут будет список задач.</p>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
<?php endif; ?>
		
	
<?php } ?>