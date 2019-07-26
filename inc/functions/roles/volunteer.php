<?php
/**
 * New roles volunteer
 */
add_action('init', 'volunteerRole');
function volunteerRole()
{
    global $wp_roles;
    if ( ! isset( $wp_roles ) )
        $wp_roles = new WP_Roles();

    $adm = $wp_roles->get_role('author');
    $wp_roles->add_role('volunteer', 'Volunteer', $adm->capabilities);
}

/*$wp_roles = new WP_Roles();
$wp_roles->remove_role("volunteer");*/

add_action( 'admin_menu', 'remove_menu_items' );
function remove_menu_items() {
    if( current_user_can( 'volunteer' ) ):
        remove_menu_page( 'edit.php?post_type=our_work' );
        remove_menu_page( 'edit.php?post_type=past_missions' );
        remove_menu_page( 'edit.php?post_type=stories' );
        remove_menu_page( 'edit-comments.php' );
        remove_menu_page( 'index.php' );
        remove_menu_page( 'upload.php' );
        remove_menu_page( 'tools.php' );
    endif;
}

/**
 * Limit media library access
 */
function wpb_show_current_user_attachments( $query ) {
    $user_id = get_current_user_id();
    if ( $user_id && !current_user_can('activate_plugins') && !current_user_can('edit_others_posts') ) {
        $query['author'] = $user_id;
    }
    return $query;
}
add_filter( 'ajax_query_attachments_args', 'wpb_show_current_user_attachments' );

/**
 * Limit all posts Campaigns access
 */
function posts_for_current_author($query) {
    global $pagenow;

    if( 'edit.php' != $pagenow || !$query->is_admin )
        return $query;

    if( !current_user_can( 'edit_others_posts' ) ) {
        global $user_ID;
        $query->set('author', $user_ID );
    }
    return $query;
}
add_filter('pre_get_posts', 'posts_for_current_author');

