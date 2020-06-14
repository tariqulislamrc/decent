$('#content_form').parsley();
$(document).on('click', '.heart', function() {
    var id = $(this).data('id');
    var ip = '{{getIp()}}';
    var url = $(this).data('url');
    
    $(this).html('<i class="fa fa-heart" aria-hidden="true"></i>');
    
    $.ajax({
        type: 'GET',
        url: url,
        data: {
            id: id, ip: ip
        },
        beforeSend: function() {
            $(this).html(' <i class="fa fa-spinner fa-spin fa-fw"></i>');
        }, 
        success: function (data) {
            if(data.status == 'success') {
                toastr.success(data.message);
            }
            if(data.status == 'warning') {
                toastr.warning(data.message);
            }
        }
    });
})

$('#content_form').on('submit', function (e) {
    e.preventDefault();
    $('#submit').hide();
    $('#submiting').show();
    $(".ajax_error").remove();
    var submit_url = $('#content_form').attr('action');
    //Start Ajax
    var formData = new FormData($("#content_form")[0]);
    $.ajax({
        url: submit_url,
        type: 'POST',
        data: formData,
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        dataType: 'JSON',
        success: function (data) {
            if (data.status == 'danger') {
                toastr.error(data.message);
            } else {
                toastr.success(data.message);
                $('#cart_total').text(data.bdt + ' ' + data.cart_total);
                if (data.goto) {
                    setTimeout(function () {
                        window.location.href = data.goto;
                    }, 500);
                }
            }
        },
        error: function (data) {
            var jsonValue = $.parseJSON(data.responseText);
            const errors = jsonValue.errors;
            if (errors) {
                var i = 0;
                $.each(errors, function (key, value) {
                    const first_item = Object.keys(errors)[i]
                    const message = errors[first_item][0];
                    if ($('#' + first_item).length > 0) {
                        $('#' + first_item).parsley().removeError('required', {
                            updateClass: true
                        });
                        $('#' + first_item).parsley().addError('required', {
                            message: value,
                            updateClass: true
                        });
                    }
                    // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                    toastr.error(value);
                    i++;
                });
            } else {
                toastr.warning(jsonValue.message);

            }
        }
    });
});