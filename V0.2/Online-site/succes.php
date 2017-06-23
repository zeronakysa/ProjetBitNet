<?php
	include "header.php";
?>
	<title>Succes</title>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
	<?php
		include "navBar.php";
	 ?>
	<div id="achievementContainer" class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h1 class="text-center"> Vos succès</h1>
				<input id="achievementSearchBar" class="form-control" type="text" name="achievementSearchBar" placeholder="Rechercher un succès" onkeyup="showResult(this.value)" />

				<div id="achievementSearchResult">

				</div>
			</div>
		</div>
		<div class="row">
			<div id="achievementDisplay" class="col-md-8 col-md-offset-2">

			</div>
		</div>
	</div>

	<?php
  		include "footer.php";
	?>
	<script src="js/succes.js"></script>
	<script src="../global/functions.js"></script>
</body>
</html>
