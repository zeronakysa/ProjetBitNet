<?php
session_start();
require "../global/conf.inc.php";
require "../global/functions.php";

$connection = dbConnect();

$query = $connection->prepare('SELECT pseudo, date_creation, experience FROM membre ORDER BY experience LIMIT 5');

//$connection->execute([$_GET['limit']]);
$query->execute();
$results = $query->fetchAll();

echo print_r($results);