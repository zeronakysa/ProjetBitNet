$( document ).ready(function() {
    getAchievement();
});

// ------------- Live Search ------------- //
function showResult(str){

    if(str.length == 0){
        document.getElementById('achievementSearchResult').innerHTML = '';
        return;
    }

    var request = newXMLHttpRequest();

    request.onreadystatechange = function(){
        if(request.readyState == 4){
            if(request.status == 200){
                var achievementsResult = JSON.parse(request.responseText);
                achievementResultToHtml(achievementsResult);
            }
        }
    };

    request.open('GET', 'services/achievementSearch.php?query='+str);
    request.send();
}

function achievementResultToHtml(achievementsResult){
    var container = document.getElementById('achievementSearchResult');
    container.innerHTML = '';

    var achievementsTags = achievementsResult.map(formatAchievementsResultToHtml);

    achievementsTags.forEach(function(achievementTag){
        container.appendChild(achievementTag);
    });
}

function formatAchievementsResultToHtml(achievementResult) {

    var div = document.createElement('div');
    var img = document.createElement('img');
    var p = document.createElement('p');

    div.id = 'id_achievement_searchResult_'+achievementResult.ID_succes;
    img.setAttribute('src',`css/img/achievement/${achievementResult.ID_succes}.png`);

    p.innerHTML =   `${achievementResult.nom_succes}
                    </br> ${achievementResult.description_succes}
                    </br> Expérience : ${achievementResult.xp_donnee} XP`;

    div.appendChild(img);
    div.appendChild(p);

    return div;
}


// ------------- GetAchievement ------------- //
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

        div.setAttribute('class', 'achievement_succeed');
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

        div.setAttribute('class', 'achievement_inprogress');
        img.setAttribute('src',`css/img/achievement/${achievement.ID_succes}.png`);

        var p = document.createElement('p');
        p.innerHTML =   `${achievement.nom_succes} </br>
                            ${achievement.description_succes} </br>
                            Expérience : ${achievement.xp_donnee} XP`;

        // Progress Bar
        var progressBar = document.createElement('div');
        var bar = document.createElement('div');

        progressBar.setAttribute('class','myProgressBar');
        progressBar.setAttribute('onmouseover',`showProgress(this, ${achievement.progression}, ${achievement.goal})`);
        progressBar.setAttribute('onmouseleave', 'hideProgress(this)');
        bar.setAttribute('class','myBar');
        progressBar.appendChild(bar);

        div.appendChild(img);
        div.appendChild(p);
        div.appendChild(progressBar);
    }

    return div;
}

function showProgress(elem, prog, goal){
    var elem = elem.childNodes[0];
    var width = 0;
    var id = setInterval(frame, 25);

    function frame(){
        if(width >= prog){
            clearInterval(id);
        } else {
            width++;
            elem.style.width = (width * 100) / goal + '%';
            elem.innerHTML = width +'/'+goal;
        }
    }
}

function hideProgress(elem) {
    var elem = elem.childNodes[0];
    elem.style.width = 0;
    elem.innerHTML = '';
}
