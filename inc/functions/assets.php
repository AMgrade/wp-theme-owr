<?php

/**
 * Class CSS_Menu_Walker
 */

class CSS_Menu_Walker extends Walker {

    var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul>\n";
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

        global $wp_query;
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $class_names = $value = '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;

        /* Add active class */
        if (in_array('current-menu-item', $classes)) {
            $classes[] = 'active';
            unset($classes['current-menu-item']);
        }

        /* Check for children */
        $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
        if (!empty($children)) {
            $classes[] = 'has-sub';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        $attributes  = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
        $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target    ) .'"' : '';
        $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn       ) .'"' : '';
        $attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url       ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'><span>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</span></a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function end_el(&$output, $item, $depth = 0, $args = array()) {
        $output .= "</li>\n";
    }
}
/**
 * Hide default editor on page
 */
function wph_hide_editor()
{
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
    if (!isset($post_id)) return;

    $template_file = get_post_meta($post_id, '_wp_page_template', true);
    if ($template_file == 'templates/template-home.php' || $template_file == 'templates/template-our-work.php' || $template_file == 'templates/template-about.php' || $template_file == 'templates/template-stories.php' || $template_file == 'templates/template-past-missions.php' || $template_file == 'templates/template-sponsor.php' || $template_file == 'templates/template-media.php' || $template_file == 'templates/template-sponsors.php') {
        remove_post_type_support('page', 'editor');
    }
}

add_action('admin_init', 'wph_hide_editor');
/**
 * Function Excerpt text
 */
function do_excerpt_symbols($string, $length) {
    if (strlen($string) <= $length) {
        echo $string;
    } else {
        echo substr($string, 0, $length) . '...';
    }
}
/**
 * Function Excerpt title
 */
function do_excerpt_title($string, $length) {
    if (strlen($string) <= $length) {
        echo $string;
    } else {
        echo substr($string, 0, $length) . '';
    }
}

/**
 * Remove menu item
 */
function remove_menus() {
    remove_menu_page( 'edit.php' );
}
add_action( 'admin_menu', 'remove_menus' );

/**
 *  Remove Contact Form 7 Links from dashboard menu items if not admin
 */
if (!(current_user_can('administrator'))) {
    function remove_wpcf7() {
        remove_menu_page( 'wpcf7' );
    }

    add_action('admin_menu', 'remove_wpcf7');
}

/**
 *  View posts in admin user list
 */
add_action('manage_users_columns','yoursite_manage_users_columns');
function yoursite_manage_users_columns($column_headers) {
    unset($column_headers['posts']);
    $column_headers['custom_posts'] = 'All Posts';
    return $column_headers;
}

add_action('manage_users_custom_column','yoursite_manage_users_custom_column',10,3);
function yoursite_manage_users_custom_column($custom_column,$column_name,$user_id) {
    if ($column_name=='custom_posts') {
        $counts = _yoursite_get_author_post_type_counts();
        $custom_column = array();
        if (isset($counts[$user_id]) && is_array($counts[$user_id]))
            foreach($counts[$user_id] as $count) {
                $link = admin_url() . "edit.php?post_type=" . $count['type']. "&author=".$user_id;
                // admin_url() . "edit.php?author=" . $user->ID;
                $custom_column[] = "\t<tr><th><a href={$link}>{$count['label']}</a></th><td>{$count['count']}</td></tr>";
            }
        $custom_column = implode("\n",$custom_column);
        if (empty($custom_column))
            $custom_column = "<th>[none]</th>";
        $custom_column = "<table>\n{$custom_column}\n</table>";
    }
    return $custom_column;
}

function _yoursite_get_author_post_type_counts() {
    static $counts;
    if (!isset($counts)) {
        global $wpdb;
        global $wp_post_types;
        $sql = <<<SQL
        SELECT
        post_type,
        post_author,
        COUNT(*) AS post_count
        FROM
        {$wpdb->posts}
        WHERE 1=1
        AND post_type NOT IN ('revision','nav_menu_item')
        AND post_status IN ('publish','pending', 'draft')
        GROUP BY
        post_type,
        post_author
SQL;
        $posts = $wpdb->get_results($sql);
        foreach($posts as $post) {
            $post_type_object = $wp_post_types[$post_type = $post->post_type];
            if (!empty($post_type_object->label))
                $label = $post_type_object->label;
            else if (!empty($post_type_object->labels->name))
                $label = $post_type_object->labels->name;
            else
                $label = ucfirst(str_replace(array('-','_'),' ',$post_type));
            if (!isset($counts[$post_author = $post->post_author]))
                $counts[$post_author] = array();
            $counts[$post_author][] = array(
                'label' => $label,
                'count' => $post->post_count,
                'type' => $post->post_type,
            );
        }
    }
    return $counts;
}

/**
 * Woo shop cart
 */
function add_shop_cart()
{
    if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

        $count = WC()->cart->cart_contents_count; ?>

        <li class="social-icon cart-icon">
            <a class="cart-link" href="<?php echo WC()->cart->get_cart_url(); ?>"
               title="<?php _e('View your shopping cart'); ?>"><?php
                if ( $count > 0 ) {
                    ?>
                    <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
                    <?php
                }
                ?>
            </a>
        </li>

    <?php }
}

add_action('owr_shop_cart', 'add_shop_cart');