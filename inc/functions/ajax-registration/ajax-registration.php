<?php

/**
 * Registration form
 *
 */

function vb_registration_form() { ?>

    <div class="vb-registration-form">
        <form class="form-horizontal registraion-form" role="form" method="post">

            <div class="form-group">
                <label for="vb_name">First Name <span style="color: red;">*</span></label>
                <input type="text" name="vb_name" id="vb_name" value="" class="form-control" />
            </div>

            <div class="form-group">
                <label for="vb_last_name">Last Name <span style="color: red;">*</span></label>
                <input type="text" name="vb_last_name" id="vb_last_name" value="" class="form-control" />
            </div>

            <div class="form-group">
                <label for="vb_email" >E-mail <span style="color: red;">*</span></label>
                <input type="email" name="vb_email" id="vb_email" value="" class="form-control" />
            </div>

            <div class="form-group">
                <label for="vb_username" >Username <span style="color: red;">*</span></label>
                <input type="text" name="vb_username" id="vb_username" value="" class="form-control" />
                <span class="help-block">Please use only a-z,A-Z,0-9, minimum 5 characters</span>
            </div>

            <div class="form-group">
                <label for="vb_pass" >Password <span style="color: red;">*</span></label>
                <input type="password" name="vb_pass" id="vb_pass" value="" class="form-control" />
                <span class="help-block">Minimum 8 characters</span>
            </div>

            <div class="form-group">
                <label for="vb_confirm_pass" >Confirm Password</label>
                <input type="password" name="vb_confirm_pass" id="vb_confirm_pass" value="" class="form-control" autocomplete="off" />
            </div>

            <?php wp_nonce_field('vb_new_user','vb_new_user_nonce', true, true ); ?>
            <input type="hidden" id="vb_role" name="vb_role" value="volunteer" />
            <input type="submit" class="btn owr-btn sign-up-btn" id="btn-new-user" value="Register" />
        </form>
        <div class="alert result-message"></div>
        <div class="or-line">
            or
        </div>
        <div class="social-buttons">
            <a href="<?php echo home_url('/wp-login.php?loginSocial=facebook') ?>" class="social_login" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="facebook" data-popupwidth="475" data-popupheight="175">
                <img src="/wp-content/themes/owr/assets/img/continue-facebook.svg" alt="" />
            </a>
            <a href="<?php echo home_url('/wp-login.php?loginSocial=google') ?>" class="social_login" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="google" data-popupwidth="600" data-popupheight="600">
                <img src="/wp-content/themes/owr/assets/img/continue-google.svg" alt="" />
            </a>
        </div>
    </div>

    <?php
}

/**
 * Enqueue and localize js
 *
 */
function vb_register_user_scripts() {
    // Enqueue script 
    wp_register_script('vb_reg_script', get_template_directory_uri() . '/inc/functions/ajax-registration/ajax-registration.js', array('jquery'), null, false);
    wp_enqueue_script('vb_reg_script');

    wp_localize_script( 'vb_reg_script', 'vb_reg_vars', array(
            'vb_ajax_url' => admin_url( 'admin-ajax.php' ),
            'vb_home_url' => home_url( '/my-account/campaigns/campaigns-add/' )
        )
    );
}
add_action('wp_enqueue_scripts', 'vb_register_user_scripts', 100);

/**
 * New User registration
 *
 */
function vb_reg_new_user()
{
    global $reg_errors;
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'vb_new_user'))
        die('Ooops, something went wrong, please try again later.');

    // Post values
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $confirm_password = $_POST['confirm_pass'];
    $email = $_POST['mail'];
    $name = $_POST['name'];
    $lname = $_POST['lname'];
    $role = $_POST['role'];

    $reg_errors = new WP_Error;

    if ( empty($username) || empty($password) || empty($email) || empty($name) || empty($lname) ) {
        $reg_errors->add('field', 'Required form field is missing');
    }

    if (5 > strlen($username)) {
        $reg_errors->add('username_length', 'Username too short. At least 5 characters is required');
    }

    if (2 > strlen($name)) {
        $reg_errors->add('username_length', 'First name too short. At least 2 characters is required');
    }

    if (2 > strlen($lname)) {
        $reg_errors->add('username_length', 'Last Name too short. At least 2 characters is required');
    }

    if (username_exists($username)) {
        $reg_errors->add('user_name', 'Sorry, that username already exists!');
    }

    if (!validate_username($username)) {
        $reg_errors->add('username_invalid', 'Sorry, the username you entered is not valid');
    }

    if ( !empty($password) && 8 > strlen($password)) {
        $reg_errors->add('password', 'Password length must be greater than 8');
    }

    if ( !empty($password) && $password != $confirm_password ) {
        $reg_errors->add('password', 'The passwords do not match.');
    }

    if ( !is_email( $email ) ) {
        $reg_errors->add( 'email_invalid', 'Email is not valid' );
    }

    if ( email_exists( $email ) ) {
        $reg_errors->add( 'email', 'Email Already in use' );
    }

    if ( empty($reg_errors->errors) ) {
        echo '1';
        $userdata = array(
            'user_login'    => $username,
            'user_pass'     => $password,
            'user_email'    => $email,
            'first_name'    => $name,
            'last_name'     => $lname,
            'role'          => $role,
        );

        $user_id = wp_insert_user( $userdata );
        $current_user = get_user_by( 'id', $user_id );

        // set the WP login cookie
        $secure_cookie = is_ssl() ? true : false;
        wp_set_auth_cookie( $user_id, true, $secure_cookie );
    } else {
        foreach ( $reg_errors->get_error_messages() as $error ) {
            echo '<div>';
            echo $error . '<br/>';
            echo '</div>';
        } ?>
    <?php }

    die();
}

add_action('wp_ajax_register_user', 'vb_reg_new_user');
add_action('wp_ajax_nopriv_register_user', 'vb_reg_new_user');