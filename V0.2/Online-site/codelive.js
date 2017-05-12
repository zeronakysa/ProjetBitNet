/** Initialise l'éditeur codemirror avec différentes options
*
*	matchBrackets -> Met en valeur les couples de quotes, parenthèses, crochets
*	lineNumbers -> Affiche les numéros de lignes sur la gauche
*	smartIndent -> Auto indentation selon le language
*	showCursorWhenSelecting -> Affiche toujours le curseur pendant une sélection
*	autofocus -> Met le curseur sur codemirror lors de l'initialisation de celui-ci
*	matchTags -> Met en valeur les couples de balises
*	autoCloseTags -> Fermeture automatique des balises
*	autoCloseBrackets -> Fermeture automatique des couples de quotes, parenthèses, crochets
*	fullScreen -> mode plein écran
*	extraKeys -> configuration touche pour activer/désactiver le fullScreen
*
*/
var editor = CodeMirror.fromTextArea(document.getElementById("codeMirror"),{
	placeholder: "Work In progress (codelive)",
	theme: 'monokai',
	matchBrackets: true,
	lineNumbers: true,
	smartIndent: true,
  	scrollbarStyle: "overlay",
  	showCursorWhenSelecting: true,
  	autofocus: true,
  	matchTags: {bothTags: true},
  	autoCloseTags: true,
  	autoCloseBrackets: true,
  	fullScreen: true,
  	extraKeys: {
        "F11": function(cm) {
          cm.setOption("fullScreen", !cm.getOption("fullScreen"));
        },
        "Esc": function(cm) {
          if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
        }
    }
});

//Change les options theme ou language pour codemirror
function changeOption(option, element){

	if (option === 'theme') {
		var theme = element.options[element.selectedIndex].value;
		editor.setOption('theme', theme.split('.')[0]);
	}

	if (option === 'language') {
		var language = element.options[element.selectedIndex].value;
		editor.setOption('mode', language.split('.')[0]);
	}
}

//Sauvegarde le contenu de codemirror
function save(){
	var content = editor.getValue();
	console.log(content);
}

//Transition pour afficher les options
$('div.tab span').on('click', function() {
	$('div.options').slideToggle('fast');
});