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
		<?php
			require "navbar.php";
		?>

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
						<form class="form-group" role="form" action="register.php" method="POST">
							<!-- Pseudo -->
							<label>Pseudo</label>
							<i class="fa fa-user"></i>
							<input class="form-control" type="text" name="pseudo" placeholder="Votre pseudo"
							required="required" data-toggle="tooltip" data-placement="bottom" title="Pseudo entre 3 et 36 caractères!"
							value="<?php echo (isset($_SESSION['form_post']['pseudo'])) ? $_SESSION['form_post']['pseudo']:'' ?>">

							<!-- Adresse Email -->
							<label>Adresse e-mail</label>
							<i class="fa fa-at"></i>
							<input class="form-control" type="email" name="email" placeholder="Votre email" required="required"
							value="<?php echo (isset($_SESSION['form_post']['email'])) ? $_SESSION['form_post']['email']:'' ?>" >

							<!-- Mot de passe -->
							<label>Mot de passe</label>
							<i class="fa fa-lock"></i>
							<input class="form-control" type="password" name="pwd" placeholder="Votre mot de passe" required="required"
							data-toggle="tooltip" data-placement="bottom" title="Le mot de passe doit contenir entre 6 et 36 caractères">

							<!-- Verification Mot de passe -->
							<label>Vérification du mot de passe</label>
							<i class="fa fa-lock"></i>
							<input class="form-control" type="password" name="pwd2" placeholder="Confirmation" required="required"
							data-toggle="tooltip" data-placement="bottom" title="La confirmation du mot de passe doit être identique au mot de passe">

							<!-- Captcha -->
							<label>Captcha</label><br>
							<img id="captcha" src="captcha/captcha.php" alt="captcha">
							<!-- Reload Captcha Button -->
							<label>Recharger Captcha</label>
							<button type="button" id="reload_captcha" class="btn btn-default"><i class="fa fa-refresh" aria-hidden="true"></i></button>
							<br /><br />
							<input class='form-control' type="text" name="captcha" placeholder="Votre captcha" required="required">

							<input type="checkbox" name="CGU" />
							<label>J'ai lu et j'accepte les <a href="cgu.html" target="_blank">Conditions Générales d'Utilisation</a></label>
							<br />
							<!-- Button Submit -->
							<input id="modalRegisterButton" type="submit" class="btn btn-default" value="S'enregistrer"> <br />
							<small class="form-text text-muted">Aucune information ne sera partagée sur d'autres sites</small>
						</form>
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
							CodeLive est un editeur de texte en ligne dédié a la programmation. Il vous permettra de coder seul ou avec des amis grâce à son système de partage de session.
						</p>
					</div>
					<div class="col-md-4">
						<h2>Projets</h2>
						<i class="fa fa-users fa-5x" aria-hidden="true"></i>
						<p>
							Créez, gérez tous vos fichiers avec notre fonctionnalité Projets qui vous permettra de travailler en groupe avec vos amis.
						</p>
					</div>
					<div class="col-md-4">
						<h2>Hall Of Fame</h2>
						<i class="fa fa-star-o fa-5x" aria-hidden="true"></i>
						<p>
							Retrouvez le classement des meilleurs membres du site dans notre fonctionnalité Hall Of Fame. Serez vous parmi le top du top ?
						</p>
					</div>
				</div>

				<!-- Second Row -->
				<div class="row services-second-row">
					<div class="col-md-4">
						<h2>Espace Personnel</h2>
						<i class="fa fa-id-card-o fa-5x" aria-hidden="true"></i>
						<p>
							Votre espace dédié à vous et rien qu'a vous. Vous pourrez y remplir toutes les informations essentielles que vous souhaitez mettre en avant !
						</p>
					</div>
					<div class="col-md-4">
						<h2>ShoutBox</h2>
						<i class="fa fa-commenting-o fa-5x" aria-hidden="true"></i>
						<p>
							Une question ? Une suggestion ? Discutez avec tous les membres du site dans notre Shoutbox dédiée !
						</p>
					</div>
					<div class="col-md-4">
						<h2>Succès</h2>
						<i class="fa fa-trophy fa-5x" aria-hidden="true"></i>
						<p>
							Fan de programmation et de jeux vidéo ? Essayer de remporter tous les succès disponibles sur le site ! Amusez-vous en travaillant !
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
						<a href="#quentin" data-toggle="collapse"><img src="img/team/quentin2.jpg" class="img-circle member" alt="quentin-photo" /></a>
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
		<!-- Chargement fonctionnalités perso -->
		<script src="../global/functions.js"></script>
	</body>
</html>
