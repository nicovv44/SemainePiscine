<!DOCTYPE html>
<html>
	<?php /*On ouvre la base de donnée*/
		require("config.php");
		$database = 'facebouc';
		$IDauteur = 2;/*on definit arbitrairement un IDauteur (de la page en cours) pour les tests*/
		$dbhandle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		$dbfound = mysqli_select_db($dbhandle, $database);
	?>
	<head>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
		<title>Mes Amis</title>
		<link type="text/css" rel="stylesheet" href="style1.css">
	</head>
	<header>
		<img class="miniLogoGauche" src="images/bouc.png" alt="Logo bouc" style="width:50px;height:50px;"/>
		<tr>
			<td>
			<?php /*On récupère et affiche la photo de profil de l'auteur*/
				if($dbfound){
					$sql = "SELECT * FROM membre WHERE IDmembre = '$IDauteur'";
					$reqUTF8 = 'SET NAMES UTF8';//pour avoir les accents OK
					mysqli_query($dbhandle, $reqUTF8);//pour avoir les accents OK
					$result = mysqli_query($dbhandle, $sql);
					while($data = mysqli_fetch_assoc($result)){
						$lienPhotoProfil = $data['lienPhotoProfil'];
						echo "<img class='photoProfil' src='$lienPhotoProfil' alt='Photo profil auteur' style='width:150px;height:150px;'/>";
					}
				}
				else{
					echo "Base de donnée non trouvée.";
				}
			?>
			</td>
			<td align="left">
			<?php /*On récupère et affiche nom et prénom de l'auteur*/
				if($dbfound){
					$sql = "SELECT * FROM membre WHERE IDmembre = '$IDauteur'";
					$reqUTF8 = 'SET NAMES UTF8';//pour avoir les accents OK
					mysqli_query($dbhandle, $reqUTF8);//pour avoir les accents OK
					$result = mysqli_query($dbhandle, $sql);
					while($data = mysqli_fetch_assoc($result)){
						$nom = $data['nom'];
						$prenom = $data['prenom'];
						echo "<span class='typeTexteB'>$prenom $nom</span>";
					}
				}
				else{
					echo "Base de donnée non trouvée.";
				}
			?>
			</td>
			<a href="index.php"><input type="submit" value="Deconnexion"/></a>
		</tr>
	</header>

	<body>
		<nav>
			<ul>
				<li><a class="bontonNavSelected" href="Chronologie.php">Chronologie</a></li>
				<li><a href="aproposvueglobale.php">A propos</a></li>
				<li><a href="Amis.php">Amis</a></li>
				<li><a href="Photos.php">Photos</a></li>
			</ul>
		</nav>

		<div id="blocChronologie">
			<div class="body_gauche">
				<form id="form_exprimez_vous_ici" method="post" action="form_exprimez_vous_ici_Traitement.php">
					<textarea id="textarea_exprimez_vous_ici" name="textarea_exprimez_vous_ici" rows="4" cols="70" placeHolder="Exprimez vous ici..."></textarea>
					<div class="ecarteur">
						<input type="submit" value="Poster"/>
						<input type="file" value="pieceJointe"/>
					</div>
				</form>
			</div>

			

			<div class="body_gauche">
			
				<p style="font-size: 60px; text-align: center;">Publication</p>
				
				<?php /*Affiche le nombre de j'aime, j'adore...*/
					echo "3 J'aime, 2 J'adore, 0 Je rigole, 0 Grrr";
				?>
				
				<form id="form_avis" method="post" action="form_avis_Traitement.php">
					<input type="submit" name="jaime" value="J'aime"/>
					<input type="submit" name="jadore"value="J'adore"/>
					<input type="submit" name="jerigole"value="Je rigole"/>
					<input type="submit" name="grrr"value="Grrr"/>
				</form>
				
				<table class="commentaire_publication">
					<tr>
						<th>Utilisateur1</th>
					</tr>
					<tr>
						<td>Commentaire1 Commentaire1 Commentaire1 Commentaire1 Commentaire1 Commentaire1 Commentaire1 Commentaire1 Commentaire1 Commentaire1 Commentaire1 </td>
					</tr>
				</table>
				<table class="commentaire_publication">
					<tr>
						<th>Utilisateur2</th>
					</tr>
					<tr>
						<td>Commentaire2 Commentaire2 Commentaire2 Commentaire2 Commentaire2 Commentaire2 Commentaire2 Commentaire2 Commentaire2 Commentaire2 Commentaire2 Commentaire2 Commentaire2 Commentaire2 </td>
					</tr>
				</table>
				<?php /*Affichage des commentaires depuis la base de donnée*/
					/**/
				?>
				
				<form id="ajouter_commentaire" method="post" action="ajouter_commentaire_Traitement.php">
					<textarea id="textarea_ajouter_commentaire" name="textarea_ajouter_commentaire" rows="4" cols="70" placeHolder="Ajouter un commentaire..."></textarea>
					<div class="ecarteur">
						<input type="submit" value="Poster"/>
						<input type="file" value="pieceJointe"/>
					</div>
				</form>
			</div>
		</div>
		
		<div class="contact">
			<h3>Contacts</h3>
			<br>
			Liste des contacts
		</div>
	</body>
	
	<footer>
			<a href="ConditionsGenerales.html">Conditions générales</a> <br/>
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
	<?php /*On ferme la base de donnée*/
		mysqli_close($dbhandle);
	?>
</html>