<?php

// Connection A la base de Donnée
try{
    $connection = new PDO("mysql:host=localhost;dbname=projet_bitnet", "root", "");
} catch(Exception $e) {
    die('Erreur :' .$e->getMessage());
}

// Insert message in bdd
$req = $connection->prepare('INSERT INTO shoutbox_message(pseudo, message) VALUES(:pseudo, :message)');
$req->execute(['pseudo'=>$_POST["pseudo"], 'message'=>$_POST["msg"]]);

header("Location: shoutbox.php");
