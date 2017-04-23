<?php
	session_start();
	require "conf.inc.php";
	require "lib.php";
	include "header.php";

	/*
		Vérifier le GET
		Récupérer en base de données toutes les informations sur l'user
		Alimenter le tableau $data avec le contenu de la bdd
	*/
	if (!empty($_GET['id']) && count($_GET) == 1 && is_numeric($_GET['id'])) {
		$connection = dbConnect();
		$query = $connection->prepare('SELECT * FROM users WHERE id = :id');
		$query->execute(['id' => $_GET['id']]);

		$data = $query->fetch();
	}
?>

<section>

	<?php
		if (isset($_SESSION['form_errors'])) {
			foreach ($_SESSION['form_errors'] as $error) {
				echo "<li>".$errors[$error];
			}

			$data = $_SESSION['form_post'];
		}
	?>

	<form method="POST" action="saveUser.php?id=<?php echo $_GET['id']?>">

		<!-- instruction (condition) ? vrai : faux; 
			 echo (isset(........)) ? ........ : '' -->

		<input type="text" name="pseudo" placeholder="Votre pseudo" required="required" 
		value="<?php echo (isset($data['pseudo'])) ? $data['pseudo']:'' ?>"><br>

		<input type="email" name="email" placeholder="Votre email" required="required" 
		value="<?php echo (isset($data['email'])) ? $data['email']:'' ?>"><br>

		<input type="password" name="pwd" placeholder="Votre mot de passe" required="required"><br>

		<input type="password" name="pwd2" placeholder="Confirmation" required="required"><br>

		<input type="date" name="birthday" placeholder="Date de naissance" required="required"
		value="<?php echo (isset($data['birthday'])) ? $data['birthday']:'' ?>"><br>

		<?php 

		foreach ($listOfGender as $key => $gender) {
			echo "<label>";
			echo $gender;

			$defaultGender = (isset($data['gender'])) ? $data['gender']:$defaultGender;
			if ($key == $defaultGender) {
				echo "<input type='radio' name='gender' value='".$key."'checked='checked'>";
			}else{
			echo "<input type='radio' name='gender' value='".$key."'>";
			}
			echo "</label>";
		} 
		?>


		<br>

		<select name="country">
			<?php
				foreach ($listOfCountry as $key => $value) {

					$selected = (isset ($data['country']) 
								&& $data['country'] == $key)
								? "selected='selected'" :"";

					echo "<option value='".$key."' ".$selected.">".$value."</option>";
				}
			?>
		</select>

		<br>

		<textarea name="comment" placeholder="Votre commentaire"><?php echo (isset($data['comment'])) ? $data['comment']:'' ?>		
		</textarea>

		<br>

		<input type="submit" value="S'enregistrer">
		
	</form>
	
</section>

<?php

	//Supprimer les variables de session permettant
	//d'afficher les erreurs et les valeurs
	unset($_SESSION['form_post']);
	unset($_SESSION['form_errors']);

	include "footer.php";
?>