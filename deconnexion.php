<?php
	session_start();
	session_unset();
	session_destroy();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Deconnexion</title>
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="css/header_footer.css">
		<link rel="stylesheet" href="css/style_simple.css">
		<link rel="stylesheet" media="(max-width:640px)" href="css/mobile.css">
	</head>
	<body>
		<header>
			<?php include('header.inc.php'); ?>
		</header>
		<div id="cadre">
			<div>Vous avez été deconnecté avec succès</div>
			<div><a href="index.php">Retour vers l'accueil</a></div>
		</div>
		<footer>
			<?php include('footer.inc.php'); ?>
		</footer>
	</body>
</html>