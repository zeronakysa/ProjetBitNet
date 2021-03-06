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
            <a class="navbar-brand" href="index.php">BitNet</a>
        </div>

        <!-- Navbar Link  (Work when collapse)-->
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="codeLive.php" >CodeLive</a></li>
                <li><a href="hallOfFame.php">Hall Of Fame</a></li>
                <li><a href="shoutBox.php">ShoutBox</a></li>
                <li><a href="succes.php">Succès</a></li>
                <li><a href="projet.php">Projets</a></li>
                <?php if ($_SESSION['role'] == "admin"):?>
                    <li><a href="admin.php">Administration</a></li>
                <?php endif;?>
                <!-- Dropdown collapse Login Link   -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Compte <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <form class="navbar-form navbar-right">
                            <div class="form-group">
                                <li><a href="">Paramètres</a></li>
                                <li><a href="">Deconnexion</a></li>
                            </div>
                        </form>
                    </ul>
                </li>
                <!-- End of Dropdown Login Link -->
            </ul>
            <!-- Desktop Navbar Login form -->
            <div class="nav navbar-nav navbar-right">
                <a id="infoCompte" href="espacePersonnel.php">Vous êtes connectés en tant que: <em><b><?php echo $_SESSION['pseudo']; ?></b></em></a>
                <img src="<?php echo $_SESSION["profile_picture"]?>" height="32" width="32" /> 
                <br>
                <span style="float: right"><a href="deconnection.php">Se déconnecter</a></span>
            </div>
        </div>
    </div>
</nav>
