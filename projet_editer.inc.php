<?php
	
	$erreur = "";
	$recuperation_succes;
	$infos_projet;
	$ajouter_succes = false;
	
	//Recupere les infos du projet
	function recuperation_projet(){
		global $recuperation_succes;
		global $infos_projet;
		$requete = sprintf("SELECT titre, description, etat FROM projets WHERE id = '%s'",
							mysql_real_escape_string(htmlspecialchars($_GET['id'])));
		$donnees = connexion($requete);
		
		if(mysql_num_rows($donnees) != 1){
			$recuperation_succes = false;
		}else{
			$infos_projet = mysql_fetch_assoc($donnees);
			$recuperation_succes = true;
		}
	}
	
	//Verifi que le formulaire est correctement rempli et renvoi les erreurs si necessaire
	function formulaire_bien_rempli(){
		$erreur = "";
		
		//Titre
		if(strlen($_POST['titre']) > 60 || strlen($_POST['titre']) == 0){
			$erreur .= "<div style='color:red;'>Le titre est mal renseigné</div>";
		}
		
		return $erreur;
	}
	
	//Boolean test si tous les _POST sont bien définis
	function formulaire_rempli(){
		return isset($_POST['titre'], $_POST['description']);
	}
	
	//Ajoute le projet à la base de données
	function ajoute_projet(){
		global $ajouter_succes;
		global $erreur;
		$erreur = formulaire_bien_rempli();
		
		if(strlen($erreur) != 0){
			$ajoute_succes = false;
		}else{
			$requete = sprintf("UPDATE projets SET titre = '%s', description = '%s', etat = '%s' WHERE id = '%s'",
								mysql_real_escape_string(htmlspecialchars($_POST['titre'])),
								mysql_real_escape_string(htmlspecialchars($_POST['description'])),
								mysql_real_escape_string(htmlspecialchars($_POST['avancement'])),
								mysql_real_escape_string(htmlspecialchars($_GET['id'])));
			connexion($requete);
			$ajouter_succes = true;
			incremente_nbr_ecriture();
		}
	}
	
	//Incremente compteur du nombre d'écriture
	function incremente_nbr_ecriture(){
		$requete = 'UPDATE identifiant SET nbr_ecriture = "'.($_SESSION["nbr_ecriture"]+1).'" WHERE id="'.$_SESSION['id'].'"';
		connexion($requete);
	}
	
	
	if(formulaire_rempli() && isset($_GET['id'])){
		ajoute_projet();
	}else if(isset($_GET['id'])){
		recuperation_projet();
	}
	
?>
<script type="text/javascript" src="javascript/jquery.js"></script>
<script type="text/javascript" src="javascript/aide_titre.js"></script>
<section id="projet_editer">
	<?php
	if(!$logger){
		echo "<div>Vous devez être connecté pour acceder à cette page.</div>";
	}else if($_SESSION['grade'] == 0){
		echo "<div>Vous devez appartenir à l'organigramme pour créer un projet.</div>";
	}else if(!isset($_GET['id']) || isset($recuperation_succes) && !$recuperation_succes){
		echo "<div>Aucun projet selectionné</div>";
	}else if($ajouter_succes){
		echo "<div>Le projet a été modifié avec succes.</div>";
	}else{
	?>
	<header>Editer le projet</header>
	<table>
		<form method="POST">
			<tr>
				<td><label for="titre">Titre</label></td>
			</tr>
			<tr>
				<td>
					<div id="article_editer_titre">
						<input type="text" name="titre" id="titre" value="<?php echo $infos_projet['titre']; ?>" size=80 >
						<span id="aide_titre">
							<span id="aide_titre_compteur"><?php echo strlen($infos_projet['titre']); ?></span>
							<span>/60 caractères maximum</span>
						</span>
					</div>
				</td>
			</tr>
			<tr>
				<td><label for="description">Description</label></td>
			</tr>
			<tr>
				<td><textarea name="description" id="description" cols=60 rows=20><?php echo $infos_projet['description']; ?></textarea></td>
			</tr>
			<tr>
				<td>Avancement</td>
			</tr>
			<tr>
				<td><label for="encours">En cours</label><input type="radio" name="avancement" value="0" id="encours" <?php if(!$infos_projet['etat']){ echo "checked";} ?>>
					<label for="terminer">Terminé<label><input type="radio" name="avancement" value="1" id="terminer" <?php if($infos_projet['etat']){ echo "checked";} ?>>
				</td>
			<tr>
				<td><input type="submit" value="Envoyer"></td>
			</tr>
		</form>
	</table>
	<?php } ?>
</section>