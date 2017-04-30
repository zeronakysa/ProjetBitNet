<?php

// Connection A la base de Donnée
try{
    $connection = new PDO("mysql:host=localhost;dbname=projet_bitnet", "root", "");
} catch(Exception $e) {
    die('Erreur :' .$e->getMessage());
}

// Insert message in bdd
$req = $connection->prepare('INSERT INTO test(message) VALUES(:message)');
$req->execute([ 'message'=>$_POST["msg"]]);

header("Location: codeshare.php");
