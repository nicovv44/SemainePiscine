<!DOCTYPE html>
<html>
	<?php /*On ouvre la base de donnée*/
		require("config.php");
		$database = 'facebouc';
		$IDauteur = 2;/*on definit arbitrairement un IDauteur (de la page en cours) pour les tests*/
		$dbhandle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		$dbfound = mysqli_select_db($dbhandle, $database);

		/*
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
		}*/
		
		
		
		/*On vérifie le transfert du fichier et on recupère des données sur le fichier*/
		$erreur = "";
		if ($_FILES['pieceJointe']['error'] > 0) $erreur = " Erreur lors du transfert";
		if ($_FILES['pieceJointe']['size'] > 100000000) $erreur = $erreur . " Le fichier est trop gros";
		$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
		$extension_upload = strtolower(  substr(  strrchr($_FILES['pieceJointe']['name'], '.')  ,1)  );
		if ( !in_array($extension_upload,$extensions_valides) ) $erreur = $erreur . " Extension incorrecte";
		echo $erreur;
		
		/*On créer un nom unique au fichier*/
		$IDimage = uniqid();
		$nomFichierAvecExtension = $IDimage.".".$extension_upload;
		
		/*On déplace le fichier et le renomant avec son nom unique*/
		$lienTotalFichier = "images/$nomFichierAvecExtension";
		$resultat = move_uploaded_file($_FILES['pieceJointe']['tmp_name'],$lienTotalFichier);
		if ($resultat) echo "Transfert réussi";
		
		/*On insert la publication (type photo) dans la base de donnée*/
		if($dbfound){
			echo "base trouvée";
			$timeStamp = time();
			$sql = "INSERT INTO publication(type, timeStamp, IDmembre) VALUES ('photo', FROM_UNIXTIME($timeStamp), '$IDauteur')";
			$reqUTF8 = 'SET NAMES UTF8';//pour avoir les accents OK
			mysqli_query($dbhandle, $reqUTF8);//pour avoir les accents OK
			if(mysqli_query($dbhandle, $sql)){
				echo "Publication posté. Redirection en cours...";
			}
		}
		else{
			echo "Base de donnée non trouvée.";
		}
		
		/*On récupère l'identifiant de la publication qui vien d'être ajoutée à la base de donnée*/
		if($dbfound){
			$sql = "SELECT MAX(IDpublication) AS 'nombre'
				FROM publication";
			$reqUTF8 = 'SET NAMES UTF8';//pour avoir les accents OK
			mysqli_query($dbhandle, $reqUTF8);//pour avoir les accents OK
			$result = mysqli_query($dbhandle, $sql);
			while($data = mysqli_fetch_assoc($result)){
				$IDpublication = $data['nombre'];
			}
		}
		else{
			echo "Base de donnée non trouvée.";
		}
		
		/*On insert la  photo dans la base de donnée*/
		if($dbfound){
			$sql = "INSERT INTO contenu (lienPhoto, IDpublication)
				VALUES ('$lienTotalFichier', '$IDpublication')";
			$reqUTF8 = 'SET NAMES UTF8';//pour avoir les accents OK
			mysqli_query($dbhandle, $reqUTF8);//pour avoir les accents OK
			$result = mysqli_query($dbhandle, $sql);
		}
		else{
			echo "Base de donnée non trouvée.";
		}
		
		
		/*On redirige vers la page chronologie (la page de provenance)*/
		/*header('Location: Chronologie.php');*/
		header('refresh:5;url=Chronologie.php');//pour le degub
		exit();
		
		
		/*On ferme la base de donnée*/
		mysqli_close($dbhandle);
	?>
</html>