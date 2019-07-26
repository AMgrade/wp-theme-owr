<?php

add_role( 'buyer', __('Buyer' ),array(
        'read' => true,
    )
);

add_filter('woocommerce_new_customer_data', 'owr_assign_custom_role', 10, 1);

function owr_assign_custom_role($args) {
    $args['role'] = 'buyer';
    return $args;
}