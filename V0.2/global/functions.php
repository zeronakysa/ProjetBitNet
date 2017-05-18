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
		$query = $connection->prepare('SELECT email FROM succes_reussi WHERE succes_reussi.email=:email AND succes_reussi.ID_succes = :id_succes');
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

	/*
			Trois fonction sont mise en place pour gérer les infos membre dans BDD,
			la première,
			deleteUser(ID_membre);
			deleteUser est accessible depuis admin.php
			ell passe is_deleted à 1 soit compte inactif/supprimé
			?? accessible depuis l'user par "supprimer mon compte" ?

			updateUser();
			updateUser met à jour les informations d'un utilisateur qui a le role 'user'
			met à jour les infos suivante de façon libre:
			pseudo, nom, prenom, code postale, langages, date de naisance, profile_picture
			débloque un succes lors de la première modification
			des vérification de sécurité sont à faire sur les entrées

			adminUser(ID_membre);
			adminUser est accessible depuis la page admin.php
			la fonction adminUser permet de manage tout les user, hors email et ID
			n'est accessible que avec le role 'admin'
			PAS DE VERIFICATION faite sur les entrées

	*/
	function updateUser(){
		//verification pas encore faite
		//ATTENTION
		$connection=dbConnect();
		$query=$connection->prepare("UPDATE membre SET
			pseudo = :pseudo,
			nom = :nom,
			prenom = :prenom,
			langages = :langages,
			date_naissance = :date_naissance,
			date_update = NOW(),
			profile_picture = :profile_picture
			WHERE email=:email");
		 $query->execute([
			"pseudo" => $_POST["pseudo"],
			"nom" => $_POST["nom"],
			"prenom" => $_POST["prenom"],
			"langages" => $_POST["langages"],
			"date_naissance" => $_POST["date_naissance"],
			"profile_picture" => $_POST["profile_picture"],
			"email" => $_SESSION["email"]
		]);
		header('Location: espacePersonnel.php');
	}

	function deleteUser($id){
		$connection=dbConnect();
		$query=$connection->prepare("UPDATE MEMBRE SET is_deleted=1 WHERE ID_membre=:id"); //les deux points mettent la donnée de l'execute
		$query->execute(["id" => $id]);
		header("Location: admin.php");
		}
		function unDeleteUser($id){
			$connection=dbConnect();
			$query=$connection->prepare("UPDATE MEMBRE SET is_deleted=0 WHERE ID_membre=:id"); //les deux points mettent la donnée de l'execute
			$query->execute(["id" => $id]);
			header("Location: admin.php");
			}

	function adminUser($id){
		$connection=dbConnect();
		$query=$connection->prepare("UPDATE membre SET
			pseudo = :pseudo,
			nom = :nom,
			prenom = :prenom,
			langages = :langages,
			date_naissance = :date_naissance,
			date_creation = :date_creation,
			date_update = NOW(),
			succes_reussi = :succes_reussi,
			role = :role,
			profile_picture = :profile_picture,
			experience = :experience
			WHERE ID_membre=:id");

		 $_SESSION["test"] = $query->execute([
			 "id" => $_GET["id"],
			"pseudo" => $_POST["pseudo"],
			"nom" => $_POST["nom"],
			"prenom" => $_POST["prenom"],
			"langages" => $_POST["langages"],
			"date_naissance" => $_POST["date_naissance"],
			"date_creation" => $_POST["date_creation"],
			"succes_reussi" => $_POST["succes_reussi"],
			"role" => $_POST["role"],
			"profile_picture" => $_POST["profile_picture"],
			"experience" => $_POST["experience"]
		]);
 /* DEBUG
		print_r ($_SESSION);
		echo "<br />";
		print_r ($_GET);
		echo "<br />";
		print_r ($_POST);
		echo "<br />";
		var_dump($connection);
		echo "<br />";
DEBUG */
		header("Location: admin.php");
	}


?>
