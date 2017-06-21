<?php
		include "header.php";
	?>
	<title>Contribution Projet</title>
</head>
<body>
	<?php
		include "navBar.php";
	 ?>
	<div id="project" class="container-fluid">
			<?php
// print_r ($_POST);
// echo "<br />";
// print_r ($_SESSION);
// echo "<br />";
// print_r ($_SERVER);
// echo "<br />";
if(isset($_SESSION["ID_project"]) && $_SESSION["ID_project"] == -1){
	$_SESSION["ID_project"] = $_POST["projectID"];
}else if(!isset($_SESSION["ID_project"])){
	die("Il faut ouvrir un projet depuis le gestionnaire de projet.");
}

$connection = dbConnect();
$query = $connection->prepare("SELECT * FROM PROJET WHERE is_deleted=0 AND ID_projet=:ID_projet;");
$query->execute(['ID_projet' => $_SESSION["ID_project"]]);
$project = $query->fetchAll();
// print_r($project);
if(!$project[0]){
  echo "<i>Vous n'avez créer aucun projets..</i>";
}
else {?>
    <table>
          <h2> Nom de projet: <i><?php echo ($project[0]["nom_projet"])?$project[0]["nom_projet"]:"";?></i> </h2>
					<h3> Description: <br /></h3> <i><?php echo ($project[0]["description_projet"])?$project[0]["description_projet"]:"";?></i>
					<h3> Membre du projet: <br /></h3>
					<?php
					$query = $connection->prepare("SELECT pseudo, ID_membre FROM MEMBRE,participe_projet WHERE participe_projet.ID_projet = :ID_projet AND participe_projet.role_projet = 'owner' AND MEMBRE.email = participe_projet.email;");
					$query->execute(['ID_projet' => $_SESSION["ID_project"]]);
					$membre = $query->fetchAll();
					echo "<br /><b> Propriétaire:</b><br /> - ".$membre[0]["pseudo"]."<br />";
					if ($membre[0]["ID_membre"] == $_SESSION["ID_membre"]){
						$isOwner = 1;
					}else{$isOwner = 0;}

					$query = $connection->prepare("SELECT pseudo, ID_membre FROM MEMBRE,participe_projet WHERE participe_projet.ID_projet = :ID_projet AND participe_projet.role_projet = 'admin' AND MEMBRE.email = participe_projet.email;");
					$query->execute(['ID_projet' => $_SESSION["ID_project"]]);
					$membres = $query->fetchAll();
					echo "<br /><b> Administrateur(s):</b><br />";
					if($isOwner == 1){
						?><div class="raw">
								<div id="adminSearchBar">
								 <input type="text" name="adminSearchBar" placeholder="Ajouter un administrateur" />
								</div>
							</div>
						<?php
					}else{}
					if ($membres){
						foreach ($membres as $membre) {
							 echo "- ".$membre["pseudo"]."<br />";
							 if($membre["ID_membre"] == $_SESSION["ID_membre"]){
								 $isAdmin = 1;
							 }else{
								 $isAdmin = 0;
							 }
						}
					}else{
						echo"<i>Aucun administrateur..</i><br />";
					}

					$query = $connection->prepare("SELECT pseudo FROM MEMBRE,participe_projet WHERE participe_projet.ID_projet = :ID_projet AND participe_projet.role_projet = 'contrib' AND MEMBRE.email = participe_projet.email;");
					$query->execute(['ID_projet' => $_SESSION["ID_project"]]);
					$membres = $query->fetchAll();
					echo "<br /><b> Contributeur(s):</b><br />";
					if($isOwner == 1 || $isAdmin == 1){
						?><div class="raw">
								<div id="contribSearchBar" >
								 <input type="text" name="contribSearchBar" placeholder="Ajouter un contributeur" />
								</div>
							</div>
						<?php
					}else{}
					if ($membres){
						foreach ($membres as $membre) {
							 echo "- ".$membre["pseudo"]."<br />";
						}
					}else{
						echo"<i>Aucun contributeur..</i>";
					}
     			echo "</table><br />";
    $structure = "../PROJETS/".$project[0]["ID_createur"]."/".$project[0]["nom_projet"]."/";
		$structure = realpath($structure);
    addMultipleFiles($structure);
		echo "<br /> <b>Ajouter un fichier au projet: </b><br />";
		?><form method="post" action="treatment.php">
			<input type="text" name="nameFile" id="nameFile" placeholder="Nom (55 car max)" maxlength="55" required="required"><br />
			<input type="text" name="extFile" id="extFile" placeholder="Extension (5 car max)" maxlength="5" required="required"><br />
			<input type="hidden" name="action" value="createFile"/>
			<input type="submit" value="Creer nouveau fichier">
		</form><?php
		echo "<br /> <b>Arborescence du projet: </b><br />";
		listFilesAndPrint($structure);
  }?>
</div>
<?php
	  		include "footer.php";
		?>
	</body>
</html>
