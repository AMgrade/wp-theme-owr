<?php
/**
 * Template Name: V-TRIPS page
 */
?>

<?php get_header();
global $post;
$owr_header_image = get_field('header_image');
$owr_top_button_name = get_field( 'owr_top_button_name', $post_id );
$top_button_link = get_field( 'top_button_link', $post_id );

?>

<!-- Headline Section -->
<div class="headline-section button-wrap" style="background: url('<?php echo $owr_header_image['url']; ?>') center no-repeat; background-size: cover;">
    <a href="<?php echo $top_button_link; ?>" class="btn btn-primary owr-btn"><?php echo $owr_top_button_name; ?></a>
</div>
<!--End Headline Section -->

<!-- V-Trips section -->
<div class="section-wrap stories-section v-trips-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-title">
                    <h2>V-Trips</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
            $args = array(
                'post_type'             => 'product',
                'post_status'           => 'publish',
                'ignore_sticky_posts'   => 1,
                'posts_per_page'        => 9,
                'tax_query'             => array(
                    array(
                        'taxonomy'      => 'product_cat',
                        'field'         => 'slug',
                        'terms'         => 'v-trip',
                        'operator'      => 'IN'
                    )),
                'order' => 'DESC',
                'orderby' => 'date',
                'paged' => $paged
            );

            $old_query = $wp_query;
            $wp_query = new WP_Query( $args );

            $big = 999999999;
            $paged_v_trips = array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $wp_query->max_num_pages,
                'prev_text' => (''),
                'next_text' => (''),
                'mid_size' => 1,
                'end_size' => 1,
            );

            while ( have_posts() ) : the_post();
                $_product = wc_get_product( $post->ID );
                $v_trips_item_thumb = get_the_post_thumbnail_url( $post->ID, 'large' );
                $sub_title_trip = get_field('titile_trip');
                $product_excerpt = $_product->post->post_excerpt; ?>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <a href="<?php echo get_permalink(); ?>">
                        <div class="v-trips-item">
                            <div class="v-trips-item__header" style="background: url('<?php echo $v_trips_item_thumb; ?>') center no-repeat; background-size: cover;">
                                <div class="v-trips-item__price">
                                    <?php echo get_woocommerce_currency_symbol() . ' ' . $_product->get_price(); ?>
                                </div>
                            </div>
                            <div class="v-trips-item__body">
                                <div class="v-trips-item__title">
                                    <?php the_title(); ?>
                                </div>
                                <div class="v-trips-item__sub-title">
                                    <?php echo $sub_title_trip; ?>
                                </div>
                                <div class="v-trips-item__content">
                                    <?php do_excerpt_symbols($product_excerpt, '80') ?>
                                </div>
                                <div class="v-trips-item__button">
                                    <!--<a href="/v-trips/?add-to-cart=<?php /*echo $post->ID */?>" data-quantity="1" class="btn btn-primary owr-btn product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php /*echo $post->ID */?>" data-product_sku="" aria-label="<?php /*echo $post->post_title */?>" rel="nofollow">Add to cart</a>-->
                                    <a href="<?php echo get_permalink(); ?>" class="btn btn-primary owr-btn">Find out more</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            <?php endwhile;
            $wp_query = $old_query;
            ?>

        </div>
        <div class="row">
            <!-- Post navigation -->
            <?php if( paginate_links( $paged_v_trips ) ) { ?>
                <div class="stories-navigation v-trips-navigation">
                    <?php echo paginate_links( $paged_v_trips ); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>


<?php get_footer(); ?>