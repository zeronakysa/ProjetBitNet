<?php
	session_start();
	require "../global/conf.inc.php";
	require "../global/functions.php";
	$error = false;
	$listOfErrors = [];

	if (!empty($_POST['pseudo']) &&
		!empty($_POST['email']) &&
		!empty($_POST['pwd']) &&
		!empty($_POST['pwd2']) &&
		!empty($_POST['captcha']) &&
		count($_POST) >= 5 && count($_POST) <=6)
	{

		$_POST['pseudo'] = trim($_POST['pseudo']);
		$_POST['email'] = trim($_POST['email']);

		//pseudo entre 3 et 36 caractères
		if (strlen($_POST['pseudo']) < 3 || strlen($_POST['pseudo']) > 36) {
			$error = true;
			$listOfErrors[] = 1;
		}

		//format email valide
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$error = true;
			$listOfErrors[] = 2;
		}

		//pwd entre 6 et 36 caractères
		if (strlen($_POST['pwd']) < 6 || strlen($_POST['pwd']) > 36) {
			$error = true;
			$listOfErrors[] = 3;
		}

		//vérification pwd différend de pseudo
		if ($_POST['pwd'] == $_POST['pseudo']) {
			$error = true;
			$listOfErrors[] = 4;
		}

		//vérification pwd2 différend de pwd
		if ($_POST['pwd2'] != $_POST['pwd']) {
			$error = true;
			$listOfErrors[] = 5;
		}

		//vérification captcha
		if ($_POST['captcha'] != $_SESSION['captcha']) {
			$error = true;
			$listOfErrors[] = 6;
		}

		if (!isset($_POST['CGU'])){
			$error = true;
			$listOfErrors[] = 7;
		}

		if (!$error) {
			$connection = dbConnect();

			//est ce que l'email existe?
			$query = $connection->prepare('SELECT email FROM membre WHERE email=:email');

			$query->execute(['email'=>$_POST['email']]);

			$results = $query->fetch();

			if (!empty($results)) {
				$error = true;
				$listOfErrors[] = 8;
			}

			$query = null;

			//est ce que le pseudo existe?
			$query = $connection->prepare('SELECT pseudo FROM membre WHERE pseudo=:pseudo');

			$query->execute(['pseudo'=>$_POST['pseudo']]);

			$results = $query->fetch();

			if (!empty($results)) {
				$error = true;
				$listOfErrors[] = 9;
			}
		}

		if ($error) {
			$_SESSION['form_post'] = $_POST;
			$_SESSION['form_errors'] = $listOfErrors;

			header("Location: validation.php?id=0");
			
		}
		else{

			$query = null;

			$query = $connection->prepare("
				INSERT INTO membre (pseudo, email, pwd, date_creation)
				VALUES (:pseudo, :email, :pwd, NOW())
				");

			$pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

			$query->execute([
				'pseudo' => $_POST['pseudo'],
				'email' => $_POST['email'],
				'pwd' => $pwd
				]);
			$_SESSION['email'] = $_POST['email'];

			header("Location: validation.php?id=1");
		}
	}else{
		echo "Bien essayé";
		die();
	}
	
?>