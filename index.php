<!DOCTYPE html>
<html>
	<head>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
		<title>Acceuil</title>
		<link type="text/css" rel="stylesheet" href="style1.css">
	</head>

	<body>
		<div class="accueil">
			<img src="images/bouc.png" alt="Logo bouc"/>
			<div class="titreAccueil">
				<div>Facebouc</div>
			</div>
			<form id="formAccueil" action="A VOIR" method="post">
				<span class="typeTexteA">Connexion</span>
				<table class="identification_acceuil">
					<tr>
						<td>Pseudo</td><td><input type="text" name="pseudo"></td>
					</tr>	
					<tr>
						<td>Mail</td><td><input type="text" name="mail"></td>
					</tr>			
				</table>
				<table class="bouton_acceuil">
					<tr>
						<td>
							<a href="AuthentificationAdmin.php"><input type="button" value=" S'inscrire "></a>
						</td>
						<td>
							<INPUT TYPE="submit" NAME="nom" VALUE=" Connexion ">
						</td>
					</tr>
				</table>
			</form>
		</div>
		<div id="slogan">Avec Facebouc, partagez votre quotidien avec tous vos amis</div>
	</body>
	<footer>
			<a href="ConditionsGenerales.html">Conditions générales</a> <br/>
			&copy; 2017 Mathilde Bridron <a href="mailto:mathilde.bridron@edu.ece.fr">mathilde.bridron@edu.ece.fr</a>, Alexandre Domanchin <a href="mailto:ad162414@edu.ece.fr">alexandre.domanchin@edu.ece.fr</a>, Nicolas VERHELST <a href="mailto:nicolas.verhelst@edu.ece.fr">nicolas.verhelst@edu.ece.fr</a><br/>
			Nombre de visites : 
			<?php
				$filename = 'nbrVisites.txt';
				$nombreDeVisites = null;

				//on recupère le nombre de visite dans le fichier
				if (is_readable($filename)) {
					if (!$handle = fopen($filename, 'r')) {//ouverture en mode lecture
						 echo "Impossible d'ouvrir le fichier ($filename)";
						 exit;
					}
					if (($nombreDeVisites = fread($handle, 100)) === FALSE) {//on lit jusqu'à 100 caractères
						echo "Impossible de lire le fichier ($filename)";
						exit;
					}
					fclose($handle);
				} else {
					echo "Le fichier $filename n'est pas accessible en lecture ou est introuvable.";
				}
				
				//on affiche le nombre de visites
				if($nombreDeVisites) {echo $nombreDeVisites;}
				
				//on incrémente le nombre de visite récupéré dans le fichier
				if($nombreDeVisites != null) {$nombreDeVisites++;}
				
				//on écrit ce nouveau nombre dans le fichier
				if (is_writable($filename)) {
					if (!$handle = fopen($filename, 'w')) {//ouverture en mode écriture
						 echo "Impossible d'ouvrir le fichier ($filename)";
						 exit;
					}
					if (fwrite($handle, $nombreDeVisites) === FALSE) {//on écrit le nouveau nombre par dessus l'encien
						echo "Impossible d'écrire dans le fichier ($filename)";
						exit;
					}
					fclose($handle);
				} else {
					echo "Le fichier $filename n'est pas accessible en écriture ou est introuvable.";
				}
			?>
		</footer>
</html>