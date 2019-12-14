<!-- Tab ico -->
<link rel="SHORTCUT ICON" href="/front/img/ico.jpg" type="image">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!-- uncompressed jQuery -->
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-- Custom CSS -->
<link href="/front/css/forSignOnIndex.css" rel="stylesheet" type="text/css">
<link href="/front/css/background2.css" rel="stylesheet" type="text/css">

<!-- Mandatory Blocks -->
<?php 
	require_once ($_SERVER['DOCUMENT_ROOT']."/back/security/validator.php");
	if($_SERVER['REQUEST_URI']<>"/pages/sign_in.php" and $_SERVER['REQUEST_URI']<>"/pages/sign_up.php"){
		require_once ($_SERVER['DOCUMENT_ROOT']."/back/detectors/navBar.php");
		require_once ($_SERVER['DOCUMENT_ROOT']."/front/footer.php");
	}	
?>
