<?php
	require "header.php";
	// Vérifier le GET
	if(!empty($_GET["id"]) && count($_GET)==1 && is_numeric($_GET["id"])){
	// Récupérer en base de données toutes les informations sur l'user
		$connection=dbConnect();
		$query=$connection->prepare("SELECT * FROM USERS WHERE ID_membre=:id");
		$query->execute($_GET);
	  $data=$query->fetch();
}
?>
<section>
	<form method="POST" action="saveUser.php?id=<?php echo $_GET['id']?>">
		Votre pseudo: <input type="text" name="pseudo" placeholder="<?php echo ($data["pseudo"])?$data["pseudo"]:"";?>" required="required"><br>
    Votre email: <input type="text" name="pseudo" placeholder="<?php echo ($data["email"])?$data["email"]:"";?>" required="required"><br>
		<input type="password" name="pwd" placeholder="Votre mot de passe" required="required"><br>
		<input type="password" name="pwd2" placeholder="Confirmation" required="required"><br>
		<input type="date" name="birthday" placeholder="Date de naissance"
		value="<?php echo (isset($data["birthday"]))?$data["birthday"]:"";?>"><br>
		<?php
		foreach ($listOfGender as $key => $gender) {
			echo "<label>";
			echo $gender;
			$defaultGender = (isset($data["gender"]) )?$data["gender"]:$defaultGender;
			if( $key  == $defaultGender){
				echo "<input type='radio' name='gender' value='".$key."' checked='checked'>";
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
					$selected = (
									isset($data["country"])
									&&
									$data["country"]== $key
								)
								? "selected='selected'"
								:"";
					echo "<option value='".$key."' ".$selected.">".$value."</option>";
				}
			?>
		</select>
		<br>
		<textarea name="comment" placeholder="Votre commentaire"><?php echo (isset($data["comment"]))?$data["comment"]:"";?></textarea>
		<br>
		<input type="submit" value="S'inscrire">
	</form>
</section>
<?php
	include "footer.php";
?>
