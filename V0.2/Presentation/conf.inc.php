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
	1 => "Le pseudo doit contenir entre 3 et 36 caractères.<br>",
	2 => "Le format de votre adresse email est invalide.<br>",
	3 => "Le mot de passe doit contenir entre 6 et 36 caractères.<br>",
	4 => "Le mot de passe ne peut pas être identique au pseudo.<br>",
	5 => "Le mot de passe de confirmation doit être identique au premier mot de passe.<br>",
	6 => "Le captcha n'est pas correct.",
	7 => "L'email existe déjà.<br>",
	8 => "Le pseudo existe déjà."
];
