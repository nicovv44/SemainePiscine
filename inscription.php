
<html>
	<head>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
		<title>Inscription</title>
		<link type="text/css" rel="stylesheet" href="style1.css">
	</head>

	<body>
		<img id="imgTypePageA" src="images/bouc.png" alt="Logo bouc"/>
		<h1 id="h1TypePageA">Inscription</h1>
		<p style="text-align: center">Réservé aux administrateurs</p>
		
		<div class="box">
			<form id="formInscription" method="post" action="InscriptionTraitement.php">
				<input type="text" name="prenom" placeholder="Prénom"><br/>
				<input type="text" name="nom" placeholder="Nom"><br/>
				Date de naissance : 
				<input type="date" name="dateNaissance"/><br/>
				<input type="email" name="mail" placeholder="Mail"/><br/>
				<input type="text" name="pseudo" placeholder="Pseudo"/><br/>
				<select name="statut">
					<option value="auteur">Auteur</option>
					<option value="admin">Administrateur</option>
				</select><br/>
				<input type="checkbox" name="cg" id="cbox3" value="checkboxcg">Il a accepté les <a href="ConditionsGenerales.html">Conditions générales</a>
				<input type="submit" value="Inscrire membre"/>
			</form>
		</div>
			
		<div class="ecarteur">
			<a href="index.php"><input type="button" value="Retour accueil"></a>	
			<a href="ImportationAuteur.php"><input type="button" value="Importer des auteurs depuis la base de données"></a>
		</div>
		
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