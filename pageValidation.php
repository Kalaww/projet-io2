<?php

	include "connexion_bdd.php";

	//Enlève tous les accents d'une chaine de caractère
	function clean($toClean) {   
		$accent = array(
			'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 
			'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 
			'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 
			'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 
			'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 
			'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 
			'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f');	
		return strtr($toClean, $accent);
	}

	//Retour boolean si le formulaire est isset()
	function formulaire_rempli(){
		return isset($_POST['prenom'], $_POST['nom'], $_POST['age'], $_POST['code'], $_POST['login']);
	}
	
	//Test la validité des champs du formulaire et génère les textes d'erreur
	function formulaire_correct(){
		$erreur = "";
		// prenom
		$temp = clean($_POST["prenom"]) ;
		if(!ctype_alpha($temp) || (strlen($temp) < 3)){
			$erreur .= "<div style='color:red;'>Le prenom est mal renseigné</div>";
		}
		//nom
		$temp = clean($_POST["nom"]);
		if(!ctype_alpha($temp) || strlen($temp) < 3){
			$erreur .= "<div style='color:red;'>Le nom est mal renseingé</div>";
		}
		//login
		if(strlen($_POST['login']) < 3){
			$erreur .= "<div style='color:red;'>Le login est mal renseingé</div>";
		}
		//code postal
		if(!is_numeric($_POST['code']) || strlen($_POST['code']) != 5){
			$erreur .= "<div style='color:red;'>Le code postal est mal renseigné</div>";
		}
		//age
		if(!is_numeric($_POST['age']) || $_POST['age'] < 1 || $_POST['age'] > 120){
			$erreur .= "<div style='color:red;'>L'âge est mal renseigné</div>";
		}
		return $erreur;
	}
	
	//Test qui verifi si le login du formulaire est unique
	function verification_login_unique(){
		$req= sprintf("SELECT login FROM identifiant WHERE login='%s'",
						mysql_real_escape_string(htmlspecialchars($_POST['login'])));
		$donnee=connexion($req);
		return mysql_num_rows($donnee)==0;
	}
	
	//Genere un mot de passe aléatoire de 8 chiffres
	function generer_mdp(){
		return rand(10000000, 99999999);
	}
	
	//Ajoute le formulaire à la base de donnée
	function ajoute_bdd(){
		$erreur = formulaire_correct();
		if(formulaire_rempli() && strlen($erreur) == 0){
			if(verification_login_unique()){
				$mdp=generer_mdp();
				echo 	"<div>Compte crée avec succès</div>
						<div>Votre mot de passe est : " . $mdp." (Veuillez noter ce mot-de-passe)</div>
						<div><a href=\"index.php\">Retour à l'accueil</a></div>";
				$mdp = md5($mdp);
				$requete=sprintf("INSERT INTO identifiant(login, mdp, nom, prenom, sexe, code, age, date_inscription) 
								VALUES('%s','{$mdp}','%s','%s','%s','%s','%s',NOW())",
								mysql_real_escape_string(htmlspecialchars($_POST['login'])),
								mysql_real_escape_string(htmlspecialchars($_POST['nom'])),
								mysql_real_escape_string(htmlspecialchars($_POST['prenom'])),
								mysql_real_escape_string(htmlspecialchars($_POST['sexe'])),
								mysql_real_escape_string(htmlspecialchars($_POST['code'])),
								mysql_real_escape_string(htmlspecialchars($_POST['age'])));
				return $requete;
			}else{
				echo	"<div>Ce compte existe deja</div>
						<div><a href=\"formulaire.php\">Retour vers le formulaire</a></div>";
			}
		}else{ 
			echo 	"<div>Formulaire incomplet</div>".$erreur."
					<div><a href=\"formulaire.php\">Retour vers le formulaire</a></div>" ;
		}
	}


?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Validation</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="css/header_footer.css">
		<link rel="stylesheet" href="css/style_simple.css">
		<link rel="stylesheet" media="(max-width:640px)" href="css/mobile.css">
	</head>
	<body>
		<header>
			<?php include("header.inc.php"); ?>
		</header>
		<div id="cadre">
			<?php 
				connexion(ajoute_bdd());
			?>
		</div>
		<footer>
			<?php include("footer.inc.php"); ?>
		</footer>
	</body>
</html>