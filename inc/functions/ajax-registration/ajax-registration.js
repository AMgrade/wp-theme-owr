jQuery(document).ready(function ($) {

    /**
     * When user clicks on button...
     *
     */
    $('#btn-new-user').click(function (event) {

        /**
         * Prevent default action, so when user clicks button he doesn't navigate away from page
         *
         */
        if (event.preventDefault) {
            event.preventDefault();
        } else {
            event.returnValue = false;
        }

        $('.indicator').show();

        $('.result-message').hide();

        var reg_nonce = $('#vb_new_user_nonce').val();
        var reg_user = $('#vb_username').val();
        var reg_pass = $('#vb_pass').val();
        var reg_confirm_pass = $('#vb_confirm_pass').val();
        var reg_mail = $('#vb_email').val();
        var reg_name = $('#vb_name').val();
        var reg_role = $('#vb_role').val();
        var reg_lname = $('#vb_last_name').val();

        /**
         * AJAX URL where to send data
         * (from localize_script)
         */
        var ajax_url = vb_reg_vars.vb_ajax_url;
        var home_url = vb_reg_vars.vb_home_url;

        data = {
            action: 'register_user',
            nonce: reg_nonce,
            user: reg_user,
            pass: reg_pass,
            confirm_pass: reg_confirm_pass,
            mail: reg_mail,
            name: reg_name,
            lname: reg_lname,
            role: reg_role
        };

        $.post(ajax_url, data, function (response) {

            if (response) {
                $('.indicator').hide();

                if (response === '1') {
                    $('.result-message').removeClass('alert-danger');
                    $('.result-message').html('Your submission is complete. Please wait, redirection to your account');
                    $('.result-message').addClass('alert-success');
                    $('.result-message').show();
                    setTimeout(function () {
                        $(location).attr('href', home_url);
                    }, 2000);
                } else {
                    $('.result-message').html(response);
                    $('.result-message').addClass('alert-danger');
                    $('.result-message').show();
                }
            }
        });

    });

});

