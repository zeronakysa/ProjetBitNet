<?php
session_start();
require "../global/conf.inc.php";
require "../global/functions.php";

$token = $_POST['token'];

$connection = dbConnect();

//On récupère le contenu_codelive en base
$query = $connection->prepare('SELECT contenu_codelive FROM codelive WHERE token_session = :token_session');
$query->execute(['token_session' => $token]);
$results = $query->fetch();

print_r($results[0]);