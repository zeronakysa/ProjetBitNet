// Script sendMsg() ShoutBox
function sendMsg(){
    var msg = document.getElementById('msg').value;

    if(msg.length <= 0){
        alert('Votre message est vide');
    } else {
        var postData = "msg="+msg;

        var request = newXMLHttpRequest();

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

function displayMsg(){

    var request = newXMLHttpRequest();
    var container = document.getElementById('msg_container');
    var url = 'shoutboxReceiveData.php';

    request.onreadystatechange = function(){
        if(request.readyState == 4){
            if(request.status == 200){
                container.innerHTML = request.responseText;
            }
        }
    }
    request.open('GET', url, true);
    request.send();
}

setInterval(displayMsg, 1000);
