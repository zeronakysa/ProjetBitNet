$(function() {
    $(document).keyChange('input.demo3', function(evt, text) {
        $(this).next('span.res3').html(text);
    });
});