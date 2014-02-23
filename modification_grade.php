<?php
	session_start();
	
	include "connexion_bdd.php";
	
	function modifier(){
		$requete = sprintf("UPDATE identifiant SET grade = '%s' WHERE id = '%s'",
							mysql_real_escape_string(htmlspecialchars($_POST['grade'])),
							mysql_real_escape_string(htmlspecialchars($_POST['id'])));
		connexion($requete);
	}
	function modification_possible(){
		if ($_SESSION['grade']==30){
			return true;
		}else if($_SESSION['grade'] == 20 && $_SESSION['grade'] >= $_POST['grade']){
			return true;
		}else {return false;
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="css/header_footer.css">
		<link rel="stylesheet" href="css/style_simple.css">
		<link rel="stylesheet" media="(max-width:640px)" href="css/mobile.css">
		<meta charset="utf-8">
		<title>Modification</title>
	</head>
	<body>
		<header>
			<?php
				include "header.inc.php";
			?>
		</header>
		<div id="cadre">
			<?php 
				if(!isset($_SESSION['login'])){
					echo "<div>Vous devez être connecté pour modifier les grades!</div>";
				}else if(!isset($_POST['grade'], $_POST['id'])){
					echo "<div> Le formulaire de modification n'a pas été correctement rempli, veuillez réessayer </div>";
				}else if(!modification_possible()){
					echo "<div> Vous n'avez pas le droit de modifier les grades!</div>";
				}else{
					modifier();
					echo "<div>La modification a été prise en compte</div>";
				}
			?>
			<a href="index.php"><span>Retour à l'accueil.</span></a>
		</div>
		<footer>
			<?php
				include "footer.inc.php";
			?>
		</footer>
	</body>
</html>