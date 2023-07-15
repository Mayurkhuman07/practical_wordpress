jQuery(document).ready(function ($) {
    // AJAX Filter for Product Page
    $('.filter-dropdown').on('change', function () {
        var selectedOption = $(this).val();
        var container = $(this).closest('.container');
        
        $.ajax({
            url: ajaxurl, // ajaxurl is a global variable in WordPress that points to admin-ajax.php
            type: 'POST',
            data: {
                action: 'apply_product_filter',
                filter_option: selectedOption
            },
            beforeSend: function () {
                container.addClass('loading');
            },
            success: function (response) {
                container.removeClass('loading');
                container.find('.product-container').html(response);
            },
            error: function () {
                container.removeClass('loading');
                alert('An error occurred while fetching products.');
            }
        });
    });
});
