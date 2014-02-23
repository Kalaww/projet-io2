<?php

	$infos_id;
	$id_defini = false;
	$recup_id_succes = false;
	
	//Récupère les infos de l'id du GET et les stockent dans infos_id
	function recuperation_info_id(){
		global $infos_id;
		$requete = sprintf("SELECT id, nom, prenom, login, age, date_inscription, description, code, nbr_ecriture, grade FROM identifiant WHERE id='%s'",
							mysql_real_escape_string(htmlspecialchars($_GET['id'])));
		$donnee = connexion($requete);
		global $recup_id_succes;
		if(mysql_num_rows($donnee) == 1){
			$infos_id = mysql_fetch_assoc($donnee);	
			$recup_id_succes = true;
		}
	}
	
	//Test si GET[id] est defini et appelle recuperation_info() si oui
	function test_id(){
		if(isset($_GET['id'])){
			recuperation_info_id();
			global $id_defini;
			$id_defini = true;
		}
	}
	
	//Ajoute un lien vers la page perso si l'id est celui de la personne connectée
	function id_same_connecter(){
		if(isset($_SESSION['id']) && $_SESSION['id'] == $_GET['id']){
			return '<div>Pour modifier votre profil, c\'est <a href="index.php?where=perso">ici</a></div>';
		}
	}
	
	//Afficher l'image en fonction du grade
	 function affiche_image(){
		global $infos_id;
		if($infos_id['grade']==0){
			return"<img src='ressources/membre.png' title='Membre' alt='Membre'>";
		}
		if($infos_id['grade']==10){
			return "<img src='ressources/users.png' title='Conseil' alt='Membre du conseil'>";
		}
		if($infos_id['grade']==20){
			return "<img src='ressources/admin.png' title='Vice président' alt='Vice président'>";
		}
		if($infos_id['grade']==30){
			return "<img src='ressources/boss.png' title='Président' alt='Président'>";
		}
	}
	
	//Text "Aucune description" si description vide
	function description_vide(){
		global $infos_id;
		if($infos_id['description'] == ""){
			return "Aucune description";
		}else{
			return $infos_id['description'];
		}
	}
	
	//Affiche les article de la personne
	function mes_articles(){
		global $infos_id;
		$requete = "SELECT titre, id FROM articles WHERE auteur='{$infos_id['id']}'";
		$donnees = connexion($requete);
		if(mysql_num_rows($donnees) >= 1){
			$res = '<ul>';
			while($ligne = mysql_fetch_assoc($donnees)){
			$res .= 	"<li>".
							"<a href='index.php?where=article&amp;id={$ligne['id']}'>".$ligne['titre']."</a>
						</li>";
			}
			$res .= "</ul>";
			return $res;
		}else{
			return "<div>{$infos_id['prenom']} {$infos_id['nom']} a rédigé aucun article</div>";
		}
	}

	test_id();
	
?>

<section id="profil">
<?php
	if(!$logger){
		echo "<div>Vous devez être connecté pour acceder à cette page</div>";
	}else if(!$id_defini){
		echo "<div>Aucune personne sélectionnée</div>";
	}else if(!$recup_id_succes){
		echo "<div>Aucun membre trouvé avec cet id</div>";
	}else{
		echo "<header>Profil de {$infos_id['prenom']} {$infos_id['nom']}</header>";
		echo affiche_image();
		echo "<div>
				<div>Pseudo : {$infos_id['login']}</div>
				<div>Age : {$infos_id['age']}</div>
				<div>Description : ".description_vide()."</div>
				<div>Nombre d'articles/réunions/projets rédigés/édités : {$infos_id['nbr_ecriture']}</div>
			</div>";
		echo "<div id='mes_articles'>
				<header>Articles rédigés par {$infos_id['prenom']} {$infos_id['nom']}</header>
				".mes_articles()."
			</div>";
		echo id_same_connecter();
	}
?>
</section>