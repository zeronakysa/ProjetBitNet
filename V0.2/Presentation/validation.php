<!-- Temporaire -->
<?php
	session_start();
	require 'conf.inc.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- BootStrap Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Bootstrap Css Link -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <!-- Custom Css Link -->
        <link rel="stylesheet" href="css/presentation.css" />
        <!-- Title -->
        <title>Bitnet</title>

        <!-- Custom font -->
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

        <!-- Css Plugin -->
        <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.min.css">
    </head>
    <body>
	<?php
		if ($_GET['id'] == 0 || $_GET['id'] == 1) {
			if ($_GET['id'] == 0) {
				echo "Ce pseudo ou cet email est déjà utilisé, veuillez réessayer";
			}elseif ($_GET['id'] == 1) {
				echo "Erreur lors de la tentative d'inscription, veuillez réessayer:";
				if (isset($_SESSION['form_errors'])) {
		        	foreach ($_SESSION['form_errors'] as $error) {
		            	echo "<li>".$errors[$error];
		        	}
		    	}
			}
	?>
	    	<form role="form" action="register.php" method="POST">
	            <div class="form-group float-label-control">
	                <label for="">Pseudo</label>
	                <input class="form-control" type="text" name="pseudo" placeholder="Votre pseudo" required="required" value="<?php echo (isset($_SESSION['form_post']['pseudo'])) ? $_SESSION['form_post']['pseudo']:'' ?>">
	            </div>
	            <div class="form-group float-label-control">
	                <label for="">Email</label>
	                <input class="form-control" type="email" name="email" placeholder="Votre email" required="required" value="<?php echo (isset($_SESSION['form_post']['email'])) ? $_SESSION['form_post']['email']:'' ?>" >
	            </div>
	            <div class="form-group float-label-control">
	                <label for="">Mot de passe</label>
	                <input class="form-control" type="password" name="pwd" placeholder="Votre mot de passe" required="required">
	            </div>
	            <div class="form-group float-label-control">
	                <label for="">Confirmation mot de passe</label>
	                <input class="form-control" type="password" name="pwd2" placeholder="Confirmation" required="required">
	            </div>
	            <div class="form-group float-label-control">
	                <label for="">Captcha</label><br>
	                <img src="captcha.php" alt="captcha">
	                <input class='form-control' type="text" name="captcha" placeholder="Votre captcha" required="required"
	                size="10" maxlength="6">
	                <input type="button" id="reload_captcha" name="reload" value="Recharger captcha">                       
	            </div>
	            <div>
	                <input type="submit" class="btn btn-default" value="S'enregistrer"> <br />
	                <small class="form-text text-muted">Aucune information ne sera partagée sur d'autres sites</small>
	            </div>
	        </form>
	<?php
	    }elseif ($_GET['id'] == 2) {
			echo "Félicitations vous êtes inscrits!";
			echo "<a href='../Online-site/index.php'>Se rendre sur le site</a>";
		}else{
	        echo "Bien essayé";
	        die();
	    }
	?>
	<a href="index.php">Retourner sur la page d'accueil</a>

	<script type="text/javascript">
        $(function() {
            $('#reload_captcha').click(function(){
                $('img').attr('src', 'captcha.php?cache=' + new Date().getTime());
            });
        });
    </script>

	</body>
	<?php
	    //Supprimer les variables de session permettant
	    //d'afficher les erreurs et les valeurs
	    unset($_SESSION['form_post']);
	    unset($_SESSION['form_errors']);
    ?>
</html>
