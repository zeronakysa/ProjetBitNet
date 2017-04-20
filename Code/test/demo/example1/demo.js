$(function() {
    $('input.demo1').keyChange(function(evt, text) {
        $('span.demo1').html(text);
    });
});