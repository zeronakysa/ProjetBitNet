<?php
	function dbConnect(){
		//Se connecter à la bdd
		try{
				$connection = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBUSER, DBPWD);
		}catch(Exception $e){
				die("Erreur SQL".$e->getMessage());
		}

		return $connection;
	}

	function etatSucces(){
		$connection = dbConnect();
		// Nombre de succes dans la BDD
		$query = $connection->prepare('SELECT COUNT(ID_succes) FROM SUCCES');
		$query->execute();
		$maxSucces = $query->fetch();
		$query = null;

		//boucle pour parcourir et vérifier tous les succes du membre
		for ($i=1; $i <= $maxSucces[0]; $i++) {

			//Donne un email si le succes est reussi
			$query = $connection->prepare('SELECT email FROM succes_reussi WHERE succes_reussi.email = :email AND succes_reussi.ID_succes = :i');
			$query->execute([
				'email' => $_SESSION['email'],
				'i' => $i
				]);
			$result = $query->fetch();

			//Donne le nom du succes qui a pour ID $i
			$query = $connection->prepare('SELECT nom_succes FROM SUCCES WHERE ID_succes = :i');
			$query->execute(['i' => $i]);
			$nomSucces = $query->fetch();

			echo "Le succes <i>".$nomSucces[0];
			if ($result[0] == $_SESSION['email']){
				echo "</i> est réussi par l'utilisateur qui a pour email: '<i>".$_SESSION['email']."'</i><br />";
				}
			else{
				echo "</i> n'est pas réussi par l'utilisateur qui a pour email: '<i>".$_SESSION['email']."'</i><br />";
				}
			$result[0] = 0;
			}
			$query = null;
		}

	function giveSucces($id_succes){
		$connection = dbConnect();
		//verrifie si le succes est déjà reussi. Retourne un email si il l'est.
		$query = $connection->prepare('SELECT email FROM succes_reussi WHERE succes_reussi.email=:email AND succes_reussi.ID_succes = :$id_succes');
		$query->execute([
			'email' => $_SESSION['email'],
			'id_succes' => $id_succes
			]);
		$result = $query->fetch();

		//Donne le nom du succes qui a pour ID $id_succes
		$query = $connection->prepare('SELECT nom_succes FROM SUCCES WHERE ID_succes = :id_succes');
		$query->execute([
			'id_succes' => $id_succes
			]);
		$nomSucces = $query->fetch();

		//passe le succes en reussi donc créer une ligne dans la table succes_reussi
		if ($result[0] != $_SESSION['email']){
			$query = $connection->prepare('INSERT INTO `succes_reussi` (`email`, `ID_succes`) VALUES (:email, :id_succes)');
			$succesExist = $query->execute([
				'email'=>$_SESSION['email'],
				'id_succes'=>$id_succes
				]);

			if ($succesExist) {
				giveExp($_SESSION['email'], $id_succes);
			}
			
			echo "Succes </i>".$nomSucces[0]."</i> accompli ! Bravo ! <br />";
		}
		else {
			echo "Succes <i>".$nomSucces[0]."</i> déjà accompli..<br />";
		}
	}

	//Récupère l'exp actuel d'un membre
	function getExp($email){
		$connection = dbConnect();
		
		$query = $connection->prepare('SELECT experience FROM MEMBRE WHERE email=:email');
		$query->execute(['email'=>$email]);
		$result=$query->fetch();

		return $result[0];
	}

	//Donne l'exp associé au succes au membre
	function giveExp($email, $id_succes){
		$connection = dbConnect();

		$expMembre = getExp($email);

		$query = $connection->prepare('SELECT xp_donnee FROM SUCCES WHERE ID_succes=:id_succes');
		$query->execute(['id_succes'=>$id_succes]);
		$result = $query->fetch();

		$exp_donnee = $result[0];
		
		$result = null;

		$exp = $expMembre + $exp_donnee;

		$query = $connection->prepare('UPDATE MEMBRE SET experience = :exp WHERE email=:email');
		$query->execute([
			'exp' => $exp,
			'email' => $email
			]);
	}
?>
