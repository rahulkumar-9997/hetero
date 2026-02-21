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
    /**adverse reaction form start */
    $(document).on('click', '#event_report_form', function(e) {
        e.preventDefault();
        $('#event_report_form_form').slideToggle();
        $('#adverse_reaction_form')[0].reset();           
    });
        
    $('#add_more').click(function() {
        var newMedItem = createMedicationItem();
        $('#other_meds_container').append(newMedItem);
        $('html, body').animate({
            scrollTop: $('#other_meds_container .other_med_item:last').offset().top - 100
        }, 500);
    });
    $(document).on('click', '.remove_med', function() {
        if ($('.other_med_item').length > 1) {
            $(this).closest('.other_med_item').remove();
        }
    });
    
    $(document).on('click', '.cancel_reaction_form', function() {
        $('#event_report_form_form').slideUp();
    });
    // document.addEventListener('DOMContentLoaded', function() {
    //     const farmakonadzorSlug = 'farmakonadzor';
    //     const currentSlug = "{{ $page->slug }}";
    //     if (currentSlug === farmakonadzorSlug) {
    //         document.getElementById('farma').style.display = 'block';
    //     }
    // });

    $(document).off('submit', '#adverse_reaction_form').on('submit', '#adverse_reaction_form', function(event) {
        event.preventDefault();        
        var form = $(this);
        var submitButton = form.find('button[type="submit"]');
        var originalButtonText = submitButton.html();
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Отправка...');
        var formData = new FormData(this);
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                submitButton.prop('disabled', false).html(originalButtonText);                
                if (response.status === 'success') {
                    form[0].reset();
                    showNotificationAll(response.message || 'Форма успешно отправлена! Письмо отправлено на указанный email.', 'success');
                    $('#adverse_reaction_form').slideUp(400, function() {
                        $('#adverse_reaction_form').data('hidden', true);
                    });
                    
                }
            },
            error: function(xhr) {
                submitButton.prop('disabled', false).html(originalButtonText);
                var errors = xhr.responseJSON?.errors;
                var message = xhr.responseJSON?.message || 'Что-то пошло не так. Пожалуйста, попробуйте позже.';
                if (errors) {
                    $.each(errors, function(key, value) {
                        var inputField = $('[name="' + key + '"]');
                        inputField.addClass('is-invalid');
                        if (inputField.is('select')) {
                            inputField.parent().append('<div class="invalid-feedback">' + value[0] + '</div>');
                        } else if (inputField.is('textarea')) {
                            inputField.after('<div class="invalid-feedback">' + value[0] + '</div>');
                        } else {
                            inputField.after('<div class="invalid-feedback">' + value[0] + '</div>');
                        }
                    });                    
                    showNotificationAll('Пожалуйста, исправьте ошибки в форме', 'warning');
                } else {
                    showNotificationAll(message, 'error');
                }
                console.error('Form submission error:', xhr.responseJSON);
            }
        });
    });
    /**adverse reaction form start */

});
function createMedicationItem() {
    return `
    <div class="other_med_item">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Наименование ЛС (торговое):</label>
                <input type="text" class="form-control" name="omt_name[]" value="">
            </div>
            <div class="form-group col-md-6">
                <label>Номер серии:</label>
                <input type="text" class="form-control" name="omt_serial[]" value="">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Производитель:</label>
                <input type="text" class="form-control" name="omt_manufacturer[]" value="">
            </div>
            <div class="form-group col-md-6">
                <label>Доза, путь введения:</label>
                <input type="text" class="form-control" name="omt_dose[]" value="">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Дата начала приема:</label>
                <input type="text" class="form-control" name="omt_date_start[]" value="">
            </div>
            <div class="form-group col-md-6">
                <label>Дата прекращения приема:</label>
                <input type="text" class="form-control" name="omt_date_end[]" value="">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col">
                <button type="button" class="btn btn-sm btn-danger remove_med">Удалить препарат</button>
            </div>
        </div>
    </div>
    `;
}

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

