$(function() {
    $('#reload_captcha').click(function(){
        $('img').attr('src', '../Presentation/captcha/captcha.php?cache=' + new Date().getTime());
    });
});
