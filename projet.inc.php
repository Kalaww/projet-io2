<script>
	function verification(id){
		if(confirm("Etes-vous sur de supprimer l'article ?")){
			document.getElementById("supprimer_"+id).submit();
			
		}
	}
</script>
<?php

	//Renvoi la liste des projets
	function liste_projet(){
		$requete = "SELECT * FROM projets ORDER BY date_creation ASC";
		$donnees = connexion($requete);
		
		if(mysql_num_rows($donnees) == 0){
			return "<div>Aucuns projets trouvés</div>";
		}
		
		$r = "";
		while($ligne = mysql_fetch_assoc($donnees)){
			$r .="<li id='projet_{$ligne['id']}'>
					<header>{$ligne['titre']}</header>
					<div class='projet_date'>Crée le ".conversion_date($ligne['date_creation'])."</div>
					<div class='projet_avancement'>Avancement: ".etat_projet($ligne['etat'])."</div>
					<p>{$ligne['description']}</p>
					<div class='participants'>
						<header>Y participent :</header>
						<div>
						".affichage_participants($ligne['participants'])."
						</div>";
		if(!deja_inscrit_projet($ligne['participants'])){
				$r .= 	"<div>
							<form method='post' action='projet_inscription.php'>
								<input type='hidden' name='id_projet' value='{$ligne['id']}'>
								<input type='submit' value=\"Participer au projet\">
							</form>
						</div>
						</div>";
			}else{
				$r .= 	"<div>
							<form method='post' action='projet_desincription.php'>
								<input type='hidden' name='id_projet' value='{$ligne['id']}'>
								<input type='submit' value=\"Quitter le projet\">
							</form>
						</div>
						</div>";
			}
			$r .= bouton_edition_projet($ligne['id']);
			$r .= "</li>";
		}
		return "<ul>".$r."</ul>";
	}
	
	//Renvoi l'état du projet
	function etat_projet($etat){
		if($etat){
			return "<div class='etat_projet_terminer'>Terminé</div>";
		}else{
			return "<div class='etat_projet_progress'>En cours ...</div>";
		}
	}
	
	//Renvoi les boutons d'édition si on peut modifier le projet
	function bouton_edition_projet($id){
		global $logger;
		$res = '';
		
		if($logger && $_SESSION['grade'] > 0){
			$res .= "<div class='projet_edite'>
						<span><a href='index.php?where=projet_editer&amp;id={$id}'>
								<img src='ressources/editer.png' title='Editer' alt='Editer'></a>
						</span>
						<span class='suppr'>
							<img src='ressources/supprimer.png' title='Supprimer' alt='Supprimer'>
						</span>
					</div>
					<div>
						<form method='post' action='projet_supprimer.php'>
							<input type='hidden' name='id' value='{$id}'>
						</form>
					</div>";
		}	
		return $res;
	}
	
	//Renvoi la liste des participants
	function affichage_participants($participants){
		$participants_table = explode('|', $participants);
		$length = count($participants_table);
		
		if($length == 0){ // Si aucun participants
			return 'Aucun participants';
		}
		
		$requete_id = '';
		for($i = 0; $i < $length; $i++){
			if($i == 0){
				$requete_id .= "id = '{$participants_table[$i]}' ";
			}else{
				$requete_id .= "OR id = '{$participants_table[$i]}' ";
			}
		}
		
		$requete = "SELECT id, nom, prenom FROM identifiant WHERE {$requete_id} ";
		$donnee = connexion($requete);
		
		$r = '';
		while($ligne = mysql_fetch_assoc($donnee)){
			$r .= "<li>
					<a href='index.php?where=profil&amp;id={$ligne['id']}'>
						{$ligne['prenom']} {$ligne['nom']}
					</a>
				</li>";
		}
		
		return '<ul>'.$r.'</ul>';
	}
	
	//Vérifi si le client est deja inscrit à la réunion
	function deja_inscrit_projet($participants){
		$table_participants = explode('|', $participants);
		foreach($table_participants as $id){
			if($_SESSION['id'] == $id){
				return true; //Deja inscrit à la réunion
			}
		}
		return false; // Pas inscrit à la réunion
	}
	
	
?>
<script type="text/javascript" src="javascript/jquery.js"></script>
<script type="text/javascript" src="javascript/supprimer_modif.js"></script>
<section id="projets">
	<?php
	if(!$logger){
		echo "<div>Vous devez être connecté pour acceder cette page</div>";
	}else{
		echo "<header>Projets</header>";
		if($_SESSION['grade'] > 0){
				echo "<div><a href='index.php?where=projet_nouveau'><img src='ressources/more.png' alt='Ajouter' title='Ajouter'>	Ajouter un nouveau projet</a></div>";
			}else{
				echo "<div>Pour créer un projet vous devez faire parti de l'organigramme</div>";
			}
		echo liste_projet();
	}
	?>
</section>