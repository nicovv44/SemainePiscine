<!DOCTYPE html>
<html>
	<?php 
		/*On ouvre la base de donnée*/
		require("config.php");
		$database = 'facebouc';
		session_start();
		$IDauteur = $_SESSION['IDauteur'];
		$dbhandle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		$dbfound = mysqli_select_db($dbhandle, $database);

		/*On récupert le commentaire*/
		$textCommentaire = $_POST['textarea_ajouter_commentaire'];
		$timeStamp = time();
		$IDpublication = $_POST['IDpublication'];
		echo 'IDpublication : ' . $IDpublication . '<br/>';
		
		/*On insert le commentaire dans la base de donnée*/
		if($dbfound){
			echo "Base trouvée <br/>";
			$timeStamp = time();
			$sql = "INSERT INTO commentaire(commentaire, timeStamp, IDmembre, IDpublication) VALUES ('$textCommentaire', FROM_UNIXTIME($timeStamp), '$IDauteur', '$IDpublication')";
			$reqUTF8 = 'SET NAMES UTF8';//pour avoir les accents OK
			mysqli_query($dbhandle, $reqUTF8);//pour avoir les accents OK
			if(mysqli_query($dbhandle, $sql)){
				echo "Commentaire posté.<br/>";
			}
		}
		else{
			echo "Base de donnée non trouvée.<br/>";
		}
		
		
		
		/*On redirige vers la page chronologie (la page de provenance)*/
		header('Location: Chronologie.php');
		//header('refresh:5;url=Chronologie.php');//pour le debug
		
		
		
		/*On ferme la base de donnée*/
		mysqli_close($dbhandle);
		exit();
	?>
</html>