<?php
    session_start();
    header('Content-type: application/json');

    require "../../global/functions.php";
    require "../../global/conf.inc.php";

    if(isset($_GET["query"])) {

        $connection = dbConnect();

        $request = $connection->prepare("SELECT * FROM succes");

        $request->execute();

        $achievementsResult = $request->fetchAll(PDO::FETCH_ASSOC);

        $matches = [];
        $pattern = "#" .$_GET["query"] ."#i";

        foreach($achievementsResult as $result) {
            $is_not_empty = !empty(preg_grep($pattern, $result));

            if($is_not_empty){
                $matches[] = $result;
            }
        }

        echo json_encode($matches);
    }

 ?>
