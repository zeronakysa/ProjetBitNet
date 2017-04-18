$(function() {
    $('input.demo2').keyChange({
        minLength: 3,
        delay: 1000
    }, function(evt, text) {
        $('span.demo2').html(text);
    });
});