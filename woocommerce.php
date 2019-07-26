<?php get_header();
global $product;
do_action('woocommerce_before_single_product'); ?>

<!-- Products section -->
<div class="section-wrap product-section">
    <div class="container">
        <div class="row">

            <?php if( is_singular( 'product' ) ) {

                while(have_posts()) : the_post();
                    $_product = wc_get_product( get_the_ID() );
                    $product_thumb = get_the_post_thumbnail_url( $post->ID, 'large' );
                    $sub_title_product = get_field('titile_trip', $post->ID);
                    $owr_ab_video_url = get_field('owr_ab_video_url');
                    $current_share_url = urlencode(get_permalink());
                    $current_share_title = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?>

                    <div class="col-lg-7 bottom-order">
                        <div class="product-section__left">
                            <div class="product-section__title">
                                <h1><?php the_title(); ?></h1>
                            </div>
                            <div class="product-section__subtitle">
                                <?php echo $sub_title_product; ?>
                            </div>
                            <div class="product-section__content">
                                <?php the_content(); ?>
                            </div>
                            <div class="product-section__photo-gallery photo-gallery-wrap top-line">
                                <div class="product-section__title">
                                    Photos
                                </div>
                                <div class="flexbin flexbin-margin">
                                    <?php

                                    if( have_rows('product_photo_gallery') ):

                                        while ( have_rows('product_photo_gallery') ) : the_row();

                                            $photo_src = get_sub_field('photo');
                                            $url = $photo_src['url'];
                                            $alt = $photo_src['alt'];
                                            $size = 'medium';
                                            $thumb = $photo_src['sizes'][ $size ]; ?>

                                            <div>
                                                <img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" />
                                            </div>

                                        <?php endwhile;

                                    endif;

                                    ?>
                                </div>
                            </div>
                            <div class="product-section__video media-preview-wrap top-line">
                                <div class="product-section__title">
                                    Video
                                </div>
                                <div class="embed-container">
                                    <?php echo $owr_ab_video_url; ?>
                                </div>
                            </div>
                            <div class="product-section__reviews top-line">
                                <?php get_template_part( 'templates/content', 'comments' ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 top-order" id="sidebar">
                        <div class="product-section__right">
                            <div class="product-section__product-thumb">
                                <img src="<?php echo $product_thumb; ?>" alt="">
                            </div>
                            <div class="product-section__product-price-wrap">
                                <form action="<?php echo $product->add_to_cart_url() ?>" class="cart" method="post" enctype="multipart/form-data">
                                    <div class="product-price-wrap__price">
                                        <span class="label">Price</span>
                                        <span class="text"><?php echo get_woocommerce_currency_symbol() . ' ' . $product->get_price(); ?></span>
                                    </div>
                                    <div class="product-price-wrap__quantity">
                                        <span class="label">Quantity</span>
                                        <span class="text"><?php echo woocommerce_quantity_input( array(), $product, false ); ?></span>
                                    </div>
                                    <div class="product-price-wrap__add-to-cart">
                                        <button style="background-color: #E0E0E0;
    border-color: #E0E0E0;" type="submit" class="btn btn-primary owr-btn" disabled><?php echo $product->add_to_cart_text(); ?></button>
                                    </div>
                                </form>
                            </div>
                            <ul class="product-section__share-buttons">
                                <?php get_template_part( 'templates/content', 'social_share' ); ?>
                            </ul>
                        </div>
                    </div>

                <?php endwhile;
            } ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>