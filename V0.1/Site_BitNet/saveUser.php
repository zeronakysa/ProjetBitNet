<?php
session_start();
require "conf.inc.php";
require "lib.php";
include_once "securimage/securimage.php";

$securimage = new Securimage();
$error = false;
$listOfErrors = [];

//trim
if (!empty($_POST['pseudo']) &&
    !empty($_POST['email']) &&
    !empty($_POST['pwd']) &&
    !empty($_POST['pwd2']) &&
    (!empty($_POST['captcha']) || !empty($_GET['id'])) &&
    count($_POST) < 1 && count($_POST) > 5){


    $_POST["pseudo"] = trim($_POST["pseudo"]);
    $_POST["email"] = trim($_POST["email"]);
    $_POST["comment"] = trim($_POST["comment"]);
         
    //Pseudo : entre 6 et 36
    if(strlen($_POST['pseudo'])<6 || strlen($_POST['pseudo'])>36){
        $error = true;
        $listOfErrors[] = 1;
    }
     
    //Email : soit valide
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL && !empty($_POST['email']))){
        $error = true;
        $listOfErrors[] = 2;
    }
     
    //pwd : entre 6 et 36 et différent du pseudo
    if(strlen($_POST['pwd'])<6 || strlen($_POST['pwd'])>36){
        $error = true;
        $listOfErrors[] = 3;
    }

    //Vérification si le pwd est identique au pseudo
    if ($_POST['pwd'] == $_POST['pseudo']) {
        $error = true;
        $listOfErrors[] = 4;
    }
     
    //pwd2 : égale avec pwd
    if($_POST['pwd2'] !== $_POST['pwd']){
        $error = true;
        $listOfErrors[] = 5;
    }
     
    if ($securimage->check($_POST['captcha_code']) == false) {

        echo "Le captcha que vous avez entré est incorrect.<br /><br />";
        echo "Clickez <a href='javascript:history.go(-1)'>ici</a> et rééssayez.";
        exit;
    }

    if(!$error){
        $connection = dbConnect();

        //est ce que l'email existe
        $query = $connection->prepare('SELECT id FROM users WHERE email=:email AND id!=:id');

        $id = (empty($_GET['id'])) ? -1:$_GET['id'];

        $query->execute(['email'=>$_POST['email'], 'id'=>$id]);

        $results = $query->fetch();

        if (!empty($results))
        {
            $error = true;
            $listOfErrors[] = 6;
        }

        //est ce que le pseudo existe
        $query = $connection->prepare('SELECT id FROM users WHERE pseudo=:pseudo');

        $id = (empty($_GET['id'])) ? -1:$_GET['id'];

        $query->execute(['pseudo'=>$_POST['pseudo']]);

        $results = $query->fetch();

        if (!empty($results))
        {
            $error = true;
            $listOfErrors[] = 7;
        }

        header("Location: index.php");
    }

    if ($error) {
        $_SESSION["form_post"] = $_POST;
        $_SESSION["form_errors"] = $listOfErrors;

        if (empty($_GET['id'])) {
            header("Location: saveUser.php");
        }else{
            header("Location: updateUser.php?id=" . $_GET['id']);
        }
        
    }else{

        $query = $connection->prepare("
            INSERT INTO USERS (pseudo, email, pwd) 
            VALUES (:pseudo, :email, :pwd)
            ");

        $pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);

        $query->execute([
                "pseudo" => $_POST["pseudo"],
                "email" => $_POST["email"],
                "pwd" => $pwd
            ]);
    }
}
else{
    echo "Bien essayé";
    die();
}