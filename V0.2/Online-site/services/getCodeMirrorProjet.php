<?php
session_start();
require "../../global/conf.inc.php";
require "../../global/functions.php";

$idFichier = $_POST['id_fichier'];

$connection = dbConnect();

//On récupère le contenu_codelive en base
$query = $connection->prepare('SELECT content FROM fichier WHERE ID_fichier = ?');
$query->execute([
    $idFichier
]);

$results = $query->fetch();

print_r($results[0]);
