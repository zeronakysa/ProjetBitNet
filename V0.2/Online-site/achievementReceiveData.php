<?php
session_start();

require "../global/functions.php";
require "../global/conf.inc.php";

$connection = dbConnect();

// Get number of achievment in DB
$query = $connection->prepare("SELECT COUNT(ID_succes) FROM SUCCES");
$query->execute();
$nbOfAchievements = $query->fetch();

for($i = 1; $i <= $nbOfAchievements; $i++){

    $query = $connection->prepare("SELECT email, progression FROM succes_reussi WHERE email=:email AND ID_succes=:i");
    $query->execute([
        "email" => $_SESSION["email"],
        "i"     => $i
    ]);

    $achievementSucceed = $query->fetch();

    $query = $connection->prepare("SELECT ID_succes")

}

// Reminder SQL Request 
// SELECT 	succes_reussi.email,
// 		succes_reussi.progression,
//         succes.nom_succes,
//         succes.description_succes,
//         succes.xp_donnee,
//         succes.goal
//
// FROM	succes,
// 		succes_reussi
//
// WHERE 	succes.ID_succes = succes_reussi.ID_succes
// AND		succes_reussi.email = "steven.canta@gmail.com"
