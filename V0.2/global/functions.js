//Script refresh captcha
$(function() {
    $('#reload_captcha').click(function(){
        $('#captcha').attr('src', '../Presentation/captcha/captcha.php?cache=' + new Date().getTime());
    });
});

// Tooltip script
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
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
