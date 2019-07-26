<?php

function cp_create_post_form() {
    global $post_id, $content;

    $featured_image_link = get_the_post_thumbnail_url( $post_id, 'medium' );
    $featured_image_id = get_post_thumbnail_id( $post_id );

    ?>

    <div class="create-campaign-post">
        <div id="postbox">
            <div class="alert result-message"></div>
            <form id="new_post" name="new_post" method="post" action="">
                <div class="form-group">
                    <div class="create-campaign-post__add-image">
                        <input id="frontend_button" type="button" class="button">
                        <div class="create-campaign-post__image-wrapper">
                            <i class="far fa-times-circle create-campaign-post__del-icon"></i>
                            <img src="<?php echo $featured_image_link; ?>" id="frontend-image" />
                        </div>
                    </div>
                    <input id="post_image_id" type="hidden" value="<?php echo  $featured_image_id; ?>" name="post_image_id">
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="post_content">Post Content</label>
                    <?php $settings =   array(
                        'wpautop' => true,
                        'media_buttons' => true,
                        'textarea_name' => 'post_content',
                        'textarea_rows' => get_option('default_post_edit_rows', 10),
                        'teeny' => false,
                        'dfw' => false,
                        'tinymce' => true,
                        'quicktags' => true,
                        'drag_drop_upload' => true
                    );
                    wp_editor( $content, 'post_content', $settings );
                    ?>
                </div>
                <div class="form-group">
                    <label for="cat">Categories</label>
                    <select id="cat" class="form-control" name="cat">
                        <option disabled selected value> -- Select category -- </option>
                        <?php
                        $taxonomy = 'campaign_categories';
                        $terms = get_terms([
                            'taxonomy' => $taxonomy,
                            'hide_empty' => false,
                            'exclude' => 25
                        ]);
                        foreach ($terms as $term) { ?>
                            <option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location">
                </div>
                <div class="form-group">
                    <label for="current_money">Current money</label>
                    <input type="number" class="form-control" id="current_money" name="current_money">
                </div>
                <div class="form-group">
                    <label for="goal_money">Total money</label>
                    <input type="number" class="form-control" id="goal_money" name="goal_money">
                </div>
                <div class="form-group">
                    <label for="paypal_account">Paypal account email</label>
                    <input type="email" class="form-control" id="paypal_account" name="paypal_account">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn owr-btn post-add" value="Publish" id="submit_new_post" name="submit" />
                </div>
                <input type="hidden" name="action" value="new_post" />
                <?php wp_nonce_field('add_new_post','add_new_post_nonce', true, true ); ?>
            </form>
        </div>
    </div>

<?php }

/**
 * Enqueue and localize js
 *
 */
function cp_new_campaign_post_scripts() {
    // Enqueue script
    wp_register_script('cp_reg_script', get_template_directory_uri() . '/inc/functions/my-account/ajax-create-post.js', array('jquery'), null, false);
    wp_enqueue_script('cp_reg_script');

    wp_localize_script( 'cp_reg_script', 'cp_reg_vars', array(
            'cp_ajax_url' => admin_url( 'admin-ajax.php' ),
            'cp_home_url' => home_url( '/my-account/campaigns/' )
        )
    );
}
add_action('wp_enqueue_scripts', 'cp_new_campaign_post_scripts', 100);

function cp_add_campaign() {

    global $error_output;
    // Verify nonce
    $nonce = $_POST['nonce'];
    if ( !isset($nonce) || !wp_verify_nonce( $nonce, 'add_new_post' ) )
        die('Ooops, something went wrong, please try again later.');

    // Post values

    if ($_POST['title'] != null) {
        $campaign_title = $_POST['title'];
    } else {
        $error_output .= 'Please enter a post  title<br/>';
    }

    if ($_POST['content'] != null) {
        $campaign_content = $_POST['content'];
    } else {
        $error_output .= 'Please enter a post content<br/>';
    }

    if ($_POST['image'] != null) {
        $campaign_image = $_POST['image'];
    } else {
        $error_output .= 'Please add image<br/>';
    }

    if ($_POST['cat'] != null) {
        $campaign_cat = $_POST['cat'];
    } else {
        $error_output .= 'Please choose category<br/>';
    }

    if ($_POST['loc'] != null) {
        $campaign_location = $_POST['loc'];
    } else {
        $error_output .= 'Please enter a post location<br/>';
    }

    if ($_POST['goal'] != null) {
        $campaign_goal_money = $_POST['goal'];
    } else {
        $error_output .= 'Please enter a total money<br/>';
    }

    if ($_POST['paypal'] != null) {
        $campaign_paypal_account = $_POST['paypal'];
    } else {
        $error_output .= 'Please enter your PayPal email account<br/>';
    }

    if ( $error_output == null ) {
        echo '1';
        $new_post = array(
            'post_name'     => $campaign_title,
            'post_title'    => $campaign_title,
            'post_content'  => $campaign_content,
            'post_status'   => 'publish',
            'post_type'     => 'campaign'
        );

        $create_post_id = wp_insert_post($new_post);

        set_post_thumbnail( $create_post_id, $campaign_image );

        update_field('field_5b87f4879ca7a', $campaign_cat, $create_post_id);
        update_field('field_5b87f2c09cb37', $campaign_location, $create_post_id);
        update_field('field_5b87f278e66f5', $campaign_goal_money, $create_post_id);
        update_field('field_5b87f3058f56e', $campaign_paypal_account, $create_post_id);
    } else {
        echo $error_output;
    }

    die();

}

add_action('wp_ajax_new_campaign_post', 'cp_add_campaign');
add_action('wp_ajax_nopriv_new_campaign_post', 'cp_add_campaign'); ?>