
	<?php
		include "header.php";

		if ($_SESSION['role'] != 'admin') {
			header('Location: index.php');
		}
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

	<!--// **  V0.02  ** // -->
<?php
$connection = dbConnect();
$query = $connection->query("SELECT * FROM MEMBRE WHERE is_deleted=0;"); // écrit ainsi uniquement si une seule ligne
$users =$query->fetchAll();
 ?>
<!--<section>-->
	<pre>
	<table>
		<thead>
			<tr>
				<th>ID_membre </th>
				<th>E-mail </th>
				<th>Pseudo </th>
				<th>pwd </th>
				<th>Nom </th>
				<th>Prenom </th>
				<th>Langages </th>
				<th>Ville </th>
				<th>Date_naissance </th>
				<th>Date_creation </th>
				<th>Date_update </th>
				<th>Is_deleted </th>
				<th>Succes_reussi </th>
				<th>Role </th>
				<th>Profile_picture </th>
				<th>Experience</th>
			</tr>
		</thead>

<?php
		foreach ($users as $user) {
			echo "<tr>";
			echo "<td>".$user["ID_membre"]."</td>";
			echo "<td>".$user["email"]."</td>";
			echo "<td>".$user["pseudo"]."</td>";
			echo "<td>".$user["pwd"]."</td>";
			echo "<td>".$user["nom"]."</td>";
			echo "<td>".$user["prenom"]."</td>";
			echo "<td>".$user["langages"]."</td>";
			echo "<td>".$user["ville"]."</td>";
			echo "<td>".date('d F Y', strtotime($user["date_naissance"]))."</td>";
			echo "<td>".date('d F Y', strtotime($user["date_creation"]))."</td>";
			echo "<td>".date('d F Y', strtotime($user["date_update"]))."</td>";
			echo "<td>".$user["is_deleted"]."</td>";
			echo "<td>".$user["succes_reussi"]."</td>";
			echo "<td>".$user["role"]."</td>";
			echo "<td>".$user["profile_picture"]."</td>";
			echo "<td>".$user["experience"]."</td>";
//			echo "<td>".$listOfGender[$user["gender"]]."</td>";
//			echo "<td>".$listOfCountry[$user["country"]]."</td>";
//			echo "<td>".$listOfStatus[$user["statut"]]."</td>";

			// Créer un lien en fin de ligne vers ce fichier
			// Envoyer en GET l'id de l'user
			echo "<td><a href='updateUser.php?id=".$user["ID_membre"]."'>Modifier </a></td>";
			echo "<td><a href='deleteUser.php?id=".$user["ID_membre"]."'>Supprimer </a></td>";
			echo "</tr>";
		}
?>
</pre>

<!--</section>-->
<!--
// **  V0.01  ** //
<?php
/*
$connection = dbConnect();
$query = $connection->prepare('SELECT COUNT(ID_membre) FROM membre;');
$query->execute([]);
$i = $query->fetch();
$query = null;
$temp = $i[0];

echo "<br />";
echo $_SESSION['role'];
echo "<br />";

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
						<th>Experience</th>
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
*/
?>
-->
  </body>
  <?php
      include "footer.php";
  ?>
  </html>
