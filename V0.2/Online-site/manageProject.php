<?php
		include "header.php";
	?>
	<title>Espace personnel</title>
<?php
print_r ($_POST);
echo "<br />";
print_r ($_SESSION);
echo "<br />";

if(isset($_SESSION["ID_project"]) && $_SESSION["ID_project"] == -1){
	$_SESSION["ID_project"] = $_POST["projectID"];
}else if(!isset($_SESSION["ID_project"])){
	die("Il faut ouvrir un projet depuis le gestionnaire de projet.");
}

$connection = dbConnect();
$query = $connection->prepare("SELECT * FROM PROJET WHERE is_deleted=0 AND ID_projet=:ID_projet;");
$query->execute(['ID_projet' => $_SESSION["ID_project"]]);
$project = $query->fetchAll();
print_r($project);
echo "<br />";
if(!$project[0]){
  echo "<i>Vous n'avez créer aucun projets..</i>";
}
else {?>
    <table>
          <h2> Nom de projet: <i><?php echo ($project[0]["nom_projet"])?$project[0]["nom_projet"]:"";?></i> </h2>
          <h3> Description: <i><?php echo ($project[0]["description_projet"])?$project[0]["description_projet"]:"";?></i></h3>
    </table>
    <?php
    $structure = "../PROJETS/".$_SESSION["ID_membre"]."/".$project[0]["nom_projet"]."/";
    listFilesAndPrint($structure);
    addMultipleFiles($structure);
  }

	  		include "footer.php";
		?>
	</body>
</html>
