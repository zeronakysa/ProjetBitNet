$( document ).ready(function() {
    getHallOfFame();
});

function getHallOfFame(){
	var request = newXMLHttpRequest();

	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200) {
			var div = document.getElementById('hallOfFameDisplay');
			div.innerHTML = request.responseText;
			//alert(request.responseText);
		}
	}

	request.open('GET', 'services/getHallOfFame.php');
	request.send();
}
