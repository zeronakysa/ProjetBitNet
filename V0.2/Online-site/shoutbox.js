
// Keep Scroll At Bottom
function updateScroll(){
    var scroll = document.getElementById('msg_container');
    scroll.scrollTop = scroll.scrollHeight;
}

// Send on Enter Key
var input = document.getElementById('msg');
var button = document.getElementById('sendButton');

function inputOnEnter(event){
    if(event.keyCode == 13) {
        button.click();
    }
}

input.addEventListener("keyup", inputOnEnter);


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
                    // container.innerHTML = request.responseText;
                }
            }
        }

        request.open('POST', url, true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request.send(postData);
    }

    document.getElementById('msg').value = '';
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

    updateScroll();
}

setInterval(displayMsg, 1000);
