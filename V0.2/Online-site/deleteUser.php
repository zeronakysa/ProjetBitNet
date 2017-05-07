<?php
require "header.php";

if(!empty($_GET["id"]) && count($_GET)==1 && is_numeric($_GET["id"])){

$connection=dbConnect();
$query=$connection->prepare("UPDATE MEMBRE SET is_deleted=1 WHERE ID_membre=:id"); //les deux points mettent la donnée de l'execute
$query->execute($_GET);

}

header("Location: admin.php");
