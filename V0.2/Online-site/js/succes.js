$( document ).ready(function() {
    getAchievement();
});

// Ajax function to get Achievement suceed
function getAchievement(){
    var request = newXMLHttpRequest();
    var url = 'services/achievementReceiveData.php';

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

    var achievements = achievementsWin.map(formatAchievementToHtml);

    achievements.forEach(function(achievement){
        container.appendChild(achievement);
    });
}


function formatAchievementToHtml(achievement){

    if(achievement.progression == achievement.goal){

        var div = document.createElement('div');
        var img = document.createElement('img');

        div.id = 'id_achievement_succeed_'+achievement.ID_succes;
        img.setAttribute('src',`css/img/achievement/${achievement.ID_succes}w.png`);
        // img.setAttribute('class', 'img-responsive')

        var p = document.createElement('p');
        p.innerHTML =   `${achievement.nom_succes}
                        </br> ${achievement.description_succes}
                        </br> Expérience : ${achievement.xp_donnee} XP`;

        div.appendChild(img);
        div.appendChild(p);

    } else if(achievement.progression < achievement.goal){

        var div = document.createElement('div');
        var img = document.createElement('img');

        div.id = 'id_achievement_inprogress_'+achievement.ID_succes;
        img.setAttribute('src',`css/img/achievement/${achievement.ID_succes}.png`);

        var p = document.createElement('p');
        p.innerHTML =   `${achievement.nom_succes} </br>
                            ${achievement.description_succes} </br>
                            Expérience : ${achievement.xp_donnee} XP`;

        // Progress Bar
        var progressBar = document.createElement('div');
        var bar = document.createElement('div');

        progressBar.id = 'myProgressBar';
        bar.id = 'myBar';

        progressBar.appendChild(bar);

        progressBar.onclick = function(){
            var elem = document.getElementById('myBar');
            var width = 0;
            var id = setInterval(frame, 25);

            function frame(){
                if(width >= achievement.progression){
                    clearInterval(id);
                } else {
                    width++;
                    elem.style.width = (width * 100) / achievement.goal + '%';
                    elem.innerHTML = width +`/${achievement.goal}`;
                }
            }
        }

        div.appendChild(img);
        div.appendChild(p);
        div.appendChild(progressBar);
    }

    return div;
}
