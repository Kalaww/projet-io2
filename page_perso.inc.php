<?php
	
	$erreur = "";
	
	if($logger){
		generer_session($_SESSION['login']); // Mise à jour des infos de l'utilisateur
	}
	
	//Renvoi vrai si tout le formulaire est rempli
	function formulaire_rempli(){
		if(isset($_POST['prenom'], $_POST['nom'], $_POST['age'], $_POST['description'], $_POST['code'])){
			editer();
		}
	}
	
	//Vérifie si le formulaire est correctement rempli
	function formulaire_correct(){
		$erreur = "";
		// prenom
		$temp = clean($_POST["prenom"]);
		if(!ctype_alpha($temp) || (strlen($temp) < 3)){
			$erreur .= "<div style='color:red;'>Le prenom est mal renseigné</div>";
		}
		//nom
		$temp = clean($_POST["nom"]);
		if(!ctype_alpha($temp) || strlen($temp) < 3){
			$erreur .= "<div style='color:red;'>Le nom est mal renseingé</div>";
		}
		//code postal
		if(!is_numeric($_POST['code']) || strlen($_POST['code']) != 5){
			$erreur .= "<div style='color:red;'>Le code postal est mal renseigné</div>";
		}
		//age
		if(!is_numeric($_POST['age']) || $_POST['age'] < 1 || $_POST['age'] > 120){
			$erreur .= "<div style='color:red;'>L'âge est mal renseigné</div>";
		}
		//mdp
		$requete = "SELECT mdp FROM identifiant WHERE id='{$_SESSION['id']}'";
		$donnees = connexion($requete);
		if(mysql_num_rows($donnees) != 1){
			$erreur .= "<div style='color:red;'>Erreur, reessayez</div>";
		}else{
			$ligne = mysql_fetch_assoc($donnees);
			if(md5($_POST['mdp']) != $ligne['mdp']){
				$erreur .= "<div style='color:red;'>Mot de passe incorrect</div>";
			}
		}
		return $erreur;
	}

	//Enlève tous les accents d'une chaine de caractère
	function clean($toClean) {   
		$accent = array(
		'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 
		'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 
		'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 
		'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 
		'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 
		'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 
		'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f');	
		return strtr($toClean, $accent);
	}
	
	//Edite le profil selon le formulaire
	function editer(){
		global $erreur;
		$erreur = formulaire_correct();
		if(strlen($erreur) == 0){
			$requete = sprintf("UPDATE identifiant SET 	nom = '%s', prenom = '%s', sexe = '%s', code = '%s', age = '%s', description = '%s' WHERE id = '{$_SESSION["id"]}'",
								mysql_real_escape_string(htmlspecialchars($_POST["nom"])),
								mysql_real_escape_string(htmlspecialchars($_POST["prenom"])),
								mysql_real_escape_string(htmlspecialchars($_POST["sexe"])),
								mysql_real_escape_string(htmlspecialchars($_POST["code"])),
								mysql_real_escape_string(htmlspecialchars($_POST["age"])),
								mysql_real_escape_string(htmlspecialchars($_POST["description"])));
			connexion($requete);
			generer_session($_SESSION['login']);
		}
	}
	
	 //Afficher l'image en fonction du grade
	 function affiche_image(){
		if($_SESSION['grade']==0){
		return"<img src='ressources/membre.png' title='Membre' alt='Membre'>";
		}
		if($_SESSION['grade']==10){
		return "<img src='ressources/users.png' title='Conseil' alt='Membre du conseil'>";
		}
		if($_SESSION['grade']==20){
		return "<img src='ressources/admin.png' title='Vice president' alt='Vice president'>";
		}
		if($_SESSION['grade']==30){
		return "<img src='ressources/boss.png' title='President' alt='President'>";
		}
	}
	
	//Affiche les article de la personne
	function mes_articles(){
		$requete = "SELECT titre, id FROM articles WHERE auteur='{$_SESSION['id']}'";
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
			return "<div>Vous avez rédigé aucun article</div>";
		}
	}
	
	formulaire_rempli();
	
?>
<section id="page_perso">
	<?php if($logger){ //Si l'on est loggé, on affiche le profil ?>
	<div class="partie">
		<header>Mon Profil</header>
		<div> 
			<?php echo affiche_image(); ?>
			<div>
				<div>Nom : <?php echo $_SESSION['nom']; ?></div>
				<div>Prénom : <?php echo $_SESSION['prenom']; ?></div>
				<div>Pseudonyme : <?php echo $_SESSION['login']; ?></div>
				<div>Date d'inscription : <?php echo conversion_date($_SESSION['date_inscription']); ?></div>
				<div>Nombre de connexions : <?php echo $_SESSION['nbr_connexion']; ?></div>
				<div>Nombre d'articles/réunions/projets rédigés/modifiés : <?php echo $_SESSION['nbr_ecriture']; ?></div>
				<div>Age : <?php echo $_SESSION['age']; ?></div>
			</div>
			<div id="mes_articles">
				<header>Mes articles :</header>
				<?php echo mes_articles(); ?>
			</div>
		</div>
	</div>
	<div class="partie">
		<header>Modifier mes informations</header>
		<?php echo $erreur; ?>
		<form  method="POST">
		<table id="formulaire_inscription">
			<tr>
				<td>
					<label for="no" >Prénom :</label>
				</td>
				<td class="td_input">
					<input type="text" name="prenom" id="no" class="input_js" value="<?php echo $_SESSION['prenom']; ?>">
					<span class="bulle_aide">3 caractères minimum</span>
				</td>
			</tr>
			<tr>
				<td> 
					<label for="nom">Nom :</label>
				</td>
				<td class="td_input">
					<input type="text" name="nom" id="nom" class="input_js" value="<?php echo $_SESSION['nom']; ?>">
					<span class="bulle_aide">3 caractères minimum</span>
				</td>
			</tr>
			<tr>
				<td>
					Sexe :
				</td>
				<td class="td_input">
				<label for="h">Homme</label> <input type="radio" name="sexe" value="h" <?php if($_SESSION['sexe'] == 'h') {echo 'checked';} ?> id="h">
				<label for="f">Femme</label> <input type="radio" name="sexe" value="f" <?php if($_SESSION['sexe'] == 'f') {echo 'checked';} ?> id="f">
				</td>
			</tr>
			<tr>
				<td>
					<label for="age">Age :</label>
				</td>
				<td class="td_input">
					<input type="text" name="age" id="age" class="input_js" value="<?php echo $_SESSION['age']; ?>">
					<span class="bulle_aide">Entre 1 et 120 ans</span>
				</td>
			</tr>
			<tr>
				<td>	
					<label for="code">Code postal :</label>
				</td>
				<td class="td_input">
					<input type="text" name="code" id="code" class="input_js" value="<?php echo $_SESSION['code']; ?>">
					<span class="bulle_aide">5 chiffres</span>
				</td>
			</tr>
			<tr>
				<td>
					<label for="des">Description :</label>
				</td>
				<td class="td_input">
					<textarea name="description" id="des" cols=30 rows=8><?php echo $_SESSION['description']; ?></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<label for="mdp">Entrer votre mot de passe :</label>
				</td>
				<td class="td_input">
					<input type="password" name="mdp" id="mdp">
				</td>
			</tr>
			<tr>
				<td>
					<label for="sub">Enregister les changements</label>
				</td>
				<td class="td_input">
					<input type="submit" name="submit" id="sub">
				</td>
			</tr>
		</table>
		</form>
	</div>
	<div class="partie" id="desincription">
		<div><a href="desinscription.php">Se désinscrire</a></div>
	</div>
	<?php 
		}else{ //sinon on affiche un message d'erreur
	?>
	<div class="partie">
		<div>Vous devez être connecté pour acceder à cette page</div>
	</div>
	<?php } ?>
</section>