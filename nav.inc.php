<?php

	//Renvoie id="select" sur le bon menu de la page courante
	function select($v){
		$res = "id='select'";
		if(!isset($_GET['where']) && $v == 1){
			return $res;
		}else if(isset($_GET['where'])){
			switch($v){
				case 2:
					if($_GET['where'] == 'organigramme'){
						return $res;
					}
					break;
				case 3:
					if($_GET['where'] == 'article' || $_GET['where'] == 'article_nouveau' || $_GET['where'] == 'article_editer'){
						return $res;
					}
					break;
				case 4:
					if($_GET['where'] == 'perso'){
						return $res;
					}
					break;
				case 5:
					if($_GET['where'] == 'reunion' || $_GET['where'] == 'reunion_nouvelle' || $_GET['where'] == 'reunion_editer'){
						return $res;
					}
					break;
				case 6:
					if($_GET['where'] == 'projets' || $_GET['where'] == 'projet_nouveau' || $_GET['where'] == 'projet_editer'){
						return $res;
					}
					break;
				case 7:
					if($_GET['where'] == 'adherents' || $_GET['where'] == 'profil'){
						return $res;
					}
					break;
				case 8:
					if($_GET['where'] == 'competences'){
						return $res;
					}
					break;
			}
		}
	}
						
?>
<header>Espace Public</header>
<ul>
	<li <?php echo select(1); ?>>
		<a href="index.php"><div><img src="ressources/accueil.png" title="accueil" alt="accueil" >A la une</div></a>
	</li>
	<li <?php echo select(2); ?>>
		<a href="index.php?where=organigramme"><div><img src="ressources/organigramme.png" title="Organigramme" alt="Organigramme">Organigramme</div></a>
	</li>
	<li <?php echo select(3); ?>>
		<a href="index.php?where=article"><div><img src="ressources/article.png" title="Article" alt="Article" >Articles</div></a>
		<?php if($logger){
		 echo '<a href="index.php?where=article_nouveau"><img src="ressources/more.png" title="Nouvel article" alt="Nouveau article" class="new_contenu"></a>';
		} ?>
	</li>
</ul>