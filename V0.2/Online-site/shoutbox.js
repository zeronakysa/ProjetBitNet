// Script sendMsg() ShoutBox
function sendMsg(){
    var pseudo = document.getElementById('pseudo').value;
    var msg = document.getElementById('msg').value;

    if(msg.length <= 0){
        alert('Votre message est vide');
    } else {
        var postData = "pseudo="+pseudo+"&msg="+msg;

        // Création d'un objet
        if(window.XMLHttpRequest){
            var request = new XMLHttpRequest;
        } else if(window.ActiveXObject){
            var request = new ActiveXObject('Microsoft.XMLHTTP');
        }
        // Si objet XMLHttpRequest indisponible
        if(!request){
            reject({
                statusCode: 501,
                statusText: 'Not implemented',
                body: undefined
            });
            return;
        }

        var url = 'shoutboxSendData.php';
        var container = document.getElementById('msg_container');

        request.onreadystatechange = function(){
            if(request.readyState == 4){
                if(request.status == 200){
                    container.innerHTML = request.responseText;
                }
            }
        }

        request.open('POST', url, true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request.send(postData);
    }
}
