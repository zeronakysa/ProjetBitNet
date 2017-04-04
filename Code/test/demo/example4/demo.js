$(function() {
    $('input.demo4')
            .keyChange()
            .bind('keyChange',
                    function(evt, text) {
                        $('span.res4').html(text);
                    }
            )
            .bind('keyChange',
                    function(evt, text) {
                        var nb = $('span.cpt4').html();
                        $('span.cpt4').html(parseInt(nb) + 1);
                    }
            );
});