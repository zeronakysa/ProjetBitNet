<?php
session_start();
$image;

$redBackgroundColor=rand(0, 255);		//initialisation couleurs aléatoire pour le fond
$greenBackgroundColor=rand(0, 255);
$blueBackgroundColor=rand(0, 255);

$image = imagecreate(300, 150);
$backgroundColor = imagecolorallocate($image, $redBackgroundColor, $greenBackgroundColor, $blueBackgroundColor);

$nbChar = 6;
$charAuthorized = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$charAuthorized = str_shuffle($charAuthorized); // créé un captcha à 6 caractères aléatoire
$captcha = substr($charAuthorized, 0, $nbChar);
$_SESSION['captcha'] = $captcha;

//$fontsFiles = array_diff(scandir("fonts/"), [".", ".."]); // scandir récupère les fichiers dans le dossier précisé et les placent dans un tableau
//$fonts = "fonts/" . $fontsFiles[array_rand($fontsFiles)]; // array_diff permet de retirer le cas où le fichier s'appelle . ou ..
                                                                // cas possible sur linux par exemple

for ($i=0; $i < $nbChar ; $i++) { 
	$redTextColor = (~$redBackgroundColor) % 255;		//initialisation des couleurs du texte en prenant
	$greenTextColor = (~$greenBackgroundColor) % 255;	//l'opposé du background grâce à ~
	$blueTextColor = (~$blueBackgroundColor) % 255;		//~ permet d'inverser les bits entre 1 et 0 ce qui permet
														//d'obtenir un très bon contraste 

	$textColor = imagecolorallocate($image, $redTextColor, $greenTextColor, $blueTextColor); //soucis: les valeurs sont négatives donc le texte n'a pas d'aliasing

	$textColor = $textColor + 3; //Permet de forcer le typage de la variable $textColor en entier afin que
                                 //valeurs ne soient plus négatives et ainsi reactiver l'antialiasing

	imagettftext($image, rand(25, 50), rand(-20, 20), $i*45+15, rand(70, 90), $textColor, "Calibri.ttf", $captcha[$i]);
	imagerectangle($image, rand(0, 300), rand(0, 300), rand(0, 150), rand(0, 150), $textColor);
	imageellipse($image, rand(0, 300), rand(0, 150), rand(0, 150), rand(0, 150), $textColor);
}

header ("Content-type: image/png");
imagepng($image);