<?php
		include "header.php";
	?>
		<title>Succes</title>
	</head>
	<body>
		<br />
		<br />
		<br />
		<?php
	  		include "navBar.php";
				etatSucces();
				giveSucces(4);
				$exp = getExp($_SESSION['email']);
				print_r($_SESSION);
				print_r($exp);
		?>
		<p><br>
			Work In progress (Succes)
		</p>
		<?php
	  		include "footer.php";
		?>
	</body>
</html>
