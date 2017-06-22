<?php
session_start();
require "../../global/functions.php";
require "../../global/conf.inc.php";



if( isset($_SESSION['ID_membre']) &&
    !empty($_POST['msg'])){

        $connection = dbConnect();

        $req = $connection->prepare('INSERT INTO shoutbox_message (ID_sender,pseudo,date_send,message) VALUES(:ID_sender, :pseudo, NOW(), :message)');

        $req->execute([
            "ID_sender" => $_SESSION['ID_membre'],
            "pseudo"    => $_SESSION['pseudo'],
            "message"   => $_POST["msg"]
        ]);

        // Succès Shoutbox
        giveSucces(6);
}
