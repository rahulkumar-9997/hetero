$(document).ready(function() {
    function loadMedicinesByCategory(categoryId) {
        var tabContent = $(".medicine-list-catewise");
        
        $.ajax({
            url: medicineCategoryUrl,
            type: "GET",
            data: { id: categoryId },
            beforeSend: function() {
                tabContent.html('<p>Loading...</p>');
            },
            success: function(response) {
                if (response.html) {
                    tabContent.html(response.html);
                    new WOW().init();
                } 
            },
            error: function(xhr) {
                console.error("AJAX Error:", xhr.responseText);
                tabContent.html('<div class="alert alert-danger">Error loading data. Please try again.</div>');
            }
        });
    }
    $(".medicine-cate-pills .nav-link").on("click", function(e) {
        e.preventDefault();
        $(".medicine-cate-pills .nav-link").removeClass('active');
        $(this).addClass('active');        
        var categoryId = $(this).data('id');
        loadMedicinesByCategory(categoryId);
    });

    /*Load default category on page load */
    var defaultCategoryId = $(".medicine-cate-pills .nav-link.active").data('id');
    if (!defaultCategoryId && $(".medicine-cate-pills .nav-link").length > 0) {
        defaultCategoryId = $(".medicine-cate-pills .nav-link:first").data('id');
        $(".medicine-cate-pills .nav-link:first").addClass('active');
    }    
    if (defaultCategoryId) {
        loadMedicinesByCategory(defaultCategoryId);
    }
});