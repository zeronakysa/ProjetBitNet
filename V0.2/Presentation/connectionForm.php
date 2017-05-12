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
                <p>Les identifiants sont incorrects - <a href="index.php">Retourner sur la page d'accueil</a></p>
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

        <!-- Footer -->
        <footer class="bitnet-footer navbar-fixed-bottom">
            <div class="container-fluid">
                <div class="row">
                    <div class="text-center">
                        <p>© Bitnet, 2017 - Tous droits réservés - <a href="mailto:stevencantagrel.contact@gmail.com" target="_top">Contact</a></p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap Jquery Link -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Bootstrap JavaScript Link -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </body>
</html>
