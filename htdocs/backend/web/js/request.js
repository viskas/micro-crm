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

    $('.main-call-complete').on('change', function (e) {
        if (confirm('Вы точно хотите отметить звонок как выполненный?')) {
            var id = $(this).val();

            $.ajax({
                url: '/admin/client/call-status',
                type: 'post',
                data: {"id": id},
                success: function (response) {
                    if (response == 1) {
                        $('#call-' + id).hide();
                    }
                }
            });
        } else {
            this.checked = false;
        };
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

    setInterval(function() {
        noty();
    }, 30000);

    function noty() {
        $.ajax({
            url: '/admin/client/notification',
            type: 'get',
            global: false,
            success: function (response) {
                if (response == 1) {
                    if (!$('#modal-danger').hasClass('in')){
                        $('#danger-modal').click();
                    }
                }
            }
        });
    }
});