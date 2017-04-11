<?php
	session_start();
	require "conf.inc.php";
	require "lib.php";
	include "header.php";

	if (isset($_SESSION['form_errors'])) {
		foreach ($_SESSION['form_errors'] as $error) {
			echo "<li>".$errors[$error];
		}
	}
?>

<h1 align="center">Inscrivez vous!</h1>

<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <form role="form" method="POST" action="saveUser.php">
                <div class="form-group float-label-control">
                    <label for="">Pseudo</label>
                    <input class="form-control" type="text" name="pseudo" placeholder="Votre pseudo" required="required" rows="1"
					value="<?php echo (isset($_SESSION['form_post']['pseudo'])) ? $_SESSION['form_post']['pseudo']:'' ?>">
                </div>
                <div class="form-group float-label-control">
                    <label for="">Email</label>
                    <input class="form-control" type="email" name="email" placeholder="Votre email" required="required" rows="1"
					value="<?php echo (isset($_SESSION['form_post']['email'])) ? $_SESSION['form_post']['email']:'' ?>" >
                </div>
                <div class="form-group float-label-control">
                    <label for="">Mot de passe</label>
                    <input class="form-control" type="password" name="pwd" placeholder="Votre mot de passe" required="required" rows="1">
                </div>
                <div class="form-group float-label-control">
                    <label for="">Confirmation mot de passe</label>
                    <input class="form-control" type="password" name="pwd2" placeholder="Confirmation" required="required" rows="1">
                </div>
                <div class="form-group float-label-control">
                    <label for="">Captcha</label><br>
                	<img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image">
                	<a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">Nouvelle image</a>
					<input class="form-control" type="text" name="captcha_code" size="10" maxlength="6" rows="1">						
				</div>
				<div>
					<input type="submit" value="S'enregistrer">
				</div>
            </form>

        </div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Consignes
                    </h3>
                </div>
                <div class="panel-body">
                    <ul>
                        <li>Le pseudo doit contenir entre 6 et 36 caractères</li>
                        <li>L'email doit être utiliser un format valide</li>
                        <li>Le mot de passe doit contenir entre 6 et 36 caractères</li>
                        <li>Le mot de passe de confirmation doit être identique au mot de passe</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
	//Supprimer les variables de session permettant
	//d'afficher les erreurs et les valeurs
	unset($_SESSION['form_post']);
	unset($_SESSION['form_errors']);
?>