<?php
	require "header.php";
	// Vérifier le GET
	if(!empty($_GET["id"]) && count($_GET)==1 && is_numeric($_GET["id"])){
	// Récupérer en base de données toutes les informations sur l'user
		$connection=dbConnect();
		$query=$connection->prepare("SELECT * FROM MEMBRE WHERE email=:email");
		$query->execute(['email' => $_SESSION['email']]);
	  $user=$query->fetch();

}
?>
<section>
	<form method="POST" action="saveUser.php?id=<?php echo $_GET['id']?>">
<table>
		<tr>
			<th>E-mail </th>
			<th>Pseudo </th>
			<th>Nom </th>
			<th>Prenom </th>
			<th>Langages </th>
			<th>Ville </th>
			<th>Date_naissance </th>
			<th>Profile_picture </th>
			<th>Action</th>
		</tr>

		<?php
		echo "<tr>";
		echo "<td>".$user["email"]."</td>";?>
		<td><input value="<?php echo ($user["pseudo"])?$user["pseudo"]:"";?>" type="text" name="pseudo" placeholder="pseudo" required="required"></td>
		<td><input type="text" name="nom" value="<?php echo ($user["nom"])?$user["nom"]:"";?>" placeholder="Nom"></td>
		<td><input type="text" name="prenom" value="<?php echo ($user["prenom"])?$user["prenom"]:"";?>" placeholder="Prénom"></td>
		<td><input type="text" name="langages" value="<?php echo ($user["langages"])?$user["langages"]:"";?>" placeholder="langages"></td>
		<td><input type="text" name="ville" value="<?php echo ($user["ville"])?$user["ville"]:"";?>" placeholder="Code Postale"></td>
		<td><input type="date" name="date_naissance" placeholder="Date de naissance" value="<?php echo date('Y-m-d', strtotime($user["date_naissance"]))?>"></td>
		<td><input type="text" name="profile_picture" value="<?php echo ($user["profile_picture"])?$user["profile_picture"]:"";?>" placeholder="Chemin our URL"></td>
<!--	 Créer un lien en fin de ligne vers ce fichier
		 Envoyer en GET l'id de l'user									-->
		<td><input type="submit" value="Modifier"></td>
	</tr>
	</form>
</table>
</section>
<?php
	include "footer.php";
?>
