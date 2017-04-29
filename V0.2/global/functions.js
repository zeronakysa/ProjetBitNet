$(function() {
    $('#reload_captcha').click(function(){
        $('img').attr('src', 'captcha/captcha.php?cache=' + new Date().getTime());
    });
});
