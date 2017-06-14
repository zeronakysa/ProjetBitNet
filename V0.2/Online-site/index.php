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
					<a href="codelive.php"><i class="fa fa-code fa-5x" aria-hidden="true"></i></a>
				</div>
				<div class="col-lg-4">
					<h2>HallOfFame</h2>
					<a href="hallOfFame.php"><i class="fa fa-star-o fa-5x" aria-hidden="true"></i></a>
				</div>
				<div class="col-lg-4">
					<h2>ShoutBox</h2>
					<a href="shoutBox.php"><i class="fa fa-commenting-o fa-5x" aria-hidden="true"></i></a>
				</div>
			</div>
			<div class="row text-center">
				<div class="col-lg-4">
					<h2>Succès</h2>
					<a href="succes.php"><i class="fa fa-trophy fa-5x" aria-hidden="true"></i></a>
				</div>
				<div class="col-lg-4">
					<h2>Projets</h2>
					<a href="projet.php"><i class="fa fa-users fa-5x" aria-hidden="true"></i></a>
				</div>
				<div class="col-lg-4">
					<h2>Espace perso.</h2>
					<a href="espacePersonnel.php"><i class="fa fa-id-card-o fa-5x" aria-hidden="true"></i></a>
				</div>
			</div>
		</div>
		<?php
	  		include "footer.php";
		?>
	</body>
</html>
