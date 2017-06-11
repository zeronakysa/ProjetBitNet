<?php
header('Content-type: application/json');
session_start();

require "../global/functions.php";
require "../global/conf.inc.php";

$connection = dbConnect();

// $request = $connection->prepare("SELECT * FROM succes");
$request = $connection->prepare("   SELECT  succes_reussi.email,
                                            succes_reussi.progression,
                                            succes.nom_succes,
                                            succes.description_succes,
                                            succes.xp_donnee,
                                            succes.goal
                                    FROM    succes, succes_reussi
                                    WHERE   succes.ID_success = succes_reussi.ID_succes
                                    AND     succes_reussi.progression = succes.goal
                                    AND     succes_reussi.email=:email");

$request->execute(['email' => $_SESSION['email']]);

$achievementArray = $request->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($achievementArray);




// Reminder SQL Request
// SELECT 	succes_reussi.email,
// 		succes_reussi.progression,
//         succes.nom_succes,
//         succes.description_succes,
//         succes.xp_donnee,
//         succes.goal
// FROM succes, succes_reussi
// WHERE succes.ID_succes = succes_reussi.ID_succes
// AND succes_reussi.progression <= succes.goal
// AND succes_reussi.email = "steven.canta@gmail.com"
