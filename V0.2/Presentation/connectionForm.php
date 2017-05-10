<!DOCTYPE html>
<html>
    <head>
        <title>Erreur Connexion</title>
        <?php
            require "header.php";
         ?>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row text-center">
                <h1>Erreur lors de la connexion</h1>
            </div>
            <div class="row">
                <div id="connectionForm" class="col-md-8 col-md-offset-2">
                    <form class="form-group" role="form" action="connection.php" method="POST">
                        <!-- Adresse Email -->
                        <label>Adresse e-mail</label>
                        <input class="form-control" type="email" name="email" placeholder="Votre email" required="required">

                        <!-- Mot de passe -->
                        <label>Mot de passe</label>
                        <input class="form-control" type="password" name="pwd" placeholder="Votre mot de passe" required="required">

                        <br>

                        <!-- Button Submit -->
                        <input type="submit" class="btn btn-default" value="Se connecter"> <br />
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
