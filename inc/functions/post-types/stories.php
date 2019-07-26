<?php

function post_type_stories(){
    register_post_type('stories', array(
        'label'  => null,
        'labels' => array(
            'name'               => __('Stories', 'owr'),
            'singular_name'      => __('Stories', 'owr'),
            'add_new'            => __('Add Story', 'owr'),
            'add_new_item'       => __('Add Story', 'owr'),
            'edit_item'          => __('Edit Story', 'owr'),
            'new_item'           => __('New Story', 'owr'),
            'view_item'          => __('Show Story', 'owr'),
            'search_items'       => __('Search Story', 'owr'),
            'not_found'          => __('Not Found', 'owr'),
            'not_found_in_trash' => __('Not Found In Trash', 'owr'),
            'parent_item_colon'  => __('', 'owr'),
            'menu_name'          => __('Stories', 'owr'),
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
        'menu_icon'           => 'dashicons-media-text',
        'hierarchical'        => false,
        'supports'            => array('title','editor', 'thumbnail'),
        'taxonomies'          => array(),
        'has_archive'         => false,
        'rewrite'             => array(
            'slug' => 'stories_post'
        ),
        'query_var'           => true,
    ) );
}

add_action('init', 'post_type_stories');
