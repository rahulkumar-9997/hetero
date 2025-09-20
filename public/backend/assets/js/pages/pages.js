
$(function () {  
    $(document).off('submit', '#createPageForm').on('submit', '#createPageForm', function(event) {
        event.preventDefault();
        var form = $(this);
        var submitButton = form.find('button[type="submit"]');
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        submitButton.prop('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...'
        );
        var formData = new FormData(this);
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                submitButton.prop('disabled', false).html('Submit');
                if (response.status === 'success') {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        className: "bg-success",
                        close: true
                    }).showToast();
                    setTimeout(function() {
                        window.location.href = response.redirect_url;
                    }, 300);
                }
            },
            error: function(xhr) {
                submitButton.prop('disabled', false).html('Submit');
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    if (errors) {
                        let firstErrorField = null;                        
                        $.each(errors, function(key, value) {
                            var inputField = form.find('[name="' + key + '"]');
                            inputField.addClass('is-invalid');
                            var formGroup = inputField.closest('.form-group');
                            if (formGroup.length === 0) {
                                formGroup = inputField.closest('.mb-3');
                            }                            
                            if (formGroup.length > 0) {
                                formGroup.append('<div class="invalid-feedback d-block">' + value[0] + '</div>');
                            } else {
                                inputField.after('<div class="invalid-feedback d-block">' + value[0] + '</div>');
                            }                            
                            if (!firstErrorField) {
                                firstErrorField = inputField;
                            }
                        });                        
                        if (firstErrorField) {
                            $('html, body').animate({
                                scrollTop: firstErrorField.offset().top - 100
                            }, 500);
                            firstErrorField.focus();
                        }
                    }
                } else if (xhr.status === 500) {
                    Toastify({
                        text: xhr.responseJSON?.message || 'An unexpected error occurred. Please try again.',
                        duration: 10000,
                        gravity: "top",
                        position: "right",
                        className: "bg-danger",
                        close: true
                    }).showToast();
                } else {
                    Toastify({
                        text: xhr.responseJSON?.message || 'An error occurred. Please try again.',
                        duration: 10000,
                        gravity: "top",
                        position: "right",
                        className: "bg-danger",
                        close: true
                    }).showToast();
                }
            }
        });
    });

    $(document).off('submit', '#editPageForm').on('submit', '#editPageForm', function (event) {
        event.preventDefault();
        var form = $(this);
        var submitButton = form.find('button[type="submit"]');
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        submitButton.prop('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...'
        );        
        var formData = new FormData(this);
        formData.append('_method', 'PUT');
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                submitButton.prop('disabled', false).html('Update');                
                if (response.status === 'success') {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        className: "bg-success",
                        close: true
                    }).showToast();                    
                    setTimeout(function () {
                        window.location.href = response.redirect_url;
                    }, 300);
                }
            },
            error: function (xhr) {
                submitButton.prop('disabled', false).html('Update');
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    if (errors) {
                        let firstErrorField = null;                        
                        $.each(errors, function (key, value) {
                            var inputField = form.find('[name="' + key + '"]');
                            inputField.addClass('is-invalid');
                            var formGroup = inputField.closest('.form-group');
                            if (formGroup.length === 0) {
                                formGroup = inputField.closest('.mb-3');
                            }                            
                            if (formGroup.length > 0) {
                                formGroup.append('<div class="invalid-feedback d-block">' + value[0] + '</div>');
                            } else {
                                inputField.after('<div class="invalid-feedback d-block">' + value[0] + '</div>');
                            }                            
                            if (!firstErrorField) {
                                firstErrorField = inputField;
                            }
                        });                        
                        if (firstErrorField) {
                            $('html, body').animate({
                                scrollTop: firstErrorField.offset().top - 100
                            }, 500);
                            firstErrorField.focus();
                        }
                    }
                } else if (xhr.status === 500) {
                    Toastify({
                        text: xhr.responseJSON?.message || 'An unexpected error occurred. Please try again.',
                        duration: 10000,
                        gravity: "top",
                        position: "right",
                        className: "bg-danger",
                        close: true
                    }).showToast();
                } else {
                    Toastify({
                        text: xhr.responseJSON?.message || 'An error occurred. Please try again.',
                        duration: 10000,
                        gravity: "top",
                        position: "right",
                        className: "bg-danger",
                        close: true
                    }).showToast();
                }
            }
        });
    });  
    
});