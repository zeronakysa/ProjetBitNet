
function displayAchievement(){
    var request = newXMLHttpRequest();
    var url = 'achievementReceiveData.php';
    var div = document.getElementById('achievementDisplay');

    request.onreadystatechange = function(){
        if(request.readyState == 4) {
            if(request.status == 200){
                div.innerHTML = request.responseText;
            }
        }
    }

    request.open('GET', url, true);
    request.send();
}
