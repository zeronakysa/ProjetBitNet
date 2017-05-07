<!-- Temporaire -->
<?php
	session_start();
	require '../global/conf.inc.php';
	require "../global/functions.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Validation</title>
	<?php
		require "header.php";
	?>
</head>

    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
	<?php
		if ($_GET['id'] == 0) {

			if (isset($_SESSION['form_errors'])) {
				echo "<h1 class='text-center'>Erreur lors de l'inscription</h1>";

				echo "<div class='panel panel-danger'>";
				echo "<div class='panel-heading'>Erreurs</div>";
		        	foreach ($_SESSION['form_errors'] as $error) {
						echo 	"<div class='panel-body'>" .$errors[$error] ."</div>";
		            	// echo "<li>".$errors[$error];
		        }
				echo "</div>";
		    }

			require "registerForm.php";

	    }elseif ($_GET['id'] == 1) {
	    	giveSucces(1);
			echo "Félicitations vous êtes inscrits!<br>";
		}elseif ($_GET['id'] == 2) {
			echo "Les identifiants sont incorrects";
			require "connectionForm.php";
		}else{
	        echo "Bien essayé";
	        die();
	    }
	?>
	

	<!-- Bootstrap Jquery Link -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript Link -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Script Reload Captcha -->
    <script src="../global/functions.js"></script>

	</body>
	<?php
	    //Supprimer les variables de session permettant
	    //d'afficher les erreurs et les valeurs
	    unset($_SESSION['form_post']);
	    unset($_SESSION['form_errors']);
    ?>
</html>
