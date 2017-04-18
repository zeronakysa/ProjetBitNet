<?php

define("HOST", "localhost");
define("DBNAME", "projet2a");
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
	3 => "Erreur: Veuilleur choisir un mot de passe entre 8 et 16 caractères.<br>",
	4 => "Erreur: Le mot de passe ne peut pas être identique au pseudo.<br>",
	5 => "Erreur: Le mot de passe de confirmation doit être identique au premier mot de passe.<br>",
	6 => "L'email existe déjà<br>",
	7 => "Le pseudo existe déjà"


];

function isValidDate($date) {
    $arrayDate = explode("-", $date);
    
    if (!isset($arrayDate[0]) || !isset($arrayDate[1]) || !isset($arrayDate[2]))
        return false;
    
    if (!checkdate(intval($arrayDate[1]), intval($arrayDate[2]), intval($arrayDate[0])))
        return false;
        
    return true;
}

function isValidBirth($date) {
    if (!isValidDate($date))
        return false;
    
    $plus120 = strtotime("+120years", strtotime($date));
    $plus10  = strtotime("+10years", strtotime($date));
    $now     = strtotime("now");
    
    return $now > $plus10 && $now < $plus120;
}