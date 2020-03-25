<nav class="navbar bg-light">
	<ul class="nav nav-pills">
        <li class="nav-item" style="higth: 1rem">
			<a class="nav-link active" href="/">Главная</a>
		</li>
        <?php 
			require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");
		
			if(!empty($_SESSION["id"])){
				connect();
				$id=$_SESSION["id"];
				$admin = mysqli_query($link, "SELECT grant_id FROM accounts WHERE account_id='".$id."'");
				$admin=implode(mysqli_fetch_assoc($admin));
				close();
				
				if($admin=="2"){
					require_once ($_SERVER['DOCUMENT_ROOT']."/front/navBars/navBarAdm.php");
				}
				if($admin=="1"){
					require_once ($_SERVER['DOCUMENT_ROOT']."/front/navBars/navBarTeach.php");
				}
			}
		?>      
		<li class="nav-item">
			<button class="btn btn-light" type="button" onclick="window.location.href='/pages/about.php'">О системе</button>
		</li>
	</ul>
	<?php 		
		if(!empty($_SESSION["id"])){
			connect();
			$id=$_SESSION["id"];
			$first_name = mysqli_query($link, "SELECT name.first_name FROM accounts as acc, teachers as name WHERE acc.account_id='".$id."' and acc.teacher_id=name.teacher_id");
			$second_name = mysqli_query($link, "SELECT name.second_name FROM accounts as acc, teachers as name WHERE acc.account_id='".$id."' and acc.teacher_id=name.teacher_id");
			$first=implode(mysqli_fetch_assoc($first_name));
			$second=implode(mysqli_fetch_assoc($second_name));
			close();
	?>	
			<form class="form-inline">
				<a href="/pages/control/users.php?id=<?php echo($id);?>" title="Личный кабинет">
					<?php print("".$first." ".$second."". "\n")?>
				</a>
				<p class="text-light">....</p>
				<input class="btn btn-danger btn-mg" onclick="location.href='/pages/sign_in.php'" type="button" value="Выход">
			</form>
	<?php } else { ?>
			<form class="form-inline">
    			<input class="btn btn-success btn-mg" onclick="location.href='/pages/sign_in.php'" type="button" value="Войти">
			</form>
	<?php } ?>
</nav>

