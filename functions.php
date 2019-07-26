<?php

define( 'OWR_THEME_VERSION', 0.1 );

show_admin_bar( false );

//initials scripts
require_once( __DIR__ . '/inc/functions/init.php' );

//Plugins compatibility
require_once( __DIR__ . '/inc/functions/shortcodes.php' );

//register custom post types
require_once(__DIR__ . '/inc/functions/post-types/index.php');

//New roles
require_once(__DIR__ . '/inc/functions/roles/index.php');

//Plugins compatibility
require_once( __DIR__ . '/inc/functions/plugins_compatibility/acf.php' );

//Menu walker
require_once( __DIR__ . '/inc/functions/assets.php' );

//Pay Pal donate
require_once( __DIR__ . '/inc/functions/donate.php' );

//Ajax ACF
require_once ( __DIR__ . '/inc/functions/repeater-ajax-load-more.php' );

//AJAX registration
require_once ( __DIR__ . '/inc/functions/ajax-registration/ajax-registration.php' );

//Register adn login
require_once ( __DIR__ . '/inc/functions/sign.php' );

// Comment form
require_once (__DIR__ . '/inc/functions/comments-form.php');

// Comment form
require_once (__DIR__ . '/inc/functions/my-account/index.php');

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}