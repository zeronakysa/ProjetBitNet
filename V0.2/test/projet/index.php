<?php

 session_start();
 require "../../global/conf.inc.php";
 require "../../global/functions.php";

 //Empêche d'accéder au online-site si on n'est pas connecté
 if (!isset($_SESSION['email']) && !isset($_SESSION['pseudo']) && !isset($_SESSION['online'])) {
   header('Location: ../Presentation/index.php');
 }
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

<!-- Custom font -->
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

<!-- Css Plugin -->


<div id="projet">

  <form method="post" action="phpProjet.php">
    <input type="text" name="projectName" id="projectName" placeholder="Nom du projet (50 caractères maximum)" maxlength="50" required="required"><br />
    <input type="text" name="description" id="description" placeholder="Description du projet (255 caractères maximum)" maxlength="255" required="required"></textarea><br />
    <input type="submit" value="Creer nouveau projet">
      </button><br />
  </form>
</div>
