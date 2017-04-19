<!DOCTYPE html>
<html>
	<head>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
		<title>Acceuil</title>
		<link type="text/css" rel="stylesheet" href="style1.css">
	</head>

	<body>
		<table class="acceuil">
			<tr>
				<td><img src="bouc.jpg.png" alt="avis" style="width:50px;height:50px;"/></td><td>Avec Facebouc, <br> Partagez votre <br> quotidien avec <br> tous vos amis</td>
			</tr>
		</table>
		<br>
		<br>
		<table class="identification_inscription">
			<tr>
				<td>Nom</td><td>case</td>
			</tr>
			<tr>
				<td>Prénom</td><td>case</td>
			</tr>
			<tr>
				<td>Date de naissance</td><td>case</td>
			</tr>
			<tr>
				<td>Mail</td><td>case</td>
			</tr>
			<tr>
				<td><input type="checkbox" id="cbox1" value="checkboxmembre">checkbox membre</td><td><input type="checkbox" id="cbox2" value="checkboxadministrateur">checkbox administrateur</td>
			</tr>
			<tr>
				<td><input type="checkbox" id="cbox3" value="checkboxcg">Il a accepté les connditions générales</td>
			</tr>		
		</table>
		<br><br><br><br><br><br><br><br><br>
		<table class="bouton_inscription">
			<tr>
				<td>Importer auteur depuis la base de données</td><td><a href="acceuil.php">Retour Acceuil</td><td>Inscrire Auteur</a></td>
			</tr>
		</table>
		<br><br><br><br><br><br>
	</body>
	<footer>
			Hébergé par <br/>
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