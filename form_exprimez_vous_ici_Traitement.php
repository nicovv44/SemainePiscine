<!DOCTYPE html>
<html>
	<?php /*On ouvre la base de donnée*/
		require("config.php");
		$database = 'facebouc';
		session_start();
		$IDauteur = $_SESSION['IDauteur'];
		$dbhandle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		$dbfound = mysqli_select_db($dbhandle, $database);

		
		/*On vérifie le transfert du fichier et on recupère des données sur le fichier*/
		$erreur = "";
		if ($_FILES['pieceJointe']['error'] > 0) $erreur = " Erreur lors du transfert";
		if ($_FILES['pieceJointe']['size'] > 100000000) $erreur = $erreur . " Le fichier est trop gros";
		$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
		$extension_upload = strtolower(  substr(  strrchr($_FILES['pieceJointe']['name'], '.')  ,1)  );
		if ( !in_array($extension_upload,$extensions_valides) ) $erreur = $erreur . " Extension incorrecte";
		echo $erreur;
		
		/*On créer un nom unique au fichier*/
		if($_FILES['pieceJointe']['size']>10){
			$IDimage = uniqid();
			$nomFichierAvecExtension = $IDimage.".".$extension_upload;
		}
		else{
			$nomFichierAvecExtension="";
		}
		
		/*On déplace le fichier et le renomant avec son nom unique*/
		$lienTotalFichier = "images/$nomFichierAvecExtension";
		$resultat = move_uploaded_file($_FILES['pieceJointe']['tmp_name'],$lienTotalFichier);
		if ($resultat) echo "Pièce jointe stockée.<br/>";
		
		/*On insert la publication (type photo) dans la base de donnée*/
		if($dbfound){
			echo "base trouvée <br/>";
			$timeStamp = time();
			$sql = "INSERT INTO publication(type, timeStamp, IDmembre) VALUES ('photo', FROM_UNIXTIME($timeStamp), '$IDauteur')";
			$reqUTF8 = 'SET NAMES UTF8';//pour avoir les accents OK
			mysqli_query($dbhandle, $reqUTF8);//pour avoir les accents OK
			if(mysqli_query($dbhandle, $sql)){
				echo "Publication posté.<br/>";
			}
		}
		else{
			echo "Base de donnée non trouvée.<br/>";
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
				echo "IDpublication : " . $IDpublication . "<br/>";
			}
		}
		else{
			echo "Base de donnée non trouvée.<br/>";
		}
		
		/*On insert la  photo/texte (contenu) dans la base de donnée*/
		if($dbfound){
			$texte = isset($_POST['textarea_exprimez_vous_ici'])?$_POST['textarea_exprimez_vous_ici']:"";
			$sql = "INSERT INTO contenu (texte, lienPhoto, IDpublication)
				VALUES ('$texte', '$lienTotalFichier', '$IDpublication')";
			$reqUTF8 = 'SET NAMES UTF8';//pour avoir les accents OK
			mysqli_query($dbhandle, $reqUTF8);//pour avoir les accents OK
			if(mysqli_query($dbhandle, $sql)){
				echo "Contenu posté.<br/>";
			}
			
		}
		else{
			echo "Base de donnée non trouvée.<br/>";
		}
		
		
		/*On redirige vers la page chronologie (la page de provenance)*/
		header('Location: Chronologie.php');
		/*header('refresh:5;url=Chronologie.php');*///pour le debub
		exit();
		
		
		/*On ferme la base de donnée*/
		mysqli_close($dbhandle);
	?>
</html>