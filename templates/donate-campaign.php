<?php
$owr_donate_paypal_email  = get_field('owr_calient_donate_paypal_email', $post->ID);
$owr_donate_use_sandbox   = get_field('owr_client_donate_use_sandbox', $post->ID);
$post_id = get_queried_object()->ID;
?>
<form target="paypal" action="<?php if(!$owr_donate_use_sandbox){echo 'https://www.paypal.com/cgi-bin/webscr';}else{ echo 'https://www.sandbox.paypal.com/cgi-bin/webscr';} ?>" method="post" name="myform">
    <!-- If using a Business or Company Logo Graphic, include the "cpp_header_image" variable in your View Cart code. -->
    <input type="hidden" name="cpp_header_image"
           value="https://pbs.twimg.com/profile_images/932350418918633472/_stJ_IZk_400x400.jpg">
    <input type="hidden" name="on0" value="Donation Amount">
    <button id="donateButton" class="btn btn-primary owr-btn donate-btn campaign-donate-btn" type="submit">Donate now</button>
    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
    <input type="hidden" name="cmd" value="_donations">
    <!-- Replace "business" value with your PayPal Email Address or Account ID -->
    <input type="hidden" name="business" value="<?php echo $owr_donate_paypal_email; ?>">
    <input type="hidden" name="item_number" value="<?php echo $post_id; ?>">
    <input type="hidden" id="itemNamePayPal" name="item_name" value="<?php echo get_the_title($post->ID); ?>">
    <input type="hidden" name="amount">
    <input type="hidden" name="no_shipping" value="2">
    <input type="hidden" name="no_note" value="1">
    <input type="hidden" name="tax" value="0">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="lc" value="US">
    <!-- Replace value with the web page you want the customer to return to after a successful transaction -->
    <input type="hidden" name="return" value="<?php echo esc_url( get_home_url( $post_id ) ); ?>">
    <!-- Replace value with the web page you want the customer to return to after item cancellation -->
    <input type="hidden" name="cancel_return" value="<?php echo esc_url( get_home_url( $post_id )); ?>">
    <!-- Replace with page for parse request -->
    <input type="hidden" name="notify_url"
           value="<?php echo esc_url( home_url( '/wp-admin/admin-post.php?action=paypal_donate&id=' . $post_id . '' ) ); ?>">
    <input type="hidden" name="button_subtype" value="products">
    <input type="hidden" name="no_note" value="0">
    <input type="hidden" name="cn" value="Add special instructions to the seller:">
    <input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHosted">
</form>