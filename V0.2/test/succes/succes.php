<?php
    session_start();
    require "../../global/conf.inc.php";
    require "../../global/functions.php";

    $connection = dbConnect();

    $query = $connection->prepare('SELECT email FROM membre WHERE email=:email');

    $query->execute(['email'=>$_POST['email']]);

    $results = $query->fetch();

?>

$connection = dbConnect();

SELECT ID_succes FROM succes_reussi,MEMBRE where email.succes_reussi=email.MEMBRE
