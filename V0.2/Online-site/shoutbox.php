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
				<div id="msg_container" class="col-lg-6 col-lg-offset-3"></div>

				<div class="col-lg-6 col-lg-offset-3">
					<!-- Input -->
					<input id="pseudo" type="hidden" value="<?php echo isset($_SESSION['pseudo'])?$_SESSION['pseudo']:"";	?>"/>
					<textarea class="form-control" id="msg" type="text" placeholder="Votre message" autofocus onkeyup="onEnter(event)"/></textarea>
					<input class="btn btn-default" id="sendButton" type="button" value="Envoyer" onclick="sendMsg()"/>
				</div>

			</div>
		</div>


		<script src="../global/function.js"></script>
		<?php
	  		include "footer.php";
		?>
	</body>
</html>
