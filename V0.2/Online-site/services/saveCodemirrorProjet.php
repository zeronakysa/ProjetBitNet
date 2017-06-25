<?php
session_start();
require "../../global/conf.inc.php";
require "../../global/functions.php";

$idFichier = $_POST['id_fichier'];
$content = $_POST['content'];

$connection = dbConnect();

$date = new DateTime(null, new DateTimeZone('Europe/Paris'));
$date = $date->format('Y-m-d H:i:s');

$query = $connection->prepare('UPDATE fichier SET content = ?, date_modification = ? WHERE ID_fichier = ?');
$query->execute([
	$content,
	$date,
	$idFichier
]);
