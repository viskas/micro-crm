$(document).ready(function () {
    backend_connect();
});

$(document).on('pjax:success', function() {
    backend_connect();
});

function backend_connect() {

    $('.group_languages').on('change', function() {
        var id = $(this).val();

        $.ajax({
            url: '/admin/languages/change-main?id=' + id,
            type: 'post',
            success: function (response) {}
        });
    });

    $('.group_promo').on('change', function () {
        var id = $(this).val();

        $.ajax({
            url: '/admin/promo-code/change-main?id=' + id,
            type: 'post',
            success: function (response) {}
        });
    });

    $('#date-picker').on('change', function(event) {
        event.preventDefault();
        $('#client-send').click();
    });

    $('#code-select').on('change', function(event) {
        event.preventDefault();
        $('#client-send').click();
    });
    
    $('#client-clear').on('click', function(event) {
        event.preventDefault();
        window.location.href = window.location.origin + window.location.pathname; 
    });

    $('#ac-basic').on('blur', function(event) {
        event.preventDefault();
        $('#client-form').submit();
    });

};