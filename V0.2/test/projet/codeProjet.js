function execPost(){
  var request = new XMLHttpRequest();
  request.onreadystatechange = function() {
    if(request.readyState == 4) {
      if(request.status == 200) {
        console.log('Oui !');
      } else {
        console.log('non !');
      }
    }
  }
  request.open('POST','phpProjet.php');
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
};
