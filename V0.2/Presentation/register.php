<?php
    session_start();
    require "conf.inc.php";
    require "fonctions.php";
    $error = false;
    $listOfErrors = [];

    if (!empty($_POST['pseudo']) &&
        !empty($_POST['email']) &&
        !empty($_POST['pwd']) &&
        !empty($_POST['pwd2']) &&
        !empty($_POST['captcha']) &&
        count($_POST) == 5)
    {

        $_POST['pseudo'] = trim($_POST['pseudo']);
        $_POST['email'] = trim($_POST['email']);

        //pseudo entre 3 et 36 caractères
        if (strlen($_POST['pseudo']) < 3 || strlen($_POST['pseudo']) > 36) {
            $error = true;
            $listOfErrors[] = 1;
        }

        //format email valide
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $listOfErrors[] = 2;
        }

        //pwd entre 6 et 36 caractères
        if (strlen($_POST['pwd']) < 6 || strlen($_POST['pwd']) > 36) {
            $error = true;
            $listOfErrors[] = 3;
        }

        //vérification pwd différend de pseudo
        if ($_POST['pwd'] == $_POST['pseudo']) {
            $error = true;
            $listOfErrors[] = 4;
        }

        //vérification pwd2 différend de pwd
        if ($_POST['pwd2'] != $_POST['pwd']) {
            $error = true;
            $listOfErrors[] = 5;
        }

        //vérification captcha
        if ($_POST['captcha'] != $_SESSION['captcha']) {
            $error = true;
            $listOfErrors[] = 6;
        }

        if (!$error) {
            $connection = dbConnect();
            $query = null;
            $results = null;

            //est ce que l'email existe?
            $query = $connection->prepare('SELECT id FROM MEMBRE WHERE email=:email AND id !=:id');

            $id = (empty($_GET['id'])) ? -1 : $_GET['id'];

            $query->execute(['email'=>$_POST['email'], 'id'=>$id]);

            $results = $query->fetch();

            if (!empty($results)) {
                $error = true;
                $listOfErrors[] = 7;
            }

            //est ce que le pseudo existe?
            $query = $connection->prepare('SELECT id FROM MEMBRE WHERE pseudo=:pseudo AND id !=:id');

            $id = (empty($_GET['id'])) ? -1 : $_GET['id'];

            $query->execute(['pseudo'=>$_POST['pseudo'], 'id'=>$id]);

            $results = $query->fetch();

            if (!empty($results)) {
                $error = true;
                $listOfErrors[] = 8;
            }

            header("Location: validation.php?id=0");
        }

        if ($error) {
            $_SESSION['form_post'] = $_POST;
            $_SESSION['form_errors'] = $listOfErrors;

            if (empty($_GET['id'])) {
                header("Location: validation.php?id=1");
            }else{
                header("Location: updateUser.php?id=" . $_GET['id']);
            }
        }
        else{
            $query = null;

            $query = $connection->prepare("
                INSERT INTO MEMBRE (pseudo, email, pwd)
                VALUES (:pseudo, :email, :pwd)
                ");

            $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

            $query->execute([
                'pseudo' => $_POST['pseudo'],
                'email' => $_POST['email'],
                'pwd' => $pwd
                ]);

            $_SESSION['query'] = 'test ' . $query;

            header("Location: validation.php?id=2");
        }
    }else{
        echo "Bien essayé";
        die();
    }
	
?>