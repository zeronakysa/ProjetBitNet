<!-- Footer -->
<footer id="contact" class="bitnet-footer">
    <div class="container-fluid">
        <div class="row footer-main">
            <div class="col-md-4 contact">
                <h4>Nous contacter</h4>
                <form action="mailto:stevencantagrel.contact@gmail.com" method="POST">
                </form>
            </div>
        </div>
        <div class="row footer-rights">
            <div class="text-center">
                <p>© Bitnet, 2017 - Tous droits réservés</p>
            </div>
        </div>
    </div>

</footer>


<!-- Bootstrap Jquery Link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Bootstrap JavaScript Link -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Script Reload Captcha -->
<script type="text/javascript">
    $(function() {
        $('#reload_captcha').click(function(){
            $('img').attr('src', 'captcha/captcha.php?cache=' + new Date().getTime());
        });
    });
</script>
</body>
</html>
