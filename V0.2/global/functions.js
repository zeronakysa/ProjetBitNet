//Script refresh captcha
$(function() {
    $('#reload_captcha').click(function(){
        $('#captcha').attr('src', '../Presentation/captcha/captcha.php?cache=' + new Date().getTime());
    });
});

// Tooltip script
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
