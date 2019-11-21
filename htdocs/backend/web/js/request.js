jQuery(function($){

    $(document).on('submit', 'form#message-form', function(e){
        e.preventDefault();
        var request_id = $('#request_id').val();

        $.ajax({
            url: '/admin/request/chat?request_id=' + request_id,
            type: 'post',
            data: $('#message-request').serialize(),
            success: function (response) {
                $('.modal-content').html(response);
            }
        });
    });

    $(document).on('click', '.delete-message', function (e) {
       e.preventDefault();
       var id = $('.delete-message').data('id');
       var request_id = $('#request_id').val();

       $.ajax({
           url: '/admin/request/delete-message?id=' + id + '&request_id=' + request_id,
           success: function (response) {
               $('.modal-content').html(response);
           }
       });
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

    $(".promo-code").change(function() {
        var user_id = $(this).attr('data-key');
        var id = $(this).val();

        $.ajax({
            url: 'change-user-promo?id=' + id + '&user_id=' + user_id,
            success: function (response) {
                if (response == 1) {
                    setAlert('success');
                } else {
                    setAlert('error');
                }
            }
        });
    });

    //Смена статуса документам
    $(".status").change(function() {
        var document_id = $(this).attr('data-key');
        var status      = $(this).val();

        $.ajax({
            url: 'document-status?document_id=' + document_id + '&status=' + status,
            success: function (response) {
                if (response == 1) {
                    setAlert('success');
                } else {
                    setAlert('error');
                }
            }
        });
    });

    //Метод оплаты (смена статуса)
    $(document).on('click', '.default-check', function(){
        var key = $(this).attr('data-key');

        $.ajax({
            url: 'status?id=' + key,
            success: function (response) {
                if (response == 1) {
                    setAlert('success');
                } else {
                    setAlert('error');
                }
            }
        });
    });

    //Метод оплаты (смена привилегии)
    $(document).on('blur', '.input-privilege', function(){
        var key = $(this).attr('data-key');
        var sort = $(this).val();

        $.ajax({
            url: 'privilege?id=' + key + '&sort=' + sort,
            success: function (response) {
                if (response == 1) {
                    setAlert('success');
                }
            }
        });
    });

    //Смена главного промо кода
    $(".group-radio").change(function() {
        var id = $(this).val();

        $.ajax({
            url: 'main-promo?id=' + id,
            success: function (response) {
                if (response == 1) {
                    setAlert('success');
                } else {
                    setAlert('error');
                }
            }
        });
    });

    $(document).on('change', '.order-balance-select', function(){
        var id = $(this).attr('data-key');

        $.ajax({
            url: 'status?id=' + id + '&val=' + $(this).val(),
            success: function (response) {
                if (response == 1) {
                    setAlert('success');
                } else {
                    setAlert('error');
                }
            }
        });
    });

    $(document).on('click', '.modal-client', function(){
        $('#client-modal').modal('show')
            .find('#modalClientContent')
            .load($(this).attr('value'));
    });

    $(document).on('click', '.modal-client-pass', function(){
        $('#client-modal').modal('show')
            .find('#modalClientContent')
            .load($(this).attr('value'));
    });

    $(document).on('click', '.modal-bill', function(){
        $('#client-bill').modal('show')
            .find('#modalBillContent')
            .load($(this).attr('value'));
    });

    $(document).on('click', '.modal-bill-deposit', function(){
        $('#client-bill-deposit').modal('show')
            .find('#modalBillDepositContent')
            .load($(this).attr('value'));
    });

    $(document).on('click', '.modal-bill-operation', function(){
        $('#client-bill-operation').modal('show')
            .find('#modalBillOperationContent')
            .load($(this).attr('value'));
    });

    function setAlert(type) {
        if(type == 'success') {
            $(".c-success").removeClass("hide");
             setTimeout(function() {
               $(".c-success").addClass("hide");
             }, 1500);
        } else if(type == 'error') {
            $(".sa-error").removeClass("hide");
             setTimeout(function() {
               $(".sa-error").addClass("hide");
             }, 1500);
        }
    }

});
