<?php
		include "header.php";
	?>
		<title>Page membre</title>
	</head>
	<body>
		<?php
	  		include "navBar.php";
		?>
		<?php echo "<div id='memberContainer' class='container-fluid' onload='getInfoMember(" . $_GET['pseudo'] . ")'>" ?>
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<h1 class="text-center">Page membre</h1>
				</div>
			</div>
			<div class="row">
                <div id="infoMember" class="col-md-4 col-md-offset-2">

                </div>

                <div id="imgMember" class="col-md-4 col-md-offset-1 text-center">

                </div>
			</div>
		<?php echo "</div>" ?>

		<?php
	  		include "footer.php";
		?>
		<script src="../global/functions.js"></script>
        <script>
            $( document ).ready(function() {
                var pseudo = "<?php echo $_GET['pseudo'] ?>";
                getInfoMember(pseudo);
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
                //console.log(results);

                for (var result in results) {
                    console.log(`results.${result} = ${results[result]}`);
                    if (`${results[result]}`) {
                        var p = document.createElement('p');
                        p.innerHTML = `${result}: ${results[result]}`;
                        container.appendChild(p);
                    }
                }
            }
        </script>
	</body>
</html>
