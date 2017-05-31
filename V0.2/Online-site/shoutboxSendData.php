<?php

require "../global/functions.php";
require "../global/conf.inc.php";

if( isset($_POST['pseudo']) &&
    !empty($_POST['msg'])){

        $connection = dbConnect();

        $request = $connection->prepare('INSERT INTO shoutbox_message()')

    }
