$(document).ready(function () {
    $(document).off('submit', '#contactForm').on('submit', '#contactForm', function (event) {
        event.preventDefault();
        var form = $(this);
        var submitButton = form.find('button[type="submit"]');
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...');
        var formData = new FormData(this);
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                submitButton.prop('disabled', false).html('Submit');
                if (response.status === 'success') {
                    form[0].reset();
                    showNotificationAll(response.message, 'success');
                }
            },
            error: function (xhr) {
                submitButton.prop('disabled', false).html('Submit');
                var errors = xhr.responseJSON?.errors;
                if (errors) {
                    $.each(errors, function (key, value) {
                        var inputField = $('#' + key);
                        inputField.addClass('is-invalid');
                        inputField.after('<div class="invalid-feedback">' + value[0] + '</div>');
                    });
                    showNotificationAll('Please fill required field', 'warning');
                } else {
                    showNotificationAll('Something went wrong. Please try again later.', 'error');
                }
            }
        });
    });
});

function showNotificationAll(message, type = 'success') {
    var $toast = $('#liveToast');
    var $toastBody = $toast.find('.toast-body');
    $toastBody.text(message);
    $toast.removeClass('bg-success bg-danger bg-warning bg-info text-white text-dark');
    switch (type) {
        case 'success':
            $toast.addClass('bg-success text-white');
            break;
        case 'error':
            $toast.addClass('bg-danger text-white');
            break;
        case 'warning':
            $toast.addClass('bg-warning text-dark');
            break;
        case 'info':
            $toast.addClass('bg-info text-white');
            break;
    }
    $toast.toast({ delay: 3000 });
    $toast.toast('show');
}

