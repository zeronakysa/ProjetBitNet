
	<?php
		include "header.php";
	?>
  <title>Page Administration</title>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
	<?php
  		include "navBar.php";
	?>
  <br />
  <br />
  <br />
  <br />
  <br />
<?php

$connection = dbConnect();
$query = $connection->prepare('SELECT COUNT(ID_membre) FROM membre;');
$query->execute([]);
$i = $query->fetch();
$query = null;
$temp = $i[0];

for ($temp; $temp > 0 ; $temp--) {
	echo "<table>
					<tr>
						<th>ID_membre </th>
						<th>E-mail </th>
						<th>Pseudo </th>
						<th>pwd </th>
						<th>Nom </th>
						<th>Prenom </th>
						<th>Langages </th>
						<th>Date_naissance </th>
						<th>Ville </th>
						<th>Date_creation </th>
						<th>Date_update </th>
						<th>Is_deleted </th>
						<th>Succes_reussi </th>
						<th>Role </th>
						<th>Profile_picture </th>
						<th></th>
						</tr>
						<tr>";
  $query = $connection->prepare('SELECT * FROM membre where ID_membre LIKE '.$temp.';');
  $query->execute([]);
  $membre = $query->fetch();
  $query = null;
//  echo "<table>";
  print_r($membre);
  echo "</tr></table>";
}
?>

  </body>
  <?php
      include "footer.php";
  ?>
  </html>
