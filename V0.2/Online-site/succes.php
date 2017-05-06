<?php
		include "header.php";
	?>
<<<<<<< HEAD
	<title>Succes</title>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
	<br />
	<br />
	<br />
	<?php
  		include "navBar.php";
			etatSucces();
			giveSucces(4);
	?>
=======
		<title>Succes</title>
	</head>
	<body>
		<br />
		<br />
		<br />
		<?php
	  		include "navBar.php";
				etatSucces();
				$id_succes = 4;
				giveSucces($id_succes);
				$exp = getExp($_SESSION['email']);
				print_r($_SESSION);
				print_r($exp);
		?>
>>>>>>> refs/remotes/origin/master

		<p><br>
			Work In progress (Succes)
		</p>
		<?php
	  		include "footer.php";
		?>
	</body>
</html>
