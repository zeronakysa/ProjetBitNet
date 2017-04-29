<!-- Temporaire -->
<?php
	session_start();
	require '../global/conf.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Validation</title>
	<?php
		require "header.php";
	?>
</head>

    <body>
	<?php
		if ($_GET['id'] == 0) {
			echo "Erreur lors de la tentative d'inscription, veuillez réessayer:";

			if (isset($_SESSION['form_errors'])) {
		        	foreach ($_SESSION['form_errors'] as $error) {
		            	echo "<li>".$errors[$error];
		        }
		    }
				require "register_form.php";
	    }elseif ($_GET['id'] == 1) {
			echo "Félicitations vous êtes inscrits!<br>";
		}elseif ($_GET['id'] == 2) {
			echo "Les identifiants sont incorrects";
			require "connectionForm.php";
		}else{
	        echo "Bien essayé";
	        die();
	    }
	?>
	<a href="index.php">Retourner sur la page d'accueil</a>

	<script src="functions.php"></script>

	</body>
	<?php
	    //Supprimer les variables de session permettant
	    //d'afficher les erreurs et les valeurs
	    unset($_SESSION['form_post']);
	    unset($_SESSION['form_errors']);
    ?>
</html>
