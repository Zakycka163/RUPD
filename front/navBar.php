<nav class="navbar bg-light sticky-top d-none d-lg-flex">
	<ul class="nav nav-pills">
        <li class="nav-item">
			<a class="btn btn-primary active" href="/">Главная</a>
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
			<a class="btn btn-light" type="button" href="/pages/about.php">О системе</a>
		</li>
	</ul>
	<?php if(!empty($_SESSION["id"])){
			connect();
			$id=$_SESSION["id"];
			$first_name = mysqli_query($link, "SELECT name.first_name FROM accounts as acc, teachers as name WHERE acc.account_id='".$id."' and acc.teacher_id=name.teacher_id");
			$second_name = mysqli_query($link, "SELECT name.second_name FROM accounts as acc, teachers as name WHERE acc.account_id='".$id."' and acc.teacher_id=name.teacher_id");
			$first=implode(mysqli_fetch_assoc($first_name));
			$second=implode(mysqli_fetch_assoc($second_name));
			close();
	?>	
		<form class="form-inline">
			<a class="btn btn-light btn-link" href="/pages/control/users.php?id=<?php echo($id);?>" title="Мой аккаунт">
				<?php print("".$first." ".$second."". "\n")?>
			</a>
			<input class="btn btn-danger" onclick="location.href='/pages/sign_in.php'" type="button" value="Выход">
		</form>
	<?php } else { ?>
		<form class="form-inline">
    		<input class="btn btn-success" onclick="location.href='/pages/sign_in.php'" type="button" value="Войти">
		</form>
	<?php } ?>
</nav>

<nav class="navbar bg-light sticky-top d-none d-sm-flex d-lg-none">
	<ul class="nav nav-pills">
        <li class="nav-item">
			<a class="btn btn-primary btn-sm active" href="/">Главная</a>
		</li>
		<?php 
			if(!empty($_SESSION["id"])){
				if($admin=="2"){
					require_once ($_SERVER['DOCUMENT_ROOT']."/front/navBars/navBarAdmMd.php");
				}
				if($admin=="1"){
					require_once ($_SERVER['DOCUMENT_ROOT']."/front/navBars/navBarTeachMd.php");
				}
			} else { ?>
				<a class="btn btn-light btn-sm" type="button" href="/pages/about.php">О системе</a>
		<?php } ?>
	</ul>
	<?php if(!empty($_SESSION["id"])){ ?>	
		<form class="form-inline">
			<ul class="nav nav-pills"><li class="nav-item dropdown">
				<button class="btn btn-light btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<img src="/front/img/items.svg" height="25px">
				</button>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item btn btn-link btn-sm" href="/pages/control/users.php?id=<?php echo($id);?>" title="<?php print(''.$first.' '.$second.'')?>">
						Мой аккаунт
					</a>
					<?php if($admin=="2"){ ?>
						<a class="dropdown-item btn btn-sm d-md-none" href="/pages/control/users.php?action=create">Новый аккаунт</a>
						<a class="dropdown-item btn btn-sm d-md-none" href="/pages/control/users.php">Список аккаунтов</a>
					<?php } ?>
					<div class="dropdown-divider"></div>
					<a class="btn btn-sm dropdown-item" type="button" href="/pages/about.php">О системе</a>
				</div>
			</li></ul>
			<input class="btn btn-danger btn-sm" onclick="location.href='/pages/sign_in.php'" type="button" value="Выход">
		</form>
	<?php } else { ?>
		<form class="form-inline">
    		<input class="btn btn-success btn-sm" onclick="location.href='/pages/sign_in.php'" type="button" value="Войти">
		</form>
	<?php } ?>
</nav>

<div class="pos-f-t sticky-top d-sm-none">
	<nav class="navbar bg-light sticky-top">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
			<img src="/front/img/items.svg" height="20px">
		</button>
		<?php if(!empty($_SESSION["id"])){ ?>	
			<form class="form-inline">
				<input class="btn btn-danger btn-sm" onclick="location.href='/pages/sign_in.php'" type="button" value="Выход">
			</form>
		<?php } else { ?>
			<form class="form-inline">
				<input class="btn btn-success btn-sm" onclick="location.href='/pages/sign_in.php'" type="button" value="Войти">
			</form>
		<?php } ?>
	</nav>
	<div class="collapse" id="navbarToggleExternalContent">
		<div class="bg-light p-1">
			<a class="btn btn-primary btn-sm active" href="/">Главная</a>
			<?php 
				if(!empty($_SESSION["id"])){
					if($admin=="2"){
						require_once ($_SERVER['DOCUMENT_ROOT']."/front/navBars/navBarAdmSm.php");
					}
					if($admin=="1"){
						require_once ($_SERVER['DOCUMENT_ROOT']."/front/navBars/navBarTeachSm.php");
					}
				}
			?>
			<a class="btn btn-sm btn-light" type="button" href="/pages/about.php">О системе</a>
		</div>
  	</div>
</div>