<?php

	//Renvoi la liste des 5 derniers inscrits
	function liste_dernier_inscrit(){
		$requete = "SELECT nom, prenom, id, date_inscription FROM identifiant ORDER BY date_inscription DESC";
		$donnees = connexion( $requete);
		
		if(mysql_num_rows($donnees) < 1){
			return "<div>Aucun membre inscrit récement</div>";
		}
		
		$r = "";
		$compteur = 1;
		while($compteur < 6){
			if($ligne = mysql_fetch_assoc($donnees)){
				$r .= 	"<div>
							<a href='index.php?where=profil&amp;id={$ligne['id']}'>
								<header>{$ligne['prenom']} {$ligne['nom']}</header>
							</a>
							<div>le ".conversion_date($ligne['date_inscription'])."</div>
						</div>";
			}
			$compteur++;
		}
		return $r;
	}
	
?>
<aside id="membres_nouveau">
	<header>Derniers membres inscrits</header>
	<div>
		<?php echo liste_dernier_inscrit(); ?>
	</div>
</aside>