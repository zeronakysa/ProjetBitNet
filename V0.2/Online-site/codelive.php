<?php
	session_start();
	require '../global/functions.php';
	require '../global/conf.inc.php';

	if (!isset($_SESSION['email']) && !isset($_SESSION['pseudo']) && !isset($_SESSION['online'])) {
		header('Location: ../Presentation/index.php');
	}

	//Si le token n'existe pas -> on le créé et on redirige
	if (!isset($_SESSION['token'])) {
		$token_key = md5(uniqid(rand(), true));
		$token = '';

		for ($i=0; $i < 6; $i++) {
			$charIndex = rand(0, 22); 
			$token .=  $token_key[$charIndex]; 
		}

		$_SESSION['token'] = $token;
		
		header("Location: codelive.php?token=" . $token);
	}

	//si le token existe mais qu'il n'est pas dans l'url, on redirige
	if ($_GET['token'] == null) {
		header("Location: codelive.php?token=" . $_SESSION['token']);
	}

?>

	<!DOCTYPE html>

	<html>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- BootStrap Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="description" content="">
		<meta name="author" content="">
		<!-- Bootstrap Css Link -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
		<!-- Custom Css Link -->
		<link rel="stylesheet" href="css/custom_css.css" />

		<!-- Custom font -->
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

		<!-- Css Plugin -->
		<link rel="stylesheet" href="lib/font-awesome/css/font-awesome.min.css">

		<!-- css theme codemirror -->
		<?php
			foreach (new DirectoryIterator('codemirror/theme') as $fileInfo) {
			    if($fileInfo->isDot()) continue;

			    $name = $fileInfo->getFilename();

			    echo '<link rel="stylesheet" type="text/css" href="codemirror/theme/' . $name .'">';
			}
		?>
		<title>CodeLive</title>
	</head>
	<body>
		<?php
			include "navBar.php";
		?>

		<div style="margin-top:40px;">
			<textarea id="codeMirror"></textarea>
		</div>

		<div id="footer_menu">
			<div class="tab"><span>Options</span></div>
			<div class="options">
				<select onchange="changeOption('theme', this)">
					<option selected="true" disabled="disabled">Votre thême</option>
					<?php
						foreach (new DirectoryIterator('codemirror/theme') as $fileInfo) {
						    if($fileInfo->isDot()) continue;

						    $fileName = $fileInfo->getFilename();
						    $name = explode('.', $fileName);

						    echo "<option value='". $fileName . "'>" . $name[0] . "</option>";
						}
					?>
				</select>

				<select onchange="changeOption('language', this)">
					<option selected="true" disabled="disabled">Votre language</option>
					<option value="text/x-csrc">C</option>
					<option value="text/x-c++src">C++</option>
					<option value="text/html">HTML</option>
					<option value="text/xml">XML</option>
					<option value="text/css">CSS</option>
					<option value="javascript">Javascript</option>
					<option value="text/x-php">PHP</option>
					<option value="text/x-java">Java</option>
				</select>

				<button id= "button_token" type="button" class="btn btn-save fa fa-floppy-o" onclick="saveCodeMirrorContent()"
				data-toggle="tooltip" data-placement="top" data-token="<?php echo $_SESSION['token'] ?>" title="Sauvegarder"></button>
				<span id="saved"></span>
			</div>
		</div>

		<?php
	  		include "footer.php";
		?>

		<!-- JS codemirror -->
		<script src="codemirror/lib/codemirror.js"></script>

		<!-- addons codemirror -->
		<!-- addon/search -->
		<script src="codemirror/addon/search/search.js"></script>
		<script src="codemirror/addon/search/searchcursor.js"></script>

		<!-- addon/scroll -->
		<script src="codemirror/addon/scroll/simplescrollbars.js"></script>
		<script src="codemirror/addon/scroll/annotatescrollbar.js"></script>

		<!-- addon/edit -->
		<script src="codemirror/addon/edit/matchBrackets.js"></script>
		<script src="codemirror/addon/edit/closebrackets.js"></script>
		<script src="codemirror/addon/edit/matchTags.js"></script>
		<script src="codemirror/addon/edit/closetag.js"></script>

		<!-- addon/selection -->
		<script src="codemirror/addon/selection/mark-selection.js"></script>

		<!-- addon/fold -->
		<script src="codemirror/addon/fold/xml-fold.js"></script>	

		<!-- addon/display -->
		<script src="codemirror/addon/display/placeholder.js"></script>
		<script src="codemirror/addon/display/fullscreen.js"></script>
		
		<!-- modes codemirror -->
		<script src="codemirror/mode/clike/clike.js"></script>
		<script src="codemirror/mode/javascript/javascript.js"></script>
		<script src="codemirror/mode/xml/xml.js"></script>
		<script src="codemirror/mode/css/css.js"></script>
		<script src="codemirror/mode/htmlmixed/htmlmixed.js"></script>
		<script src="codemirror/mode/php/php.js"></script>

		<!-- css codemirror -->
		<link rel="stylesheet" href="codemirror/lib/codemirror.css"/>
		<link rel="stylesheet" href="codemirror/addon/scroll/simplescrollbars.css">
		<link rel="stylesheet" href="codemirror/addon/display/fullscreen.css">
	
		<!-- Créé l'éditeur de texte -->
		<script src="codelive.js"></script>

		<!-- Tooltip script -->
		<script>
			$(document).ready(function(){
			    $('[data-toggle="tooltip"]').tooltip(); 
			});
	
			
	
		</script>
	</body>
</html>
