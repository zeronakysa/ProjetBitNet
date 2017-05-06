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