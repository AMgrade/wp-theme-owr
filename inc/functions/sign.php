<?php

/**
 * Social register set role
 */
function social_login_redirect($user_id) {
    $user = new WP_User($user_id);
    $user->set_role('volunteer');
};
add_action('nsl_register_new_user', 'social_login_redirect');

/**
 * Main redirection of the default login page
 */
function redirect_login_page() {
    $login_page  = home_url('/sign-in/');
    $page_viewed = basename($_SERVER['REQUEST_URI']);

    if($page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect($login_page);
        exit;
    }
}
add_action('init','redirect_login_page');

/**
 * Where to go if a login failed
 */
function custom_login_failed() {
    $login_page  = home_url('/sign-in/');
    wp_redirect($login_page . '?login=failed');
    exit;
}
add_action('wp_login_failed', 'custom_login_failed');

/**
 * Where to go if any of the fields were empty
 */
function verify_user_pass($user, $username, $password) {
    $login_page  = home_url('/sign-in/');
    if($username == "" || $password == "") {
        wp_redirect($login_page . "?login=empty");
        exit;
    }
}
add_filter('authenticate', 'verify_user_pass', 1, 3);

/**
 * What to do on logout
 */
function logout_redirect() {
    $login_page  = home_url('/sign-in/');
    wp_redirect($login_page . "?login=false");
    exit;
}
add_action('wp_logout','logout_redirect');

/**
 * Redirect my-account to sign-in
 */
function redirect() {
    if ( is_page('my-account') && !is_user_logged_in() ) {
        wp_redirect( home_url('/sign-in') );
        die();
    }
}
add_action( 'wp', 'redirect' );