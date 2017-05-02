<?php
    function dbConnect(){
        //Se connecter à la bdd
        try{
            $connection = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBUSER, DBPWD);
        }catch(Exception $e){
            die("Erreur SQL".$e->getMessage());
        }

        return $connection;
    }

    function etatSucces(){
      $connection = dbConnect();
      // Nombre de succes dans la BDD
      $query = $connection->prepare('SELECT COUNT(ID_succes) FROM SUCCES');
      $query->execute([]);
      $maxSucces = $query->fetch();
      $query = null;

      //boucle pour parcourir vériffier tout les succes du membre
      for ($i=1; $i <= $maxSucces[0]; $i++) {

        //Donne un email si le succes est reussi
        $query = $connection->prepare('SELECT email FROM succes_reussi WHERE succes_reussi.email LIKE email AND succes_reussi.ID_succes LIKE '.$i);
        $query->execute(['email'=>$_SESSION['email']]);
        $result = $query->fetch();

        //Donne le nom du succes qui a pour ID $i
        $query = $connection->prepare('SELECT nom_succes FROM SUCCES WHERE ID_succes LIKE '.$i);
        $query->execute();
        $nomSucces = $query->fetch();

        echo "Le succes <i>'".$nomSucces[0];
        if ($result[0] == $_SESSION['email']){
          echo "'</i> est réussi par l'utilisateur qui a pour email: '<i>".$_SESSION['email']."'</i><br />";
          }
        else{
          echo "'</i> n'est pas réussi par l'utilisateur qui a pour email: '<i>".$_SESSION['email']."'</i><br />";
          }
        $result[0] = 0;
        }
        $query = null;
      }

      function giveSucces($id_succes){
        $connection = dbConnect();
        //verrifie si le succes est déjà reussi. Retourne un email si il l'est.
        $query = $connection->prepare('SELECT email FROM succes_reussi WHERE succes_reussi.email LIKE email AND succes_reussi.ID_succes LIKE '.$id_succes);
        $query->execute(['email'=>$_SESSION['email']]);
        $result = $query->fetch();
        $email = $_SESSION['email'];

        //passe le succes en reussi donc créer un ligne dans le table succes_reussi
        if ($result[0] != $_SESSION['email']){
          $query = $connection->prepare('INSERT INTO `succes_reussi` (`email`, `ID_succes`) VALUES (\''.$email.'\','.$id_succes.')');
      	  $query->execute(['email_membre'=>$_SESSION['email'],'new_succes'=>$id_succes]);
          echo "Succes n°".$id_succes." réussi ! Bravo ! <br />";
        }
        else {
          echo "Succes n°".$id_succes." déjà réussie..<br />";
        }
      }
?>
