<?php

	//Recupère la liste des articles public et/ou public
	function recupere_list_articles(){
		global $logger;
		
		if(formulaire_rempli()){
			$requete = generer_requete(true);
		}else if(!$logger){//si pas connecté
			$requete = 'SELECT id, titre, date, statut FROM articles WHERE statut="0" ORDER BY date DESC LIMIT '.intervalle_page().', 10';
		}else{
			$requete = 'SELECT id, titre, date, statut FROM articles ORDER BY date DESC LIMIT '.intervalle_page().', 10';
		}	
		$res = '<ul>';
		$donnee = connexion($requete);
		if(mysql_num_rows($donnee) == 0){//si aucun article
			return 'Aucun article trouvé';
		}else{
			while($ligne = mysql_fetch_assoc($donnee)){
				$res .= "<li>
							<a href='index.php?where=article&amp;id={$ligne["id"]}'><header>".$ligne["titre"]."</header></a>
							<div>
								<div class='list_article_date'>".conversion_date($ligne['date'])."</div>
								<div class='list_article_statut'>".article_statut($ligne['statut'], false)."</div>
							</div>
						</li>";
			}
		}	
		$res .= '</ul>';
		
		$nb_page = nombre_pages_articles();
		$ordre = "";
		if(isset($_GET['ordre'], $_GET['orderby'])){
			$ordre = "&amp;ordre={$_GET['ordre']}&amp;orderby={$_GET['orderby']}";
		}
		$res.= "<div id='article_pages'>Page ";
		for($i=1; $i<=$nb_page; $i++){
			$res .= "<a href='index.php?where=article&amp;page=$i{$ordre}'>$i</a>";
			if($i!= $nb_page){
				$res .= " - ";
			}
		}
		$res .= "</div>";
		return $res;
	}
	
	//Renvoi le nombre de page en fonction de la recherche effectuée sur les articles
	function nombre_pages_articles(){
		global $logger;
		if(formulaire_rempli()){
			$requete = generer_requete(false);
		}else if(!$logger){//si pas connecté
			$requete = 'SELECT id FROM articles WHERE statut="0"';
		}else{
			$requete = 'SELECT id FROM articles';
		}
		
		return ceil(mysql_num_rows(connexion($requete))/10);
	}
	
	//Renvoi l'intervalle des articles en fonction de $_GET['page']
	function intervalle_page(){
		if(isset($_GET['page'])){
			return $_GET['page']*10-10;
		}else{
			return 0;
		}
	}
	
	//Renvoi le prenom nom de l'id
	function nom_auteur($id){
		$requete = 'SELECT nom, prenom FROM identifiant WHERE id="'.$id.'"';
		$donnee = connexion( $requete);
		$ligne = mysql_fetch_assoc($donnee);
		return $ligne['prenom'].' '.$ligne['nom'];
	}
	
	//Renvoi l'article de l'id du GET
	function recupere_article(){
		global $logger;
		$requete = sprintf("SELECT * FROM articles WHERE id='%s'",
							mysql_real_escape_string(htmlspecialchars($_GET['id'])));
		$donnee = connexion($requete);
		
		if(mysql_num_rows($donnee) == 0){//si aucun article
			return 'Aucun article trouvé';
		}
		
		$ligne = mysql_fetch_assoc($donnee);
		
		if($ligne['statut'] == 1 && !$logger){// si une personne non logger essai de lire un article privé
			return 'Vous devez vous connecter pour voir cet article';
		}
		$res = 	"<article>
					<header>".$ligne['titre']."</header>
					<div class='article_auteur'>
						<img src='ressources/auteur.png' title='Auteur' alt='Auteur'>
						Auteur: <a href='index.php?where=profil&amp;id={$ligne['auteur']}'>";
		$res .= 		nom_auteur($ligne["auteur"]);
		$res .= 	'</a></div>
					<div class="article_date">Le '.conversion_date($ligne['date']).'</div>
					<p>'.tagger($ligne['text']).'</p>';
		$res .= 	article_statut($ligne['statut'], true);
		$res .= 	liste_modificateurs_test($ligne["modificateur"]);
		$res .= 	article_bouton_edition($ligne['statut'], $ligne['id']);
		$res .= 	affiche_commentaire($ligne['id']);
		$res .= "</article>";
		return $res;
	}
	
	//Trouve et modifi le tag vers un membre du site dans un texte
	function tagger($article){
		$emplacement = strpos($article, 'pseudo@');
		do{
			$emplacement = strpos($article, 'pseudo@');
			if($emplacement !== false){
				$emplacement += 7;
				$pseudo = "";
				while($article[$emplacement] != '@'){
						$pseudo .= $article[$emplacement];
						$emplacement++;
				}
				$requete="SELECT prenom, nom, id FROM identifiant WHERE login='{$pseudo}'";
				$donnee = connexion($requete);
				$ligne = mysql_fetch_assoc($donnee);
				$article = str_replace('pseudo@'.$pseudo.'@', "<a href='index.php?where=profil&amp;id={$ligne["id"]}'>{$ligne['prenom']} {$ligne['nom']}</a>", $article);
			}
		}while($emplacement !== false);
		return $article;		
	}
	
	//Renvoi le statut public/privé de l'article
	function article_statut($statut, $div){
		if($statut == 0){// article public
			$img = "public";
			$statut_text = "Article public";
		}else{// article privé
			$img = "prive";
			$statut_text = "Article privé";
		}
		
		$res =	"<img src='ressources/{$img}.png' alt='{$img}' title='{$img}'>{$statut_text}";
				
		if($div){
			return "<div class='article_statut'>".$res."</div>";
		}else{
			return $res;
		}
	}
	
	//Renvoi les boutons d'édition si on peut modifier l'article
	function article_bouton_edition($statut, $id){
		global $logger;
		$res = "";
		
		//logger et privé et organigramme OU logger et public OU logger et modérateur
		if($logger && $statut == 0 && $_SESSION['grade'] > 0 || 
			$logger && $statut == 1){
			$res .= "<div class='article_edite'>
						<span><a href='index.php?where=article_editer&amp;id={$id}'>
							<img src='ressources/editer.png' title='Editer' alt='Editer' ></a>
						</span>
						<span class='suppr'>
							<img src='ressources/supprimer.png' title='Supprimer' alt='Supprimer' >
						</span>
					</div>
					<div>
						<form method='POST' action='article_supprimer.php'>
							<input type='hidden' name='id' value='{$id}'>
						</form>
					</div>";
		}
		return $res;
	}
	
	//Test si le formulaire est rempli
	function formulaire_rempli(){
		return isset($_GET['orderby'], $_GET['ordre']);
	}
	
	//Genere la requete selon le formulaire
	function generer_requete($limit){
		if($_GET['orderby'] == "2"){
			$orderby = "titre";
		}else{
			$orderby = "date";
		}
		
		if($_GET['ordre'] == "desc"){
			$ordre = "DESC";
		}else{
			$ordre = "ASC";
		}
		
		$interval = "";
		if($limit){
			$interval = " LIMIT ".intervalle_page().", 10";
		}
		
		global $logger;
		if(!$logger){
			return "SELECT id, titre, date, statut FROM articles WHERE statut='0' ORDER BY {$orderby} {$ordre} {$interval}";
		}else{
			return "SELECT id, titre, date, statut FROM articles ORDER BY {$orderby} {$ordre} {$interval}";
		}
	}
	
	//Renvoi la liste des modificateurs
	function liste_modificateurs_test($liste){
		//|50-10-08-2013| id-jours-date-annee
		$liste_table = explode("|", $liste);
		
		$res = "";
		$length = count($liste_table);
		
		if(strlen($liste) > 0){
			$res .= "Modifié par : ";
		}else{
			return "";
		}
		
		$length_premier_for = 2;
		if($length == 1){
			$length_premier_for = 1;
		}
		
		for($i = 0; $i < $length_premier_for; $i++){
			$modifieur_table = explode("-", $liste_table[$i]);
			$requete="SELECT prenom, nom FROM identifiant WHERE id='{$modifieur_table[0]}'";
			$donnee =connexion($requete);
			if(mysql_num_rows($donnee) == 1){
				$infos_modificateurs=mysql_fetch_assoc($donnee);
				$res .= "<a href='index.php?where=profil&amp;id={$modifieur_table[0]}'>{$infos_modificateurs['prenom']} {$infos_modificateurs['nom']}</a><span style='color:rgb(150,150,150); font-size: 80%;'> le {$modifieur_table[1]}/{$modifieur_table[2]}/{$modifieur_table[3]}</span>";
				if($i < $length_premier_for-1){
					$res .= ", ";
				}
			}
		}
		
		if($length > 2){
			$res .= "<div class='article_modif_more' onclick='affiche(".htmlspecialchars($_GET['id']).");'>
						<div class='article_modif_more_popup' id='article_modif_more_".htmlspecialchars($_GET['id'])."' style='display: none;'>
							<span>";
			for($i = 2; $i < $length; $i++){
				$modifieur_table = explode("-", $liste_table[$i]);
				$requete="SELECT prenom, nom FROM identifiant WHERE id='{$modifieur_table[0]}'";
				$donnee =connexion($requete);
				if(mysql_num_rows($donnee) == 1){
					$infos_modificateurs=mysql_fetch_assoc($donnee);
					$res .= "<a href='index.php?where=profil&amp;id={$modifieur_table[0]}'>{$infos_modificateurs['prenom']} {$infos_modificateurs['nom']}</a><span style='color:rgb(150,150,150); font-size: 80%;'> le {$modifieur_table[1]}/{$modifieur_table[2]}/{$modifieur_table[3]}</span>";
					if($i < $length-1){
						$res .= "<br>";
					}
				}
			}
			$res .= "</span></div><img src='ressources/more.png' alt='more' title='more'></div>";
		}
		return $res;
	}
	
	//Return la liste des articles
	function affiche_commentaire($id){
		$requete = sprintf("SELECT * FROM commentaires_article WHERE article = '%s' ORDER BY date ASC",
							mysql_real_escape_string(htmlspecialchars($id)));
		
		$donnees = connexion($requete);
		
		$res = "";
		if(mysql_num_rows($donnees) >= 1){
			$res .= "<div id='conteneur_commentaires'>
						<header>Commentaires (".mysql_num_rows($donnees).")</header>";
			while($ligne = mysql_fetch_assoc($donnees)){
				$res .= "<div class='commentaire'>
							<header>De <a href='index.php?where=profil&amp;id={$ligne['auteur']}'>".nom_auteur($ligne['auteur'])."</a> le ".conversion_date($ligne['date'])." à ".conversion_heure($ligne['heure'])."</header>
							<div>".tagger($ligne['texte'])."</div>
							".boutton_supprimer_commentaire($ligne['id'])."
						</div>";
			}
			$res .= "</div>";
		}
		
		global $logger;
		if($logger){
			$res .= "<div id='nouveau_commentaire'>
						<header>Ajouter un commentaire</header>
						<form action='commentaire_ajouter.php'>
							<textarea name='com' id='com' placeholder='Pour tagger une personne, utiliser la syntaxe suivant : pseudo@le-pseudo-a-tagger@' wrap='hard'></textarea>
							<input type='hidden' name='auteur' value='{$_SESSION['id']}'>
							<input type='hidden' name='article' value='".htmlspecialchars($_GET['id'])."'>
							<input type='submit' value='Ajouter'>
						</form>
					</div>";
		}
		
		return $res;
		
	}
	
	//boutton suppression de commentaire
	function boutton_supprimer_commentaire($id){
		global $logger;
		if($logger && $_SESSION['grade'] >= 10){
			$res = "<div class='commentaire_supprimer'>
						<img src='ressources/supprimer.png' title='Supprimer' alt='Supprimer'>
						<form action='commentaire_supprimer.php' style='display:none;'>
							<input type='hidden' name='id' value='{$id}'>
						</form>
					</div>";
			return $res;
		}
	}
	
	//converti une heure mysql en String
	function conversion_heure($heure_mysql){
		$table_heure = explode(':', $heure_mysql);
		return $table_heure[0]."h".$table_heure[1];
	}
		
	
?>
<script type="text/javascript" src="javascript/jquery.js"></script>
<script type="text/javascript" src="javascript/supprimer_modif.js"></script>
<script type="text/javascript" src="javascript/commentaire.js"></script>
<section id="list_article">
	<?php if(isset($_GET['id'])){
			echo recupere_article();
		}else{
	?>
		<header>Listes des articles</header>
		<div>
			<form method="GET" action="index.php?where=article">
				<input type="hidden" name="where" value="article">
				<label for="orderby">Classé par : </label>
				<select name="orderby" id="orderby">
					<option value="1">Date</option>
					<option value="2">Titre</option>
				</select>
				 dans l'ordre 
				<input type="radio" name="ordre" value="asc" id="asc" checked>
				<label for="asc">croissant</label>
				<input type="radio" name="ordre" value="desc" id="desc">
				<label for="desc">décroissant</label>
				<input type="submit" value="Recharger">
			</form>
		</div>
	<?php
			if(isset($_SESSION['login'])){
				echo "<div><a href='index.php?where=article_nouveau'><img src='ressources/more.png' alt='Ajouter' title='Ajouter'>	Ajouter un nouvel article</a></div>";
			}
			echo recupere_list_articles();
		}
	?>
</section>