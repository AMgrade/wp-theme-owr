<?php

//add_filter('acf/load_field/name=owr_client_current_money', 'disable_acf_field');

function disable_acf_field($field) {
  $field['disabled'] = 1;
  return $field;
}

add_action( 'admin_post_paypal_donate', 'paypal_donate_save_to_db' );
add_action( 'admin_post_nopriv_paypal_donate', 'paypal_donate_save_to_db' );

function paypal_donate_save_to_db() {

	global $wpdb;

    $data = $_REQUEST;
	$post_id = json_encode($data['id'], JSON_NUMERIC_CHECK);
	$donate_sum = json_encode($data['mc_gross'], JSON_NUMERIC_CHECK);
    $donate_sum = floor($donate_sum);
    $get_current_money = get_field('owr_client_current_money', $post_id);
    $total_donate_sum = $donate_sum + $get_current_money;
    update_field('owr_client_current_money', $total_donate_sum, $post_id);

}
