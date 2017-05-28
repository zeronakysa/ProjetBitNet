<?php

session_start();

define("HOST", "localhost");
define("DBNAME", "projet_bitnet");
define("DBUSER", "root");
define("DBPWD", "");

function dbConnect(){
  //Se connecter à la bdd
  try{
      $connection = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBUSER, DBPWD);
  }catch(Exception $e){
      die("Erreur SQL".$e->getMessage());
  }
  return $connection;
}

function dbGetIdProject($idCreateur, $nameProject){
  $connection = dbConnect();
  $query = $connection->prepare('SELECT ID_projet FROM PROJET WHERE ID_createur LIKE :ID_createur AND nom_projet LIKE :nom_projet' );
  $getID = $query->execute([
    'ID_createur'=>$idCreateur,
    'nom_projet'=>$nameProject
          ]);
  $getID = $query->fetchAll();
  $idProject = $getID["0"];
  return $idProject[0];
}

function dbAddProjet($nameProject, $idCreateur, $desciptionProjet){
  $connection = dbConnect();
  $query = $connection->prepare('INSERT INTO `projet` (`nom_projet`, `ID_createur`, `date_creation`, `description_projet`) VALUES (:nom_projet, :ID_createur, NOW(), :description_projet)');
  $results = $query->execute([
    'nom_projet'=>$nameProject,
    'ID_createur'=>$idCreateur,
    'description_projet'=>$desciptionProjet
          ]);
  return $results;
}

function dbAddParticipeProjet($idProject, $email, $role){
	$connection = dbConnect();
	$query = $connection->prepare('INSERT INTO `participe_projet` (`email`, `ID_projet`, `role_projet`) VALUES (:email, :ID_projet, :role_projet)');
	$participe_projet = $query->execute([
		'email'=>$email,
    'ID_projet'=>$idProject,
		'role_projet'=>$role,
					]);
  return $participe_projet;
}

function listFilesAndPrint( $from )
{
  $length = strlen($from);
    if(! is_dir($from))
        return false;
    $dirs = array( $from);
    while( NULL !== ($dir = array_pop( $dirs)))
    {
        if( $dh = opendir($dir))
        {
            while( false !== ($file = readdir($dh)))
            {
                if( $file == '.' || $file == '..')
                    continue;
                $path = $dir . '/' . $file;
                if( is_dir($path)){
                  $dirs[] = $path;
                  $path = substr($path, $length);
                  echo " ..".$path."/<br />";
                }else{
                  $path = substr($path, $length);
                  echo " ..".$path."<br />";
                }
            }
            closedir($dh);
        }
    }
    return true;
}

//print_r($_SESSION);
//echo '<br />';
//print_r($_POST);
//echo '<br />';

$structure = "../PROJETS/".$_SESSION["ID_membre"]."/".$_POST["projectName"]."/";
$racine = "../PROJETS/".$_SESSION["ID_membre"];
$root = "../PROJETS/";



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
  // A REMETTRE EN LIVE
  //  header('Location: .php?ce=1');
  }
  echo "<B>Arborescence personnel</B><pre>";
  listFilesAndPrint($racine);
  echo "</pre>";

  echo "<B>Arborescence du projet ".$_POST["projectName"]."</B><pre>";
  listFilesAndPrint($structure);
  echo "</pre>";

/* OLD


$connection = dbConnect();
$query = $connection->prepare('SELECT * FROM projet WHERE ID_membre = :ID_membre');
$query->execute(['ID_membre' => $_POST["projectName"]]);
$results = $query->fetch();


//affiche le contenu du dossier du projet
if (is_dir($structure)) {
  echo "<b>Projet précis: </b><br />";
if ($dh = opendir($structure)) {
  while (($file = readdir($dh)) !== false) {
    if ($file != "." && $file != "..") {
      echo "<b>type:</b> ".filetype($structure . $file)."  <b>nom:</b> $file\n<br />";
    }
  }
  closedir($dh);
}
}

//affiche le repertoire personnel contenant tout les dossier de projets
if (is_dir($structure)) {
  echo "<b>Racine: </b><br />";
if ($dh = opendir($racine)) {
  while (($file = readdir($dh)) !== false) {
    if ($file != "." && $file != "..") {
      echo "<b>type:</b> ".filetype($racine . $file)."  <b>nom:</b> $file\n<br />";
    }
  }
  closedir($dh);
}
}

function listFiles( $from )
{
    if(! is_dir($from))
        return false;

    $files = array();
    $dirs = array( $from);
    while( NULL !== ($dir = array_pop( $dirs)))
    {
        if( $dh = opendir($dir))
        {
            while( false !== ($file = readdir($dh)))
            {
                if( $file == '.' || $file == '..')
                    continue;
                $path = $dir . '/' . $file;
                if( is_dir($path)){
                  $dirs[] = $path;
                  $files[] = $path."/";
                }else{
                  $files[] = $path;
                }
            }
            closedir($dh);
        }
    }
    return $files;
}
*/
?>
