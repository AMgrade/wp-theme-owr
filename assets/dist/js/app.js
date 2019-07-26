'use strict';

jQuery(document).ready(function ($) {

    $('#mobileMenu .has-sub').append("<span class='mobile-arrow'></span>");

    $('#mobileMenu .has-sub').each(function () {
        var dropdown = $(this);
        $(".mobile-arrow", dropdown).click(function (e) {
            $(this).toggleClass('translate-arrow');
            e.preventDefault();
            var div = $("ul", dropdown);
            div.slideToggle();
            return false;
        });
    });

    $('#nav-icon2').click(function () {
        $(this).toggleClass('open');
    });

    /* Search input */
    var searchBtn = $('#searchIcon');

    searchBtn.on('click', function () {
        $('#desctopSearch').fadeIn();
    });
    $('.close-search-input').on('click', function () {
        $('#desctopSearch').fadeOut();
    });

    /*Search first el in string*/
    $('.our-work-single .section-title-blue').each(function () {
        this.innerHTML = this.innerHTML.replace(/^(.+?\s)/, '<span class="section-title-dark">$1</span>');
    });

    /* Play video */
    var videoControls = document.getElementById('videoControls');
    var playVideo = $('#playVideo');
    var pauseVideo = $('#videoControls');
    playVideo.on('click', function () {
        videoControls.play();
        $(this).fadeOut();
        pauseVideo.css('cursor', 'pointer');
    });
    pauseVideo.on('click', function () {
        videoControls.pause();
        playVideo.fadeIn();
        pauseVideo.css('cursor', 'auto');
    });

    /* Story contact form */
    $('#storyBtnForm').on('click', function () {
        $('.story-form').slideToggle();
        $(this).toggleClass('close-story-form-btn');
        $('.story-wrap-form .wpcf7-response-output').fadeToggle();
    });

    document.addEventListener('wpcf7mailsent', function (event) {
        if ('172' == event.detail.contactFormId) {
            $('#storyModal').modal('show').css({
                'display': 'flex',
                'padding': '0 10px'
            });
            $('.story-form').slideUp();
            $('#storyBtnForm').removeClass('close-story-form-btn');
        }
    }, false);

    //File input
    function falseInputClick(falseInput, trueInput) {
        falseInput.click(function () {
            trueInput.click();
        });
        trueInput.change(function (e) {
            falseInput.val(e.target.files[0].name);
        });
    }

    var falseInputAutorPhoto = $('#visiblePhotoAutor'),
        trueInputAutorPhoto = $('#photoAutor'),
        falseInputFiles = $('#visibleFilesStory'),
        trueInputFiles = $('#filesStory');

    falseInputClick(falseInputAutorPhoto, trueInputAutorPhoto);
    falseInputClick(falseInputFiles, trueInputFiles);

    $('#uploadBtnAutorPhoto').on('click', function () {
        trueInputAutorPhoto.click();
    });
    $('#uploadBtnFiles').on('click', function () {
        trueInputFiles.click();
    });

    //Customize select on sponsor page
    var firstOption = $('#volunteerTrip option, #missionLike option');
    for (var i = 0; i < 1; i++) {
        $(firstOption[i]).attr('value', 'hide');
    }

    $('select').each(function () {
        var $this = $(this),
            numberOfOptions = $(this).children('option').length;

        $this.addClass('select-hidden');
        $this.wrap('<div class="select"></div>');
        $this.after('<div class="select-styled"></div>');

        var $styledSelect = $this.next('div.select-styled');
        $styledSelect.text($this.children('option').eq(0).text());

        var $list = $('<ul />', {
            'class': 'select-options'
        }).insertAfter($styledSelect);

        for (var i = 0; i < numberOfOptions; i++) {
            $('<li />', {
                text: $this.children('option').eq(i).text(),
                rel: $this.children('option').eq(i).val()
            }).appendTo($list);
        }

        var $listItems = $list.children('li');

        $styledSelect.click(function (e) {
            e.stopPropagation();
            $('div.select-styled.active').not(this).each(function () {
                $(this).removeClass('active').next('ul.select-options').hide();
            });
            $(this).toggleClass('active').next('ul.select-options').toggle();
        });

        $listItems.click(function (e) {
            e.stopPropagation();
            $styledSelect.text($(this).text()).removeClass('active');
            $this.val($(this).attr('rel'));
            $list.hide();
        });

        $(document).click(function () {
            $styledSelect.removeClass('active');
            $list.hide();
        });
    });

    //Donate
    $('#donateButton').on('click', function () {
        var radG1;

        for (var i = 0; i < document.myform.os0.length; i++) {
            if (document.myform.os0[i].checked == true) {
                radG1 = document.myform.os0[i].value;
            }
        }

        if (radG1 == "25.00") {
            document.myform.amount.value = '25.00';
            document.myform.item_number.value = "WF-25-00";
        } else if (radG1 == "50.00") {
            document.myform.amount.value = '50.00';
            document.myform.item_number.value = "WF-50-00";
        } else if (radG1 == "100.00") {
            document.myform.amount.value = '100.00';
            document.myform.item_number.value = "WF-100-00";
        } else if (radG1 == "200.00") {
            document.myform.amount.value = '200.00';
            document.myform.item_number.value = "WF-200-00";
        } else if (radG1 == "Other") {
            document.myform.amount.value = '0.00';
            document.myform.item_number.value = "WF-0-00";
        }

        var itemNameVal = $('#missionLikeWrap .select-styled').text();
        $('#itemNamePayPal').val(itemNameVal);
    });

    //Media gallery
    var CurrentImg = 0;
    $(".page-template-template-media .flexbin > div").on('click', function () {
        CurrentImg = $(this).find('.popup-photo-image').attr('data-value') - 1;
        $('#imageGalleryModal').modal({
            keyboard: true,
            'show': true
        });
    });

    function initSlider() {
        $("#photoSlider").slick({
            initialSlide: CurrentImg,
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: $('.prev-arrow'),
            nextArrow: $('.next-arrow'),
            asNavFor: '#photoSliderBot'
        });
        $('#photoSliderBot').slick({
            initialSlide: CurrentImg,
            slidesToShow: 8,
            slidesToScroll: 1,
            asNavFor: '#photoSlider',
            focusOnSelect: true,
            prevArrow: $('.prev-arrow-mini'),
            nextArrow: $('.next-arrow-mini'),
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 5
                }
            }, {
                breakpoint: 480,
                settings: {
                    slidesToShow: 3
                }
            }, {
                breakpoint: 340,
                settings: {
                    slidesToShow: 2
                }
            }]
        });
    }
    $('#imageGalleryModal').on('shown.bs.modal', function () {
        initSlider();
    });
    $('#imageGalleryModal').on('hidden.bs.modal', function () {
        $("#photoSlider").slick('unslick');
        $("#photoSliderBot").slick('unslick');
    });

    var status = $('.slider-index span');
    var slickElement = $('#imageGalleryModal');

    slickElement.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
        var i = (currentSlide ? currentSlide : 0) + 1;
        status.text(i + ' of ' + slick.slideCount);
    });

    $('#sponsorBtn').click(function () {
        $('html, body').animate({
            scrollTop: $("#sponsorsAnchor").offset().top
        }, 1500);
    });

    /* Sticky sidebar */
    $('.product-section__right').stickySidebar({
        topSpacing: 100,
        bottomSpacing: 200,
        minWidth: 992
    });

    /* wc-forward */
    $(document).on('added_to_cart', function (event) {
        var forward = $(document).find('.wc-forward');
        forward.prev().text(forward.text()).attr('href', forward.attr('href')).removeClass('ajax_add_to_cart');
        forward.remove();
    });

    if ($('.v-trip-items').length > 0) {
        $('.v-trip-items').text($('#order_items_count').val());
    }

    /* Volunteer delete post */
    $('.v-post-delete').on('click', function (event) {
        event.preventDefault();
        if (confirm('Are you sure?')) {
            window.location.href = $(this).attr('href');
        }
    });

    /* Add campaigns image on create/edit post */
    var file_frame, attachment;

    if ($('#frontend-image').length) {
        if ($('#frontend-image').attr('src').trim() !== '') {
            $('.create-campaign-post__image-wrapper').show();
            $('#frontend_button').hide();
        }
    }
    $('#frontend_button').on('click', function (event) {
        event.preventDefault();

        if (file_frame) {
            file_frame.open();
            return;
        }

        file_frame = wp.media.frames.file_frame = wp.media({
            title: $(this).data('uploader_title'),
            button: {
                text: $(this).data('uploader_button_text')
            },
            multiple: false
        });

        file_frame.on('select', function () {
            attachment = file_frame.state().get('selection').first().toJSON();
            $('#post_image_id').val(attachment.id);
            $('#frontend_button').hide();
            $('.create-campaign-post__image-wrapper').show();
            $('#frontend-image').attr('src', attachment.url);
        });

        file_frame.open();
    });

    $('.create-campaign-post__del-icon').on('click', function () {
        $('#frontend_button').show();
        $('#frontend-image').attr('src', '');
        $('#post_image_id').val('');
        $('.create-campaign-post__image-wrapper').hide();
    });
});