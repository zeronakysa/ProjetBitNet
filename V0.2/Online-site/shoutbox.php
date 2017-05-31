<?php

		include "header.php";
	?>
		<title>ShoutBox</title>
	</head>
	<body onload="displayMsg()">
		<?php
			include "navBar.php";
		?>

		<div class="container-fluid">
			<div class="row">
				<!-- Chat Box Display -->
				<div id="msg_container" class="col-lg-8 col-lg-offset-2"></div>
			</div>
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<!-- Input -->
					<input id="pseudo" type="hidden" value="<?php echo isset($_SESSION['pseudo'])?$_SESSION['pseudo']:"";	?>"/>
					<input class="form-control" id="msg" type="text" placeholder="Votre message" autofocus />
					<input class="btn btn-default" id="sendButton" type="button" value="Envoyer" onclick="sendMsg()"/>
				</div>
			</div>
		</div>



		<?php
	  		include "footer.php";
		?>
		<script src="shoutbox.js"></script>
		<script src="../global/functions.js"></script>
	</body>
</html>
