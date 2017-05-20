<?php
session_start();
require "../global/conf.inc.php";
require "../global/functions.php";

$token = $_POST['token'];
$content = $_POST['content'];

$connection = dbConnect();

//On vérifie si le membre a déjà écrit et enregistré pendant cette session
$query = $connection->prepare('SELECT token_session FROM codelive WHERE token_session = :token_session');
$query->execute(['token_session' => $token]);
$results = $query->fetch();

//Si le membre a déjà écrit et enregistré -> UPDATE sinon -> INSERT INTO
if ($results != null) {
	$date = new DateTime(null, new DateTimeZone('Europe/Paris'));
	$date = $date->format('Y-m-d H:i:s');

	$query = $connection->prepare('UPDATE codelive SET token_session = :token_session, last_update = :last_update, contenu_codelive = :contenu_codelive WHERE token_session = :token_session');
	$test = $query->execute([
		'token_session'=> $token,
		'last_update' => $date,
		'contenu_codelive' => $content
	]);
}else{
	$query = $connection->prepare('INSERT INTO codelive (`token_session`, `nom_createur`, `contenu_codelive`) VALUES (:token_session, :nom_createur, :contenu_codelive)');
	$test = $query->execute([
		'token_session'=> $token,
		'nom_createur' => $_SESSION['pseudo'],
		'contenu_codelive' => $content
	]);
}

//echo $test;