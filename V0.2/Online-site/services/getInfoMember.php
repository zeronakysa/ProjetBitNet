<?php
session_start();
header('Content-type: application/json');

require "../../global/conf.inc.php";
require "../../global/functions.php";

if (isset($_GET['pseudo'])) {

    $connection = dbConnect();

    $query = $connection->prepare("SELECT email AS Email,
                                    pseudo AS Pseudo,
                                    langages AS Langages,
                                    nom AS Nom,
                                    prenom AS Prenom,
                                    DATE_FORMAT(date_naissance, '%d/%m/%Y') AS Date_de_naissance,
                                    ville AS Ville,
                                    DATE_FORMAT(date_creation, '%d/%m/%Y') AS Date_inscription,
                                    role AS Role,
                                    experience AS Experience
                                    FROM membre
                                    WHERE pseudo = ?");
    $query->execute([
        $_GET['pseudo']
    ]);
    $result = $query->fetch(PDO::FETCH_ASSOC);

    echo json_encode($result);

} else {
    die('Informations manquantes');
}
