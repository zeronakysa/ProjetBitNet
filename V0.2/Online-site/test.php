<?php
session_start();
require '../global/functions.php';
require '../global/conf.inc.php';
	?>

	<!DOCTYPE html>
	<html>
	<head>

	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- BootStrap Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Bootstrap Css Link -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
	<!-- Custom Css Link -->
	<link rel="stylesheet" href="css/custom_css.css" />

	<!-- Custom font -->
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

	<!-- Css Plugin -->
	<link rel="stylesheet" href="lib/font-awesome/css/font-awesome.min.css">


		<title>TEST</title>
	</head>
	<body>

		<ul class="nav nav-pills">
  <li class="active"><a href="#tab1" data-toggle="tab">Programme</a></li>
  <li><a href="#tab2" data-toggle="tab">Nouveau Projet</a></li>
  <li><a href="#tab3" data-toggle="tab">Mes projet(s) créé(s)</a></li>
  <li><a href="#tab4" data-toggle="tab">Mes projet(s) actif(s)</a></li>
</ul>
<div class="tab-content">
	<div class="tab-pane active" id="tab1">
		<form method="post" action="test.php?test=1">
			<input type="text" name="newFile" id="newFile" placeholder="fichier.extension (55 caractères maximum)" maxlength="55" required="required"><br />
			<input type="hidden" name="action" value="createFile"/>
			<input type="submit" value="Creer nouveau projet">
		</form>
		<?php
			if(isset($_GET["test"])){
				$handle = fopen($_POST["newFile"], "w+");
				echo $handle;

			}
		?>
	</div>
  <div class="tab-pane" id="tab2">
		<div id="createProjet">
			<h3>Créer un nouveau projet</h3>
		<?php if(isset($_GET["ce"])){if ($_GET["ce"] == 1){
							echo 'Echec lors de la création du projet. Un projet portant le même nom existe déjà. Essayer avec un autre nom. <br />';}} ?>
			<form method="post" action="treatment.php?id=<?php echo $_SESSION["ID_membre"]; ?>">
				<input type="text" name="projectName" id="projectName" placeholder="Nom de projet (50 caractères maximum)" maxlength="50" required="required"><br />
				<input type="text" name="projetDescription" id="description" placeholder="Description du projet (255 caractères maximum)" maxlength="255" required="required">><br />
				<input type="hidden" name="action" value="createProject"/>
				<input type="submit" value="Creer nouveau projet">
					</button><br />
			</form>
		</div>
	</div>
  <div class="tab-pane" id="tab3">
		<div id="myProject">
			<h3>Mes projets créé</h3>
			<?php
			$connection = dbConnect();
			$query = $connection->prepare("SELECT * FROM PROJET WHERE ID_createur=:ID_membre AND is_deleted=0;");
			$query->execute(['ID_membre' => $_SESSION["ID_membre"]]);
			$myProjects = $query->fetchAll();
			if(!$myProjects){
				echo "<i>Vous n'avez créer aucun projets..</i>";
			}
			else {?>
				<pre>
					<table>
						<thead>
							<tr>
								<th>Date de création </th>
								<th>Nb. membres </th>
								<th>Nb. admins </th>
								<th>Nb. contribs </th>
								<th>Nb. fichiers </th>
								<th>Nom Projet </th>
								<th>Description </th>
							</tr>
						</thead>
				<?php
						foreach ($myProjects as $myProject) {

							// Compte le nombre de membres qui participe au projet
							$query = $connection->prepare("SELECT COUNT(DISTINCT email) FROM participe_projet WHERE ID_projet=:ID_projet;");
							$query->execute(['ID_projet' => $myProject["ID_projet"]]);
							$nbMembers = $query->fetch();
							// Compte le nombre d'admin qui participe au projet
							$query = $connection->prepare("SELECT COUNT(DISTINCT email) FROM participe_projet WHERE ID_projet=:ID_projet AND role_projet='admin';");
							$query->execute(['ID_projet' => $myProject["ID_projet"]]);
							$nbAdmins = $query->fetch();
							// Compte le nombre de contribs qui participe au projet
							$query = $connection->prepare("SELECT COUNT(DISTINCT email) FROM participe_projet WHERE ID_projet=:ID_projet AND role_projet='contrib';");
							$query->execute(['ID_projet' => $myProject["ID_projet"]]);
							$nbContribs = $query->fetch();
							// Compte le nombre de fichiers présent dans le projet
							$query = $connection->prepare("SELECT COUNT(DISTINCT ID_fichier) FROM FICHIER WHERE ID_projet=:ID_projet;");
							$query->execute(['ID_projet' => $myProject["ID_projet"]]);
							$nbFiles = $query->fetch();

							echo "<form method=\"POST\" action='treatment.php'><tr>"; /* id=".$user["ID_membre"].", */
							echo "<td>".date('d F Y', strtotime($myProject["date_creation"]))." </td>";
							echo "<td>".$nbMembers[0]." </td>";
							echo "<td>".$nbAdmins[0]." </td>";
							echo "<td>".$nbContribs[0]." </td>";
							echo "<td>".$nbFiles[0]." </td>";
							echo "<td>".$myProject["nom_projet"]." </td>";?>
							<td><input type="text" name="description_projet" value="<?php echo ($myProject["description_projet"])?$myProject["description_projet"]:"";?>" placeholder="Description projet"></td>
								<input type="hidden" name="action" value="editProject"/>
								<input type="hidden" name="idProject" value="<?php echo $myProject["ID_projet"] ?>"/>
							<td><input type="submit" value="Modifier"></td>
						</form>
						<td><form method="POST" action='treatment.php'></td>
							<input type="hidden" name="action" value="deleteProject"/>
							<input type="hidden" name="idProject" value="<?php echo $myProject["ID_projet"] ?>"/>
						<td><input type="submit" value="Supprimer"></td>
						</form>
						<form method="POST" action="manageProject.php">
							<input type="hidden" name="action" value="manageProject"/>
							<input type="hidden" name="projectID" value="<?php echo $myProject["ID_projet"]; ?>">
						<td><input type="submit" value="Gérer"></td>
						</form>
						</tr><?php
					}
						?>
					</table>
				</pre><?php
			}
			 ?>

		</div>
	</div>
  <div class="tab-pane" id="tab4">
		<div id="activeProject">
			<h3>Mes projets actifs</h3>
			<?php
			$connection = dbConnect();
			//Sort Les ID projet au quel le membre participe => $idProjects
			$query = $connection->prepare("SELECT DISTINCT projet.ID_projet FROM PROJET,participe_projet WHERE participe_projet.email=:email AND is_deleted=0 ;");
			$query->execute(['email' => $_SESSION["email"]]);
			$idProjects = $query->fetchAll();
			if(!$idProjects){
				echo "<i>Vous ne participez à aucun projets..</i>";
			}else {?>
				<pre>
					 <table>
						 <thead>
							 <tr>
								 <th>Date de création </th>
								 <th>Propriétaire </th>
								 <th>Nb. membres </th>
								 <th>Nb. fichiers </th>
								 <th>Nom Projet </th>
								 <th>Description </th>
							 </tr>
						 </thead><?php
							for ($i=0; $i < count($idProjects); $i++) {
									// Sort les infos de projet selon sont ID => $project
									$query = $connection->prepare("SELECT * FROM PROJET WHERE ID_projet=:ID_projet;");
									$query->execute(['ID_projet' => $idProjects[$i][0]]);
									$project = $query->fetch();
									// Sort le pseudo du propriétaire du projet selon son ID => $proprietaire
									$query = $connection->prepare("SELECT pseudo FROM MEMBRE WHERE ID_membre=:ID_createur;");
									$query->execute(['ID_createur' => $project["ID_createur"]]);
									$proprietaire = $query->fetch();
									// Compte le nombre de membres qui participe au projet
									$query = $connection->prepare("SELECT COUNT(DISTINCT email) FROM participe_projet WHERE ID_projet=:ID_projet;");
									$query->execute(['ID_projet' => $idProjects[$i][0]]);
									$nbMembers = $query->fetch();
									// Compte le nombre de fichiers présent dans le projet
									$query = $connection->prepare("SELECT COUNT(DISTINCT ID_fichier) FROM FICHIER WHERE ID_projet=:ID_projet;");
									$query->execute(['ID_projet' => $idProjects[$i][0]]);
									$nbFiles = $query->fetch();

								echo "<tr><td>".date('d F Y', strtotime($project["date_creation"]))." </td>";
								echo "<td>".$proprietaire[0]." </td>";
								echo "<td>".$nbMembers[0]." </td>";
								echo "<td>".$nbFiles[0]." </td>";
								echo "<td>".$project["nom_projet"]." </td>";
								echo "<td>".$project["description_projet"]." </td>";?>
								<form method="POST" action="manageProject.php">
									<input type="hidden" name="action" value="contribProject"/>
									<input type="hidden" name="projectID" value="<?php echo $project["ID_projet"]; ?>">
								<td><input type="submit" value="Contribuer"></td>
								</form></tr>
						<?php  } ?>
					</table>
				</pre>
			<?php } ?>
		</div>
	</div>
</div>
    <?php

			include "footer.php";
		?>
	</body>
</html>
