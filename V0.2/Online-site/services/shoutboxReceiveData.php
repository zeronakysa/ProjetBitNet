<?php
session_start();
require "../../global/functions.php";
require "../../global/conf.inc.php";

if(isset($_SESSION["ID_membre"])) {

    $connection = dbConnect();

    $req = $connection->prepare("SELECT pseudo, message, DATE_FORMAT(date_send, '%H:%i:%s') AS date_send FROM shoutbox_message ORDER BY ID_shoutbox_message ASC");
    $req->execute();

    while($messages = $req->fetch()){
        echo "<p>".$messages["date_send"] ." <strong>" .$messages["pseudo"]."</strong>" ." : "  .$messages["message"]."</p>";
    }
}
