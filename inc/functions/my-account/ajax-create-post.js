jQuery(document).ready(function ($) {
    /**
     * When user clicks on button...
     *
     */
    $('#submit_new_post').click(function (event) {

        /**
         * Prevent default action, so when user clicks button he doesn't navigate away from page
         *
         */
        if (event.preventDefault) {
            event.preventDefault();
        } else {
            event.returnValue = false;
        }

        $('.result-message').hide();

        function get_tinymce_content(id) {
            var content;
            var inputid = id;
            var editor = tinyMCE.get(inputid);
            var textArea = $('textarea#' + inputid);
            if (textArea.length>0 && textArea.is(':visible')) {
                content = textArea.val();
            } else {
                content = editor.getContent();
            }
            return content;
        }

        var reg_nonce = $('#add_new_post_nonce').val();
        var reg_title = $('#title').val();
        var reg_content = get_tinymce_content('post_content');
        var reg_thumb_image = $('#post_image_id').val();
        var reg_cat = $('#cat').val();
        var reg_loc = $('#location').val();
        var reg_current_money = $('#current_money').val();
        var reg_goal_money = $('#goal_money').val();
        var reg_paypal_account = $('#paypal_account').val();

        /**
         * AJAX URL where to send data
         * (from localize_script)
         */
        var ajax_url = cp_reg_vars.cp_ajax_url;
        var home_url = cp_reg_vars.cp_home_url;

        data = {
            action: 'new_campaign_post',
            nonce: reg_nonce,
            title: reg_title,
            content: reg_content,
            image: reg_thumb_image,
            cat: reg_cat,
            loc: reg_loc,
            current: reg_current_money,
            goal: reg_goal_money,
            paypal: reg_paypal_account
        };

        $.post(ajax_url, data, function (response) {

            if (response) {
                $('.indicator').hide();

                if (response === '1') {
                    $('.result-message').removeClass('alert-danger');
                    $('.result-message').html('Your submission is complete. Please wait, redirection to your account');
                    $('.result-message').addClass('alert-success');
                    $('.result-message').show();
                    $('html,body').animate({
                        scrollTop: 0
                    }, 500);
                    setTimeout(function () {
                        $(location).attr('href', home_url);
                    }, 1500);
                } else {
                    $('.result-message').html(response);
                    $('.result-message').addClass('alert-danger');
                    $('.result-message').show();
                    $('html,body').animate({
                        scrollTop: 0
                    }, 500);
                }
            }
        });

    });

});