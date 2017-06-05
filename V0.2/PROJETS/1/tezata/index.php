<?php
		include "header.php";
	?>
		<title>Accueil</title>
	</head>
	<body>
		<?php
	  		include "navBar.php";
		?>
		<div class="container-fluid">
			<div  id="onlineFirstRow" class="row">
				<div class="col-lg-8 col-lg-offset-2 text-center">
					<h1>Bienvenue sur Bitnet</h1>
					<p><i>Découvrez nos fonctionnalités</i></p>
				</div>
			</div>
			<div class="row text-center">
				<div class="col-lg-4">
					<h2>CodeLive</h2>
					<a href="codelive.php"><img id="codeliveprez" src="css/img/codeliveprez.png" alt="codelive prez" /></a>
				</div>
				<div class="col-lg-4">
					<h2>HallOfFame</h2>
				</div>
				<div class="col-lg-4">
					<h2>ShoutBox</h2>
				</div>
			</div>
			<div class="row text-center">
				<div class="col-lg-4">
					<h2>Succès</h2>
				</div>
				<div class="col-lg-4">
					<h2>Projets</h2>
				</div>
				<div class="col-lg-4">
					<h2>Page Perso</h2>
				</div>
			</div>
		</div>
		<?php
	  		include "footer.php";
		?>
	</body>
</html>
