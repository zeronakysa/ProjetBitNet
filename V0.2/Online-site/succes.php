<?php
	session_start();
	require '../global/functions.php';
	require '../global/conf.inc.php';

	if (!isset($_SESSION['email']) && !isset($_SESSION['pseudo']) && !isset($_SESSION['online'])) {
		header('Location: ../Presentation/index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<?php
		include "header.php";
	?>
	<title>Bitnet</title>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
	<br />
	<br />
	<br />
	<?php
  		include "navBar.php";
			etatSucces();
			$id_succes = 4;
			giveSucces($id_succes);
	?>

	<p><br>
		Work In progress (Succes)
	</p>
	<?php
  		include "footer.php";
	?>
</body>
</html>
