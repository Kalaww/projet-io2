<?php
	
	//Fonction de connexion au serveur SQL et renvoi la réponse à la requete
	function connexion($requete){
		//Information sur la base de donnée
		//Changer ces valeurs selon la base de donnée
		
		//Adresse:
		$adresse = "localhost";	
		//Base de donnée
		$bdd = "association";
		//identifiant
		$user = "root";
		//Mot de passe
		$mdp = "";
		
		$connexion=mysql_pconnect($adresse, $user, $mdp);
		if(!$connexion){
			echo "Erreur de connexion à l'adresse de la base de donnée";
		}else if(!mysql_select_db($bdd, $connexion)){
			echo "Echec de connexion à la base de donnée";
		}else{
			mysql_query("SET NAMES 'utf8'");
			return mysql_query($requete, $connexion);
		}
	}