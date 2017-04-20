<?php /*On ouvre la base de donnée*/
	require("config.php");
	$database = 'facebouc';
	$IDauteur = 2;/*on definit arbitrairement un IDauteur (de la page en cours) pour les tests*/
	$dbhandle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
	$dbfound = mysqli_select_db($dbhandle, $database);

	function verification_login($pseudo,$mail){
		session_start();
		$loginOK=false;
		if ($dbfound){
			$req="SELECT pseudo, mail FROM membre WHERE pseudo='$pseudo' and mail='$mail';";
			if ($res=($dbfound, $req)){
				$tb=db_fetch($res);
				if ($tb){
					$ts="SELECT statut FROM membre WHERE pseudo='$pseudo' and mail='$mail';";
					if($ts="1"){
						$loginOK=true;
						return $tb['pseudo'];
					}
				}
			}
			db_close($dbfound);
		}
		return 0;
	}

	$pseudo=$_POST['pseudo'];
	$mail=$_POST['mail'];
	$user=verification_login($pseudo,$mail);
	if (!$user){
		echo "erreur de connexion";
		//<a href="index.php" /a>
	}
	else{
		$_SESSION['pseudo']=$data['pseudo'];
		$_SESSION['mail']=$data['mail'];
		//<a href="inscription.php" /a>
	}

?>