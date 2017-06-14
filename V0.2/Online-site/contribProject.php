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

					$query = $connection->prepare("SELECT pseudo, ID_membre FROM MEMBRE,participe_projet WHERE participe_projet.ID_projet = :ID_projet AND participe_projet.role_projet = 'admin' AND MEMBRE.email = participe_projet.email;");
					$query->execute(['ID_projet' => $_SESSION["ID_project"]]);
					$membres = $query->fetchAll();
					echo "<br /><b> Administrateur(s):</b><br />";
					if ($membres){
						foreach ($membres as $membre) {
							 echo "- ".$membre["pseudo"]."<br />";
						}
					}else{
						echo"<i>Aucun administrateur..</i><br />";
					}

					$query = $connection->prepare("SELECT pseudo FROM MEMBRE,participe_projet WHERE participe_projet.ID_projet = :ID_projet AND participe_projet.role_projet = 'contrib' AND MEMBRE.email = participe_projet.email;");
					$query->execute(['ID_projet' => $_SESSION["ID_project"]]);
					$membres = $query->fetchAll();
					echo "<br /><b> Contributeur(s):</b><br />";
					if ($membres){
						foreach ($membres as $membre) {
							 echo "- ".$membre["pseudo"]."<br />";
						}
					}else{
						echo"<i>Aucun contributeur..</i>";
					}
     			echo "</table><br />";
    $structure = "../PROJETS/".$project[0]["ID_createur"]."/".$project[0]["nom_projet"]."/";
    addMultipleFiles($structure);
		echo "<br /> <b>Arborescence du projet: </b><br />";
		listFilesAndPrint($structure);
  }?>
</div>
<?php
	  		include "footer.php";
		?>
	</body>
</html>
