document.querySelectorAll('.ckeditor4').forEach(function(el) {
    CKEDITOR.replace(el, {
        removePlugins: 'exportpdf',
        allowedContent: true,
        extraAllowedContent: '*(*);*{*}',
        extraPlugins: 'uploadimage, sourcearea',
        filebrowserUploadUrl: window.CKEDITOR_ROUTES.upload,
        filebrowserImageUploadUrl: window.CKEDITOR_ROUTES.upload,
        filebrowserUploadMethod: 'form',
        imageUploadUrl: window.CKEDITOR_ROUTES.upload,
    });
});

CKEDITOR.on('dialogDefinition', function(ev) {
    if (ev.data.name === 'image') {
        var dialogDefinition = ev.data.definition;
        var infoTab = dialogDefinition.getContents('info');
        infoTab.elements.unshift({
            type: 'html',
            id: 'imageGallery',
            html: `
                <div style="margin-bottom: 20px; padding: 15px; background: #f5f5f5; border-radius: 5px;">
                    <h4 style="margin: 0 0 10px 0;">Image Gallery</h4>
                    <div id="simple-image-gallery" style="min-height: 100px; border: 1px dashed #ccc; padding: 10px; text-align: center;">
                        Loading images...
                    </div>
                </div>
            `
        });

        var originalOnShow = dialogDefinition.onShow;
        dialogDefinition.onShow = function() {
            if (originalOnShow) {
                originalOnShow.call(this);
            }
            setTimeout(loadSimpleGallery, 100);
        };
    }
});

function loadSimpleGallery() {
    var container = document.getElementById('simple-image-gallery');
    if (!container) return;

    container.innerHTML = 'Loading images...';

    fetch(window.CKEDITOR_ROUTES.imagelist)
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(images => {
            if (images && images.length > 0) {
                let html = '<div style="display: flex; flex-wrap: wrap; gap: 5px; justify-content: center;">';
                images.slice(0, 8).forEach(image => {
                    html += `
                        <img src="${image.url}" 
                             style="width: 60px; height: 45px; object-fit: cover; cursor: pointer; border: 2px solid transparent; border-radius: 3px;" 
                             onclick="setImageUrl('${image.url}')"
                             onmouseover="this.style.borderColor='#007bff'"
                             onmouseout="this.style.borderColor='transparent'"
                             title="${image.name}">
                    `;
                });
                html += '</div>';
                container.innerHTML = html;
            } else {
                container.innerHTML = '<div style="color: #666; padding: 20px;">No images found. Upload images using the Upload tab.</div>';
            }
        })
        .catch(error => {
            console.error('Error loading images:', error);
            container.innerHTML = '<div style="color: red; padding: 20px;">Error loading images. Please try again.</div>';
        });
}

function setImageUrl(url) {
    var dialog = CKEDITOR.dialog.getCurrent();
    if (dialog) {
        dialog.setValueOf('info', 'txtUrl', url);
        try {
            var preview = dialog.getContentElement('info', 'txtPreview');
            if (preview) {
                var previewElement = preview.getElement();
                var imgElement = previewElement.findOne('img');
                if (imgElement) {
                    imgElement.setAttribute('src', url);
                }
            }
        } catch (e) {}
    }
}
