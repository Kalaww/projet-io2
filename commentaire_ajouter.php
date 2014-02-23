<?php

	session_start();

	include "connexion_bdd.php";

	//converti une heure mysql en String
	function conversion_heure($heure_mysql){
		$table_heure = explode(':', $heure_mysql);
		return $table_heure[0]."h".$table_heure[1];
	}
	
	//Convertie le mois en chaine de caractère
	function conversion_date($date_sql){
		$temp = explode('-', $date_sql);
		$mois = array(	"01"=>"Janvier",
						"02"=>"Fevrier",
						"03"=>"Mars", 
						"04"=>"Avril", 
						"05"=>"Mai", 
						"06"=>"Juin", 
						"07"=>"Juillet", 
						"08"=>"Aout", 
						"09"=>"Septembre", 
						"10"=>"Octobre", 
						"11"=>"Novembre", 
						"12"=>"Decembre", 
						"00"=>"Erreur");
		foreach($mois as $i=>$v){
			if($i == $temp[1]){
				return $temp[2].' '.$v.' '.$temp[0];
			}
		}
	}
	
	//Trouve et modifi le tag vers un membre du site dans un texte
	function tagger($article){
		$emplacement = strpos($article, 'pseudo@');
		do{
			$emplacement = strpos($article, 'pseudo@');
			if($emplacement !== false){
				$emplacement += 7;
				$pseudo = "";
				while($article[$emplacement] != '@'){
						$pseudo .= $article[$emplacement];
						$emplacement++;
				}
				$requete="SELECT prenom, nom, id FROM identifiant WHERE login='{$pseudo}'";
				$donnee = connexion($requete);
				$ligne = mysql_fetch_assoc($donnee);
				$article = str_replace('pseudo@'.$pseudo.'@', "<a href='index.php?where=profil&amp;id={$ligne["id"]}'>{$ligne['prenom']} {$ligne['nom']}</a>", $article);
			}
		}while($emplacement !== false);
		return $article;		
	}
	
	//Renvoi le prenom nom de l'id
	function nom_auteur($id){
		$requete = 'SELECT nom, prenom FROM identifiant WHERE id="'.$id.'"';
		$donnee = connexion( $requete);
		$ligne = mysql_fetch_assoc($donnee);
		return $ligne['prenom'].' '.$ligne['nom'];
	}
	
	
	$retour['success'] = false;
	
	if(isset($_POST['com'], $_POST['auteur'], $_POST['article']) && !empty($_POST['com'])){
		$auteur = mysql_real_escape_string(htmlspecialchars($_POST['auteur']));
		$texte = mysql_real_escape_string(htmlspecialchars($_POST['com']));
		$article = mysql_real_escape_string(htmlspecialchars($_POST['article']));
		$date = date("Y-m-d");
		$heure = date("H:i:s");
		
		$requete = sprintf("INSERT INTO commentaires_article (texte, auteur, date, heure, article) VALUES('%s', '%s', '%s', '%s', '%s')",
					$texte, $auteur, $date, $heure, $article);
		$retour['success'] = connexion($requete);
		
		$retour['commentaire'] = "<header>De <a href='index.php?where=profil&amp;id={$auteur}'>".nom_auteur($auteur)."</a> le ".conversion_date($date)." à ".conversion_heure($heure)."</header>
									<div>".tagger($texte)."</div>";
	}
	
	echo json_encode($retour);
	
?>