<?php
	
	//Renvoi la liste des 5 réunions les plus récentes
	function liste_miniature_reunions(){
		$date_actuelle = date('Y-m-d');
		$requete = "SELECT id, titre, date FROM reunions WHERE date >= '{$date_actuelle}' ORDER BY date";
		$donnees = connexion($requete);
		
		if(mysql_num_rows($donnees) < 1){
			return "<div>Aucune réunion à venir</div>";
		}
		
		$r = "";
		$compteur = 1;
		while($compteur < 6){
			if($ligne = mysql_fetch_assoc($donnees)){
				$r .= 	"<div>
							<a href='index.php?where=reunion#reunion_{$ligne['id']}'><header>{$ligne['titre']}</header></a>
							<div>le ".conversion_date($ligne['date'])."</div>
						</div>";
			}
			$compteur++;
		}
		return $r;
	}
		
	
?>
<aside id="next_reunion">
	<header>Réunion à venir</header>
	<div>
		<?php echo liste_miniature_reunions(); ?>
	</div>
</aside>
