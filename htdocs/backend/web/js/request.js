jQuery(function($){
    $('.call-checkbox').on('change', function () {
        var id = $(this).val();

        $.ajax({
            url: '/admin/client/call-status',
            type: 'post',
            data: {"id": id},
            success: function (response) {}
        });

        return false;
    });

    $('#qr-auth').click(function() {
        if ($(this).is(':checked')) {
            var html = '';
            $.ajax({
                url: 'qr-code',
                type: 'post',
                success: function (response) {
                    response = $.parseJSON(response);
                    html = response.data.img +
                        '<br><br>Запомните секретный ключ: <b>' + response.data.secret + '</b>';

                    $('#qr-check').hide();
                    $('#qr-block').html(html);
                }
            });
        }
    });

    $('#qr-auth-disable').click(function() {
        if ($(this).is(':checked')) {
            $('#qr-check-disable').hide();
            $('#qr-auth-form').show();
        }
    });
});
