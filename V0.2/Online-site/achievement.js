function getAchievement(){
    var request = newXMLHttpRequest();
    var url = 'achievementReceiveData.php';

    request.onreadystatechange = function(){
        if(request.readyState == 4) {
            if(request.status == 200){
                var achievementsWin = JSON.parse(request.responseText);
                getAchievementToHTML(achievementsWin);
                console.log(achievementsWin);
            }
        }
    }

    request.open('GET', url, true);
    request.send();
}

function getAchievementToHTML(achievementsWin){
    var container = document.getElementById('achievementDisplay');

    achievementsWin.forEach(function(achievement) {
        var div = document.createElement('div');

        var img = document.createElement('img');
            img.setAttribute('src',`css/img/achievement/${achievement.ID_succes}w.png`);

        var p = document.createElement('p');
            p.innerHTML = `${achievement.nom_succes}`;

        p.appendChild(img);
        div.appendChild(p);
        container.appendChild(div);


    })
}
