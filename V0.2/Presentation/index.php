<?php
    session_start();
    require "../global/conf.inc.php";
    require "../global/functions.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>BitNet</title>
        <?php
            require "header.php";
        ?>
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
                        <!-- Dropdown collapse Login Form   -->
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Login <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <form class="navbar-form navbar-right" action="connection.php" method="POST">
                                   <div class="form-group" meth>
                                       <input type="email" class="form-control input-sm dropdown-input" placeholder="Adresse e-mail" name="email" />
                                       <input type="password" class="form-control input-sm dropdown-input" placeholder="Mot de passe" name="pwd" />
                                   </div>
                                   <input id="DropdownHomePageLoginButton" type="submit" class="btn btn-default btn-sm" value="Login"/>
                                   <button id="DesktopHomePageRegisterButton" type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">S'inscrire</button>

                               </form>
                            </ul>
                        </li>
                        <!-- End of Dropdown Login Form -->
                    </ul>
                    <!-- Desktop Navbar Login form -->
                    <form class="navbar-form navbar-right" id="desktop-login-form" action="connection.php" method="POST">
                       <div class="form-group">
                           <input type="email" class="form-control input-sm" placeholder="Adresse e-mail" name="email" />
                           <input type="password" class="form-control input-sm" placeholder="Mot de passe" name="pwd" />
                           <input id="DesktopHomePageLoginButton" type="submit" class="btn btn-default btn-sm" value="Login"/>
                           <button id="DesktopHomePageRegisterButton" type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">S'inscrire</button>
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
                        <?php
                            require "register_form.php";
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Container Services -->
        <section id="services" class="bitnet-services">
            <div  class="container-fluid text-center">
                <h1><strong>Nos Services</strong></h1>
                <!-- First Row -->
                <div class="row services-first-row">
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
                <div class="row services-second-row">
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
        <section id="team" class="bitnet-team">
            <div class="container-fluid text-center">
                <h1><strong>Notre équipe</strong></h1>
                <div class="row">
                    <div class="col-md-4">
                        <p class="text-center"><strong>Aurélien Delagarde</strong></p>
                        <a href="#aurelien" data-toggle="collapse"><img src="img/team/aurelien2.jpg" class="img-circle member" alt="aurelien-photo" /></a>
                        <div id="aurelien" class="collapse">
                            <p>Codeur et poseur de question à plein temps</p>
                            <p>Aime les balades sur la plage</p>
                            <p>Membre du projet depuis 2017</p>
                        </div> <br />
                        <a href="https://www.linkedin.com/in/aur%C3%A9lien-delagarde-758a24a5/" target="_blank"><i class="fa fa-linkedin-square fa-3x" aria-hidden="true"></i></a>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center"><strong>Quentin Hermiteau</strong></p>
                        <a href="#quentin" data-toggle="collapse"><img src="img/team/quentin.jpg" class="img-circle member" alt="quentin-photo" /></a>
                        <div id="quentin" class="collapse">
                            <p>Codeur incurvé</p>
                            <p>Aime les mangas et les belles courbes</p>
                            <p>Membre du projet depuis 2017</p>
                        </div> <br />
                        <a href="https://www.linkedin.com/in/quentin-hermiteau-ba2a9912a/" target="_blank"><i class="fa fa-linkedin-square fa-3x" aria-hidden="true"></i></a>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center"><strong>Steven Cantagrel</strong></p>
                        <a href="#steven" data-toggle="collapse"><img src="img/team/steven2.jpg" class="img-circle member" alt="steven-photo" /></a>
                        <div id="steven" class="collapse">
                            <p>Codeur calme</p>
                            <p>Aime la vape et les beaux nuages</p>
                            <p>Membre du projet depuis 2017</p>
                        </div> <br />
                        <a href="https://www.linkedin.com/in/steven-cantagrel-7171758b/" target="_blank"><i class="fa fa-linkedin-square fa-3x" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="row team-text">
                    <p class="text-muted">
                        Actuellement étudiant en premier année d'alternance à l'ESGI. <br />
                        Nous sommes une équipe composée de trois membres passionnés travaillant sur Bitnet depuis Mars 2017. <br />
                        Bitnet est née de notre envie de créer une plateforme communautaire destinée aux developpeurs regroupant tous les outils nécessaires répondant à leur besoins.
                    </p>
                </div>
                <div class="row team-esgi-logo">
                    <a href="http://www.esgi.fr/ecole-informatique.html" target="_blank"><img src="img/team/esgi.png" alt="esgi" /></a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bitnet-footer">
            <div class="container-fluid">
                <div class="row footer-rights">
                    <div class="text-center">
                        <p>© Bitnet, 2017 - Tous droits réservés - <a class="contact" href="mailto:stevencantagrel.contact@gmail.com" target="_top">Contact</a></p>
                    </div>
                </div>
            </div>
        </footer>


        <!-- Bootstrap Jquery Link -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Bootstrap JavaScript Link -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- Script Reload Captcha -->
        <script src="functions.js"></script>
    </body>
</html>
