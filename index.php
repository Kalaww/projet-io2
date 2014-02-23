<?php

	session_start();

	//Boolean si la personne est connecté sur le site
	$logger = false;
	//Boolean si la personne a raté la connexion au site
	$logger_fail = false;
	
	//Fonction de connexion à la base de donnée
	//changer les variables de ce fichier selon la base de donnée
	include "connexion_bdd.php";
	
	//Fonction de vérification de login
	function verif_login(){
		$requete = sprintf("SELECT login, mdp, id FROM identifiant WHERE login='%s'",
							mysql_real_escape_string(htmlspecialchars($_POST['login'])));
		$donnee = connexion($requete);
		//S'il y a 0 ou plus d'un login, erreur
		if(mysql_num_rows($donnee) != 1){
			return false;
		}else{
			$ligne = mysql_fetch_assoc($donnee);
			//Si le mdp est le bon
			if(md5(htmlspecialchars($_POST['mdp'])) == $ligne['mdp']){
				incremente_connexion($ligne["id"]);
				return true;
			}else{
				return false;
			}
		}
	}
	
	//Verifie si la session est defini ou que le formulaire de connexion est défini
	function start(){
		global $logger;
		if(isset($_SESSION['login'])){
			$logger = true;
		}else if(isset($_POST['login'], $_POST['mdp'])){
			if(verif_login()){
				$logger = true;
				generer_session($_POST['login']);
			}else{
				global $logger_fail;
				$logger_fail = true;
			}
		}
	}
	
	//Recupere toutes les infos de l'utilisateur connecté et les stockent dans $_SESSION
	function generer_session($login){
		$requete = sprintf("SELECT * FROM identifiant WHERE login='%s'",
							mysql_real_escape_string(htmlspecialchars($login)));
		$donnee = connexion( $requete);
		$_SESSION = mysql_fetch_assoc($donnee);
	}
	
	// Fonction qui renvoi le message à la place du formulaire si on est logger
	function logger_message(){
		$r = "";
		global $logger;
		if($logger){
			global $infos;
			$r .= '<div><img src="ressources/user.png" title="Utilisateur" alt="Utilisateur"><div>'.$_SESSION["prenom"].'</div><div>'.$_SESSION["nom"].'</div></div>';
			$r .= '<div><a id="deconnexion" href="deconnexion.php"><img src="ressources/deco.png" title="Déconnexion" alt="Déconnexion"></a></div>';
		}else{
			$r .= '<div>Erreur de la connexion</div>';
		}
		return $r;
	}
		
	//Incremente le compteur de connexion 
	function incremente_connexion($id){
		$requete = 'SELECT nbr_connexion FROM identifiant WHERE id="'.$id.'"';
		$donnee = connexion( $requete);
		$ligne = mysql_fetch_assoc($donnee);
		$requete = 'UPDATE identifiant SET nbr_connexion = "'.($ligne["nbr_connexion"]+1).'" WHERE id="'.$id.'"';
		connexion( $requete);
	}
	
	//Renvoi le contenu du tableau en string
	function test_table($tab){
		$r = "";
		foreach($tab as $i=>$v){
			$r .= $i." => ".$v."<br>";
		}
		return $r;
	}
	
	//Convertie le mois en chaine de caractère
	function conversion_date($date_sql){
		$temp = explode('-', $date_sql);
		$mois = array(	"01"=>"Janvier",
						"02"=>"Fevrier",
						"03"=>"Mars", 
						"04"=>"Avril", 
						"05"=>"Mai", 
						"06"=>"Juin", 
						"07"=>"Juillet", 
						"08"=>"Aout", 
						"09"=>"Septembre", 
						"10"=>"Octobre", 
						"11"=>"Novembre", 
						"12"=>"Decembre", 
						"00"=>"Erreur");
		foreach($mois as $i=>$v){
			if($i == $temp[1]){
				return $temp[2].' '.$v.' '.$temp[0];
			}
		}
	}
	
	//Renvoi le titre de la page selon $_GET[where]
	function titre_page(){
		if( isset($_GET["where"])) {
			//Page perso
			if($_GET["where"]== "perso"){
				return "Mon profil";
			//Liste des adhérents
			}else if($_GET["where"]== "adherents"){
				return "Membres";
			//Organigramme
			}else if($_GET["where"]=="organigramme"){
				return "Organigramme";
			//Profil
			}else if($_GET["where"]=="profil"){
				return "Profil d'un membre";
			//Articles
			}else if($_GET["where"]=="article"){
				return "Articles";
			}else if($_GET["where"]=="article_nouveau"){
				return "Nouvel article";
			}else if($_GET["where"]=="article_editer"){
				return "Editer l'article";
			//Réunions
			}else if($_GET["where"]=="reunion"){
				return "Réunions";
			}else if($_GET["where"]=="reunion_nouvelle"){
				return "Nouvelle réunion";
			}else if($_GET["where"]=="reunion_editer"){
				return "Editer la réunion";
			//Compétences
			}else if($_GET["where"]=="competences"){
				return "Compétences";
			//Projets
			}else if($_GET["where"]=="projets"){
				return "Projets";
			}else if($_GET["where"]=="projet_nouveau"){
				return "Nouveau projet";
			}else if($_GET["where"]=="projet_editer"){
				return "Editer le projet";
			}
		}else{
			return "Association";
		}
	}
	
	start();
	
	
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title><?php echo titre_page(); ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="css/header_footer.css"/>
		<link rel="stylesheet" href="css/nav_event.css"/>
		<link rel="stylesheet" href="css/milieu.css"/>
		<link rel="stylesheet" media="(max-width:640px)" href="css/mobile.css">
	</head>
	<body>
		<!--entete-->
		<header>
			<?php include("header.inc.php");?>
		</header>
		<!--conteneur général-->
		<div id="page">
			<!--conteneur gauche-->
			<div id="menu">
				<nav>
					<?php include("nav.inc.php"); ?> 
					<?php if($logger){ include("nav_logger.inc.php"); } ?>
				</nav>
			</div>
			<!--conteneur central-->
			<div id="milieu">
				<?php if( isset($_GET["where"])) {
							//Page perso
							if($_GET["where"]== "perso"){
								include "page_perso.inc.php";
							//Liste des adhérents
							}else if($_GET["where"]== "adherents"){
								include "adherents.inc.php";
							//Organigramme
							}else if($_GET["where"]=="organigramme"){
								include "organigramme.inc.php";
							//Profil
							}else if($_GET["where"]=="profil"){
								include "profil.inc.php";
							//Articles
							}else if($_GET["where"]=="article"){
								include "article.inc.php";
							}else if($_GET["where"]=="article_nouveau"){
								include "article_nouveau.inc.php";
							}else if($_GET["where"]=="article_editer"){
								include "article_editer.inc.php";
							//Réunions
							}else if($_GET["where"]=="reunion"){
								include "reunion.inc.php";
							}else if($_GET["where"]=="reunion_nouvelle"){
								include "reunion_nouvelle.inc.php";
							}else if($_GET["where"]=="reunion_editer"){
								include "reunion_editer.inc.php";
							//Compétences
							}else if($_GET["where"]=="competences"){
								include "competences.inc.php";
							//Projets
							}else if($_GET["where"]=="projets"){
								include "projet.inc.php";
							}else if($_GET["where"]=="projet_nouveau"){
								include "projet_nouveau.inc.php";
							}else if($_GET["where"]=="projet_editer"){
								include "projet_editer.inc.php";
							}else{
								include "accueil.php";
							}
						}else{
							include "accueil.php";
						}
						?>
			</div>
			<!--conteneur droit-->
			<div id="droite">
				<div id="connecter">
					<header>
						Connexion
					</header>
					<?php if(!$logger){ ?>
					<table>
						<form method="post">
							<tr>
								<td><label for="login">Login :</label></td>
							</tr>
							<tr>
								<td><input type="text" name="login" id="login" size=10></td>
							</tr>
							<tr>
								<td><label for="mdp">Mot de passe :</label></td>
							</tr>
							<tr>
								<td><input type="password" name="mdp" id="mdp" size=10></td>
							</tr>
							<tr>
								<td><input type="submit" value="Connexion"></td>
							</tr>
						</form>
					</table>
					<?php if($logger_fail){ ?><div style="color:red;">Login ou mot de passe incorrect</div><?php } ?>
					<div><a href="formulaire.php">Rejoignez-nous</a></div>
					<?php }else{
						echo logger_message();
					} ?>
				</div>
				<div>
					<div id="event">
						<?php 
							if($logger){ 
								include "reunion_miniature.php";
								include "adherents_miniature.php";
							} 
						?>
					</div>
				</div>
			</div>
		</div>
		<!--pied de page-->
		<footer>
			<?php include("footer.inc.php");?>
		</footer>
	</body>
</html>