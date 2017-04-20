<?php /*On ouvre la base de donnée*/
		require("config.php");
		$database = 'facebouc';
		$IDauteur = 2;/*on definit arbitrairement un IDauteur (de la page en cours) pour les tests*/
		$dbhandle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		$dbfound = mysqli_select_db($dbhandle, $database);
		if($dbfound){
			echo "connexion ok";
		}

		if ($dbfound){
		$req="SELECT pseudo, mail, id FROM membre;";
		$result=mysqli_query($dbhandle, $req);
		while ($data=mysqli_fetch_assoc($result)){
			if($mail==$data["mail"] && $pseudo==$data["pseudo"]{
				echo "connexion reussi;"
				session_start();
				$id="SELECT id FROM membre WHERE $mail=$data["mail"] AND $pseudo=$data["pseudo"];";
				$_SESSION['ID']=$id;
				header('Location : chronologie.php');
			}
			else{
				header('Location : index.php');
			}
		}
	}
?>