<!DOCTYPE html>
<html>
	<?php /*On ouvre la base de donnée*/
		require("config.php");
		$database = 'facebouc';
		session_start();
		$IDauteur = $_SESSION['IDauteur'];
		$dbhandle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		$dbfound = mysqli_select_db($dbhandle, $database);
	?>
	<head>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
		<title>Mes Amis</title>
		<link type="text/css" rel="stylesheet" href="style1.css">
	</head>
	
	<?php /*Construction de la balise <header> pour l'image de couverture*/
		if($dbfound){
			$sql = "SELECT * FROM membre WHERE IDmembre = '$IDauteur'";
			$reqUTF8 = 'SET NAMES UTF8';//pour avoir les accents OK
			mysqli_query($dbhandle, $reqUTF8);//pour avoir les accents OK
			$result = mysqli_query($dbhandle, $sql);
			while($data = mysqli_fetch_assoc($result)){
				$lienPhotoCouverture = $data['lienPhotoCouverture'];
				$style = '"'."background-image: url('$lienPhotoCouverture');".'"';
				echo "<header  style=$style>";
			}
		}
		else{
			echo "Base de donnée non trouvée.";
		}
	?>
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
				<li><a href="Chronologie.php">Chronologie</a></li>
				<li><a href="aproposvueglobale.php">A propos</a></li>
				<li><a class="bontonNavSelected" href="Amis.php">Amis</a></li>
				<li><a href="Photos.php">Photos</a></li>
			</ul>
		</nav>
		<div class="body_gauche">
			<?php /*On affiche le nombre d'ami de l'auteur dans un cadre*/
				if($dbfound){
					/*On recupere le nombre d'ami de l'auteur*/
					$sql = "SELECT COUNT(*) AS 'nombre' FROM estAmisAvec WHERE IDmembre1 = '$IDauteur'";
					$reqUTF8 = 'SET NAMES UTF8';//pour avoir les accents OK
					mysqli_query($dbhandle, $reqUTF8);//pour avoir les accents OK
					$result = mysqli_query($dbhandle, $sql);
					while($data = mysqli_fetch_assoc($result)){
						$nbrAmi = $data['nombre'];
						echo "<div style='margin: 20px; border: 2px solid black; width: 250px;'>";
						echo "Nombre d'ami : " . $nbrAmi . "<br/>";
						echo "</div>";
					}
				}
				else{
					echo "Base de donnée non trouvée.";
				}
			?>
			<table class="mes_amis">
				<tr>
					<th>Photo amis</th><th></th><th>Nom</th><th></th><th>Prénom</th><th></th><th>Degré d'amitié</th><th></th><th>Nombre d'ami</th>
				</tr>
				
				<?php /*On affiche les amis*/
					if($dbfound){
						$sql = "SELECT *
							FROM estAmisAvec 
							JOIN membre ON estAmisAvec.IDmembre2 = membre.IDmembre
							WHERE estAmisAvec.IDmembre1 = '$IDauteur'";
						$reqUTF8 = 'SET NAMES UTF8';//pour avoir les accents OK
						mysqli_query($dbhandle, $reqUTF8);//pour avoir les accents OK
						$result = mysqli_query($dbhandle, $sql);
						while($data = mysqli_fetch_assoc($result)){
							echo "<tr>";/*Debut de ligne*/
							
							/*Photo*/
							$lienPhoto = $data['lienPhotoProfil'];
							echo "<td>";
							echo "<img src='$lienPhoto' alt='Photo ami' style='width:150px;height:150px;'/>";
							echo "<td/>";
							
							/*Nom*/
							$nom = $data['nom'];
							echo "<td>";
							echo "$nom";
							echo "<td/>";
							
							/*Prenom*/
							$prenom = $data['prenom'];
							echo "<td>";
							echo "$prenom";
							echo "<td/>";
							
							/*Degré d'amitié*/
							$degre = $data['degreDAmitie'];
							echo "<td>";
							echo "$degre/5";
							echo "<td/>";
							
							/*Nombre d'ami de l'ami*/
							$IDami = $data['IDmembre'];
							$sql2 = "SELECT COUNT(*) AS 'nombre' FROM estAmisAvec WHERE IDmembre1 = '$IDami'";
							$reqUTF82 = 'SET NAMES UTF8';//pour avoir les accents OK
							mysqli_query($dbhandle, $reqUTF82);//pour avoir les accents OK
							$result2 = mysqli_query($dbhandle, $sql2);
							while($data2 = mysqli_fetch_assoc($result2)){
								$nbrAmi = $data2['nombre'];
							}
							echo "<td>";
							echo "$nbrAmi";
							echo "<td/>";
							
							echo "</tr>";/*Fin de ligne*/
						}
					}
					else{
						echo "Base de donnée non trouvée.";
					}
				?>
			</table>
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