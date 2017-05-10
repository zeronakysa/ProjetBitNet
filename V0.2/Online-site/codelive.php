<?php
		include "header.php";
	?>
		<title>CodeLive</title>
	</head>
	<body>
		<?php
			include "navBar.php";
		?>

		<div id="codeMirror" style="margin-top:58px;">

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
		<script src="codemirror/addon/search/match-highlighter.js"></script>

		<!-- addon/scroll -->
		<script src="codemirror/addon/scroll/simplescrollbars.js"></script>

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
		<script src="codemirror/mode/javascript/javascript.js"></script>
		<script src="codemirror/mode/xml/xml.js"></script>
		<script src="codemirror/mode/css/css.js"></script>
		<script src="codemirror/mode/htmlmixed/htmlmixed.js"></script>

		<!-- css codemirror -->
		<link rel="stylesheet" href="codemirror/lib/codemirror.css">
		<link rel="stylesheet" href="codemirror/addon/scroll/simplescrollbars.css">
		<link rel="stylesheet" href="codemirror/addon/display/fullscreen.css">
		<link rel="stylesheet" href="codemirror/theme/monokai.css">

		<script>
			var myCodeMirror = CodeMirror(document.getElementById("codeMirror"),{
				mode: "text/html",
				placeholder: "Work In progress (codelive)",
				theme: "monokai",
				styleActiveLine: true,
				matchBrackets: true,
				lineWrapping: true,
				lineNumbers: true,
				smartIndent: true,
				onCursorActivity: function() {
			    	editor.matchHighlight("CodeMirror-matchhighlight");
			  	},
			  	scrollbarStyle: "overlay",
			  	showCursorWhenSelecting: true,
			  	autofocus: true,
			  	matchTags: {bothTags: true},
			  	autoCloseTags: true,
			  	autoCloseBrackets: true,
			  	extraKeys: {
			        "F11": function(cm) {
			          cm.setOption("fullScreen", !cm.getOption("fullScreen"));
			        },
			        "Esc": function(cm) {
			          if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
			        }
			    }			  	
			});
		</script>
	</body>
</html>
