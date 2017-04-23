<?php

define("HOST", "localhost");
define("DBNAME", "projet");
define("DBUSER", "root");
define("DBPWD", "");

$listOfStatus = [
			"Inactif",
			"Actif",
			"Banned",
			"Deleted"
		  ];

$errors = [
	1 => "Erreur: veuillez entrer un pseudo entre 3 et 36 caractères s'il vous plait.<br>",
	2 => "Erreur: Le format de votre adresse email est invalide.<br>",
	3 => "Erreur: Veuilleur choisir un mot de passe entre 6 et 36 caractères.<br>",
	4 => "Erreur: Le mot de passe ne peut pas être identique au pseudo.<br>",
	5 => "Erreur: Le mot de passe de confirmation doit être identique au premier mot de passe.<br>",
	6 => "Erreur: Le captcha n'est pas correcte",
	7 => "L'email existe déjà<br>",
	8 => "Le pseudo existe déjà"
];