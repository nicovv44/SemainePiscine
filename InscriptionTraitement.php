<!DOCTYPE html>
<html>
	<?php 
		/*On ouvre la base de donnée*/
		require("config.php");
		$database = 'facebouc';
		//session_start();
		//$IDadmin = $_SESSION['IDadmin'];
		$dbhandle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		$dbfound = mysqli_select_db($dbhandle, $database);

		/*On récupère les données du formulaire d'inscription*/
		$prenom = isset($_POST['prenom'])?$_POST['prenom']:"";
		$nom = isset($_POST['nom'])?$_POST['nom']:"";
		$dateNaissance = isset($_POST['dateNaissance'])?$_POST['dateNaissance']:"";
		$mail = isset($_POST['mail'])?$_POST['mail']:"";
		$pseudo = isset($_POST['pseudo'])?$_POST['pseudo']:"";
		$statutTexte = isset($_POST['statut'])?$_POST['statut']:"";
		$cg = isset($_POST['cg'])?$_POST['cg']:"";//Conditions générales
		$statut = 0;//par defaut le membre n'est pas admin, mais auteur
		if($statutTexte == 'admin'){
			$statut = 1;
		}
		
		/*On insert le membre dans la base de donnée*/
		if($dbfound){
			echo "Base de donnée trouvée<br/>";
			if(isset($_POST['cg']) && isset($_POST['mail']) && isset($_POST['pseudo'])){
				$sql = "INSERT INTO membre(adresseMail, pseudo, nom, prenom, statut, dateNaissance) VALUES ('$mail', '$pseudo', '$nom', '$prenom', '$statut', '$dateNaissance')";
				$reqUTF8 = 'SET NAMES UTF8';//pour avoir les accents OK
				mysqli_query($dbhandle, $reqUTF8);//pour avoir les accents OK
				if(mysqli_query($dbhandle, $sql)){
					echo "Membre ajouté<br/>";
				}
			}
			else{
				if(!isset($_POST['cg'])){echo "Conditions générales n'ont pas été acceptées<br/>";}
				if(!isset($_POST['mail'])){echo "Mail absent<br/>";}
				if(!isset($_POST['pseudo'])){echo "Pseudo absent<br/>";}
				echo "Membre non ajouté<br/>";
			}
		}
		else{
			echo "Base de donnée non trouvée.<br/>";
		}
		
		
		
		/*On redirige vers la page chronologie (la page de provenance)*/
		/*header('Location: Chronologie.php');*/
		header('refresh:3;url=Inscription.php');//pour le debug
		
		
		
		/*On ferme la base de donnée*/
		mysqli_close($dbhandle);
		exit();
	?>
</html>