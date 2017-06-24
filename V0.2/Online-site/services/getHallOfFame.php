<?php
session_start();
header('Content-type: application/json');

require "../../global/conf.inc.php";
require "../../global/functions.php";

if (isset($_GET['query'])) {
    $connection = dbConnect();

    if ($_GET['query'] == 1) {

        $query = $connection->prepare('SELECT pseudo, experience FROM membre ORDER BY experience DESC LIMIT 20');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($result);

    } else if ($_GET['query'] == 2) {

        $query = $connection->prepare('SELECT ID_membre FROM membre');
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $members = $results;
        $query = null;
        $results = null;
        $array = [];

        foreach ($members as $member) {
            $query = $connection->prepare('SELECT membre.pseudo, COUNT(projet.Id_createur) AS countProject FROM projet,membre WHERE membre.ID_membre = projet.ID_createur AND membre.ID_membre = ? GROUP  BY membre.pseudo ORDER BY countProject LIMIT 20');
            $query->execute([$member['ID_membre']]);
            $results = $query->fetch(PDO::FETCH_ASSOC);

            $array[] = $results;
        }

        echo json_encode($array);

    } else if ($_GET['query'] == 3) {

        $query = $connection->prepare('SELECT ID_membre FROM membre');
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $members = $results;
        $query = null;
        $results = null;
        $array = [];

        foreach ($members as $member) {
            $query = $connection->prepare('SELECT membre.pseudo, COUNT(shoutbox_message.Id_sender) AS countMessage FROM shoutbox_message,membre WHERE membre.ID_membre = shoutbox_message.ID_sender AND membre.ID_membre = ? GROUP BY pseudo ORDER BY countMessage LIMIT 20');
            $query->execute([$member['ID_membre']]);
            $results = $query->fetch(PDO::FETCH_ASSOC);

            $array[] = $results;
        }

        echo json_encode($array);

    } else {
        die('Informations données incorrectes');
    }
} else {
    die('Informations manquantes');
}
