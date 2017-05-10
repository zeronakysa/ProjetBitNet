<?php
	session_start();
	require '../global/functions.php';
	require '../global/conf.inc.php';

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
<link rel="stylesheet" href="css/custom_css.css" />

<!-- Custom font -->
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

<!-- Css Plugin -->
<link rel="stylesheet" href="lib/font-awesome/css/font-awesome.min.css">
