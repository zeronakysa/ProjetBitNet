function getAchievement(){
    var request = newXMLHttpRequest();
    var url = 'achievementReceiveData.php';

    request.onreadystatechange = function(){
        if(request.readyState == 4) {
            if(request.status == 200){
                var achievementsWin = JSON.parse(request.responseText);
                getAchievementToHTML(achievementsWin);
            }
        }
    }

    request.open('GET', url, true);
    request.send();
}

function getAchievementToHTML(achievementsWin){
    var container = document.getElementById('achievementDisplay');

    achievementsWin.forEach(function(achievement) {
        var p = document.createElement('p');
        p.innerHTML = `${achievement.nom_succes} ${achievement.description_succes} ${achievement.xp_donnee} ${achievement.goal}`;
        container.appendChild(p);
    })
}
