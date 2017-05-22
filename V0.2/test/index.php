<!DOCTYPE html>

<!-- Fichier qui upload des images (extensions choisie dans $extension)
	dans le dossier ($UploadFolder) selon $totalBytes
	n'upload pas de doublons, le dis,
	n'upload pas plus de la taille, le dis,
	n'upload pas de types interdit, le dis,
	compte le nombres de fichiers bien upload, le dis,
	dis quelle erreurs sur quel fichier
	les fonctions:
	- isset()
	- empty()
	- in_array()
	- array_push()
	- pathinfo()
	- file_exists()
	- move_uploaded_file()
	- count()
	- echo
-->

<html>
	<head>
		<title>PHP multiple upload</title>
	</head>
	<body>
		<form method="post" enctype="multipart/form-data" name="formUploadFile">
			<label>Selectioné les fichiers à chargé:</label>
			<input type="file" value="Choisir fichiers" name="files[]" multiple="multiple" />
			<input type="submit" value="Uploader" name="btnSubmit"/>
		</form>
		<?php
			if(isset($_POST["btnSubmit"]))
			{
				$errors = array();
				$uploadedFiles = array();
				$extension = array("jpeg","jpg","png","gif");
				$bytes = 16384;
				$KB = 16384;
				$totalBytes = $bytes * $KB;
				$UploadFolder = "UploadFolder";
				$counter = 0;
				echo "<pre>";
				print_r ($_FILES);
				echo "</pre>";
				foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name){
					$temp = $_FILES["files"]["tmp_name"][$key];
					$name = $_FILES["files"]["name"][$key];
					if(empty($temp)){
						break;
					}
					$counter++;
					$UploadOk = true;
					if($_FILES["files"]["size"][$key] > $totalBytes){
						$UploadOk = false;
						array_push($errors, $name.", la de taille supérieur à 32 MB.");
					}
					$ext = pathinfo($name, PATHINFO_EXTENSION);
					if(in_array($ext, $extension) == false){
						$UploadOk = false;
						array_push($errors, $name." , le type de fichier n'est pas accepté.");
					}
					if(file_exists($UploadFolder."/".$name) == true){
						$UploadOk = false;
						array_push($errors, $name." , le fichier existe déjà.");
					}
					if($UploadOk == true){
						move_uploaded_file($temp,$UploadFolder."/".$name);
						array_push($uploadedFiles, $name);
					}
				}
				if($counter>0){
					if(count($errors)>0){
						echo "<b>Erreurs:</b>";
						echo "<br/><ul>";
						foreach($errors as $error){
							echo "<li>".$error."</li>";
						}
						echo "</ul><br/>";
					}
					if(count($uploadedFiles)>0){
						echo "<b>Fichier uploadé(s):</b>";
						echo "<br/><ul>";
						foreach($uploadedFiles as $fileName){
							echo "<li>".$fileName."</li>";
						}
						echo "</ul><br/>";
						echo count($uploadedFiles)." fichier(s) uploadé(s) avec succès.";
					}
				}
				else{
					echo "S'il vous plait, séléctionné les fichier(s) à uploader.";
				}
			}
		?>
	</body>
</html>
