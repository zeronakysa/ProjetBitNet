$( document ).ready(function() {
    getExpLeaderboard();
    getProjectLeaderboard();
    getShoutboxLeaderboard();
});

function showHofResult(str) {

    if(str.length == 0){
        var container = document.getElementById('hofSearchResult');
        container.innerHTML = '';
        var div = document.getElementById('result');
        div.removeChild(container);
        return;
    }

    var request = newXMLHttpRequest();

    request.onreadystatechange = function(){
        if(request.readyState == 4) {
            if(request.status == 200){
                var searchResults = JSON.parse(request.responseText);
                searchResultsToHtml(searchResults);
            }
        }
    };

    request.open('GET','services/hofSearch.php?query=' +str);
    request.send();
}

function searchResultsToHtml(searchResults) {
    if (document.getElementById('hofSearchResult')) {
        var container = document.getElementById('hofSearchResult');
        container.innerHTML = '';
    } else {
        var div = document.getElementById('result');
        var container = document.createElement('div');
        container.id = 'hofSearchResult';
        div.appendChild(container);
        var container = document.getElementById('hofSearchResult');
    }

    // Container Style
    container.style.paddingTop = "10px";
    container.style.borderWidth = "0px 1px 1px 1px";
    container.style.borderStyle = "solid";
    container.style.borderColor = "#e5e5e5";

    var searchTags = searchResults.map(formatSearchResultsToHtml);

    searchTags.forEach(function(searchTag) {
        container.appendChild(searchTag);
    });
}

function formatSearchResultsToHtml(searchResult) {
    var div = document.createElement('div');
    div.style.paddingLeft = '10px';

    var link = document.createElement('a');
    link.href = '../pageMembre.php?pseudo=' + `${searchResult.pseudo}`;

    link.innerHTML =  `Email : ${searchResult.email} <br>
                    Pseudo : ${searchResult.pseudo}`;

    div.appendChild(link);

    return div;
}

function getExpLeaderboard(){
	var request = newXMLHttpRequest();
    var query = 1;

	request.onreadystatechange = function() {
        if (request.readyState == 4) {
            if (request.status == 200) {
                var results = JSON.parse(request.responseText);
                expResultToHtml(results);
            }

        }
	}

	request.open('GET', 'services/getHallOfFame.php?query=' + query);
	request.send();
}

function getProjectLeaderboard(){
	var request = newXMLHttpRequest();
    var query = 2;

	request.onreadystatechange = function() {
		if (request.readyState == 4) {
            if (request.status == 200) {
                var results = JSON.parse(request.responseText);
                projectResultToHtml(results);
            }

		}
	}

    request.open('GET', 'services/getHallOfFame.php?query=' + query);
	request.send();
}

function getShoutboxLeaderboard(){
	var request = newXMLHttpRequest();
    var query = 3;

	request.onreadystatechange = function() {
        if (request.readyState == 4) {
            if (request.status == 200) {
                var results = JSON.parse(request.responseText);
                shoutBoxResultToHtml(results);
            }

        }
	}

    request.open('GET', 'services/getHallOfFame.php?query=' + query);
	request.send();
}

function expResultToHtml(results) {
    var container = document.getElementById('hofXPDisplay');
    var i = 1;

    results.forEach(function(result){
        var p = document.createElement('p');
        p.innerHTML = `${i} - ${result.pseudo} avec ${result.experience} XP`;
        container.appendChild(p);
        i++;
    })
}

function projectResultToHtml(results) {
    var container = document.getElementById('hofProjectDisplay');
    var i = 1

    results.forEach(function(result) {
        if (!result == false) {
            var p = document.createElement('p');
            p.innerHTML = `${i} - ${result.pseudo} avec ${result.countProject} projet(s)`;
            container.appendChild(p);
            i++;
        }
    })
}

function shoutBoxResultToHtml(results) {
    var container = document.getElementById('hofShoutBoxDisplay');
    var i = 1

    results.forEach(function(result) {
        if (!result == false) {
            var p = document.createElement('p');
            p.innerHTML = `${i} - ${result.pseudo} avec ${result.countMessage} message(s)`;
            container.appendChild(p);
            i++;
        }
    })
}
