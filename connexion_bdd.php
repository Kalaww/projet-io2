<?php
	
	//Fonction de connexion au serveur SQL et renvoi la r�ponse � la requete
	function connexion($requete){
		//Information sur la base de donn�e
		//Changer ces valeurs selon la base de donn�e
		
		//Adresse:
		$adresse = "localhost";	
		//Base de donn�e
		$bdd = "association";
		//identifiant
		$user = "root";
		//Mot de passe
		$mdp = "";
		
		$connexion=mysql_pconnect($adresse, $user, $mdp);
		if(!$connexion){
			echo "Erreur de connexion � l'adresse de la base de donn�e";
		}else if(!mysql_select_db($bdd, $connexion)){
			echo "Echec de connexion � la base de donn�e";
		}else{
			mysql_query("SET NAMES 'utf8'");
			return mysql_query($requete, $connexion);
		}
	}