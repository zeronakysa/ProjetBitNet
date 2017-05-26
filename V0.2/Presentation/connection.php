<?php
session_start();
require '../global/conf.inc.php';
require '../global/functions.php';
$error = false;
$listOfErrors = [];
if (!empty($_POST['email']) &&
	!empty($_POST['pwd']) &&
	count($_POST) == 2) {
	$connection = dbConnect();
	//est ce que le compte existe?
	$query = $connection->prepare('SELECT pwd FROM membre WHERE email=:email');
	$query->execute(['email' => $_POST['email']]);
	$results = $query->fetch();
	$pwd = $results;
	$results = null;
	if (password_verify($_POST['pwd'], $pwd[0])) {
		$query = $connection->prepare('SELECT email, pwd FROM membre WHERE email=:email AND pwd=:pwd');
		$password = $pwd[0];
		$query->execute(['email' => $_POST['email'],
		 								 'pwd' => $password]);
		$results = $query->fetch();
		if (empty($results)) {
			$error = true;
			$listOfErrors[] = 10;
		}
	}else{
		$error = true;
		$listOfErrors[] = 10;
	}
    if ($error) {
    	header("Location: validation.php?id=2");
    }else{
        $_SESSION['email'] = $_POST['email'];
	    $_SESSION['online'] = 1;
      $query = null;
      $query = $connection->prepare('SELECT role, pseudo, profile_picture FROM MEMBRE WHERE email = :email');
      $query->execute(['email'=>$_SESSION['email']]);
      $result = $query->fetch();
      $_SESSION['role'] = $result[0];
      $_SESSION['pseudo'] = $result[1];
			$_SESSION['profile_picture'] = $result[2];
      unset($_SESSION['captcha']);
      giveSucces(2);
    	header("Location: ../Online-site/index.php");
    }
}else{
    echo "Bien essayé";
    die();
}
