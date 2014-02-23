<?php

	//Recupere les personnes de grade n
	function recup_personne_de_grade($grade){
		$requete = "SELECT id, nom, prenom FROM identifiant WHERE grade='{$grade}' ORDER BY nom ASC";
		$donnee = connexion($requete);
		if(mysql_num_rows($donnee) > 0){
			$res = "<ul>";
			while($ligne = mysql_fetch_assoc($donnee)){
				$res .= "<li><a href='index.php?where=profil&amp;id={$ligne['id']}'>{$ligne['prenom']} {$ligne['nom']}</a></li>";
			}
			$res .= "</ul>";
			return $res;
		}else{
			return "<div>Aucune personne trouvée</div>";
		}
	}
	
?>
<section id="organigramme">
	<section>
		<header>Président</header>
		<?php echo recup_personne_de_grade(30); ?>
	</section>
	<section>
		<header>Vice président</header>
		<?php echo recup_personne_de_grade(20); ?>
	</section>
	<section>
		<header>Membres du Conseil d'administration</header>
		<?php echo recup_personne_de_grade(10); ?>
	</section>
</section>