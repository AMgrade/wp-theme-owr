'use strict';

jQuery(document).ready(function ($) {

    $('.lazy').Lazy({
        effect: 'fadeIn',
        effectTime: 500,
        afterLoad: function afterLoad(element) {
            $('.contact-form-wrapper').css('min-height', $(window).height() - $('.contact-form-wrapper').offset().top);
            $('.preloader').fadeOut(500);
        }
    });

    $(window).resize(function () {
        $('.contact-form-wrapper').css('min-height', $(window).height() - $('.contact-form-wrapper').offset().top);
    });
});