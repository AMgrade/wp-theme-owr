<?php

function post_type_past_missions(){
    register_post_type('past_missions', array(
        'label'  => null,
        'labels' => array(
            'name'               => __('Past Missions', 'owr'),
            'singular_name'      => __('Past Missions', 'owr'),
            'add_new'            => __('Add Past Mission', 'owr'),
            'add_new_item'       => __('Add Past Mission', 'owr'),
            'edit_item'          => __('Edit Past Mission', 'owr'),
            'new_item'           => __('New Past Mission', 'owr'),
            'view_item'          => __('Show Past Mission', 'owr'),
            'search_items'       => __('Search Past Mission', 'owr'),
            'not_found'          => __('Not Found', 'owr'),
            'not_found_in_trash' => __('Not Found In Trash', 'owr'),
            'parent_item_colon'  => __('', 'owr'),
            'menu_name'          => __('Past Missions', 'owr'),
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
        'menu_icon'           => 'dashicons-universal-access-alt',
        'hierarchical'        => false,
        'supports'            => array('title','editor', 'thumbnail'),
        'taxonomies'          => array(),
        'has_archive'         => false,
        'rewrite'             => array(
            'slug' => 'past_missions'
        ),
        'query_var'           => true,
    ) );
}

add_action('init', 'post_type_past_missions');
