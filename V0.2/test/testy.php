<?php

include "../Presentation/header.php";
require "../global/conf.inc.php";
require "../global/functions.php";

$connection = dbConnect();

$query = $connection->prepare('SHOW FULL TABLES IN projet_bitnet');
$query->execute();
$result = $query->fetchAll();

echo "<pre>";

for ($i=0; $i < count($result); $i++) {
  $table = $result[$i]["Tables_in_projet_bitnet"];
$query = $connection->prepare('SHOW FULL COLUMNS IN '.$table);
  $query->execute();
  $all = $query->fetchAll();
  echo "Nombre de ligne(s) dans la table ".$table." : ".count($all);
  echo "<br />";

  $query = null;
}
echo "</pre>";

/* POUBELLE

for ($j=0; $j < count($all); $j++) {
  $special = $all[$j];
  $k = (count($special)/2);
  echo "----<br />";
  for ($l=1; $l < $k; $l++) {
    echo $special[$l];
    echo "<br />";
  }
}

print_r($special);
echo "<br />";
print_r($special[0]);
echo "<br />";
print_r($special[1]);
echo "<br />";


echo $special[0];
echo $special[1];
echo $special[2];
for ($k=0; $k < count($special); $k++) {
      print_r($special);

  if ($special[$k]){
    echo $special[$k];
  }
  $k=0;
}

print_r($all);
echo "<br />";
echo "<pre>";
echo "</pre>";
*/
?>
