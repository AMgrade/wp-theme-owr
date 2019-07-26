<?php

/**
 * Enqueue scripts and styles.
 */
function owr_scripts() {
	wp_enqueue_media();
	//css
	wp_register_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.2.0/css/all.css', null, OWR_THEME_VERSION );
	wp_register_style( 'owg-vendor-style', get_template_directory_uri() . '/assets/dist/css/vendor.css', null, OWR_THEME_VERSION );
	wp_enqueue_style( 'owg-main-style', get_template_directory_uri() . '/assets/dist/css/app.css', [ 'owg-vendor-style' ], OWR_THEME_VERSION );
	wp_enqueue_style( 'font-awesome');

	//js
	wp_deregister_script('jquery');
	wp_register_script( 'jquery', get_template_directory_uri() . '/assets/dist/js/jquery.min.js', OWR_THEME_VERSION, true );
	wp_register_script( 'popper', get_template_directory_uri() . '/assets/dist/js/popper.min.js', [ 'jquery' ], OWR_THEME_VERSION, true );
    wp_register_script( 'slick-slider', get_template_directory_uri() . '/assets/dist/js/slick.js', [ 'jquery' ], OWR_THEME_VERSION, true );
	wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/dist/js/bootstrap.min.js', [ 'jquery', 'popper' ], OWR_THEME_VERSION, true );
	wp_register_script( 'owg-vendor-script', get_template_directory_uri() . '/assets/dist/js/vendor.js', [ 'jquery', 'bootstrap' ], OWR_THEME_VERSION, true );
	wp_enqueue_script( 'owg-main-script', get_template_directory_uri() . '/assets/dist/js/app.js', [ 'owg-vendor-script', 'slick-slider' ], OWR_THEME_VERSION, true );
    wp_enqueue_script( 'owg-sticky-script', get_template_directory_uri() . '/assets/dist/js/jquery.sticky-sidebar.min.js', [ 'owg-main-script', 'slick-slider' ], OWR_THEME_VERSION, true );

	//based on template
	$template_file = get_post_meta( get_queried_object_id(), '_wp_page_template', true );

	switch($template_file) {
		case 'templates/template-holding.php':
			wp_deregister_style('owg-main-style');
			wp_enqueue_style( 'owg-holding-script', get_template_directory_uri() . '/assets/dist/css/holder.css', [ 'owg-vendor-style' ], OWR_THEME_VERSION );
			wp_deregister_script('owg-main-script');
			wp_enqueue_script( 'owg-holder-script', get_template_directory_uri() . '/assets/dist/js/holder.js', [ 'owg-vendor-script' ], OWR_THEME_VERSION, true );
			break;
	}

}

add_action( 'wp_enqueue_scripts', 'owr_scripts' );

/**
 * setup
 */
function owr_setup() {
	register_nav_menus( [
		'top'                 => 'Top menu',
	] );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
}


add_action( 'after_setup_theme', 'owr_setup' );