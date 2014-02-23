<?php
	
	$erreur = "";
	$ajouter_succes;
	$recuperation_succes;
	$infos_reunion;
	
	//Renvoi balise <option> de 1 a 31
	function select_jour(){
		global $infos_reunion;
		$r = "";
		for($i = 1; $i < 32; $i++){
			if($i == $infos_reunion['jour']){
				$r .= "<option value='{$i}' selected>{$i}</option>";
			}else{
				$r .= "<option value='{$i}'>{$i}</option>";
			}
		}
		return $r;
	}
	
	//Renvoi balise <option> de Janvier a Décembre
	function select_mois(){
		global $infos_reunion;
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
			if($i == $infos_reunion['mois']){
				$r .= "<option value='{$i}' selected>{$v}</option>";
			}else{
				$r .= "<option value='{$i}'>{$v}</option>";
			}
		}
		return $r;
	}
	
	//Renvoi balise <option> de annee actuelle à +10
	function select_annee(){
		global $infos_reunion;
		$annee_actuelle = date("Y");
		$r = "";
		for($i = $annee_actuelle; $i < ($annee_actuelle+11); $i++){
			if($i == $infos_reunion['annee']){
				$r .= "<option value='{$i}' selected>{$i}</option>";
			}else{
				$r .= "<option value='{$i}'>{$i}</option>";
			}
		}
		return $r;
	}
	
	//Renvoi balise <option> de 0 à 23h
	function select_heure(){
		global $infos_reunion;
		$r = "";
		for($i = 0; $i < 24; $i++){
			if($i == $infos_reunion['heure']){
				$r .= "<option value='{$i}' selected>{$i}</option>";
			}else{
				$r .= "<option value='{$i}'>{$i}</option>";
			}
		}
		return $r;
	}
	
	//Renvoi balise <option> de 0, 15, 30 et 45 min
	function select_minute(){
		global $infos_reunion;
		$r = "";
		for($i = 0; $i <= 45; $i=$i+15){
			if($i == $infos_reunion['minute']){
				$r .= "<option value='{$i}' selected>{$i}</option>";
			}else{
				$r .= "<option value='{$i}'>{$i}</option>";
			}
		}
		return $r;
	}
	
	//Verifie que le formulaire est correctement et renvoi les erreurs si necessaire
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
	
	//Ajoute la réunion à la base de donnée
	function ajoute_reunion(){
		global $ajouter_succes;
		global $erreur;
		$erreur = formulaire_bien_rempli();
		
		if(strlen($erreur) != 0 ){
			echo "fail";
			$ajouter_succes = false;
		}else{
			$requete = sprintf("UPDATE reunions SET titre = '%s', description = '%s', date = '%s', heure = '%s' WHERE id = '%s'",
								mysql_real_escape_string(htmlspecialchars($_POST['titre'])),
								mysql_real_escape_string(htmlspecialchars($_POST['description'])),
								mysql_real_escape_string(htmlspecialchars(date_format_mysql())),
								mysql_real_escape_string(htmlspecialchars(heure_format_mysql())),
								mysql_real_escape_string(htmlspecialchars($_GET['id'])));
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
	
	//Ajoute a $infos_reunion le mois, le jour et l'annee
	function date_format_html($date){
		$date_table = explode('-', $date);
		global $infos_reunion;
		
		//annee
		$infos_reunion['annee'] = $date_table[0];
		
		//jour
		if($date_table[2][0] == "0"){
			$infos_reunion['jour'] = $date_table[2][1];
		}else{
			$infos_reunion['jour'] = $date_table[2];
		}	
		
		//mois
		if($date_table[1][0] == "0"){
			$infos_reunion['mois'] = $date_table[1][1];
		}else{
			$infos_reunion['mois'] = $date_table[1];
		}
	}	
	
	//Ajoute a $infos_reunion l'heure et la minute
	function heure_format_html($heure_sql){
		global $infos_reunion;
		$heure_table = explode(':', $heure_sql);
		
		//heure
		if($heure_table[0][0] == "0"){
			$infos_reunion['heure'] = $heure_table[0][1];
		}else{
			$infos_reunion['heure'] = $heure_table[0];
		}
		
		//minute
		if($heure_table[1][0] == "0"){
			$infos_reunion['minute'] = $heure_table[1][1];
		}else{
			$infos_reunion['minute'] = $heure_table[1];
		}
	}
	
	//Recupère les informations de la réunion à modifier
	function recuperer_info_reunion(){
		global $recuperation_succes;
		
		if(isset($_GET['id'])){
			$requete = sprintf("SELECT titre, description, date, heure FROM reunions WHERE id = '%s'",
								mysql_real_escape_string(htmlspecialchars($_GET['id'])));
			$donnee = connexion($requete);
			if(mysql_num_rows($donnee) == 1){
				$recuperation_succes = true;
				global $infos_reunion;
				$infos_reunion = mysql_fetch_assoc($donnee);
				date_format_html($infos_reunion['date']);
				heure_format_html($infos_reunion['heure']);
			}else{
				$recuperation_succes = false;
			}
		}else{
			$recuperation_succes = false;
		}
	}
	
	//Incremente compteur du nombre d'écriture
	function incremente_nbr_ecriture(){
		$requete = 'UPDATE identifiant SET nbr_ecriture = "'.($_SESSION["nbr_ecriture"]+1).'" WHERE id="'.$_SESSION['id'].'"';
		connexion($requete);
	}
	
	
	if(formulaire_rempli()){
		ajoute_reunion();
	}else{
		recuperer_info_reunion();
	}
	
?>
<script type="text/javascript" src="javascript/jquery.js"></script>
<script type="text/javascript" src="javascript/aide_titre.js"></script>
<section id="reunion_editer">
<?php
	if(!$logger){
		echo "<div>Vous devez être connecté pour acceder à cette page.</div>";
		echo "<div><a href='index.php'>Retour à l'accueil</a></div>";
	}else if($_SESSION['grade'] == 0){
		echo "<div>Vous devez appartenir à l'organigramme pour créer une réunion.</div>";
		echo "<div><a href='index.php?where=reunion'>Retour à la liste des réunions</a></div>";
	}else if(isset($recuperation_succes) && !$recuperation_succes){
		echo "<div>Impossible de récupérer les informations de la réunion selectionnée</div>";
		echo "<div><a href='index.php?where=reunion'>Retour à la liste des réunions</a></div>";
	}else if(isset($ajouter_succes) && $ajouter_succes){
		echo "<div>La réunion a été actualisé avec succes.</div>";
		echo "<div><a href='index.php?where=reunion'>Retour à la liste des réunions</a></div>";
	}else{
?>
	<header>Editer la réunion</header>
	<?php echo $erreur; ?>
	<table>
		<form method="POST">
			<tr>
				<td><label for="titre">Titre</label></td>
			</tr>
			<tr>
				<td>
					<div id="article_editer_titre">
						<input type="text" name="titre" id="titre" value="<?php echo $infos_reunion['titre']; ?>" size=80 >
						<span id="aide_titre">
							<span id="aide_titre_compteur"><?php echo strlen($infos_reunion['titre']); ?></span>
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
				<td><select name="heure"><?php echo select_heure(); ?></select>
				<select name="minute"><?php echo select_minute();?></select></td>
			</tr>
			<tr>
				<td><label for="description">Description</label></td>
			</tr>
			<tr>
				<td><textarea name="description" id="description" cols=60 rows=15><?php echo $infos_reunion['description']; ?></textarea></td>
			</tr>
			<tr>
				<td><input type="submit" value="Envoyer"></td>
			</tr>
		</form>
	</table>
	<?php } //ferme le else ?>
</section>