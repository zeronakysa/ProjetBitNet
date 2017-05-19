<!-- Formulaire d'inscription -->
<div class="container-fluid">
	<div class="row text-center">
		<h1> Erreur lors de l'inscription</h1>
	</div>
	<div class="row">
		<div id="registerForm" class="col-md-8 col-md-offset-2">
			<form class="form-group" role="form" action="register.php" method="POST">
				<!-- Pseudo -->				
				<label>Pseudo</label>
				<i class="fa fa-user"></i>
				<input class="form-control" type="text" name="pseudo" placeholder="Votre pseudo" required="required" value="<?php echo (isset($_SESSION['form_post']['pseudo'])) ? $_SESSION['form_post']['pseudo']:'' ?>">

		<div class="container-fluid">
			<div class="row">
				<div id="registerForm" class="col-md-8 col-md-offset-2">
					<form class="form-group" role="form" action="register.php" method="POST">
						<!-- Pseudo -->
						<label>Pseudo</label>
						<input class="form-control col-4" type="text" name="pseudo" placeholder="Votre pseudo" required="required" value="<?php echo (isset($_SESSION['form_post']['pseudo'])) ? $_SESSION['form_post']['pseudo']:'' ?>">
				    
            <!-- Adresse Email -->				
				    <label>Adresse e-mail</label>
				    <i class="fa fa-at"></i>
				    <input class="form-control" type="email" name="email" placeholder="Votre email" required="required"
				    value="<?php echo (isset($_SESSION['form_post']['email'])) ? $_SESSION['form_post']['email']:'' ?>" >
				
            <!-- Mot de passe -->				
				    <label>Mot de passe</label>
				    <i class="fa fa-lock"></i>
				    <input class="form-control" type="password" name="pwd" placeholder="Votre mot de passe" required="required">

				    <!-- Verification Mot de passe -->				
				    <label>Vérification du mot de passe</label>
				    <i class="fa fa-lock"></i>
				    <input class="form-control" type="password" name="pwd2" placeholder="Confirmation" required="required">

						<!-- Captcha -->
						<label>Captcha</label><br>
						<img id="captcha" src="captcha/captcha.php" alt="captcha">
						
            <!-- Reload Captcha Button -->
						<label>Recharger Captcha</label>
						<button type="button" id="reload_captcha" class="btn btn-default"><i class="fa fa-refresh" aria-hidden="true"></i></button>
						<br /><br />
						<input class='form-control' type="text" name="captcha" placeholder="Votre captcha" required="required">

						<input type="checkbox" name="CGU" />
						<label>J'ai lu et j'accepte les <a href="cgu.html" target="_blank">Conditions Générales d'Utilisation</a></label>
						<br />
            
						<!-- Button Submit -->
						<input id="modalRegisterButton" type="submit" class="btn btn-default" value="S'enregistrer"> <br />
						<small class="form-text text-muted">Aucune information ne sera partagée sur d'autres sites</small>
					</form>
				</div>
			</div>
			<div class="row text-center">
				<a href="index.php">Retourner sur la page d'accueil</a>
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
	
<!-- Script Reload Captcha -->
<script src="../global/functions.js"></script>