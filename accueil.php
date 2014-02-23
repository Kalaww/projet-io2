<?php
	
	//Renvoi la liste des 4(max) derniers articles
	function afficher_derniers_articles(){
		global $logger;
		if($logger){// si connecté, affiche article public et privé
			$requete = 'SELECT * FROM articles ORDER BY date DESC';
		}else{// sinon que public
			$requete = 'SELECT * FROM articles WHERE statut="0" ORDER BY date DESC';
		}
		$donnees = connexion( $requete);
		$res = "";
		
		if(mysql_num_rows($donnees) < 1){
			return "<div>Aucun article récent trouvé</div>";
		}else{
			for($i =1; $i <= 4; $i++){
				if($ligne = mysql_fetch_assoc($donnees)){
					$res .= "<article>
								<a href='index.php?where=article&amp;id={$ligne['id']}'><header>{$ligne['titre']}</header></a>
								<div class='article_auteur'>
									<img src='ressources/auteur.png' title='Auteur' alt='Auteur'>
									Auteur: <a href='index.php?where=profil&amp;id={$ligne['auteur']}'>";
					$res .= 		nom_auteur($ligne["auteur"]);	
					$res .= 	'</a></div>
							<div class="article_date">Le '.conversion_date($ligne['date']).'</div>
							<p>'.taille_description($ligne['text'], $ligne['id']).'</p>';
					$res .= 	article_statut($ligne['statut']);
					$res .= "</article>";
				}
			}
		}
		return $res;
	}
	
	//Renvoi le text avec une taille inferieur à 200 caractères
	function taille_description($text, $id){
		if(strlen($text) > 200){
			return substr($text, 0, 200)."...<a href='index.php?where=article&amp;id={$id}'>Lire la suite</a>";
		}else{
			return $text;
		}
	}
	
	//Renvoi le statut public/privé de l'article
	function article_statut($statut){
		if($statut == 0){// article public
			$img = "public";
			$statut_text = "Article public";
		}else{// article privé
			$img = "prive";
			$statut_text = "Article privé";
		}
		
		$res =	"<div class='article_statut'>
					<img src='ressources/{$img}.png' alt='{$img}' title='{$img}'>
					{$statut_text}
				</div>";
		return $res;
	}
	
	//Renvoi le prenom nom de l'id
	function nom_auteur($id){
		$requete = 'SELECT nom, prenom FROM identifiant WHERE id="'.$id.'"';
		$donnee = connexion( $requete);
		$ligne = mysql_fetch_assoc($donnee);
		return $ligne['prenom'].' '.$ligne['nom'];
	}
	
	//Renvoi la liste des 4(max) derniers projets crées
	function afficher_derniers_projets(){
		$requete = "SELECT id, titre, date_creation, participants FROM projets ORDER BY date_creation DESC";
		$donnees = connexion( $requete);
		
		$res = "";
		
		if(mysql_num_rows($donnees) < 1){
			return "<div>Aucun projet récent trouvé</div>";
		}else{
			for($i = 1; $i <= 4; $i++){
				if($ligne = mysql_fetch_assoc($donnees)){
					$res .= "<li>
								<header><a href='index.php?where=projets#projet_{$ligne['id']}'>{$ligne['titre']}</a></header>
								<div>Crée le ".conversion_date($ligne['date_creation'])."</div>
								<div>".nombre_participants($ligne['participants'])." participants</div>
							</li>";
				}
			}
		}
		return "<ul>".$res."</ul>";
	}
	
	//Renvoi le nombre de participants
	function nombre_participants($participants){
		$table_participants = explode("|", $participants);
		return count($table_participants)-1;
	}
	
	
?>
<section id="accueil">
	<?php if(!$logger){
		echo "<div id='message_accueil'>Bienvenue</div>";
	}else{
		echo "<div id='message_accueil'>Bonjour {$_SESSION['prenom']} {$_SESSION['nom']}</div>";
	} ?>
	<div id="derniers_articles">
		<header>Articles ajoutés récement</header>
		<?php echo afficher_derniers_articles(); ?>
	</div>
	<div id="derniers_projets">
		<header>Derniers projets ajoutés</header>
		<?php echo afficher_derniers_projets(); ?>
	</div>
</section>