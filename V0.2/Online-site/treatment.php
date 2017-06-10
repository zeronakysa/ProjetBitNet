<?php
session_start();
require '../global/functions.php';
require '../global/conf.inc.php';
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
	<link rel="stylesheet" href="css/custom_css.css" />

	<!-- Custom font -->
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

	<!-- Css Plugin -->
	<link rel="stylesheet" href="lib/font-awesome/css/font-awesome.min.css">


		<title>Traitement</title>
	</head>
	<body>
		<?php
	  		include "navBar.php";
		?>
		<br /><br /><br />
		<h1>TREATMENT ZONE </h1>
    <?php
			print_r ($_POST);
			if ($_POST["action"]=="updateUser"){
				giveSucces(3);
				updateUser();
			}
			if ($_POST["action"]=="deleteUser" && is_numeric($_GET["id"])){
				$id = $_GET["id"];
				deleteUser($id);
			}
			if ($_POST["action"]=="unDeleteUser" && is_numeric($_GET["id"])){
				$id = $_GET["id"];
				unDeleteUser($id);
			}
			if ($_POST["action"]=="adminUser" && is_numeric($_GET["id"])){
				$id = $_GET["id"];
				adminUser($id);
			}
			if ($_POST["action"]=="editProject" && is_numeric($_POST["idProject"])){
				$id = $_POST["idProject"];
				$description = $_POST["description_projet"];
				updateProject($id, $description);
			}
			if ($_POST["action"]=="adminEditProject" && is_numeric($_POST["idProject"])){
				$id = $_POST["idProject"];
				$description = $_POST["description_projet"];
				adminUpdateProject($id, $description);
			}
			if ($_POST["action"]=="adminDeleteProject" && is_numeric($_POST["idProject"])){
				$id = $_POST["idProject"];
				adminDeleteProject($id);
			}			
			if ($_POST["action"]=="deleteProject" && is_numeric($_POST["idProject"])){
				$id = $_POST["idProject"];
				deleteProject($id);
			}
			if ($_POST["action"]=="createProject" && is_numeric($_GET["id"])){
				$id = $_GET["id"];
				createProject($id, $_POST["projectName"], $_POST["projetDescription"], $_SESSION["email"]);
			}
			if ($_POST["action"]=="deleteFile" && is_numeric($_POST["idFile"])){
				$id = $_POST["idFile"];
				deleteFile($id);
			}


			if ($_POST["action"]=="openCodeLive" && is_numeric($_POST["idFile"])){
				if(isset($_SESSION["token"])){
					unset($_SESSION["token"]);
					echo "reset token ok";
				}
				echo "NOTHIG HERE ! YET !";
			}
			include "footer.php";
		?>
	</body>
</html>
