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
?>