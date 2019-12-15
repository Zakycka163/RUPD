<?php  
    if(!empty($_SESSION["id"])){
        connect();
        $id=$_SESSION["id"];
        $admin = mysqli_query($link, "SELECT grant_id FROM accounts WHERE account_id='".$id."'");
        $admin=implode(mysqli_fetch_assoc($admin));
        close();
        
		print('<div class="px-4 py-3" id="table_task">		
				<table class="table table-borderless">
					<tr>
						<td>
							<div class="card">
							<div class="card-header"><h5>Мои задачи</h5></div>
							<div class="card-body">
								<p class="card-text">Тут будут задачи.</p>
							</div>
							</div>
						</td>
					</tr>');
			
        if($admin=="2"){
            print('<tr>
					<td>
						<div class="card" id="table_admin">
							<div class="card-header"><h5>Все задачи</h5></div>
							<div class="card-body">
								<a class="btn btn-success btn-sm" href="/pages/404.php">Создать</a>
								<br><br>
								<p class="card-text">Тут будут задачи.</p>
							</div>
						</div>
					</td>
				   </tr>');
        }
		
        print('	</table>
			</div>');
		
    } else {
		
    }
?>