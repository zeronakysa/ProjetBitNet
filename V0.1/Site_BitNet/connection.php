<?php
session_start();
require "conf.inc.php";
require "lib.php";
require "header.php";
?>

<h1 align="center">Connectez vous!</h1>

<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <form role="form" method="POST">
                <div class="form-group float-label-control">
                    <label for="">Pseudo</label>
                    <input class="form-control" type="email" name="email" required="required" placeholder="Votre email" rows="1">
                </div>
                <div class="form-group float-label-control">
                    <label for="">Email</label>
                    <input class="form-control" type="password" name="pwd" required="required" placeholder="Votre mot de passe" rows="1">
                </div>
				<div>
					<input type="submit" value="S'enregistrer">
				</div>
            </form>

        </div>
    </div>
</div>

<?php

//est ce que les valeurs existes?
if (!empty($results) && !empty($_POST['email']) && !empty($_POST['pwd'])){

	//Récupération en bdd su mdp hashé
	$connection = dbConnect();
	$query = $connection->prepare('SELECT pwd FROM users WHERE email=:email');
	$query->execute(['email'=>$_POST['email']]);
	$results = $query->fetch();	
	print_r($results);

	//comparaison du mdp saisi avec le mdp hashé et affichage de l'erreur ou redirection sur index.php
	if(password_verify($_POST['pwd'], $results['pwd'])){
		//Générer une clé aléatoire grâce à la fonction md5
		//Insérer dans la colonne access_token cette clé en bdd
		//Enregistrer cett clé en session ainsi que son ID
		//Rediriger sur index.php
		$access_token = md5(uniqid() . $_POST['email'] . time());
		$query = $connection->prepare('UPDATE users SET access_token=:access_token WHERE email=:email');
		$query->execute(['access_token'=>$access_token], ['email'=>$_POST['email']]);
		$result = $query->fetch();
		header('Location: index.php');

		
	}else{
		//affichage de l'erreur
		echo "Mot de passe incorrect";
	}		
}
?>