<?php
		include "header.php";
	?>
	<title>Gestionnaire de projet</title>
</head>
	<body>
		<?php
	  		include "navBar.php";
		?>
<div id="project" class="container-fluid">

		<?php
				$connection=dbConnect();
				$query=$connection->prepare("SELECT * FROM MEMBRE WHERE email=:email");
				$query->execute(['email' => $_SESSION['email']]);
			  $user = $query->fetch();

				$_SESSION["ID_project"] = -1;

		?>
				<h1>Gestionnaire de projets</h1>
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
								<form method="POST" action="contribProject.php">
									<input type="hidden" name="action" value="manageProject"/>
									<input type="hidden" name="projectID" value="<?php echo $myProject["ID_projet"]; ?>">
								<td><input type="submit" value="Gérer"></td>
								</form>
								<form method="POST" action="treatment.php">
									<input type="hidden" name="action" value="addContrib"/>
									<td><input type="text" name="email" minlength="3" maxlength="255" placeholder="E-mail admin à add"></td>
									<input type="hidden" name="projectID" value="<?php echo $myProject["ID_projet"]; ?>">
									<input type="hidden" name="role_projet" value="admin">
									<td><input type="submit"  value="Ajouter Administrateur"></td>
								</form>
								</tr><?php
							}
								?>
							</table>
						</pre><?php
					}
					 ?>

				</div>
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
										<form method="POST" action="contribProject.php">
											<input type="hidden" name="action" value="contribProject"/>
											<input type="hidden" name="projectID" value="<?php echo $project["ID_projet"]; ?>">
										<td><input type="submit" value="Contribuer"></td>
										</form>
										<form method="POST" action="treatment.php">
											<input type="hidden" name="action" value="addContrib"/>
											<td><input type="text" name="email" minlength="3" maxlength="255" placeholder="E-mail contrib à add"></td>
											<input type="hidden" name="projectID" value="<?php echo $project["ID_projet"]; ?>">
											<input type="hidden" name="role_projet" value="contrib">
											<td><input type="submit"  value="Ajouter Contributeur"></td>
										</form>
                    </tr>
                <?php  } ?>
              </table>
            </pre>
          <?php } ?>
        </div>
			</div>
		<?php
			include "footer.php";
		?>
