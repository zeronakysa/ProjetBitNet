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
              <a class="navbar-brand" href="index.php">BitNet</a>
          </div>

          <!-- Navbar Link  (Work when collapse)-->
          <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
              <li><a href="codeLive.php">CodeLive</a></li>
              <li><a href="espacePersonnel.php">Espace Personnel</a></li>
              <li><a href="hallOfFame.php">Hall Of Fame</a></li>
              <li><a href="ShoutBox.php">ShoutBox</a></li>
              <li><a href="Succes.php">Succès</a></li>
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
              <form class="navbar-form navbar-right" id="desktop-login-form">
                 <div class="form-group">
                </div>
             </form>
          </div>
      </div>
  </nav>

  <!-- Bootstrap Jquery Link -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Bootstrap JavaScript Link -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
