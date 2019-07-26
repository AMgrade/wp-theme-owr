<?php

if (!class_exists('list_user_posts')) {

    class list_user_posts
    {
        function __construct($args = array())
        {
            add_shortcode('user_posts', array($this,list_user_posts));
        }

        public function list_user_posts($attr = array(), $content = null)
        {
            extract(shortcode_atts(array(
                'post_type' => 'post',
                'number' => 10,
            ), $attr));

            if (!is_user_logged_in()){
                return sprintf(__('You Need to <a href="%s">Login</a> to see your posts'),wp_login_url(get_permalink()));
            }

            $pagenum = isset( $_GET['pagenum'] ) ? intval( $_GET['pagenum'] ) : 1;

            $args = array(
                'author' => get_current_user_id(),
                'post_status' => array('draft', 'future', 'pending', 'publish'),
                'post_type' => $post_type,
                'posts_per_page' => $number,
                'paged' => $pagenum
            );
            $user_posts = new WP_Query( $args );

            $retVal = '';
            if ( $user_posts->have_posts() ) {

                $retVal = '
                    <div class="row campaign-list-posts__header">
                        <div class="col-md-6">'.__( 'Title', 'lup' ).'</div>
                        <div class="col-md-2">'.__( 'Category', 'lup' ).'</div>
                        <div class="col-md-2">'.__( 'Status', 'lup' ).'</div>
                        <div class="col-md-2">'.__( 'Actions', 'lup' ).'</div>
                    </div>';
                global $post;
                $temp = $post;
                while ($user_posts->have_posts()) {
                    $user_posts->the_post();
                    $delLink = wp_nonce_url( site_url() . "/wp-admin/post.php?action=trash&post=" . $post->ID, 'trash-' . $post->post_type . '_' . $post->ID);
                    $title = $post->post_title;
                    $tax_term = wp_get_post_terms( $post->ID, 'campaign_categories' );
                    $link = '<a href="' . get_permalink() . '" title="' . sprintf(esc_attr__('Permalink to %s', 'lup'), the_title_attribute('echo=0')) . '" rel="bookmark">' . $title . '</a>';
                    $retVal .=
                        '<div class="row campaign-list-posts__body">
                            <div class="col-md-6 campaign-list-posts__post-name">
                                ' . (in_array($post->post_status, array('draft', 'future', 'pending')) ? $title : $link) . '
                            </div>
                            <div class="col-md-2 campaign-list-posts__post-cat">
                                ' . $tax_term[0]->name . '
                            </div>
                            <div class="col-md-2 campaign-list-posts__post-status">
                                ' . $post->post_status . '
                            </div>
                            <div class="col-md-2 campaign-list-posts__post-actions">
                                <a href="/my-account/campaigns/campaigns-edit/?post_id=' . $post->ID . '"><span style="color: #3eaf64;">' . __('Edit', 'lup') . '</span></a>
                                <span>/</span>
                                <a href="' . add_query_arg( 'frontend', 'true', get_delete_post_link( $post->ID ) ) . '" onclick="javascript:if(!confirm(\'Are you sure to delete this post?\')) return false;"><span style="color: 
#e35553;">' . __('Delete', 'lup') . '</span></a>
                            </div>
                        </div>';
                }

                if ($user_posts->found_posts > $number ){
                    $pagination = paginate_links( array(
                            'base' => add_query_arg( 'pagenum', '%#%' ),
                            'format' => '',
                            'prev_text' => __( '&laquo;', 'lup' ),
                            'next_text' => __( '&raquo;', 'lup' ),
                            'total' => $user_posts->max_num_pages,
                            'current' => $pagenum
                        )
                    );
                    if ( $pagination ) {
                        $retVal .= '<div class="pagination">'.$pagination .'</div>';
                    }
                }
                return $retVal;
            }else{
                return  __("No Posts Found");
            }
        }

    }
}
new list_user_posts();