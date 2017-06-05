<?php
		include "header.php";
	?>
	<title>Espace personnel</title>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
	<?php
		include "navBar.php";
	 ?>
	<div id="projectContainer" class="container-fluid">
			<?php
			echo "<br /><br />";
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
echo "<br />";
if(!$project[0]){
  echo "<i>Vous n'avez créer aucun projets..</i>";
}
else {?>
    <table>
          <h2> Nom de projet: <i><?php echo ($project[0]["nom_projet"])?$project[0]["nom_projet"]:"";?></i> </h2>
					<h3> Membre du projet: <br /></h3>
					<?php
					$query = $connection->prepare("SELECT pseudo FROM MEMBRE,participe_projet WHERE participe_projet.ID_projet = :ID_projet AND participe_projet.role_projet = 'owner' AND MEMBRE.email = participe_projet.email;");
					$query->execute(['ID_projet' => $_SESSION["ID_project"]]);
					$membre = $query->fetchAll();
					echo "<b> Propriétaire:</b><br /> • ".$membre[0]["pseudo"]."<br />";

					$query = $connection->prepare("SELECT pseudo FROM MEMBRE,participe_projet WHERE participe_projet.ID_projet = :ID_projet AND participe_projet.role_projet = 'admin' AND MEMBRE.email = participe_projet.email;");
					$query->execute(['ID_projet' => $_SESSION["ID_project"]]);
					$membres = $query->fetchAll();
					if ($membres){
						echo "<b> Administrateur(s):</b><br />";
						foreach ($membres as $membre) {
							 echo "• ".$membre["pseudo"]."<br />";
						}
					}else{
						echo"<i>Aucun administrateur..</i>";
					}
					echo "<input id=\"adminSearchBar\" class=\"form-control\" type=\"text\" name=\"adminSearchBar\" placeholder=\"Ajouter un administrateur\" />";
					$query = $connection->prepare("SELECT pseudo FROM MEMBRE,participe_projet WHERE participe_projet.ID_projet = :ID_projet AND participe_projet.role_projet = 'contrib' AND MEMBRE.email = participe_projet.email;");
					$query->execute(['ID_projet' => $_SESSION["ID_project"]]);
					$membres = $query->fetchAll();
					if ($membres){
						echo "<b> Contributeur(s):</b><br />";
						foreach ($membres as $membre) {
							 echo "• ".$membre["pseudo"]."<br />";
						}
					}else{
						echo"<i>Aucun contributeur..</i>";
					}
					echo "<input id=\"contribSearchBar\" class=\"form-control\" type=\"text\" name=\"contribSearchBar\" placeholder=\"Ajouter un contributeur\" />";
					?>
					<h3> Description: <br /></h3> <i><?php echo ($project[0]["description_projet"])?$project[0]["description_projet"]:"";?></i>

    </table>
    <?php
    $structure = "../PROJETS/".$_SESSION["ID_membre"]."/".$project[0]["nom_projet"]."/";
    addMultipleFiles($structure);
		echo "<br /> <b>Arborescence du projet: </b><br />";
		listFilesAndPrint($structure);
  }

	  		include "footer.php";
		?>
	</body>
</html>
