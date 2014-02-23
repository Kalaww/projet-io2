<?php
	session_start();
	$logger = false;
	$form_rempli = false;
	$echec_desinscription = false;
	
	include "connexion_bdd.php";

	//Test si le client est bien un membre
	if(isset($_SESSION['login'])){
		$logger = true;
	}
	
	//Test si le formulaire est bien rempli
	if(isset($_POST['id_reunion'])){
		$form_rempli = true;
	}
	
	if($logger && $form_rempli){
		$requete = sprintf("SELECT participants FROM reunions WHERE id = '%s'",
							mysql_real_escape_string(htmlspecialchars($_POST['id_reunion'])));
		$donnee = connexion($requete);
		
		if(mysql_num_rows($donnee) == 1){
			$ligne = mysql_fetch_assoc($donnee);
			$participants_table = explode('|', $ligne['participants']);
			
			$new_participants = "";
			foreach($participants_table as $v){
				if($v != $_SESSION['id']){
					$new_participants .= $v."|";
				}
			}
			$new_participants = substr($new_participants, 0, -1); //supprimer le dernier caractère , ici "|"
			
			$requete = "UPDATE reunions SET participants = '{$new_participants}' WHERE id = '{$_POST['id_reunion']}'";
			if(!connexion($requete)){
				$echec_desinscription = true;
			}
		}else{
			$echec_desinscription = true;
		}
	}
	

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Desinscription à la réunion</title>
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
			<?php
				if(!$logger){
					echo "<div>Vous devez être connecté pour accéder à cette page</div>";
				}else if(!$form_rempli){
					echo "<div>Vous n'avez pas sélectionné une réunion valide</div>";
				}else if($echec_desinscription){
					echo "<div>Une erreur est survenue pendant la desinscription. Veuillez réessayer.</div>";
				}else{
					echo "<div>Vous avez bien été desinscrit de la réunion</div>";
				}
			?>
			<div><a href="index.php?where=reunion">Retour aux réunions</a></div>
		</div>
		<footer>
			<?php include('footer.inc.php'); ?>
		</footer>
	</body>
</html>