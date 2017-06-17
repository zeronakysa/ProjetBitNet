$( document ).ready(function() {
    getAchievement();
});

// Ajax function to get Achievement suceed
function getAchievement(){
    var request = newXMLHttpRequest();
    var url = 'achievementReceiveData.php';

    request.onreadystatechange = function(){
        if(request.readyState == 4) {
            if(request.status == 200){
                var achievementsWin = JSON.parse(request.responseText);
                getAchievementToHTML(achievementsWin);
                // console.log(achievementsWin);
            }
        }
    };

    request.open('GET', url, true);
    request.send();
}

function getAchievementToHTML(achievementsWin){
    var container = document.getElementById('achievementDisplay');

    achievementsWin.forEach(function(achievement) {

        var div = document.createElement('div');
        var img = document.createElement('img');
        img.setAttribute('src',`css/img/achievement/${achievement.ID_succes}w.png`);
        // img.setAttribute('class', 'img-responsive')

        var p = document.createElement('p');
        p.innerHTML =   `${achievement.nom_succes}
                        </br> ${achievement.description_succes}
                        </br> Expériences : ${achievement.xp_donnee} XP`;

        div.appendChild(img);
        div.appendChild(p);
        container.appendChild(div);
    });
}
