<div class="btn-group">
	<button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Работа с документами
	</button>
	<div class="dropdown-menu">
        <a class="btn dropdown-item btn-sm" href="/pages/doc/rup.php">Создать РУП</a>
		<a class="btn dropdown-item btn-sm" href="/pages/doc/rups.php">Список РУП</a>
	</div>
</div>
<a class="btn btn-light btn-sm" href="/pages/control/users.php?id=<?php echo($id);?>" title="<?php print(''.$first.' '.$second.'')?>">
	Мой аккаунт
</a>
<a class="btn btn-sm btn-light" type="button" href="/pages/about.php">О системе</a>