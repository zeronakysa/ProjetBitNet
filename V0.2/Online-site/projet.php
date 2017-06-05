<?php
		include "header.php";
	?>
	<title>Gestionnaire de projet</title>
</head>
	<body>
		<?php
	  		include "navBar.php";
		?>
<div id="projet" class="container-fluid">

		<?php
				$connection=dbConnect();
				$query=$connection->prepare("SELECT * FROM MEMBRE WHERE email=:email");
				$query->execute(['email' => $_SESSION['email']]);
			  $user = $query->fetch();

				if(isset($_SESSION["ID_project"])){
					$_SESSION["ID_project"] = -1;
				}else{
					$_SESSION["ID_project"] = -1;
				}
		?>
		<section>
			<div id="gestionnaireProjet">
				<h2>Gestionnaire de projets</h2>
				<div id="createProjet">
					<h3>Créer un nouveau projet</h3>
				<?php if(isset($_GET["ce"])){if ($_GET["ce"] == 1){
				          echo 'Echec lors de la création du projet. Un projet portant le même nom existe déjà. Essayer avec un autre nom. <br />';}} ?>
				  <form method="post" action="treatment.php?id=<?php echo $_SESSION["ID_membre"]; ?>">
				    <input type="text" name="projectName" id="projectName" placeholder="Nom de projet (50 caractères maximum)" maxlength="50" required="required"><br />
				    <input type="text" name="projetDescription" id="description" placeholder="Description du projet (255 caractères maximum)" maxlength="255" required="required"></textarea><br />
						<input type="hidden" name="action" value="createProject"/>
				    <input type="submit" value="Creer nouveau projet">
				      </button><br />
				  </form>
				</div>
				<div id="myProject">
					<h3>Mes projets créé</h2>
					<?php
					$connection = dbConnect();
					$query = $connection->prepare("SELECT * FROM PROJET WHERE ID_createur=:ID_membre AND is_deleted=0;");
					$query->execute(['ID_membre' => $_SESSION["ID_membre"]]);
					$projects = $query->fetchAll();
					if(!$projects){
						echo "<i>Vous n'avez créer aucun projets..</i>";
					}
					else {?>
						<pre>
							<table>
								<thead>
									<tr>
										<th>Date de création </th>
										<th>Nom Projet </th>
										<th>Description </th>
									</tr>
								</thead>
						<?php
								foreach ($projects as $project) {
									echo "<form method=\"POST\" action='treatment.php?id=".$project["ID_projet"]."'><tr>"; /* id=".$user["ID_membre"].", */
									echo "<td>".date('d F Y', strtotime($project["date_creation"]))." </td>";
									echo "<td>".$project["nom_projet"]." </td>";?>
									<td><input type="text" name="description_projet" value="<?php echo ($project["description_projet"])?$project["description_projet"]:"";?>" placeholder="Description projet"></td>
									<td><input type="hidden" name="action" value="editProject"/></td>
									<td><input type="submit" value="Modifier"></td>
								</form><?php
								echo "<td><form method=\"POST\" action='treatment.php?id=".$project["ID_projet"]."'></td>";
								?><form>
									<input type="hidden" name="action" value="deleteProject"/>
								<td><input type="submit" value="Supprimer"></td>
								</form>
								<form method="POST" action="manageProject.php">
									<input type="hidden" name="action" value="manageProject"/>
									<input type="hidden" name="projectID" value="<?php echo $project["ID_projet"]; ?>">
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

			</section>
      </div>
		<?php
			include "footer.php";
		?>
