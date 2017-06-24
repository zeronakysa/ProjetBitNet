<?php
session_start();
header('Content-type: application/json');

require "../../global/conf.inc.php";
require "../../global/functions.php";

if (isset($_GET['pseudo'])) {

    $connection = dbConnect();

    $query = $connection->prepare('SELECT email, pseudo, date_naissance, ville, date_creation, role, experience FROM membre WHERE pseudo = ?');
    $query->execute([
        $_GET['pseudo']
    ]);
    $result = $query->fetch(PDO::FETCH_ASSOC);

    echo json_encode($result);

} else {
    die('Informations manquantes');
}
