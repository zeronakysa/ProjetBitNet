<?php
	include "header.php";
?>
	<title>Succes</title>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50" onload="displayAchievement()">
	<?php
		include "navBar.php";
	 ?>
	<div id="achievementContainer" class="container-fluid">
		<div class="row text-center">
			<div class="col-md-8 col-md-offset-2">
				<h1> Vos succès</h1>
				<input id="achievementSearchBar" class="form-control" type="text" name="achievementSearchBar" placeholder="Rechercher un succès" />
			</div>
		</div>
		<div id="achievementDisplay" class="row">
			
		</div>
	</div>
	<?php

		// etatSucces();
		// $exp = getExp($_SESSION['email']);
		// echo "<br>";
		// echo "Votre expérience: ";
		// print_r($exp);
	?>


	<?php
  		include "footer.php";
	?>
	<script src="achievement.js"></script>
	<script src="../global/functions.js"></script>
</body>
</html>
