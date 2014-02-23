<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Formulaire d'inscription</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="css/header_footer.css"/>
		<link rel="stylesheet" href="css/formulaire_inscription.css"/>
		<link rel="stylesheet" media="(max-width:640px)" href="css/mobile.css">
	</head>
	<body>
		<header>
			<?php include("header.inc.php");?>
		</header>
		<div id="inscr">
			<header>Formulaire d'inscription</header>
			<form action="pageValidation.php" method="POST">
			<table id="formulaire_inscription">
				<tr>
					<td>
						<label for="no" >Prénom :</label>
					</td>
					<td class="td_input">
						<input type="text" name="prenom" id="no" class="input_js">
						<span class="bulle_aide">3 caractères minimum</span>
					</td>
				</tr>
				<tr>
					<td> 
						<label for="nom">Nom :</label>
					</td>
					<td class="td_input">
						<input type="text" name="nom" id="nom" class="input_js">
						<span class="bulle_aide">3 caractères minimum</span>
					</td>
				</tr>
				<tr>
					<td>
						<label for="login">Identifiant :</label>
					</td>
					<td class="td_input">
						<input type="text" name="login" id="login" class="input_js">
						<span class="bulle_aide">3 caractères minimum</span>
					</td>
				</tr>
				<tr>
					<td>
						Sexe :
					</td>
					<td class="td_input">
						<label for="h">Homme</label> <input type="radio" name="sexe" value="h" checked id="h">
						<label for="f">Femme</label> <input type="radio" name="sexe" value="f" id="f">
					</td>
				</tr>
				<tr>
					<td>
						<label for="age">Age :</label>
					</td>
					<td class="td_input">
						<input type="text" name="age" id="age" class="input_js">
						<span class="bulle_aide">Entre 1 et 120 ans</span>
					</td>
				</tr>
				<tr>
					<td>	
						<label for="code">Code postal :</label>
					</td>
					<td class="td_input">
						<input type="text" name="code" id="code" class="input_js">
						<span class="bulle_aide">5 chiffres</span>
					</td>
				</tr>
				<tr>
					<td>
						<label for="sub">Envoyer le formulaire</label>
					</td>
					<td class="td_input">
						<input type="submit" name="submit" id="sub">
					</td>
				</tr>
				
			</table>
			</form>
			<div>
				<a href="index.php">Retour à l'accueil</a>
			</div>
		</div>
		<footer>
			<?php include("footer.inc.php"); ?>
		</footer>
	</body>
</html>