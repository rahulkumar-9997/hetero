$(document).ready(function () {
    $(document).on('click', 'a[data-medicine-category-add="true"]', function () {
        var title = $(this).data('title');
        var size = ($(this).data('size') == '') ? 'md' : $(this).data('size');
        var action = ($(this).data('action') == '') ? '' : $(this).data('action');
        var url = $(this).data('url');
        var data = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            size: size,
            url: url,
            action: action
        };
        $("#commanModel .modal-title").html(title);
        $("#commanModel .modal-dialog").addClass('modal-' + size);

        $.ajax({
            url: url,
            type: 'get',
            data: data,
            success: function (data) {
                $('#commanModel .render-data').html(data.form);
                // $('.editor_class_multiple').summernote('destroy');
                $("#commanModel").modal('show');
                $('#commanModel').on('shown.bs.modal', function () {
                    document.querySelectorAll('.ckeditor4').forEach(function (el) {
                        if (CKEDITOR.instances[el.id]) {
                            CKEDITOR.instances[el.id].destroy(true);
                        }
                        CKEDITOR.replace(el, {
                            removePlugins: 'exportpdf'
                        });
                    });

                    // unbind so it doesn’t trigger multiple times
                    $(this).off('shown.bs.modal');
                });
            },
            error: function (data) {
                data = data.responseJSON;
            }
        });
    });
    $(document).off('submit', '#medicineCategoryAddForm').on('submit', '#medicineCategoryAddForm', function (event) {
        event.preventDefault();
        var form = $(this);
        var submitButton = form.find('button[type="submit"]');
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
        var formData = new FormData(this);
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                submitButton.prop('disabled', false);
                submitButton.html('Save changes');
                if (response.status === 'success') {
                    if (response.action == 'select') {
                        var select = $('#medicine_category');
                        select.append($('<option>', {
                            value: response.category.id,
                            text: response.category.title,
                            selected: true
                        }));
                    }
                    else {
                        $('.display-medicine-category').html(response.medicineCategoryData);
                        feather.replace();
                    }
                    form[0].reset();
                    $('#commanModel').modal('hide');
                    Toastify({
                        text: response.message,
                        duration: 10000,
                        gravity: "top",
                        position: "right",
                        className: "bg-success",
                        escapeMarkup: false,
                        close: true,
                        onClick: function () { }
                    }).showToast();
                }
            },
            error: function (xhr, status, error) {
                submitButton.prop('disabled', false);
                submitButton.html('Save changes');
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    $.each(errors, function (key, value) {
                        var errorElement = $('#' + key + '_error');
                        if (errorElement.length) {
                            errorElement.text(value[0]);
                        }
                        var inputField = $('#' + key);
                        inputField.addClass('is-invalid');
                        inputField.after('<div class="invalid-feedback">' + value[0] + '</div>');
                    });
                }
            }
        });
    });

    /**Edit group modal js */
    $(document).on('click', 'a[data-medicine-category-edit="true"]', function () {
        var title = $(this).data('title');
        var size = ($(this).data('size') == '') ? 'md' : $(this).data('size');
        var url = $(this).data('url');
        var awcateid = $(this).data('awcateid');
        var data = {
            awcateid: awcateid,
        };
        $("#commanModel .modal-title").html(title);
        $("#commanModel .modal-dialog").addClass('modal-' + size);

        $.ajax({
            url: url,
            type: 'get',
            data: data,
            success: function (data) {
                $('#commanModel .render-data').html(data.form);
                $('#commanModel').on('shown.bs.modal', function () {
                    document.querySelectorAll('.ckeditor4').forEach(function (el) {
                        if (CKEDITOR.instances[el.id]) {
                            CKEDITOR.instances[el.id].destroy(true);
                        }
                        CKEDITOR.replace(el, {
                            removePlugins: 'exportpdf'
                        });
                    });
                    $(this).off('shown.bs.modal');
                });
                $("#commanModel").modal('show');
            },
            error: function (data) {
                data = data.responseJSON;
            }
        });
    });
    /**Edit group modal js */
    $(document).off('submit', '#medicineCategoryEditForm').on('submit', '#medicineCategoryEditForm', function (event) {
        event.preventDefault();
        var form = $(this);
        var submitButton = form.find('button[type="submit"]');
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
        var formData = new FormData(this);
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                submitButton.prop('disabled', false);
                submitButton.html('Save changes');
                if (response.status === 'success') {
                    form[0].reset();
                    $('#commanModel').modal('hide');
                    $('.display-medicine-category').html(response.medicineCategoryData);
                    feather.replace();
                    Toastify({
                        text: response.message,
                        duration: 10000,
                        gravity: "top",
                        position: "right",
                        className: "bg-success",
                        escapeMarkup: false,
                        close: true,
                        onClick: function () { }
                    }).showToast();
                }
            },
            error: function (xhr, status, error) {
                submitButton.prop('disabled', false);
                submitButton.html('Save changes');
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    $.each(errors, function (key, value) {
                        var errorElement = $('#' + key + '_error');
                        if (errorElement.length) {
                            errorElement.text(value[0]);
                        }
                        var inputField = $('#' + key);
                        inputField.addClass('is-invalid');
                        inputField.after('<div class="invalid-feedback">' + value[0] + '</div>');
                    });
                }
            }
        });
    });
    /**Delete whatsapp conversation */
    $(document).on('click', '.show_confirm', function (event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();

        Swal.fire({
            title: `Are you sure you want to delete this ${name}?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
            dangerMode: true,
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

});

function initSummernoteEditor() {
    $('.editor_class_multiple').each(function () {
        if (!$(this).hasClass('note-editor') && !$(this).siblings('.note-editor').length) {
            $(this).summernote({
                height: 150,
                minHeight: null,
                maxHeight: null,
                focus: false,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                prettifyHtml: true,
                codeviewFilter: true,
                codeviewIframeFilter: true,
                styleTags: ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
                callbacks: {
                    onPaste: function (e) {
                        var clipboardData = e.originalEvent.clipboardData || window.clipboardData;
                        var pastedData = clipboardData.getData('Text/html');
                        if (pastedData) {
                            e.preventDefault();
                            var tempDiv = document.createElement('div');
                            tempDiv.innerHTML = pastedData;
                            var elementsWithStyle = tempDiv.querySelectorAll('[style]');
                            elementsWithStyle.forEach(function (el) {
                                el.removeAttribute('style');
                            });
                            var elementsWithClass = tempDiv.querySelectorAll('[class]');
                            elementsWithClass.forEach(function (el) {
                                el.removeAttribute('class');
                            });
                            document.execCommand('insertHTML', false, tempDiv.innerHTML);
                        }
                    }
                }
            });
        }
    });
}
