<?php
session_start();

require "../global/functions.php";
require "../global/conf.inc.php";

$connection = dbConnect();

$query = $connection->prepare("SELECT ID_succes FROM succes_reussi WHERE email=:email");
$query->execute([
    "email" => $_SESSION["email"]
]);

while($achievements = $query->fetch()){
    echo $achievements[0];
}
 ?>
