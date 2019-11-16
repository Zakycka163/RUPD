<nav class="navbar bg-light">
	<ul class="nav nav-pills">
        <li class="nav-item">
			<a class="nav-link active" href="/index.php">Главная</a>
		</li>
        <?php 
			require_once ($_SERVER['DOCUMENT_ROOT']."../back/base.php");
		
			if(!empty($_SESSION["id"])){
			connect();
			$id=$_SESSION["id"];
			$admin = mysqli_query($link, "SELECT grant_id FROM accounts WHERE account_id='".$id."'");
			$admin=implode(mysqli_fetch_assoc($admin));
			close();
			
			if($admin=="2"){
				require_once ($_SERVER['DOCUMENT_ROOT']."../front/navigation/navBarAdm.php");
			}
			if($admin=="1"){
				require_once ($_SERVER['DOCUMENT_ROOT']."../front/navigation/navBarTeach.php");
			}
		} else {
			if($_SERVER['REQUEST_URI']<>"/index.php"){
				if($_SERVER['REQUEST_URI']<>"/pages/about.php"){
					header("Location: ../index.php");
				}
			}
		}
		?>      
		<li class="nav-item">
			<a class="nav-link text-dark" href="/pages/about.php">О системе</a>
		</li>
	</ul>
	<?php 		
		if(!empty($_SESSION["id"])){
			require_once ($_SERVER['DOCUMENT_ROOT']."../front/navigation/buttons/exit.php");
		} else {
			require_once ($_SERVER['DOCUMENT_ROOT']."../front/navigation/buttons/sign_in.php");
		}
	?>
</nav>

