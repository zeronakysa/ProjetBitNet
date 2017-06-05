<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>expo steven</title>
	</head>
	<body>
		<?php
		define("HOST", "localhost");
		define("DBNAME", "projet_bitnet");
		define("DBUSER", "root");
		define("DBPWD", "");
		function dbConnect(){
			//Se connecter à la bdd
			try{
					$connection = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBUSER, DBPWD);
			}catch(Exception $e){
					die("Erreur SQL".$e->getMessage());
			}

			return $connection;
		}
		$_SESSION['email']="aureldenoel@hotmail.fr";
		$connection=dbConnect();
		 $id_succes = $i;

COUNT nom_succes sFROM SUCCES

		 $query = $connection->prepare('SELECT nom_succes, goal FROM SUCCES WHERE ID_succes = :id_succes');
		 $query->execute([
		 	'id_succes' => $id_succes
		 	]);
		 $achievementsInfo = $query->fetch();
		 $query = null;
		 //Verify if success' already done.
		 $query = $connection->prepare('SELECT email, progression FROM succes_reussi WHERE email=:email AND ID_succes = :id_succes');
		 $query->execute([
		 	'email' => $_SESSION['email'],
		 	'id_succes' => $id_succes
		 	]);
		 $result = $query->fetch();
		 $query = null;

		 //If Achievement not started add in DB
		 	// If prog = goal achievement unlocked
		 	if($result[0] == $_SESSION['email'] && $result[1] == $achievementsInfo[1]){
		 		echo "<img src=\"1g.jpg\" />";
		 	// If prog != goal display progression
		 	} else {
		 		echo "<img src=\"1.jpg\" />";
			}

		if ( 1 ==	 1) {
			echo "string";
		}


		 ?>
	</body>
</html>
