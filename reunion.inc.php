<?php
	
	//Renvoi la liste des réunions
	function liste_reunions(){
		$requete = "SELECT * FROM reunions ORDER BY date ASC";
		$donnee = connexion($requete);
		
		if(mysql_num_rows($donnee) == 0){
			return 'Aucunes réunions n\'a été trouvé.';
		}
		
		$r = '';
		while($ligne = mysql_fetch_assoc($donnee)){
			$r .= "<li>";
			$r .= "<header id='reunion_{$ligne['id']}'>{$ligne['titre']}</header>";
			$r .= '<div class="date">
						<div>
							<img src="ressources/calendrier.png" title="Date" alt="Date">'.conversion_date($ligne['date']).'
						</div>
						<div>
							<img src="ressources/heure.png" title="Heure" alt="Heure">'.conversion_heure($ligne['heure']).'
						</div>
					</div>';
			$r .= "<p>{$ligne['description']}</p>";
			$r .= 	'<div class="participants">
						<header>Y participent :</header>
						<div>
							'.affichage_participants($ligne['participants']).'
						</div>';
			if(!deja_inscrit_reunion($ligne['participants'])){
				$r .= 	"<div class='inscription'>
							<form method='post' action='reunion_inscription.php'>
								<input type='hidden' name='id_reunion' value='{$ligne['id']}'>
								<input type='submit' value=\"S'inscrire\">
							</form>
						</div>
						</div>";
			}else{
				$r .= 	"<div class='inscription'>
							<form method='post' action='reunion_desincription.php'>
								<input type='hidden' name='id_reunion' value='{$ligne['id']}'>
								<input type='submit' value=\"Se désinscrire\">
							</form>
						</div>
						</div>";
			}
			$r .= bouton_edition_reunion($ligne['id']);
			$r .= '</li>';
		}
		return $r;
	}
	
	//Renvoi l'heure converti en chaine de caractère
	function conversion_heure($heure){
		$heure_table = explode(':', $heure);
		return $heure_table['0'].'h'.$heure_table['1'];
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
	function deja_inscrit_reunion($participants){
		$table_participants = explode('|', $participants);
		foreach($table_participants as $id){
			if($_SESSION['id'] == $id){
				return true; //Deja inscrit à la réunion
			}
		}
		return false; // Pas inscrit à la réunion
	}

	//Renvoi les boutons d'édition si on peut modifier la réunion
	function bouton_edition_reunion($id){
		global $logger;
		$res = '';
		
		if($logger && $_SESSION['grade'] > 0){
			$res .= "<div class='reunion_edite'>
						<span><a href='index.php?where=reunion_editer&amp;id={$id}'>
								<img src='ressources/editer.png' title='Editer' alt='Editer'></a>
						</span>
						<span class='suppr'>
							<img src='ressources/supprimer.png' title='Supprimer' alt='Supprimer'>
						</span>
					</div>
					<div>
						<form method='post' action='reunion_supprimer.php'>
							<input type='hidden' name='id' value='{$id}'>
						</form>
					</div>";
		}	
		return $res;
	}
	
?>
<script type="text/javascript" src="javascript/jquery.js"></script>
<script type="text/javascript" src="javascript/supprimer_modif.js"></script>
<section id="reunion">
<?php 	if($logger){
			echo "<header>Réunions</header>";
			if($_SESSION['grade'] > 0){
				echo "<div><a href='index.php?where=reunion_nouvelle'><img src='ressources/more.png' alt='Ajouter' title='Ajouter'>	Ajouter une nouvelle réunion</a></div>";
			}else{
				echo "<div>Pour créer une réunion vous devez faire parti de l'organigramme</div>";
			}
			echo "<ul>".liste_reunions()."</ul>";
		}else{
			echo "<p>Vous devez être connecté pour acceder à cette page</p>";
		}
	?>
</section>