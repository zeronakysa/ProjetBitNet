<!-- Temporaire -->
<?php
	session_start();
	require 'conf.inc.php';
	require "header.php";
?>

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
