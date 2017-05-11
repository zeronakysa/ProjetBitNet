<?php
		include "header.php";
	?>
		<title>CodeLive</title>
	</head>
	<body>
		<?php
			include "navBar.php";
		?>

		<div style="margin-top:58px;">
			<textarea id="codeMirror"></textarea>
		</div>

		<div>
			Hello
			<select onchange="changeOption('theme', this)">
				<option selected="true" disabled="disabled">Votre thême</option>
				<?php
					foreach (new DirectoryIterator('codemirror/theme') as $fileInfo) {
					    if($fileInfo->isDot()) continue;

					    $name = $fileInfo->getFilename();

					    echo "<option value='". $name . "'>" . $name . "</option>";
					}
				?>
			</select>

			<select onchange="changeOption('language', this)">
				<option selected="true" disabled="disabled">Votre language</option>
				<option value="text/x-csrc">C</option>
				<option value="text/x-c++src">C++</option>
				<option value="text/html">HTML</option>
				<option value="XML">XML</option>
				<option value="CSS">CSS</option>
				<option value="javascript">Javascript</option>
				<option value="text/x-php">PHP</option>
				<option value="text/x-java">Java</option>
			</select>
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
	</body>
</html>
