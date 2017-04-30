<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>ShoutBox</title>
        <link rel="stylesheet" href="codeshare.css" />
    </head>
    <body>
        <div class="shoutbox_border">
            <?php
                try{
                    $connection = new PDO("mysql:host=localhost;dbname=projet_bitnet", "root", "");
                } catch(Exception $e) {
                    die('Erreur :' .$e->getMessage());
                }

                $rep = $connection->query('SELECT message FROM test ORDER BY ID_test');

                while($data = $rep->fetch()){
                    echo '<p><strong>'  .'</strong> :' .$data['message'] .'</p>';
                }
            ?>
        </div>
        <br />
        <div class="codeshare_input">
            <form action="codeshare_validation.php" method="POST">
                <input type="text" name="msg" placeholder="Votre message..." />
                <input type="submit" value="Envoyer" />
            </form>
        </div>
    </body>
</html>
