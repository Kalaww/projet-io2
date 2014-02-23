<?php 
	$infos_articles;
	$formulaire_succes = false;
	$erreur = "";
	
	// Vérifie si le titre est bien rempli
	function formulaire_new_article(){
		if(strlen($_POST['titre']) > 60){
			return "<div style='color:red;'>Le titre est trop long! 60 caractères maximum</div>";
		}else if(strlen($_POST['titre']) == 0){
			return "<div style='color:red;'>Le titre n'est pas renseigné</div>";
		}else{
			return "";
		}
	}
	
	//Verifie si le formulaire est rempli
	function formulaire_rempli(){
		return isset($_POST['titre'], $_POST['contenu']);
	}
	
	//Recupère les infos sur l'article à éditer
	function recup_article(){
		$requete = sprintf("SELECT titre, text FROM articles WHERE id='%s'",
							mysql_real_escape_string(htmlspecialchars($_GET['id'])));
		$donnee = connexion( $requete);
		global $infos_articles;
		$infos_articles = mysql_fetch_assoc($donnee);
	}
	
	//Recup id du modificateurs :
	function ajouter_modificateur(){
		$requete	= sprintf("SELECT modificateur FROM articles WHERE id='%s'",
								mysql_real_escape_string(htmlspecialchars($_GET['id'])));
		$donnee		= connexion($requete);
		$cellule	= mysql_fetch_assoc($donnee);
		
		$date =  date("d-m-Y");
		
		$temp = "";
		if(strlen($cellule['modificateur']) == 0){ // si c'est le premier modificateur
			$temp = "{$_SESSION['id']}-{$date}";
		}else{
			$old = deja_modifier($cellule['modificateur']);
			if(strlen($old) == 0){
				$temp = "{$_SESSION['id']}-{$date}";
			}else{
				$temp = "{$_SESSION['id']}-{$date}|{$old}";
			}
		}
		
		$requete1	= sprintf("UPDATE articles SET modificateur ='{$temp}' WHERE id ='%s'",
								mysql_real_escape_string(htmlspecialchars($_GET['id'])));
		connexion($requete1);
	}
	
	//Renvoi la chaine de caractere des modifieurs sans l'utilisateur courant
	function deja_modifier($old){
		$old_table = explode("|", $old);
		$res = "";
		
		foreach($old_table as $i=>$v){
			$modifieur_courant = explode("-", $v);
			if($modifieur_courant[0]	 != $_SESSION["id"]){
				$res .= $v."|";
			}
		}
		return substr($res, 0, -1);
	}
		
	//Verifi si la personne qui modifi a deja modifié l'article avant
	function exploser($v){
		$tab = explode( "|" , $v);
		
		foreach( $tab as $cle => $valeur){
			if($valeur == $_SESSION['id']){
					$i=0;
					$res= "";
					while( $cle != 0){
						$res .= $v[$i];
						if ($v[$i] == "|"){
							$cle--;
						}
						$i++;
					}
					
					while( $v[$i] != "|"){
						$i++;
					}
					$i++;
					$longueur=strlen($v);
					
					while( $i < $longueur){
						$res .= $v[$i];
						$i++;
					}
					return $res;
				}
			}
		return $v;
	}		
		
	//Edite l'article dans la base de donnée
	function editer(){
		global $erreur;
		$erreur = formulaire_new_article();
		if(strlen($erreur) == 0){
			ajouter_modificateur();
			$requete = sprintf("UPDATE articles SET titre = '%s', text = '%s' WHERE id = '%s'",
								mysql_real_escape_string(htmlspecialchars($_POST['titre'])),
								mysql_real_escape_string(htmlspecialchars($_POST['contenu'])),
								mysql_real_escape_string(htmlspecialchars($_GET['id'])));
			connexion( $requete);
			incremente_nbr_ecriture();
			global $formulaire_succes;
			$formulaire_succes = true;
		}
	}
	
	//Incremente compteur du nombre d'écriture
	function incremente_nbr_ecriture(){
		$requete = 'UPDATE identifiant SET nbr_ecriture = "'.($_SESSION["nbr_ecriture"]+1).'" WHERE id="'.$_SESSION['id'].'"';
		connexion( $requete);
	}
	
	if(formulaire_rempli()){
		editer();
	}
	
?>
<script type="text/javascript" src="javascript/jquery.js"></script>
<script type="text/javascript" src="javascript/aide_titre.js"></script>
<section id="article_editer">
	<?php 	
		if(!$logger){
			echo "<div>Vous devez être connecté pour modifier un article</div>";
			echo "<div><a href='index.php?where=article'>Retour vers la liste des articles</a></div>";
		}else if(formulaire_rempli() && $formulaire_succes){
			echo "<div>L'article à bien été modifié</div>";
			echo "<div><a href='index.php?where=article&amp;id={$_GET['id']}'>Retour vers l'article</a></div>";
		}else{
			recup_article();
			echo $erreur;
	?>
	<header>Editer l'article</header>
	<form method="POST" action="index.php?where=article_editer&id=<?php echo htmlspecialchars($_GET["id"]) ?>" >
		<table>
			<tr>
				<td><label for="titre">Titre :</label></td>
			</tr>
			<tr>
				<td>
					<div id="article_editer_titre">
						<input type="text" name="titre" id="titre" value="<?php echo $infos_articles['titre']; ?>" size=80 >
						<span id="aide_titre">
							<span id="aide_titre_compteur"><?php echo strlen($infos_articles['titre']); ?></span>
							<span>/60 caractères maximum</span>
						</span>
					</div>
				</td>
			</tr>
			<tr>
				<td><label for="contenu">Contenu :</label><div style="color: rgb(140,140,140);">Pour tagger une personne, utiliser la syntaxe suivant : pseudo@le-pseudo-a-tagger@</div></td>
			</tr>
			<tr>
				<td><textarea name="contenu" id="contenu" cols=60 rows=30><?php echo htmlspecialchars($infos_articles['text']); ?></textarea> </td>
			</tr>
			<tr>
				<td><input type="submit" value="Envoyer"></td>
			</tr>
		</table>
	</form>
	<?php } ?>
</section>
