<?php

function owr_custom_endpoints() {
    add_rewrite_endpoint( 'campaigns', EP_ROOT | EP_PAGES );
}

add_action( 'init', 'owr_custom_endpoints' );

function owr_custom_query_vars( $vars ) {
    $vars[] = 'campaigns';

    return $vars;
}

add_filter( 'query_vars', 'owr_custom_query_vars', 0 );

function owr_custom_flush_rewrite_rules() {
    flush_rewrite_rules();
}

add_action( 'wp_loaded', 'owr_custom_flush_rewrite_rules' );

function owr_custom_owr_account_menu_items( $items ) {
    $items = array(
        'dashboard'         => __( 'Dashboard', 'woocommerce' ),
        'campaigns'      => 'Campaigns',
        'orders'            => __( 'Orders', 'woocommerce' ),
        //'downloads'       => __( 'Downloads', 'woocommerce' ),
        'edit-address'    => __( 'Addresses', 'woocommerce' ),
        'payment-methods' => __( 'Payment Methods', 'woocommerce' ),
        'edit-account'      => __( 'Edit Account', 'woocommerce' ),
        'customer-logout'   => __( 'Logout', 'woocommerce' ),
    );

    return $items;
}

add_filter( 'woocommerce_account_menu_items', 'owr_custom_owr_account_menu_items' );

function owr_custom_endpoint_content() {
    include 'templates/campaigns-list.php';
}

add_action( 'woocommerce_account_campaigns_endpoint', 'owr_custom_endpoint_content' );

function owr_remove_account_links( $menu_links ){
    if( current_user_can('buyer') ) {
        unset( $menu_links['campaigns'] );
    }
    return $menu_links;
}

add_filter ( 'woocommerce_account_menu_items', 'owr_remove_account_links' );