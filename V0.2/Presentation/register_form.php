<!-- Formulaire d'inscription -->
<form class="form-group" role="form" action="register.php" method="POST">
    <!-- Pseudo -->
    <label>Pseudo</label>
    <input class="form-control" type="text" name="pseudo" placeholder="Votre pseudo" required="required" value="<?php echo (isset($_SESSION['form_post']['pseudo'])) ? $_SESSION['form_post']['pseudo']:'' ?>">

    <!-- Adresse Email -->
    <label>Adresse e-mail</label>
    <input class="form-control" type="email" name="email" placeholder="Votre email" required="required"
    value="<?php echo (isset($_SESSION['form_post']['email'])) ? $_SESSION['form_post']['email']:'' ?>" >

    <!-- Mot de passe -->
    <label>Mot de passe</label>
    <input class="form-control" type="password" name="pwd" placeholder="Votre mot de passe" required="required">

    <!-- Verification Mot de passe -->
    <label>Vérification du mot de passe</label>
    <input class="form-control" type="password" name="pwd2" placeholder="Confirmation" required="required">

    <!-- Captcha -->
    <label>Captcha</label><br>
    <img src="captcha/captcha.php" alt="captcha">
    <!-- Reload Captcha Button -->
    <label>Recharger Captcha</label>
    <button id="reload_captcha" class="btn btn-default"><i class="fa fa-refresh" aria-hidden="true"></i></button>
    <br /><br />
    <input class='form-control' type="text" name="captcha" placeholder="Votre captcha" required="required">

    <input type="checkbox" name="CGU" />
    <label>J'ai lu et j'accepte les <a href="cgu.html" target="_blank">Conditions Générales d'Utilisation</a></label>
    <br />
    <!-- Button Submit -->
    <input id="modalRegisterButton" type="submit" class="btn btn-default" value="S'enregistrer"> <br />
    <small class="form-text text-muted">Aucune information ne sera partagée sur d'autres sites</small>
</form>
