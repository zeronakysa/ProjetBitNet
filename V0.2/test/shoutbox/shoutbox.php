<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>ShoutBox</title>
        <link rel="stylesheet" href="shoutbox.css" />
    </head>
    <body>
        <div class="shoutbox_border">
            <?php
                try{
                    $connection = new PDO("mysql:host=localhost;dbname=shoutbox", "root", "");
                } catch(Exception $e) {
                    die('Erreur :' .$e->getMessage());
                }


                $rep = $connection->query('SELECT pseudo, message FROM shoutbox ORDER BY ID LIMIT 0, 10');

                while($data = $rep->fetch()){
                    echo '<p><strong>' .$data['pseudo'] .'</strong> :' .$data['message'] .'</p>';
                }
            ?>
        </div>
        <br />
        <div class="shoutbox_input">
            <form action="shoutbox_validation.php" method="POST">
                <input type="text" name="pseudo" placeholder="Votre pseudo..." />
                <input type="text" name="msg" placeholder="Votre message..." />
                <input type="submit" value="Envoyer" />
            </form>
        </div>
    </body>
</html>
