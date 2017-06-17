<?php
session_start();
header('Content-type: application/json');

require "../global/functions.php";
require "../global/conf.inc.php";

$connection = dbConnect();

// $request = $connection->prepare("SELECT ID_succes FROM `succes`");

// Select in DB All Achievement Done !
$request = $connection->prepare("   SELECT  SUCCES.*
                                    FROM    SUCCES, succes_reussi
                                    WHERE   SUCCES.ID_succes = succes_reussi.ID_succes
                                    AND     succes_reussi.progression = SUCCES.goal
                                    AND     succes_reussi.email=:email");

$request->execute(["email" => $_SESSION["email"]]);

$achievementArray = $request->fetchAll(PDO::FETCH_ASSOC);
// print_r($achievementArray);
echo json_encode($achievementArray);
