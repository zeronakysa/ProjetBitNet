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

<?php

$structure = "../PROJETS/".$_SESSION["ID_membre"]."/".$_POST["projectName"]."/";
$racine = "../PROJETS/".$_SESSION["ID_membre"];
$root = "../PROJETS/";

$connection = dbConnect();

  if (file_exists($structure)){
    $creationError = 1;
  }else{
    if((dbAddProjet($_POST["projectName"], $_SESSION["ID_membre"], $_POST["projetDescription"])) == 1){
      mkdir($structure, 0777, true);
      echo 'Projet '.$_POST["projectName"].' créé avec succès.<br /><br />';
      dbGetIdProject($_SESSION["ID_membre"], $_POST["projectName"]);
      dbAddParticipeProjet((dbGetIdProject($_SESSION["ID_membre"], $_POST["projectName"])), $_SESSION["email"], "owner");
    }else{
      $creationError = 1;
    }
    $creationError = 0;
  }
  if ($creationError == 1) {
    header('Location: espacePersonnel.php?ce=1');
  }
  echo "<B>Arborescence personnel</B><pre>";
  listFilesAndPrint($racine);
  echo "</pre>";

  echo "<B>Arborescence du projet ".$_POST["projectName"]."</B><pre>";
  listFilesAndPrint($structure);
  echo "</pre>";
?>
