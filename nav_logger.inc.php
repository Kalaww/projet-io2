<header>Espace Membre</header>
<ul>
	<li <?php echo select(4); ?>>
		<a href="index.php?where=perso"><div><img src="ressources/perso.png" title="Mon Profil" alt="Mon Profil">Mon Profil</div></a>
	</li>
	<li <?php echo select(5); ?>>
		<a href="index.php?where=reunion"><div><img src="ressources/reunion.png" title="Reunion" alt="Reunion">Réunions</div></a>
		<?php if(isset($_SESSION['grade']) && $_SESSION['grade'] >= 10){
		 echo '<a href="index.php?where=reunion_nouvelle"><img src="ressources/more.png" title="Nouvelle réunion" alt="Nouvelle réunion" class="new_contenu"></a>';
		} ?>
	</li>
	<li <?php echo select(6); ?>>
		<a href="index.php?where=projets"><div><img src="ressources/projet.png" title="Projets" alt="Projets">Projets</div></a>
		<?php if(isset($_SESSION['grade']) && $_SESSION['grade'] >= 10){
		echo '<a href="index.php?where=projet_nouveau"><img src="ressources/more.png" title="Nouveau projet" alt="Nouveau projet" class="new_contenu"></a>';
		} ?>
	</li>
	<li <?php echo select(7); ?>>
		<a href="index.php?where=adherents"><div><img src="ressources/adherents.png" title="Membres" alt="Membres">Membres</div></a>
	</li>
	<li <?php echo select(8); ?>>
		<a href="index.php?where=competences"><div><img src="ressources/check.png" title="Compétences" alt="Compétences">Compétences</div></a>
	</li>
</ul>