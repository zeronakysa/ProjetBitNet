<?php
		include "header.php";
	?>
		<title>Page membre</title>
	</head>
	<body>
		<?php
	  		include "navBar.php";
		?>
		<div id='memberContainer' class='container-fluid')>
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<h1 class="text-center">Page membre</h1>
				</div>
			</div>
			<div id="displayMember" class="row">
                <div id="infoMember" class="col-md-4 col-md-offset-2">

                </div>

                <div id="displayImgMember" class="col-md-4 text-center">
					<img id="imgMember" height="500" width="500"/>
                </div>
			</div>
		</div>

		<?php
	  		include "footer.php";
		?>
		<script src="../global/functions.js"></script>
        <script>
            $( document ).ready(function() {
                var pseudo = "<?php echo $_GET['pseudo'] ?>";
                getInfoMember(pseudo);
				getImgMember(pseudo);
            });

            function getInfoMember(pseudo){
                var request = newXMLHttpRequest();

                request.onreadystatechange = function(){
                    if(request.readyState == 4) {
                        if(request.status == 200){
                            var results = JSON.parse(request.responseText);
                            infoMemberToHtml(results);
                        }
                    }
                };

                request.open('GET', 'services/getInfoMember.php?pseudo=' + pseudo);
                request.send();
            }

            function infoMemberToHtml(results) {
                var container = document.getElementById('infoMember');

                for (var result in results) {
                    if (`${results[result]}`) {
                        var p = document.createElement('p');
                        p.innerHTML = `${result}: ${results[result]}`;
                        container.appendChild(p);
                    }
                }
            }

			function getImgMember(pseudo) {
				var request = newXMLHttpRequest();

                request.onreadystatechange = function(){
                    if(request.readyState == 4) {
                        if(request.status == 200){
                            var result = JSON.parse(request.responseText);
                            imgMemberToHtml(result);
                        }
                    }
                };

                request.open('GET', 'services/getImgMember.php?pseudo=' + pseudo);
                request.send();
			}

			function imgMemberToHtml(result) {
				var container = document.getElementById('displayImgMember')
				var img = document.getElementById('imgMember');

				img.src = result.profile_picture;

				container.appendChild(img);
			}
        </script>
	</body>
</html>
