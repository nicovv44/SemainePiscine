<?php /*On ouvre la base de donnée*/
	require("config.php");
	$database = 'facebouc';
	$IDauteur = 2;/*on definit arbitrairement un IDauteur (de la page en cours) pour les tests*/
	$dbhandle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
	$dbfound = mysqli_select_db($dbhandle, $database);
	function db_query($db,$query){
		return pg_query($db,$query);
	}
	function db_fetch($rep){
		return pg_fetch_assoc($rep);
	}
	function db_fetch_all($rep){
		return pg_fetch_all($rep);
	}
	function db_close($dbfound){
		return pg_close($dbfound);
	}
	function verification_login($pseudo,$mail,$dbfound,$dbhandle){
		session_start();
		$loginOK=false;
		if ($dbfound){
			echo"bdd trouvee";
			$req="SELECT pseudo, mail FROM membre WHERE pseudo='$pseudo' and mail='$mail'";
			if (1){
				$res=mysqli_query($dbhandle, $req);
				echo "res : " . $res;
				$tb=mysqli_fetch_assoc($res);
				if ($tb){
					$loginOK=true;
					return $tb['pseudo'];
				}
			}
			mysqli_close($dbhandle);
		}
		return 0;
	}

	$pseudo=$_POST['pseudo'];
	echo $pseudo;
	$mail=$_POST['mail'];
	echo $mail;
	$user=verification_login($pseudo,$mail,$dbfound,$dbhandle);
	echo $user;
	if (!$user){
		echo "erreur de connexion";
		/*<a href="index.php" /a>*/
	}
	else{
		$_SESSION['pseudo']=$tb['pseudo'];
		$_SESSION['mail']=$tb['mail'];
		echo "connexion reussie";
		/*<a href="chronologie.php" /a>*/
	}

?>