function getInfoMember(pseudo){
    var request = newXMLHttpRequest();

    request.onreadystatechange = function(){
        if(request.readyState == 4) {
            if(request.status == 200){
            var searchResults = JSON.parse(request.responseText);
                alert(request.responseText);
            }
        }
    };

    request.open('GET', 'services/getInfoMember.php?pseudo=' + pseudo);
    request.send();
}
