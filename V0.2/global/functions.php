<?php
	function dbConnect(){
		//Se connecter à la bdd
		try{
				$connection = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBUSER, DBPWD);
		}catch(Exception $e){
				die("Erreur SQL".$e->getMessage());
		}

		return $connection;
	}

	function etatSucces(){
		$connection = dbConnect();
		// Nombre de succes dans la BDD
		$query = $connection->prepare('SELECT COUNT(ID_succes) FROM SUCCES');
		$query->execute();
		$maxSucces = $query->fetch();
		$query = null;

		//boucle pour parcourir et vérifier tous les succes du membre
		for ($i=1; $i <= $maxSucces[0]; $i++) {

			//Donne un email si le succes est reussi
			$query = $connection->prepare('SELECT email FROM succes_reussi WHERE email = :email AND ID_succes = :i');
			$query->execute([
				'email' => $_SESSION['email'],
				'i' => $i
				]);
			$result = $query->fetch();

			//Donne le nom du succes qui a pour ID $i
			$query = $connection->prepare('SELECT nom_succes FROM SUCCES WHERE ID_succes = :i');
			$query->execute(['i' => $i]);
			$nomSucces = $query->fetch();

			echo "Le succes <i>".$nomSucces[0];
			if ($result[0] == $_SESSION['email']){
				echo "</i> est réussi par l'utilisateur qui a pour email: '<i>".$_SESSION['email']."'</i><br />";
				}
			else{
				echo "</i> n'est pas réussi par l'utilisateur qui a pour email: '<i>".$_SESSION['email']."'</i><br />";
				}
			$result[0] = 0;
			}
			$query = null;
		}

	function giveSucces($id_succes){
		$succesExist = false;
		$connection = dbConnect();

		//Get name and goal from SUCCESS
		$query = $connection->prepare('SELECT nom_succes, goal FROM SUCCES WHERE ID_succes = :id_succes');
		$query->execute([
			'id_succes' => $id_succes
			]);
		$achievementsInfo = $query->fetch();
		$query = null;

		//Verify if success' already done.
		$query = $connection->prepare('SELECT email, progression FROM succes_reussi WHERE email=:email AND ID_succes = :id_succes');
		$query->execute([
			'email' => $_SESSION['email'],
			'id_succes' => $id_succes
			]);
		$result = $query->fetch();
		$query = null;

		//If Achievement not started → add in DB
		if ($result[0] != $_SESSION['email']){
			$query = $connection->prepare('INSERT INTO `succes_reussi` (`email`, `ID_succes`) VALUES (:email, :id_succes)');
			$query->execute([
				'email'=>$_SESSION['email'],
				'id_succes'=>$id_succes
				]);
			$query = null;
				// Select new value
				$query = $connection->prepare('SELECT email, progression FROM succes_reussi WHERE email=:email AND ID_succes = :id_succes');
				$query->execute([
					'email' => $_SESSION['email'],
					'id_succes' => $id_succes
					]);
				$result = $query->fetch();
				$query = null;


			// ------------------------------------
			// Testing Condition for Debug
			// ------------------------------------
			// If prog = goal achievement unlocked
			if($result[0] == $_SESSION['email'] && $result[1] == $achievementsInfo[1]){
				echo "Succès " .$achievementsInfo[0] ." accomplie <br />";
				$succesExist = true;
			// If prog != goal display progression
			} else {
				echo "Succès " .$achievementsInfo[0] ." ".$result[1] ."/".$achievementsInfo[1] ."<br />";
			}

		//If Achievement started but not finish update progression
		} else if($result[0] == $_SESSION['email'] && $result[1] < $achievementsInfo[1]){
			$query = $connection->prepare('UPDATE SUCCES_REUSSI SET progression = :prog WHERE email=:email AND ID_succes=:id_succes');
			$succesExist = $query->execute([
				"email" => $_SESSION['email'],
				"id_succes" => $id_succes,
				"prog" => $result[1] + 1
			]);
			// Select new value
			$query = $connection->prepare('SELECT email, progression FROM succes_reussi WHERE email=:email AND ID_succes = :id_succes');
			$query->execute([
				'email' => $_SESSION['email'],
				'id_succes' => $id_succes
				]);
			$result = $query->fetch();

			// ------------------------------------
			// Testing Condition for Debug
			// ------------------------------------
			// if prog = goal achievement unlocked
			if($result[0] == $_SESSION['email'] && $result[1] == $achievementsInfo[1]){
				echo "Succès " .$achievementsInfo[0] ." accomplie<br />";
				$succesExist = true;
			// if prog != goal display progression
			} else {
				echo "Succès " .$achievementsInfo[0] ." ".$result[1] ."/".$achievementsInfo[1];
			}
		// If achievement already unlocked
		}else if($result[0] == $_SESSION['email'] && $result[1] == $achievementsInfo[1]) {
			echo "Succès " .$achievementsInfo[0] ."déja accomplie <br />";
		}

		// GiveExp to member
		if ($succesExist) {
			giveExp($_SESSION['email'], $id_succes);
		}
	}

	//Récupère l'exp actuel d'un membre
	function getExp($email){
		$connection = dbConnect();

		$query = $connection->prepare('SELECT experience FROM MEMBRE WHERE email=:email');
		$query->execute(['email'=>$email]);
		$result=$query->fetch();

		return $result[0];
	}

	//Donne l'exp associé au succes au membre
	function giveExp($email, $id_succes){
		$connection = dbConnect();

		$expMembre = getExp($email);

		$query = $connection->prepare('SELECT xp_donnee FROM SUCCES WHERE ID_succes=:id_succes');
		$query->execute(['id_succes'=>$id_succes]);
		$result = $query->fetch();

		$exp = $expMembre + $result[0];

		$query = $connection->prepare('UPDATE MEMBRE SET experience = :exp WHERE email=:email');
		$query->execute([
			'exp' => $exp,
			'email' => $email
			]);
	}

	/*
			Trois fonction sont mise en place pour gérer les infos membre dans BDD,
			la première,
			deleteUser(ID_membre);
			deleteUser est accessible depuis admin.php
			elle passe is_deleted à 1 soit compte inactif/supprimé
			?? accessible depuis l'user par "supprimer mon compte" ?

			updateUser();
			updateUser met à jour les informations d'un utilisateur qui a le role 'user'
			met à jour les infos suivante de façon libre:
			pseudo, nom, prenom, code postale, langages, date de naisance, profile_picture
			débloque un succes lors de la première modification
			des vérifications de sécurité sont à faire sur les entrées

			adminUser(ID_membre);
			adminUser est accessible depuis la page admin.php
			la fonction adminUser permet de manage tout les user, hors email et ID
			n'est accessible que avec le role 'admin'
			PAS DE VERIFICATION faites sur les entrées

	*/
	function updateUser(){
		//verification pas encore faite
		//ATTENTION
		$connection=dbConnect();
		$query=$connection->prepare("UPDATE membre SET
			pseudo = :pseudo,
			nom = :nom,
			prenom = :prenom,
			langages = :langages,
			-- ville = :ville,
			date_naissance = :date_naissance,
			date_update = NOW(),
			profile_picture = :profile_picture
			WHERE email=:email");
		 $test = $query->execute([
			"pseudo" => $_POST["pseudo"],
			"nom" => $_POST["nom"],
			"prenom" => $_POST["prenom"],
			"langages" => $_POST["langages"],
			// "ville" => $_POST["ville"],
			"date_naissance" => $_POST["date_naissance"],
			"profile_picture" => $_POST["profile_picture"],
			"email" => $_SESSION["email"]
		]);

		$_SESSION['pseudo'] = $_POST['pseudo'];
		$_SESSION['test'] = $test;
		header('Location: espacePersonnel.php#myModification');
	}

	function deleteUser($id){
		$connection=dbConnect();
		$query=$connection->prepare("UPDATE MEMBRE SET is_deleted=1 WHERE ID_membre=:id"); //les deux points mettent la donnée de l'execute
		$query->execute(["id" => $id]);
		header("Location: admin.php");
		}
		function unDeleteUser($id){
			$connection=dbConnect();
			$query=$connection->prepare("UPDATE MEMBRE SET is_deleted=0 WHERE ID_membre=:id"); //les deux points mettent la donnée de l'execute
			$query->execute(["id" => $id]);
			header("Location: admin.php");
			}

	function adminUser($id){
		$connection=dbConnect();
		$query=$connection->prepare("UPDATE membre SET
			pseudo = :pseudo,
			nom = :nom,
			prenom = :prenom,
			langages = :langages,
			-- ville = :ville,
			date_naissance = :date_naissance,
			date_creation = :date_creation,
			date_update = NOW(),
			succes_reussi = :succes_reussi,
			role = :role,
			profile_picture = :profile_picture,
			experience = :experience
			WHERE ID_membre=:id");

		 $_SESSION["test"] = $query->execute([
			 "id" => $_GET["id"],
			"pseudo" => $_POST["pseudo"],
			"nom" => $_POST["nom"],
			"prenom" => $_POST["prenom"],
			"langages" => $_POST["langages"],
			// "ville" => $_POST["ville"],
			"date_naissance" => $_POST["date_naissance"],
			"date_creation" => $_POST["date_creation"],
			"succes_reussi" => $_POST["succes_reussi"],
			"role" => $_POST["role"],
			"profile_picture" => $_POST["profile_picture"],
			"experience" => $_POST["experience"]
		]);
 /* DEBUG
		print_r ($_SESSION);
		echo "<br />";
		print_r ($_GET);
		echo "<br />";
		print_r ($_POST);
		echo "<br />";
		var_dump($connection);
		echo "<br />";
DEBUG */
		header("Location: admin.php");
	}

	function listFilesAndPrint( $from )
	{
	  $length = strlen($from);
	    if(! is_dir($from))
	        return false;
	    $dirs = array( $from);
		    while( NULL !== ($dir = array_pop( $dirs)))
	    {
	        if( $dh = opendir($dir))
	        {
	            while( false !== ($file = readdir($dh)))
	            {
	                if( $file == '.' || $file == '..')
	                    continue;
	                $path = $dir . '/' . $file;
	                if( is_dir($path)){
	                  $dirs[] = $path;
	                  $path = substr($path, $length);
	                  echo " ..".$path."/";
	                }else{
	                  $path = substr($path, $length);

										$nameFile = pathinfo($file, PATHINFO_FILENAME);
										$connection=dbConnect();
										$query=$connection->prepare("SELECT ID_fichier FROM FICHIER WHERE ID_projet = :ID_projet AND nom_fichier = :nom_fichier AND chemin_fichier = :chemin_fichier");
										$query->execute(["ID_projet" => $_SESSION['ID_project'],
																			"nom_fichier" => $nameFile,
																			"chemin_fichier" => $dir
									]);
									  $id_file = $query->fetch();
										?>
										<div class="container-fluid">
											<div id="projet_nameFile" class="col-lg-3">
												..<?php echo $path ?>
											</div>
											<div id="projet_openCLBox" class="col-lg-1">
												<form method="post" action="treatment.php">
													<input type="hidden" name="action" value="openCodeLive"/>
													<input type="hidden" name="idFile" value="<?php echo $id_file[0] ?>"/>
											    <input type="submit" value="Ouvrir dans CodeLive">
												</form>
											</div>
											<form method="post" action="treatment.php">
												<div id="projet_deleteFileBox" class="col-lg-1">
													<input type="hidden" name="action" value="deleteFile"/>
													<input type="hidden" name="idFile" value="<?php echo $id_file[0] ?>"/>
											    <input type="submit" value="Supprimer">
												</div>
										</form><br />
									</div>
										<?php
	                }
	            }
	            closedir($dh);
	        }
	    }
	    return true;
	}

	function dbAddParticipeProjet($idProject, $email, $role){
		$connection = dbConnect();
		$query = $connection->prepare('INSERT INTO `participe_projet` (`email`, `ID_projet`, `role_projet`) VALUES (:email, :ID_projet, :role_projet)');
		$participe_projet = $query->execute([
			'email'=>$email,
	    'ID_projet'=>$idProject,
			'role_projet'=>$role,
						]);
	  return $participe_projet;
	}

	function dbAddProjet($nameProject, $idCreateur, $desciptionProjet){
		$connection = dbConnect();
    $query = $connection->prepare('INSERT INTO `projet` (`nom_projet`, `ID_createur`, `date_creation`, `date_update`, `description_projet`) VALUES (:nom_projet, :ID_createur, NOW(), NOW(), :description_projet)');
    $results = $query->execute([
      'nom_projet'=>$nameProject,
      'ID_createur'=>$idCreateur,
      'description_projet'=>$desciptionProjet
    				]);
		return $results;
	}

	function dbGetIdProject($idCreateur, $nameProject){
	  $connection = dbConnect();
	  $query = $connection->prepare('SELECT ID_projet FROM PROJET WHERE ID_createur LIKE :ID_createur AND nom_projet LIKE :nom_projet' );
	  $getID = $query->execute([
	    'ID_createur'=>$idCreateur,
	    'nom_projet'=>$nameProject
	          ]);
	  $getID = $query->fetchAll();
	  $idProject = $getID["0"];
	  return $idProject[0];
	}
	function updateProject($id, $description){
		//verification pas encore faite
		//ATTENTION
		$connection=dbConnect();
		$query=$connection->prepare("UPDATE projet SET
			description_projet = :description_projet,
			date_update = NOW()
			WHERE ID_projet=:ID_projet");
		 $result = $query->execute([
			"description_projet" => $description,
			"ID_projet" => $id
		]);
		header("Location: projet.php#myProject");
	}
	function adminUpdateProject($id, $description){
		//verification pas encore faite
		//ATTENTION
		$connection=dbConnect();
		$query=$connection->prepare("UPDATE projet SET
			description_projet = :description_projet,
			date_update = NOW()
			WHERE ID_projet=:ID_projet");
		 $result = $query->execute([
			"description_projet" => $description,
			"ID_projet" => $id
		]);
		header("Location: admin.php");
	}

	function deleteProject($id){
		$connection=dbConnect();
		$query=$connection->prepare("UPDATE PROJET SET is_deleted=1 WHERE ID_projet=:id");
		$query->execute(["id" => $id]);
		$query = $connection->prepare('SELECT ID_createur, nom_projet FROM PROJET WHERE ID_projet=:id' );
	 	$getInfos = $query->execute(["id" => $id]);
	  $getInfos = $query->fetchAll();
		$oldStructure = "../PROJETS/".$getInfos[0]["ID_createur"]."/".$getInfos[0]["nom_projet"];
    $newStructure = "../PROJETS/".$getInfos[0]["ID_createur"]."/".$getInfos[0]["nom_projet"]."_old";
    if (file_exists($newStructure)){
      rmdir($newStructure);
    }
    rename ($oldStructure, $newStructure);
		header('Location: projet.php#myProject');

	}

	function createProject($idMembre, $projectName, $projetDescription, $email){
		$structure = "../PROJETS/".$idMembre."/".$projectName."/";
		$racine = "../PROJETS/".$idMembre;
		$root = "../PROJETS/";

		  if (file_exists($structure)){
		    $creationError = 1;
		  }else{
		    if((dbAddProjet($projectName, $idMembre, $projetDescription)) == 1){
		      mkdir($structure, 0777, true);
		      echo 'Projet '.$projectName.' créé avec succès.<br /><br />';
		      dbGetIdProject($idMembre, $projectName);
		      dbAddParticipeProjet((dbGetIdProject($idMembre, $projectName)), $email, "owner");
		    }else{
		      $creationError = 1;
		    }
		    $creationError = 0;
		  }
		  if ($creationError == 1) {
		    header('Location: projet.php?ce=1');
		  }
		  else
		    header('Location: projet.php#myProject');

			  echo "<B>Arborescence personnel</B><pre>";
			  listFilesAndPrint($racine);
			  echo "</pre>";

			  echo "<B>Arborescence du projet ".$_POST["projectName"]."</B><pre>";
			  listFilesAndPrint($structure);
			  echo "</pre>";
		}

		function createFile($pathName){
			$creation = fopen( $pathName, "w+");
			if( $creation ){
				$fileName = pathinfo($pathName, PATHINFO_FILENAME);
				$ext = pathinfo($pathName, PATHINFO_EXTENSION);
				$connection = dbConnect();
				$query = $connection->prepare('INSERT INTO `fichier` (
					`ID_projet`,
					`chemin_fichier`,
					`proprietaire`,
					`nom_fichier`,
					`extension`,
					`date_creation`,
					`date_modification`,
					`content`,
					`is_deleted`)
				VALUES (
					:ID_projet,
					:chemin_fichier,
					:proprietaire,
					:nom_fichier,
					:extension,
					NOW(),
					NOW(),
					:content,
					:is_deleted)');
				$query->execute([
					'ID_projet'=>$_SESSION["ID_project"],
					'chemin_fichier'=>$pathName,
					'proprietaire'=>$_SESSION["ID_membre"],
					'nom_fichier'=>$fileName,
					'extension'=>$ext,
					'content'=>'',
					'is_deleted'=>0
				]);
				header('Location: contribProject.php#NewFile');
			}
			return $creation;
		}

		function addMultipleFiles($UploadFolder){
		  ?>
		  		<form method="post" enctype="multipart/form-data" name="formUploadFile">
		  			<label>Selectioné les fichiers à ajouter au projet:</label>
		  			<input type="file" value="Choisir fichiers" name="files[]" multiple="multiple" />
		  			<input type="submit" value="Uploader" name="btnSubmit"/>
		  		</form>
		  		<?php
		  			if(isset($_POST["btnSubmit"]))
		  			{
		  				$errors = array();
		  				$uploadedFiles = array();
		  				$extension = array("jpeg","jpg","png","gif","","c","cpp","html","css","js","php","txt");
		  				$bytes = 16384;
		  				$KB = 16384;
		  				$totalBytes = $bytes * $KB;
		  				$counter = 0;
//		  				echo "<pre>";print_r ($_FILES);echo "</pre>";
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
		  						array_push($errors, $name.", le type de fichier n'est pas accepté.");
		  					}

		  					if(file_exists($UploadFolder."/".$name) == true){
		  						$UploadOk = false;
		  						array_push($errors, $name.", le fichier existe déjà.");
		  					}
		  					if($UploadOk == true){
									$contentFile = file_get_contents($temp);
									$fileName = pathinfo($name, PATHINFO_FILENAME);
									$connection = dbConnect();
							    $query = $connection->prepare('INSERT INTO `fichier` (
										`ID_projet`,
										`chemin_fichier`,
										`proprietaire`,
										`nom_fichier`,
										`extension`,
										`date_creation`,
										`date_modification`,
									  `content`,
									`is_deleted`)
									VALUES (
										:ID_projet,
										:chemin_fichier,
										:proprietaire,
										:nom_fichier,
										:extension,
										NOW(),
										NOW(),
										:content,
										:is_deleted)');
							    $results = $query->execute([
							      'ID_projet'=>$_SESSION["ID_project"],
										'chemin_fichier'=>$UploadFolder,
							      'proprietaire'=>$_SESSION["ID_membre"],
										'nom_fichier'=>$fileName,
										'extension'=>$ext,
										'content'=>$contentFile,
										'is_deleted'=>"0"
							    				]);
									// print_r($results);echo "<br />";
									// print_r($query);echo "<br />";
									// echo$_SESSION["ID_project"]."<br />";
									// echo$UploadFolder."<br />";
									// echo$_SESSION["ID_membre"]."<br />";
									// echo$fileName."<br />";
									// echo$ext."<br />";

									if($results != 1){
										echo "Impossible d'ajouter en base de donnée.";
									}
		  						move_uploaded_file($temp,$UploadFolder.$name);
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
		}

function deleteFile($id_file){
	$connection=dbConnect();
	$query=$connection->prepare("UPDATE FICHIER SET is_deleted=1 WHERE ID_fichier=:id_fichier");
	$query->execute(["id_fichier" => $id_file]);
	$query = NULL;

	$query=$connection->prepare("SELECT * FROM FICHIER WHERE ID_fichier=:id_fichier");
	$query->execute(["id_fichier" => $id_file]);
	$file = $query->fetch();
	$fileName = $file["chemin_fichier"].$file["nom_fichier"].".".$file["extension"];
	unlink($fileName);
	header('Location: manageProject.php');
}

function adminDeleteProject($id){
	deleteAllFileFromBDD($id);
	$connection=dbConnect();
	$query=$connection->prepare("UPDATE PROJET SET is_deleted=1 WHERE ID_projet=:id");
	$query->execute(["id" => $id]);
	$query = $connection->prepare('SELECT ID_createur, nom_projet FROM PROJET WHERE ID_projet=:id' );
	$getInfos = $query->execute(["id" => $id]);
	$getInfos = $query->fetchAll();
	$oldStructure = "../PROJETS/".$getInfos[0]["ID_createur"]."/".$getInfos[0]["nom_projet"];
	$newStructure = "../PROJETS/".$getInfos[0]["ID_createur"]."/".$getInfos[0]["nom_projet"]."_old";
	if (file_exists($newStructure)){
		rmdir($newStructure);
	}
	rename ($oldStructure, $newStructure);
	header('Location: admin.php');

}

function deleteAllFileFromBDD($idProjet){
	$connection=dbConnect();
	$query=$connection->prepare("SELECT ID_fichier FROM fichier WHERE ID_projet = :ID_projet");
	$query->execute(["ID_projet" => $idProjet]);
	$allFiles = $query->fetchAll();
	foreach ($allFiles as $file) {
		print_r($file);
		$query=$connection->prepare("UPDATE FICHIER SET is_deleted=1 WHERE ID_fichier=:id_fichier");
		$query->execute(["id_fichier" => $file['ID_fichier']]);
	}
}

function addContrib($id, $email, $role_projet){
	if( isset($id) &&
	    isset($email) &&
	    isset($role_projet) ) {
	      $params = [
	        $email,
	        $id,
	        $role_projet
	      ];
				$connection=dbConnect();
	      $statement = $connection->prepare('INSERT INTO participe_projet (email, ID_projet, role_projet) VALUES (?, ?, ?)');
	      echo (int)$statement->execute($params);
	} else {
		header('Location: projet.php#addPASOK');

	}
	header('Location: projet.php#addOK');
}

?>
