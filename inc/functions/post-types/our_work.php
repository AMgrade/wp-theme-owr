<?php

function post_type_our_work(){
    register_post_type('our_work', array(
        'label'  => null,
        'labels' => array(
            'name'               => __('Our Works', 'owr'),
            'singular_name'      => __('Our Work', 'owr'),
            'add_new'            => __('Add Our Work', 'owr'),
            'add_new_item'       => __('Add Our Work', 'owr'),
            'edit_item'          => __('Edit Our Work', 'owr'),
            'new_item'           => __('New Our Work', 'owr'),
            'view_item'          => __('Show Our Work', 'owr'),
            'search_items'       => __('Search Our Works', 'owr'),
            'not_found'          => __('Not Found', 'owr'),
            'not_found_in_trash' => __('Not Found In Trash', 'owr'),
            'parent_item_colon'  => __('', 'owr'),
            'menu_name'          => __('Our Works', 'owr'),
        ),
        'description'         => '',
        'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'show_ui'             => null,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => null,
        'show_in_nav_menus'   => null,
        'show_in_rest'        => null,
        'rest_base'           => null,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-hammer',
        'hierarchical'        => false,
        'supports'            => array('title','editor', 'thumbnail'),
        'taxonomies'          => array(),
        'has_archive'         => false,
        'rewrite'             => true,
        'query_var'           => true,
    ) );
}

add_action('init', 'post_type_our_work');
