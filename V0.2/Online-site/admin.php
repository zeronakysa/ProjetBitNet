
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
$query = $connection->query("SELECT * FROM MEMBRE"); 
$users =$query->fetchAll();

 ?>
<!--<section>-->

SIMPLE VISU + BOUTON

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
</table>
</pre>

TEST MODIFICATION

<pre>
	<table>
		<thead>
			<tr>
				<th>ID_membre </th>
				<th>E-mail </th>
				<th>Pseudo </th>
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
			?><td><input value="<?php echo ($user["pseudo"])?$user["pseudo"]:"";?>" type="text" name="pseudo" placeholder="pseudo" required="required"></td><?php
			?><td><input type="text" name="nom" value="<?php echo ($user["nom"])?$user["nom"]:"";?>" placeholder="nom"></td><?php
			?><td><input type="text" name="prenom" value="<?php echo ($user["prenom"])?$user["prenom"]:"";?>" placeholder="prenom"></td><?php
/*			echo "<td>".$user["pseudo"]." </td>";
			echo "<td>".$user["nom"]." </td>";
			echo "<td>".$user["prenom"]." </td>"; */
			echo "<td>".$user["langages"]." </td>";
			echo "<td>".$user["ville"]." </td>";

/*		?><td><input type="date" name="date_naissance" placeholder="Date de naissance"
			value="<?php echo date('d F Y', strtotime($user["date_naissance"]))?>"></td><?php
*/
			echo "<td>".date('d F Y', strtotime($user["date_naissance"]))." </td>";
			echo "<td>".date('d F Y', strtotime($user["date_creation"]))." </td>";
			echo "<td>".date('d F Y', strtotime($user["date_update"]))." </td>";
			?><td><input type="checkbox" name="is_Deleted" /></td><?php
//			echo "<td>".$user["is_deleted"]." </td>";
			echo "<td>".$user["succes_reussi"]." </td>";
			?><td>

				<select name="role">
					<?php
						foreach ($listOfRole as $key => $value) {
							$selected = (
											isset($user["role"])
											&&
											$user["role"]== $key
										)
										? "selected='selected'"
										:"";
							echo "<option value='".$key."' ".$selected.">".$value."</option>";
						}
					?>
				</select>

			</td><?php
	//		echo "<td>".$user["role"]." </td>";
			echo "<td>".$user["profile_picture"]." </td>";
			echo "<td>".$user["experience"]." </td>";
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
</table>
</pre>

  <?php
      include "footer.php";
  ?>
  </html>
