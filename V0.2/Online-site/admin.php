
	<?php
		include "header.php";

		if ($_SESSION['role'] != 'admin') {
			header('Location: index.php');
		}
	?>
  <title>Page Administration</title>
</head>
<body>
	<?php
  		include "navBar.php";
	?>
  <br />
  <br />
  <br />


	<!--// **  V0.02  ** // -->
<?php
$connection = dbConnect();
$query = $connection->query("SELECT * FROM MEMBRE");
$users = $query->fetchAll();

 ?>
<!--<section>-->

<h2>Suppression de compte membre</h2>


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
			<!-- <th>Succes_reussi </th> -->
			<th>Role </th>
			<th>Profile_picture </th>
			<th>Experience</th>
		</tr>
	</thead>

<?php
	foreach ($users as $user) {
		echo "<tr>";
		echo "<td>".$user["ID_membre"]." </td>";
		echo "<td>".$user["email"]." </td>";
		echo "<td>".$user["pseudo"]." </td>";
		echo "<td>".$user["pwd"]." </td>";
		echo "<td>".$user["nom"]." </td>";
		echo "<td>".$user["prenom"]." </td>";
		echo "<td>".$user["langages"]." </td>";
		echo "<td>".$user["ville"]." </td>";
		echo "<td>".date('d F Y', strtotime($user["date_naissance"]))." </td>";
		echo "<td>".date('d F Y', strtotime($user["date_creation"]))." </td>";
		echo "<td>".date('d F Y', strtotime($user["date_update"]))." </td>";
		echo "<td>".$user["is_deleted"]." </td>";
		// echo "<td>".$user["succes_reussi"]." </td>";
		echo "<td>".$user["role"]." </td>";
		echo "<td>".$user["profile_picture"]." </td>";
		echo "<td>".$user["experience"]." </td>";
//			echo "<td>".$listOfGender[$user["gender"]]."</td>";
//			echo "<td>".$listOfCountry[$user["country"]]."</td>";
//			echo "<td>".$listOfStatus[$user["statut"]]."</td>";
		// Créer un lien en fin de ligne vers ce fichier
		// Envoyer en GET l'id de l'user

		echo "<td><form method=\"POST\" action='treatment.php?id=".$user["ID_membre"]."'></td>";
		?><form>
			<input type="hidden" name="action" value="deleteUser"/>
		<td><input type="submit" value="Supprimer"></td>
		</form><?php

		echo "<td><form method=\"POST\" action='treatment.php?id=".$user["ID_membre"]."'></td>";
		?><form>
			<input type="hidden" name="action" value="unDeleteUser"/>
		<td><input type="submit" value="Dé-Supprimer"></td>
		</form><?php

		echo "</tr>";
	}
?>
</table>
</pre>

<h2>Modification de compte membre</h2>
<pre>
	<table>
		<thead>
			<tr>
				<th>ID </th>
				<th>E-mail </th>
				<th>Pseudo </th>
				<th>Nom </th>
				<th>Prenom </th>
				<th>Langages </th>
				<th>Ville </th>
				<th>Date_naissance </th>
				<th>Date_creation </th>
				<th>Date_update </th>
<!--				<th>Is_deleted </th> -->
				<!-- <th>Succes_reussi </th> -->
				<th>Role </th>
				<th>Profile_picture </th>
				<th>Experience</th>
			</tr>
		</thead>

<?php
		foreach ($users as $user) {
			echo "<form method=\"POST\" action='treatment.php?id=".$user["ID_membre"]."'><tr>"; /* id=".$user["ID_membre"].", */
			echo "<td>".$user["ID_membre"]."</td>";
			echo "<td>".$user["email"]."</td>";?>
			<td><input value="<?php echo ($user["pseudo"])?$user["pseudo"]:"";?>" type="text" name="pseudo" placeholder="pseudo" required="required"></td>
			<td><input type="text" name="nom" value="<?php echo ($user["nom"])?$user["nom"]:"";?>" placeholder="Nom"></td>
			<td><input type="text" name="prenom" value="<?php echo ($user["prenom"])?$user["prenom"]:"";?>" placeholder="Prénom"></td>
			<td><input type="text" name="langages" value="<?php echo ($user["langages"])?$user["langages"]:"";?>" placeholder="langages"></td>
			<td><input type="text" name="ville" value="<?php echo ($user["ville"])?$user["ville"]:"";?>" placeholder="Code Postale"></td>
			<td><input type="date" name="date_naissance" placeholder="Date de naissance" value="<?php echo date('Y-m-d', strtotime($user["date_naissance"]))?>"></td>
			<td><input type="date" name="date_creation" placeholder="Date de creation" value="<?php echo date('Y-m-d', strtotime($user["date_creation"]))?>"></td>
			<td><input type="date" name="date_update" placeholder="Date d'update'" value="<?php echo date('Y-m-d', strtotime($user["date_update"]))?>"></td>
<!--			<td><input type="checkbox" name="is_Deleted" <?php if ($user["is_deleted"] == 1){echo "checked=\"checked\"";}else{};?>/></td> -->
			<!-- <td><input type="text" name="succes_reussi" value="
			<?php
			// echo ($user["succes_reussi"])?$user["succes_reussi"]:"";
			?>
			" placeholder="ID_succes,..."></td> -->
			<td><select name="role"><?php foreach ($listOfRole as $value) {
							if ($user["role"] == $value){$selected = "selected='selected'";}
							else {$selected = "";}echo $value;echo "<option value='".$value."' ".$selected.">".$value."</option>";}?></select></td>
			<td><input type="text" name="profile_picture" value="<?php echo ($user["profile_picture"])?$user["profile_picture"]:"";?>" placeholder="Chemin our URL"></td>
			<td><input type="text" name="experience" value="<?php echo ($user["experience"])?$user["experience"]:"";?>" placeholder="Expérience"></td>
<!--	 Créer un lien en fin de ligne vers ce fichier
			 Envoyer en GET l'id de l'user									-->
			 <input type="hidden" name="action" value="adminUser"/>
			<td><input type="submit" value="Modifier"></td>
			</form>
			</tr><?php
		}
?>
</table>
</pre>
<h2>Modification de projet</h2>

<?php
$connection = dbConnect();
$query = $connection->prepare("SELECT * FROM PROJET ");
$query->execute(['ID_membre' => $_SESSION["ID_membre"]]);
$projects = $query->fetchAll();
?>
	<pre>
		<table>
			<thead>
				<tr>
					<th>ID projet </th>
					<th>ID createur </th>
					<th>Date de création </th>
					<th>Nom Projet </th>
					<th>Description </th>
					<th>Is_deleted </th>
				</tr>
			</thead>
	<?php
			foreach ($projects as $project) {
				echo "<form method=\"POST\" action='treatment.php'><tr>"; /* id=".$user["ID_membre"].", */
				echo "<td>".$project["ID_projet"]."</td>";
				echo "<td>".$project["ID_createur"]."</td>";
				echo "<td>".date('d F Y', strtotime($project["date_creation"]))." </td>";?>
				<td><input type="text" name="nom_projet" value="<?php echo ($project["nom_projet"])?$project["nom_projet"]:"";?>" placeholder="Nom projet" required="required"></td>
				<td><input type="text" name="description_projet" value="<?php echo ($project["description_projet"])?$project["description_projet"]:"";?>" placeholder="Description projet"></td>
				<td><input type="checkbox" name="is_Deleted" <?php if ($project["is_deleted"] == 1){echo "checked=\"checked\"";}else{};?>/></td>
				<td><input type="hidden" name="idProject" value="<?php echo $project["ID_projet"] ?>"/></td>
				<td><input type="hidden" name="action" value="adminEditProject"/></td>
				<td><input type="submit" value="Modifier"></td>
			</form><?php
			echo "<td><form method=\"POST\" action='treatment.php'></td>";
			?><form>
				<td><input type="hidden" name="idProject" value="<?php echo $project["ID_projet"] ?>"/></td>
				<input type="hidden" name="action" value="adminDeleteProject"/>
			<td><input type="submit" value="Supprimer"></td>
			</form>
			</tr><?php
}
?>
</table>
</pre>
  <?php
      include "footer.php";
  ?>
  </html>
