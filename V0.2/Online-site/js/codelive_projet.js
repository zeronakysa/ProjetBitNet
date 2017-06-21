/** Initialise l'éditeur codemirror avec différentes options
*
*	matchBrackets -> Met en valeur les couples de quotes, parenthèses, crochets
*	lineNumbers -> Affiche les numéros de lignes sur la gauche
*	smartIndent -> Auto indentation selon le language
*	indentUnit -> Précide le nombre d'espace pour l'indentation
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
	indentUnit: 4,
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

$( document ).ready(function() {
    getCodeMirrorContent();
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

//Transition pour afficher les options
$('div.tab span').on('click', function() {
	$('div.options').slideToggle('fast');
});

//création de la requête pour toutes versions de navigateur
function newXMLHttpRequest() {
	//Pour les navigateurs à jours
	if (window.XMLHttpRequest){
		return new XMLHttpRequest();
	}
	//Pour les anciennes versions d'IE
	return new ActiveXObject("Microsoft.XMLHTTP");
}

//Sauvegarde automatiquement le contenu de codemirror toutes les 2secondes
function autoSaveCodeMirrorContent(){
	var content = editor.getValue();
	var request = newXMLHttpRequest();
	var token = document.getElementById('token').value;
	var data = "content=" + content + "&token=" + token;

	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200) {
			//alert(request.responseText);
		}
	}

	request.open('POST', 'services/saveCodeMirror.php');
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
}

//Récupère automatiquemernt le contenu de codeMirror toutes les 2 secondes
function getCodeMirrorContent(){
	var request = newXMLHttpRequest();
	var element = document.getElementById('button_token');
	var token = document.getElementById('token').value;
	var data = "token=" + token;

	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200) {
			//alert(request.responseText);
			editor.setValue(request.responseText);
			editor.execCommand("goDocEnd");
		}
	}

	request.open('POST', 'services/getCodeMirror.php');
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
}

setInterval(function() { autoSaveCodeMirrorContent() }, 500);
setInterval(function() { getCodeMirrorContent() }, 5000);

//Sauvegarde le contenu de codemirror en appuyant sur le bouton
function saveCodeMirrorContent(){
	var content = editor.getValue();
	var request = newXMLHttpRequest();
	var element = document.getElementById('button_token');
	var data = "content=" + content + "&token=" + $(element).data('token');

	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200) {
			//alert(request.responseText);
			//Affiche pop up confirmation
			var confirm_save = document.getElementById('saved');
			confirm_save.innerHTML = "Fichier sauvegardé!";
			//Attend 2000ms soit 2sec et efface la pop up
			setTimeout(function(){
		        confirm_save.innerHTML = "";
		    }, 2000);
		}
	}

	request.open('POST', 'services/saveCodeMirror.php');
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
}
