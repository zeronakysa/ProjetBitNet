<?php
    session_start();
    require "conf.inc.php";
    require "lib.php";

    if (isset($_SESSION['form_errors'])) {
        foreach ($_SESSION['form_errors'] as $error) {
            echo "<li>".$errors[$error];
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- BootStrap Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Bootstrap Css Link -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <!-- Custom Css Link -->
        <link rel="stylesheet" href="css/custom_css.css" />
        <!-- Title -->
        <title>Bitnet</title>

        <!-- Custom font -->
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

        <!-- Css Plugin -->
        <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.min.css">
    </head>

    <!-- Spy Scroll -->
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

        <!-- NavBar  -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <!-- NavBar Container -->
            <div class="container-fluid" id="navbarContainer">
                <div class="navbar-header">
                    <!-- Navbar Button for Mobile - Burger -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- NavBar Brand Name -->
                    <a class="navbar-brand" href="#">BitNet</a>
                </div>

                <!-- Navbar Link  (Work when collapse)-->
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="#presentation">Présentation</a></li>
                        <li><a href="#services">Nos Services</a></li>
                        <li><a href="#team">La Team</a></li>
                        <!-- Dropdown collapse Login Link   -->
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Login <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <form class="navbar-form navbar-right">
                                   <div class="form-group">
                                       <input type="text" class="form-control input-sm dropdown-input" placeholder="Adresse e-mail" />
                                       <input type="password" class="form-control input-sm dropdown-input" placeholder="Mot de passe" />
                                   </div>
                                   <input id="DropdownHomePageLoginButton" type="submit" class="btn btn-default btn-sm" value="Login"/>
                               </form>
                            </ul>
                        </li>
                        <!-- End of Dropdown Login Link -->
                    </ul>
                    <!-- Desktop Navbar Login form -->
                    <form class="navbar-form navbar-right" id="desktop-login-form">
                       <div class="form-group">
                           <input type="text" class="form-control input-sm" placeholder="Adresse e-mail" />
                           <input type="password" class="form-control input-sm" placeholder="Mot de passe" />
                           <input id="DesktopHomePageLoginButton" type="submit" class="btn btn-default btn-sm" value="Login"/>
                       </div>
                   </form>
                </div>
            </div>
        </nav>

        <!-- Header -->
        <header id="presentation">
            <div class="container bitnet-presentation">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="header-content">
                            <div class="header-content-inner">
                                <h1>BitNet est une application web communautaire de développement. <br />
                                    Elle s’adresse à tout type de développeurs, qu’il soit débutant ou expert, et ce, dans n’importe quels langages de programmation.</h1>
                                <!-- Button To Trigger Modal Form -->
                                <button type="button" class="btn btn-outline btn-xl" data-toggle="modal" data-target="#myModal">Tentez l'Expérience</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Modal Subscribe Form -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal Content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- Cross to dismiss modal -->
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <!-- Modal Title -->
                        <h4 class="modal-title">Formulaire d'inscription</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Formulaire d'inscription -->
                        <form role="form" method="POST" action="saveUser.php">
                            <div class="form-group float-label-control">
                                <label for="">Pseudo</label>
                                <input class="form-control" type="text" name="pseudo" placeholder="Votre pseudo" required="required" rows="1"
                                value="<?php echo (isset($_SESSION['form_post']['pseudo'])) ? $_SESSION['form_post']['pseudo']:'' ?>">
                            </div>
                            <div class="form-group float-label-control">
                                <label for="">Email</label>
                                <input class="form-control" type="email" name="email" placeholder="Votre email" required="required" rows="1"
                                value="<?php echo (isset($_SESSION['form_post']['email'])) ? $_SESSION['form_post']['email']:'' ?>" >
                            </div>
                            <div class="form-group float-label-control">
                                <label for="">Mot de passe</label>
                                <input class="form-control" type="password" name="pwd" placeholder="Votre mot de passe" required="required" rows="1">
                            </div>
                            <div class="form-group float-label-control">
                                <label for="">Confirmation mot de passe</label>
                                <input class="form-control" type="password" name="pwd2" placeholder="Confirmation" required="required" rows="1">
                            </div>
                            <div class="form-group float-label-control">
                                <label for="">Captcha</label><br>
                                <img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image">
                                <a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">Nouvelle image</a>
                                <input class="form-control" type="text" name="captcha_code" size="10" maxlength="6" rows="1">                       
                            </div>
                            <div>
                                <input type="submit" class="btn btn-default" value="S'enregistrer"> <br />
                                <small class="form-text text-muted">Aucune information ne sera partagée sur d'autres sites</small>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Container Services -->
        <section class="bitnet-services">
            <div id="services" class="container-fluid text-center">
                <h1>Nos Services</h1>
                <!-- First Row -->
                <div class="row">
                    <div class="col-md-4">
                        <h2>CodeLive</h2>
                        <i class="fa fa-code fa-5x" aria-hidden="true"></i>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h2>Projets</h2>
                        <i class="fa fa-users fa-5x" aria-hidden="true"></i>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h2>Hall Of Fame</h2>
                        <i class="fa fa-star-o fa-5x" aria-hidden="true"></i>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                </div>

                <!-- Second Row -->
                <div class="row">
                    <div class="col-md-4">
                        <h2>Espace Personnel</h2>
                        <i class="fa fa-id-card-o fa-5x" aria-hidden="true"></i>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h2>ShoutBox</h2>
                        <i class="fa fa-commenting-o fa-5x" aria-hidden="true"></i>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h2>Succès</h2>
                        <i class="fa fa-trophy fa-5x" aria-hidden="true"></i>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Container Team -->
        <section class="bitnet-team">
            <div class="container-fluid text-center">
                <h1> Notre équipe </h1>
                <div class="row">
                    <div class="col-md-4">
                        <p class="text-center"><strong>Aurélien Delagarde</strong></p>
                        <a href="#aurelien" data-toggle="collapse"><img src="img/team/aurelien.jpg" class="img-circle member" alt="aurelien-photo" /></a>
                        <div id="aurelien" class="collapse">
                            <p>Codeur et poseur de question à plein temps</p>
                            <p>Aime les balades sur la plage</p>
                            <p>Membre du projet depuis 2017</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center"><strong>Aurélien Delagarde</strong></p>
                        <a href="#quentin" data-toggle="collapse"><img src="img/team/quentin.jpg" class="img-circle member" alt="quentin-photo" /></a>
                        <div id="quentin" class="collapse">
                            <p>Codeur incurvé</p>
                            <p>Aime les mangas et les belles courbes</p>
                            <p>Membre du projet depuis 2017</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center"><strong>Aurélien Delagarde</strong></p>
                        <a href="#steven" data-toggle="collapse"><img src="img/team/steven.jpg" class="img-circle member" alt="steven-photo" /></a>
                        <div id="steven" class="collapse">
                            <p>Codeur calme</p>
                            <p>Aime la vape et les beaux nuages</p>
                            <p>Membre du projet depuis 2017</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Bootstrap Jquery Link -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Bootstrap JavaScript Link -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>