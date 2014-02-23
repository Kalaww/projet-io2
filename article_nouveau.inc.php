<?php

	$erreur = "";
	$formulaire_succes = false;
	$infos_modificateurs;
	
	
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
	
	//Ajoute l'article à la base de donnée articles
	function ajouter_news(){
		global $erreur;
		$erreur = formulaire_new_article();
		if(strlen($erreur) == 0){
			if(isset($_POST['statut'])){
				$requete = sprintf("INSERT INTO articles(titre, text, auteur, date, statut)
												VALUES(	'%s', '%s', '{$_SESSION["id"]}', NOW(), '%s')",
									mysql_real_escape_string(htmlspecialchars($_POST['titre'])),
									mysql_real_escape_string(htmlspecialchars($_POST['contenu'])),
									mysql_real_escape_string(htmlspecialchars($_POST['statut'])));
			}else{
				$requete = sprintf("INSERT INTO articles(titre, text, auteur, date, statut) 
												VALUES('%s', '%s', '{$_SESSION["id"]}', NOW(), '1')",
									mysql_real_escape_string(htmlspecialchars($_POST['titre'])),
									mysql_real_escape_string(htmlspecialchars($_POST['contenu'])));
			}
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
		ajouter_news();
	}
	

?>
<script type="text/javascript" src="javascript/jquery.js"></script>
<script type="text/javascript" src="javascript/aide_titre.js"></script>
<section id="article_nouveau">
<?php
	if(!$logger){
		echo "<div>Vous devez être connecté pour ajouter un article</div>";
		echo "<div><a href='index.php?where=article'>Retour vers la liste des articles</a></div>";
	}else if(formulaire_rempli() && $formulaire_succes){
		echo "<div>L'article a été ajouté au site</div>";
		echo "<div><a href='index.php?where=article'>Retour vers la liste des articles</a></div>";
	}else{ echo $erreur;
	?>
	<header>Rédiger un nouvel article</header>
	<form method="POST" action="index.php?where=article_nouveau">
	<table>
		<tr>
			<td><label for="titre">Titre :</label></td>
		</tr>
		<tr>
			<td>
				<div id="article_nouveau_titre">
					<input type="text" name="titre" id="titre" size=80>
					<span id="aide_titre">
						<span id="aide_titre_compteur">0</span>
						<span>/60 caractères maximum</span>
					</span>
				</div>
			</td>
		</tr>
		<tr>
			<td><label for="contenu">Contenu :</label><div style="color: rgb(140,140,140);">Pour tagger une personne, utiliser la syntaxe suivant : pseudo@le-pseudo-a-tagger@</div></td>
		</tr>
		<tr>
			<td><textarea name="contenu" id="contenu" cols=60 rows=30></textarea></td>
		</tr>
		<?php if($_SESSION['grade'] > 0){ ?>
		<tr>
			<td>Article
				<input type="radio" name="statut" value="0" id="public">
				<label for="public">public</label>
				<input type="radio" name="statut" value="1" id="prive" checked>
				<label for="prive">privé</label>
			</td>
		</tr>
		<?php } ?>
		<tr>
			<td><input type="submit" value="Envoyer"></td>
		</tr>
	</table>
	</form>
	<?php if($_SESSION['grade'] == 0){
				echo "<div>L'article sera privé par défaut</div>";
			}
	} ?>
</section>