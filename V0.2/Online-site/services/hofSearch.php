<?php
session_start();
header('Content-type: application/json');

require "../../global/conf.inc.php";
require "../../global/functions.php";

if(isset($_GET["query"])) {

    $connection = dbConnect();

    $query = $connection->prepare("SELECT email, pseudo FROM membre");
    $query->execute();

    $hofResults = $query->fetchAll(PDO::FETCH_ASSOC);

    $matches = [];
    $query = trim($_GET['query']);
    $pattern = "#" . $query . "#i";

    foreach($hofResults as $result) {
        $is_not_empty = !empty(preg_grep($pattern, $result));

        if($is_not_empty){
            $matches[] = $result;
        }
    }

    echo json_encode($matches);

} else {
    die('Erreur GET');
}


 ?>
