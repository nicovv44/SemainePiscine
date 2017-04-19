<!DOCTYPE html>
<html>
	<head>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
		<title>Mes Amis</title>
		<link type="text/css" rel="stylesheet" href="style1.css">
	</head>
	<header>
		<tr>
			<td><img src="bouc.jpg.png" alt="avis" style="width:100px;height:100px;"/></td><td><img src="bouc.jpg.png" alt="avis" style="width:150px;height:150px;"/></td><td align="left">nom auteur </td><td align="right">deconnexion</td>
		</tr>
	</header>
	<br><br><br><br><br>
	<body>
		<div class="body_gauche">
		<table class="menu">
			<tr>
				<td><a href="chronologie.php">Mur</a></td><td><a href="aproposvueglobale.php">A propos</a></td><td><a href="amis.php">Amis</a></td><td><a href="photo.php">Photo</a></td>
			</tr>
		</table>
		<br>
		<table class="chronologie_exprimezvous">
			<tr>
				<td>case blanche avec marqué exprimez vous dedans</td>
			</tr>
		</table>
		<table class="chronologie_ajouterpiecesjointes">
			<tr><td>bouton + </td><td>Ajouter une pièce jointe</td></tr>
		</table>
		<br><br>
		<table class="publication">
			<table class="commentaire"><tr><td>case commentaire</td><td>bouton + </td><td>paramètre de la publication</td></tr></table>
			<br>
			<table class="image_publication"><tr><td>case</td></tr></table>
			<table class="parametres_publication"><tr><td>bouton + et main</td><td>Nombre de Like/Love/Laugh/Grrr</td></tr></table>
			<br>
			<table class="commentaires_publication">
			
			<tr>Commentaires :</tr>
			<tr>
				<td>Utilisateur1</td><td>Commentaire1</td>
			</tr>
			<tr>
				<td>Utilisateur2</td><td>Commentaire2</td>
			</tr>
			</table>
		</table>
		</div>
		<div class="contact">
			<h3>Contacts</h3>
			<br>
			Liste des contacts
		</div>
	</body>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<footer>
			Hébergé par <br/>
			&copy; 2017 Mathidle Bridron <a href="mailto:mathilde.bridron@edu.ece.fr">mathilde.bridron@edu.ece.fr</a>, Alexandre Domanchin <a href="mailto:ad162414@edu.ece.fr">alexandre.domanchin@edu.ece.fr</a>, Nicolas VERHELST <a href="mailto:nicolas.verhelst@edu.ece.fr">nicolas.verhelst@edu.ece.fr</a><br/>
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