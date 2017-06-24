<?php
		include "header.php";
	?>
		<title>Hall of Fame</title>
	</head>
	<body>
		<?php
	  		include "navBar.php";
		?>
		<div id="hofContainer" class="container-fluid">
			<div class="row">
				<div id="result" class="col-md-8 col-md-offset-2">
					<h1 class="text-center"> Hall Of Fame</h1>
					<input id="hofSearchBar" class="form-control" type="text" name="hofSearchBar" placeholder="Rechercher un membre" onkeyup="showHofResult(this.value)" />

					<div id="hofSearchResult">

					</div>
				</div>
			</div>
			<div class="row hofFullDisplay">
				<div class="col-md-8 col-md-offset-2">
					<div class="col-md-4 text-center">
						<h3> Top XP </h3>
						<small>Top 20 membres avec le plus d'XP</small>

						<div id="hofXPDisplay">

						</div>
					</div>
					<div class="col-md-4 text-center">
						<h3> Top Projets </h3>
						<small>Top 20 membres de création projet</small>

						<div id="hofProjectDisplay">

						</div>
					</div>
					<div class="col-md-4 text-center">
						<h3> Top Shoutbox </h3>
						<small>Top 20 membres les plus bavards</small>

						<div id="hofShoutBoxDisplay">

						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
	  		include "footer.php";
		?>
		<script src="js/hallOfFame.js"></script>
		<script src="../global/functions.js"></script>
	</body>
</html>
