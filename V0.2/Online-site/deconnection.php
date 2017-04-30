<?php
	session_start();
	unset($_SESSION['pseudo']);
	unset($_SESSION['email']);
	unset($_SESSION['online']);

	header("Location: ../Presentation/index.php");