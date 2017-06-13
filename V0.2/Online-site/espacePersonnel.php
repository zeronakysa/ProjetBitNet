<?php
		include "header.php";
	?>
	<title>Espace personnel</title>
  </head>
  <body>
    <?php
	  		include "navBar.php";
        $connection=dbConnect();
				$query=$connection->prepare("SELECT * FROM MEMBRE WHERE email=:email");
				$query->execute(['email' => $_SESSION['email']]);
			  $user = $query->fetch();

				if(isset($_SESSION["ID_project"])){
					$_SESSION["ID_project"] = -1;
				}else{
					$_SESSION["ID_project"] = -1;
				}
		?>

    <div class="container-fluid" id="myModificationContainer">
	<div class="row" id="myPersonnalRaw">
		<div class="col-md-12">
			<h3 class="text-center text-info" id="myPersonnalTilte">
				Informations personnelles
			</h3>
			<div class="row" id="myPersonnalRaw2">
				<div class="col-md-2">
				</div>
				<div class="col-md-4">
					<form role="form" method="POST" action="treatment.php">
						<div class="form-group">
							<label for="myInfosEmail"><b>E-mail: </b></label>
							<div id="myInfosEmail"><?php echo $user["email"] ?></div>
						</div>
						<div class="form-group">
							<label for="myInfosPseudo">
								<b>Pseudo: </b>
							</label>
              <input class="form-control" value="<?php echo ($user["pseudo"])?$user["pseudo"]:"";?>" type="text" name="pseudo" placeholder="pseudo" required="required">
						</div>
            <div class="form-group" id="myInfosName">
							<label for="myInfosPseudo">
                <b>Nom: </b>
							</label>
              <input class="form-control" type="text" name="nom" value="<?php echo ($user["nom"])?$user["nom"]:"";?>" placeholder="Nom">
						</div>
            <div class="form-group" id="myInfosFirstName">
							<label for="myInfosPseudo">
                <b>Prenom: </b>
							</label>
              <input class="form-control" type="text" name="prenom" value="<?php echo ($user["prenom"])?$user["prenom"]:"";?>" placeholder="Prénom">
						</div>
            <div class="form-group" id="myInfosLangage">
							<label for="myInfosPseudo">
                <b>Languages</b>
							</label>
              <input class="form-control" type="text" name="langages" value="<?php echo ($user["langages"])?$user["langages"]:"";?>" placeholder="langages">
						</div>
            <div class="form-group" id="myInfosCP">
							<label for="myInfosPseudo">
                <b>Code postale: </b>
							</label>
              <input class="form-control" type="text" name="ville" value="<?php echo ($user["ville"])?$user["ville"]:"";?>" placeholder="Code Postale">
						</div>
            <div class="form-group" id="myInfosBirthday">
							<label for="myInfosPseudo">
                <b>Date de naissance: </b>
							</label>
              <input class="form-control" type="date" name="date_naissance" placeholder="Date de naissance" value="<?php echo date('Y-m-d', strtotime($user["date_naissance"]))?>">
						</div>
            <div class="form-group" id="myInfosImage">
							<label for="myInfosPseudo">
                <b>Image de profile (lien URL): </b>
							</label>
              <input class="form-control" type="text" name="profile_picture" value="<?php echo ($user["profile_picture"])?$user["profile_picture"]:"";?>" placeholder="Lien URL">
						</div>
            <input type="hidden" name="action" value="updateUser"/>
						<button id="myInfosButton" type="submit" class="btn btn-default text-center">
							Mettre à jour
						</button>
					</form>
				</div>
				<div class="col-md-1">
				</div>
				<div class="col-md-3 text-center" id="myImage">
					<img alt="yourAvatar" src="<?php echo ($user["profile_picture"])?$user["profile_picture"]:"";?>" height="500" width="500" class="img-rounded">
          <br/><i>Avatar (500*500px)</i>
				</div>
				<div class="col-md-2">
				</div>
			</div>
		</div>
	</div>
</div>

<?php
  include "footer.php";
?>
