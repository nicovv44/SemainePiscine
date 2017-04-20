<?php /*On ouvre la base de donnée*/
	require"config.php";
	$database = 'facebouc';
	$dbhandle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
	$dbfound = mysqli_select_db($dbhandle, $database);
	

	$mail=$_POST['mail'];
	$pseudo=$_POST['pseudo'];
	

	if ($dbfound){
		$req="SELECT * FROM membre;";
		$result=mysqli_query($dbhandle, $req);
		while ($data=mysqli_fetch_assoc($result)){
			$ceci=$data['adresseMail'];
			echo "$ceci <br/>";
			
			if($mail==$data['adresseMail'] && $pseudo==$data['pseudo'] && ("1"==$data['statut'])){
				session_start();
				$_SESSION['IDauteur']=$data['IDmembre'];
				$_SESSION['pseudo']=$pseudo;
				header('Location: Inscription.php');
				exit();
			}
		}
		header('Location: AuthentificationAdmin.php');
		exit();
	}
?>