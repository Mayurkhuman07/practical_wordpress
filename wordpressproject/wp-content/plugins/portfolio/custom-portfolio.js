jQuery(document).ready(function ($) {
    // Show popup on click
    $('.portfolio-thumbnail-link').on('click', function (e) {
        e.preventDefault();
        var popupId = $(this).attr('href');
        $(popupId).fadeIn();
    });

    // Close popup on click on close button
    $('.portfolio-popup-close').on('click', function () {
        $(this).closest('.portfolio-popup').fadeOut();
    });

    // Close popup on click outside the popup area
    $('.portfolio-popup').on('click', function (e) {
        if (e.target === this) {
            $(this).fadeOut();
        }
    });

    // Prevent closing the popup when clicking inside it
    $('.portfolio-popup-content').on('click', function (e) {
        e.stopPropagation();
    });
});



