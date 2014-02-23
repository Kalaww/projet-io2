<?php

	include "connexion_bdd.php";
	
	if(isset($_POST['id'])){
		$requete = sprintf("DELETE FROM commentaires_article WHERE id='%s'",
							mysql_real_escape_string(htmlspecialchars($_POST['id'])));
		$table["success"] = connexion($requete);
		echo json_encode($table);
	}else{
		$table["success"] = 0;
		echo json_encode($table);
	}

?>