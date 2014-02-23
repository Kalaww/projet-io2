<?php
	session_start();
	
	$suppression_succes;
	
	include "connexion_bdd.php";
	
	if(isset($_SESSION['login']) && $_SESSION['grade'] > 0){
		supprimer();
	}
	
	//Supprime la réunion qui a pour id = $_POST['id']
	function supprimer(){
		global $suppression_succes;
		if(isset($_POST['id'])){
			$requete = sprintf("DELETE FROM projets WHERE id = '%s'",
								mysql_real_escape_string(htmlspecialchars($_POST['id'])));
			$suppression_succes = connexion($requete);
		}else{
			$suppression_succes = false;
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
		<title>Suppression du projet</title>
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
				echo "<div>Vous devez être connecté pour acceder à cette page</div>";
			}else if($_SESSION['grade'] == 0){
				echo "<div>Vous n'avez pas l'autorisation de supprimer ce projet</div>";
			}else if(!$suppression_succes){
				echo "<div>Echec lors de la suppression du projet</div>";
			}else{
				echo "<div>Le projet a bien été supprimé</div>";
			}
		?>
			<div><a href='index.php'>Retour à l'accueil</a></div>
		</div>
		<footer>
			<?php
				include "footer.inc.php";
			?>
		</footer>
	</body>
</html>