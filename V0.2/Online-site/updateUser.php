<?php
		include "header.php";
	?>
		<title>UpdateUser</title>
	</head>
	<body>
		<?php
	  		include "navBar.php";
		?>
		<br />
		<br />
		<br />
<?php
		$connection=dbConnect();
		$query=$connection->prepare("SELECT * FROM MEMBRE WHERE email=:email");
		$query->execute(['email' => $_SESSION['email']]);
	  $user = $query->fetch();
?>
<section>
	<form method="POST" action="test.php?action=updateUser">
		<?php
			echo "<b>E-mail: </b>".$user["email"]."<br />";?>
			<b>Pseudo: </b><input value="<?php echo ($user["pseudo"])?$user["pseudo"]:"";?>" type="text" name="pseudo" placeholder="pseudo" required="required"><br />
			<b>Nom: </b><input type="text" name="nom" value="<?php echo ($user["nom"])?$user["nom"]:"";?>" placeholder="Nom"><br />
			<b>Prenom: </b><input type="text" name="prenom" value="<?php echo ($user["prenom"])?$user["prenom"]:"";?>" placeholder="Prénom"><br />
			<b>Languages</b><input type="text" name="langages" value="<?php echo ($user["langages"])?$user["langages"]:"";?>" placeholder="langages"><br />
			<b>Code postale: </b><input type="text" name="ville" value="<?php echo ($user["ville"])?$user["ville"]:"";?>" placeholder="Code Postale"><br />
			<b>Date de naissance: </b><input type="date" name="date_naissance" placeholder="Date de naissance" value="<?php echo date('Y-m-d', strtotime($user["date_naissance"]))?>"><br />
			<b>Image de profile: </b><input type="text" name="profile_picture" value="<?php echo ($user["profile_picture"])?$user["profile_picture"]:"";?>" placeholder="Chemin our URL"><br />
			<input type="submit" value="Mettre à jour">
		</form>
	</section>
<?php
	include "footer.php";
?>
