<?php

	//Renvoi une liste des noms des membres
	function recup_nom(){
		if(formulaire_order_rempli()){
			$requete = requete_selon_order();
		}else if(formulaire_grade_rempli()){
			$requete = requete_selon_trier();
		}else{
			$requete = 'SELECT nom, prenom, id, grade FROM identifiant ORDER BY nom';
		}
		
		$donnee = connexion( $requete);
		$r = "<ul>";
		
		while($ligne= mysql_fetch_assoc($donnee)){
			
			$r .= 	'<li>
						<div>
							<a href="index.php?where=profil&id='.$ligne['id'].'"><header>'.$ligne["prenom"]." ".$ligne["nom"].'</header></a>
						</div>
						<div>
							<div>
								'.grade($ligne['grade']).'
							</div>
							<div class="adherent_form">';
			if($_SESSION['grade'] >= 20){
				if($ligne['grade'] < $_SESSION['grade'] && $_SESSION['grade'] != 30){
					$r .= moderation1($ligne['id']);
				}else if($_SESSION['grade']==30){
					$r .= moderation($ligne['id']);
				}
			}	
				$r .= '		</div>
						</div>
					</li>';
			}
		$r .= "</ul>";
		return $r;
	}
	
	//Retourne les options pour les modérateurs restraints
	function moderation1($id){
		return' <form method="POST" action="modification_grade.php">
						<select name="grade">
							<option value="0">Membre</option>
							<option value="10">Membre du Conseil d\'administration</option>
							<option value="20">Vice président</option>	
						</select>
						<input type="hidden" name="id" value="'.$id.'">
						<input type="submit" value="Ok">
					</form>';
	}
	
	//Retourne les options pour les modérateurs
	function moderation($id){
			return '<form method="POST" action="modification_grade.php">
						<select name="grade">
							<option value="0">Membre</option>
							<option value="10">Membre du Conseil d\'administration</option>
							<option value="20">Vice président</option>
							<option value="30">Président</option>
						</select>
						<input type="hidden" name="id" value="'.$id.'">
						<input type="submit" value="Ok">
					</form>';
	}
	
	//Retourne le grade 
	function grade($v){
		if($v == 30){
			return "Président";
		}else if($v == 20){
			return "Vice président";
		}else if($v == 10){
			return "Membre du Conseil d'administration";
		}else{
			return "Membre";
		}
	}
	
	//Renvoi vrai si le formulaire d'ordre est rempli
	function formulaire_order_rempli(){
		return isset($_GET['where'], $_GET['orderby'], $_GET['ordre']);
	}
	
	//Renvoi vrai si le formulaire des grades est rempli
	function formulaire_grade_rempli(){
		return isset($_GET['where'], $_GET['trier']);
	}
	
	//Genère la requete selon le formulaire order
	function requete_selon_order(){
		if($_GET['orderby'] == '2'){
			$orderby = 'grade';
		}else if($_GET['orderby'] == '3'){
			$orderby = 'date_inscription';
		}else{
			$orderby = 'nom';
		}
		if($orderby == 'grade' && $_GET['ordre'] == 'asc'){
			$ordre = 'DESC';
		}else if($orderby == 'grade' && $_GET['ordre'] == 'desc'){
			$ordre = 'ASC';
		}else if($_GET['ordre'] == 'desc'){
			$ordre = 'DESC';
		}else{
			$ordre = 'ASC';
		}
		
		return 'SELECT nom, prenom, id, grade FROM identifiant ORDER BY '.$orderby.' '.$ordre;
	}
	
	//Genère la requete selon le formulaire trier
	function requete_selon_trier(){
		if($_GET['trier'] == '2'){
			$grade = '10';
		}else if($_GET['trier'] == '3'){
			$grade = '20';
		}else if($_GET['trier'] == '4'){
			$grade = '30';
		}else{
			$grade = '0';
		}
		
		return "SELECT nom, prenom, id, grade FROM identifiant WHERE grade = {$grade}";
	}
	
?>
<section id="adherent">
	<?php if(!$logger){ ?>
	<div>
		Vous devez être connecté pour acceder à cette page
	</div>
	<?php }else{ ?>
	<header>Membres</header>
	<div>
		<form method="GET" action="index.php?where=adherents">
			<input type="hidden" name="where" value="adherents">
			<label for="orderby">Classé par : </label>
			<select name="orderby" id="orderby">
				<option value="1">Nom</option>
				<option value="2">Grade</option>
				<option value="3">Date d'inscription</option>
			</select>
			 dans l'ordre 
			<input type="radio" name="ordre" value="asc" id="asc" checked>
			<label for="asc">croissant</label>
			<input type="radio" name="ordre" value="desc" id="desc">
			<label for="desc">décroissant</label>
			<input type="submit" value="Recharger">
		</form>
		<form method="GET" action="index.php?where=adherents">
			<input type="hidden" name="where" value="adherents">
			<label for="trier">Récuperer que :</label>
			<select name="trier" id="trier">
				<option value="1">Membres</option>
				<option value="2">Membres du Conseil d'administration</option>
				<option value="3">Vice président</option>
				<option value="4">Président</option>
			</select>
			<input type="submit" value="Recharger">
		</form>
	</div>
	<?php echo recup_nom();
		}
		?>
	
</section>