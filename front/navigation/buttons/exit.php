<?php 
    connect();
    $id=$_SESSION["id"];
    $first_name = mysqli_query($link, "SELECT name.first_name FROM accounts as acc, teachers as name WHERE acc.account_id='".$id."' and acc.teacher_id=name.teacher_id");
    $second_name = mysqli_query($link, "SELECT name.second_name FROM accounts as acc, teachers as name WHERE acc.account_id='".$id."' and acc.teacher_id=name.teacher_id");
    $first=implode(mysqli_fetch_assoc($first_name));
    $second=implode(mysqli_fetch_assoc($second_name));
    close();
?>

<form class="form-inline">
	<a href="../pages/users.php?id=<?php echo($id);?>" title="Личный кабинет">
		<?php print("".$first." ".$second."". "\n")?>
	</a>
	<p class="text-light">....</p>
    <input class="btn btn-danger btn-mg" onclick="location.href='../pages/sign_in.php'" type="button" value="Выход">
</form>
