<?php

session_start();

print_r($_SESSION);
echo '<br />';
print_r($_POST);
$structure = "../PROJETS/".$_SESSION["ID_membre"]."/".$_POST["projectName"]."/";
$racine = "../PROJETS/".$_SESSION["ID_membre"]."/";
$root = "../PROJETS/";
if (file_exists($structure)){
  echo '<br />Echec lors de la création des répertoires.(Existe déjà)<br />';
}else{
  mkdir($structure, 0777, true);
  echo '<br />Repertoire de projet personnel créer.<br />';
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
                if( is_dir($path))
                    $dirs[] = $path;
                else
                    $files[] = $path;
            }
            closedir($dh);
        }
    }
    return $files;
}
$test = listFiles($structure);
echo "<pre>";
print_r($test);
echo "</pre>";
$test2 = listFiles($root);
echo "<pre>";
print_r($test2);
echo "</pre>";
$test3 = listFiles($racine);
echo "<pre>";
print_r($test3);
echo "</pre>";

/* OLD

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
*/
?>
