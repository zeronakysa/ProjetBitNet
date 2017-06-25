<?php
session_start();
require '../../global/functions.php';
require '../../global/conf.inc.php';
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


		<title>TEST</title>
	</head>
	<body>

	<ul class="nav nav-pills">
		<li class="active"><a href="#tab1" data-toggle="tab">Nouveau fichier</a></li>
		<li><a href="#tab2" data-toggle="tab">Nouveau Projet</a></li>
		<li><a href="#tab3" data-toggle="tab">Mes projet(s) créé(s)</a></li>
		<li><a href="#tab4" data-toggle="tab">Mes projet(s) actif(s)</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tab1">
			<h3>Créer un nouveau fichier</h3>

		</div>
	  <div class="tab-pane" id="tab2">
			<div id="createProjet">
				<h3>Créer un nouveau projet</h3>
			</div>
		</div>
	  <div class="tab-pane" id="tab3">
			<div id="myProject">
				<h3>Mes projets créé</h3>

			</div>
		</div>
	  <div class="tab-pane" id="tab4">
			<div id="activeProject">
				<h3>Mes projets actifs</h3>

			</div>
		</div>
	</div>
    <?php

			include "footer.php";
		?>
	</body>
</html>
