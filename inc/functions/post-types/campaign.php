<?php

/**
 * Register Campaign cats
 */
function campaign_taxonomy_cat() {
    register_taxonomy(
        'campaign_categories',
        'campaign',
        array(
            'hierarchical' => true,
            'label' => 'Campaign Categories',
            'query_var' => true,
            'show_admin_column' => true,
            'rewrite' => array(
                'slug' => 'openworld-go',
                'with_front' => false
            )
        )
    );
}
add_action( 'init', 'campaign_taxonomy_cat');

/**
 * Link custom post type campaign
 */
function filter_post_type_link($link, $post)
{
    if ($post->post_type != 'campaign')
        return $link;

    if ($cats = get_the_terms($post->ID, 'campaign_categories'))
        $link = str_replace('%campaign_categories%', array_pop($cats)->slug, $link);
    return $link;
}
add_filter('post_type_link', 'filter_post_type_link', 10, 2);

/**
 * Register custom post type campaign
 */
function register_campaign() {
    $labels = array(
        'name' => _x( 'Campaign', 'my_custom_post','custom' ),
        'singular_name' => _x( 'Campaign', 'my_custom_post', 'custom' ),
        'add_new' => _x( 'Add Campaign', 'my_custom_post', 'custom' ),
        'add_new_item' => _x( 'Add New Campaign', 'my_custom_post', 'custom' ),
        'edit_item' => _x( 'Edit Campaign', 'my_custom_post', 'custom' ),
        'new_item' => _x( 'New Campaign', 'my_custom_post', 'custom' ),
        'view_item' => _x( 'View Campaign', 'my_custom_post', 'custom' ),
        'search_items' => _x( 'Search Campaign', 'my_custom_post', 'custom' ),
        'not_found' => _x( 'No Campaign found', 'my_custom_post', 'custom' ),
        'not_found_in_trash' => _x( 'No Campaign found in Trash', 'my_custom_post', 'custom' ),
        'parent_item_colon' => _x( 'Parent Campaign:', 'my_custom_post', 'custom' ),
        'menu_name' => _x( 'Campaigns', 'my_custom_post', 'custom' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Campaign',
        'supports' => array( 'title', 'editor', 'page-attributes', 'thumbnail', 'comments'),
        'taxonomies' => array('campaign_categories'),
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-businessman',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug' => 'openworld-go/%campaign_categories%','with_front' => FALSE),
        'public' => true,
        'has_archive' => true,
        'capability_type' => 'post'
    );
    register_post_type( 'campaign', $args );
}
add_action( 'init', 'register_campaign', 20 );

/**
 * Remove cat box
 */
function remove_my_post_metaboxes() {
    remove_meta_box( 'campaign_categoriesdiv','campaign','normal' );
}
add_action('admin_menu','remove_my_post_metaboxes');

/**
 * Default taxonomy term
 */
function default_taxonomy_term( $post_id, $post ) {
    if ( 'publish' === $post->post_status ) {
        $defaults = array(
            'campaign_categories' => array( 'Other campaigns'),

        );
        $taxonomies = get_object_taxonomies( $post->post_type );
        foreach ( (array) $taxonomies as $taxonomy ) {
            $terms = wp_get_post_terms( $post_id, $taxonomy );
            if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
                wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
            }
        }
    }
}
add_action( 'save_post', 'default_taxonomy_term', 100, 2 );

function add_author_support_to_posts() {
    add_post_type_support( 'campaign', 'author' );
}
add_action( 'init', 'add_author_support_to_posts' );

/**
 * Add ACF column image to campaign cat
 */
function add_new_campaign_categories_column($column) {
    $column['category_image'] = 'Category Image';

    return $column;
}

add_filter('manage_edit-campaign_categories_columns', 'add_new_campaign_categories_column');

function add_new_campaign_categories_admin_column_show_value( $content, $column_name, $term_id ) {
    if ($column_name == 'category_image') {
        $content = get_field('category_image', 'campaign_categories_' . $term_id);
        return '<img style="max-width: 100px; display: block; width: 100%; margin: 0 auto;" src="' . $content . '">';
    }
    return $content;
}

add_filter('manage_campaign_categories_custom_column', 'add_new_campaign_categories_admin_column_show_value', 10, 3);