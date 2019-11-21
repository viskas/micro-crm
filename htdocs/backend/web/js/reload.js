$(document).on('ready pjax:success', function(){

    $("#search").on("pjax:end", function() {
        $.pjax.reload({container:"#grid"});
    });

});