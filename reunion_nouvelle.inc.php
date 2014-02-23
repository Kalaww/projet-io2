<?php
	
	$erreur = "";
	$ajouter_succes = false;
	
	//Renvoi balise <option> de 1 a 31
	function select_jour(){
		$r = "";
		for($i = 1; $i < 32; $i++){
			$r .= "<option value='{$i}'>{$i}</option>";
		}
		return $r;
	}
	
	//Renvoi balise <option> de Janvier a Décembre
	function select_mois(){
		$mois = array(	"1"=>"Janvier",
						"2"=>"Fevrier",
						"3"=>"Mars", 
						"4"=>"Avril", 
						"5"=>"Mai", 
						"6"=>"Juin", 
						"7"=>"Juillet", 
						"8"=>"Aout", 
						"9"=>"Septembre", 
						"10"=>"Octobre", 
						"11"=>"Novembre", 
						"12"=>"Decembre");
		$r = "";
		foreach($mois as $i=>$v){
			$r .= "<option value='{$i}'>{$v}</option>";
		}
		return $r;
	}
	
	//Renvoi balise <option> de annee actuelle à +10
	function select_annee(){
		$annee_actuelle = date("Y");
		$r = "";
		for($i = $annee_actuelle; $i < ($annee_actuelle+11); $i++){
			$r .= "<option value='{$i}'>{$i}</option>";
		}
		return $r;
	}
	
	//Renvoi balise <option> de 0 à 23h
	function select_heure(){
		$r = "";
		for($i = 0; $i < 24; $i++){
			$r .= "<option value='{$i}'>{$i}</option>";
		}
		return $r;
	}
	
	//Renvoi balise <option> de 0, 15, 30 et 45 min
	function select_minute(){
		$r = "";
		for($i = 0; $i <= 45; $i=$i+15){
			$r .= "<option value='{$i}'>{$i}</option>";
		}
		return $r;
	}
	
	//Verifie que le formulaire est correctement rempli et renvoi les erreurs si necessaire
	function formulaire_bien_rempli(){
		$erreur = "";
		
		//Titre
		if(strlen($_POST['titre']) > 60 || strlen($_POST['titre']) == 0){
			$erreur .= "<div style='color:red;'>Le titre est mal renseigné</div>";
		}
		
		//Date
		if(!checkdate($_POST['mois'], $_POST['jour'], $_POST['annee'])){
			$erreur .= "<div style='color:red;'>La date choisit n'existe pas</div>";
		}
		
		//Heure
		if(!is_numeric($_POST['heure']) || $_POST['heure'] < 0 || $_POST['heure'] > 23){
			$erreur .= "<div style='color:red;'>L'heure n'est pas valide</div>";
		}
		
		//Minute
		if(!is_numeric($_POST['minute']) || $_POST['minute'] > 45 || $_POST['minute'] < 0 || $_POST['minute']%15 != 0){
			$erreur .= "<div style='color:red;'>La minute n'est pas valide</div>";
		}
		
		return $erreur;
	}
	
	//Boolean test si tous les _POST sont bien définis
	function formulaire_rempli(){
		return isset($_POST['titre'], $_POST['description'], $_POST['jour'], $_POST['mois'], $_POST['annee'], $_POST['heure'], $_POST['minute']);
	}
	
	//Ajoute la réunion à la base de données
	function ajoute_reunion(){
		global $ajouter_succes;
		global $erreur;
		$erreur = formulaire_bien_rempli();
		
		if(strlen($erreur) != 0 ){
			$ajouter_succes = false;
		}else{
			$requete = sprintf("INSERT INTO reunions(titre, description, date, heure) VALUES('%s', '%s', '%s', '%s')",
								mysql_real_escape_string(htmlspecialchars($_POST['titre'])),
								mysql_real_escape_string(htmlspecialchars($_POST['description'])),
								mysql_real_escape_string(htmlspecialchars(date_format_mysql())),
								mysql_real_escape_string(htmlspecialchars(heure_format_mysql())));
			connexion($requete);
			$ajouter_succes = true;
			incremente_nbr_ecriture();
		}
	}
	
	//Renvoi la date au format MySQL
	function date_format_mysql(){
		$jour = $_POST['jour'];
		$mois = $_POST['mois'];

		if($_POST['jour'] < 10){
			$jour = "0".$jour;
		}
		
		if($_POST['mois'] < 10){
			$mois = "0".$mois;
		}
		
		return $_POST['annee']."-".$mois."-".$jour;
	}
	
	//Renvoi l'heure au format MySQL
	function heure_format_mysql(){
		$heure = $_POST['heure'];
		$minute = $_POST['minute'];
		
		if($_POST['heure'] < 10){
			$heure = "0".$heure;
		}
		
		if($_POST['minute'] < 10){
			$minute = "0".$minute;
		}
		
		return $heure.':'.$minute.':00';
	}
	
	//Incremente compteur du nombre d'écriture
	function incremente_nbr_ecriture(){
		$requete = 'UPDATE identifiant SET nbr_ecriture = "'.($_SESSION["nbr_ecriture"]+1).'" WHERE id="'.$_SESSION['id'].'"';
		connexion($requete);
	}
	
	if(formulaire_rempli()){
		ajoute_reunion();
	}
	
?>
<script type="text/javascript" src="javascript/jquery.js"></script>
<script type="text/javascript" src="javascript/aide_titre.js"></script>
<section id="reunion_nouvelle">
<?php
	if(!$logger){
		echo "<div>Vous devez être connecté pour acceder à cette page.</div>";
		echo "<div><a href='index.php'>Retour à l'accueil</a></div>";
	}else if($_SESSION['grade'] == 0){
		echo "<div>Vous devez appartenir à l'organigramme pour créer une réunion.</div>";
		echo "<div><a href='index.php?where=reunion'>Retour à la liste des réunions</a></div>";
	}else if($ajouter_succes){
		echo "<div>La réunion a été ajouté avec succes.</div>";
		echo "<div><a href='index.php?where=reunion'>Retour à la liste des réunions</a></div>";
	}else{
?>
	<header>Nouvelle Réunion</header>
	<?php echo $erreur; ?>
	<table>
		<form method="POST">
			<tr>
				<td><label for="titre">Titre</label></td>
			</tr>
			<tr>
				<td>
					<div id="article_editer_titre">
						<input type="text" name="titre" id="titre" size=80 >
						<span id="aide_titre">
							<span id="aide_titre_compteur">0</span>
							<span>/60 caractères maximum</span>
						</span>
					</div>
				</td>
			</tr>
			<tr>
				<td>Date</td>
			</tr>
			<tr>
				<td><select name="jour"><?php echo select_jour(); ?></select>
				<select name="mois"><?php echo select_mois(); ?></select>
				<select name="annee"><?php echo select_annee(); ?></select></td>
			</tr>
			<tr>
				<td>Heure</td>
			</tr>
			<tr>
				<td><select name="heure"><?php echo select_heure(); ?></select>h
				<select name="minute"><?php echo select_minute();?></select>min</td>
			</tr>
			<tr>
				<td><label for="description">Description</label></td>
			</tr>
			<tr>
				<td><textarea name="description" id="description" cols=60 rows=15></textarea></td>
			</tr>
			<tr>
				<td><input type="submit" value="Envoyer"></td>
			</tr>
		</form>
	</table>
	<?php } //ferme le else ?>
</section>