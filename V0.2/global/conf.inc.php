<?php

define("HOST", "localhost");
define("DBNAME", "projet_bitnet");
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
	6 => "Le captcha n'est pas correct.<br>",
	7 => "Les conditions générales d'utilisations n'ont pas été acceptés.<br>",
	8 => "L'email existe déjà.<br>",
	9 => "Le pseudo existe déjà.<br>",
	10 => "Identifiants incorrects."
];

$listOfGender = [
			"m" => "Homme",
			"w" => "Femme",
			"o" => "Autre"
		  ];

$defaultGender = "m";

$listOfCountry = [
					"fr" => "France",
					"en" => "Anglais",
					"pl" => "Pologne"
				];
