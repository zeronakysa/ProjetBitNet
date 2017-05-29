<?php
		include "header.php";
	?>
	<title>Espace personnel</title>
</head>
	<body>
		<?php
	  		include "navBar.php";
		?>
		<br />
		<br />
		<br />

		Work In progress (Espace perso)
		<?php
				$connection=dbConnect();
				$query=$connection->prepare("SELECT * FROM MEMBRE WHERE email=:email");
				$query->execute(['email' => $_SESSION['email']]);
			  $user = $query->fetch();
		?>
		<section>
			<div id="myModification">
				<h2>Mes informations personnels</h2>
				Avatar (184*184px)<br />
				<img src="<?php echo ($user["profile_picture"])?$user["profile_picture"]:"";?>" height="184" width="184" />
				<form method="POST" action="test.php">
					<?php
						echo "<b>E-mail: </b>".$user["email"]."<br />";?>
						<b>Pseudo: </b><input value="<?php echo ($user["pseudo"])?$user["pseudo"]:"";?>" type="text" name="pseudo" placeholder="pseudo" required="required"><br />
						<b>Nom: </b><input type="text" name="nom" value="<?php echo ($user["nom"])?$user["nom"]:"";?>" placeholder="Nom"><br />
						<b>Prenom: </b><input type="text" name="prenom" value="<?php echo ($user["prenom"])?$user["prenom"]:"";?>" placeholder="Prénom"><br />
						<b>Languages</b><input type="text" name="langages" value="<?php echo ($user["langages"])?$user["langages"]:"";?>" placeholder="langages"><br />
						<b>Code postale: </b><input type="text" name="ville" value="<?php echo ($user["ville"])?$user["ville"]:"";?>" placeholder="Code Postale"><br />
						<b>Date de naissance: </b><input type="date" name="date_naissance" placeholder="Date de naissance" value="<?php echo date('Y-m-d', strtotime($user["date_naissance"]))?>"><br />
						<b>Image de profile(lien): </b><input type="text" name="profile_picture" value="<?php echo ($user["profile_picture"])?$user["profile_picture"]:"";?>" placeholder="Chemin our URL"><br />
						<input type="hidden" name="action" value="updateUser"/>
						<input type="submit" value="Mettre à jour">
					</form>
			</div>
			<div id="gestionnaireProjet">
				<h2>Gestionnaire de projets</h2>
				<div id="createProjet">
					<h3>Créer un nouveau projet</h3>
				<?php if(isset($_GET["ce"])){if ($_GET["ce"] == 1){
				          echo 'Echec lors de la création du projet. Un projet portant le même nom existe déjà. Essayer avec un autre nom. <br />';}} ?>
				  <form method="post" action="test.php?id=<?php echo $_SESSION["ID_membre"]; ?>">
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
									echo "<form method=\"POST\" action='test.php?id=".$project["ID_projet"]."'><tr>"; /* id=".$user["ID_membre"].", */
									echo "<td>".date('d F Y', strtotime($project["date_creation"]))." </td>";?>
									<td><input type="text" name="nom_projet" value="<?php echo ($project["nom_projet"])?$project["nom_projet"]:"";?>" placeholder="Nom projet" required="required"></td>
									<td><input type="text" name="description_projet" value="<?php echo ($project["description_projet"])?$project["description_projet"]:"";?>" placeholder="Description projet"></td>
									<td><input type="hidden" name="action" value="editProject"/></td>
									<td><input type="submit" value="Modifier"></td>
								</form><?php
								echo "<td><form method=\"POST\" action='test.php?id=".$project["ID_projet"]."'></td>";
								?><form>
									<input type="hidden" name="action" value="deleteProject"/>
								<td><input type="submit" value="Supprimer"></td>
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
		<?php
			include "footer.php";
		?>
