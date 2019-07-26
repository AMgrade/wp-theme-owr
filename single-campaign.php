<?php

/**
 * Template Campaign posts
 */

get_header();
global $post;

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        $owr_client_current_money = get_field('owr_client_current_money');
        $owr_client_total_money = get_field('owr_client_total_money');
        if( $owr_client_current_money && $owr_client_total_money ) {
            $current_percent = floor(($owr_client_current_money/$owr_client_total_money) * 100);
        }

        $owr_client_location = get_field('owr_client_location');

        $campaign_cat = get_the_terms( $post->ID, 'campaign_categories' );
        $campaign_cat_name = $campaign_cat[0]->name;


        $author_id = get_the_author_meta('ID');
        $author_image = get_field('profile_image', 'user_'. $author_id );
        $author_fname = get_the_author_meta('first_name');
        $author_lname = get_the_author_meta('last_name');
        $author_full_name = '';
        if( empty($author_fname)){
            $author_full_name = $author_lname;
        } elseif( empty( $author_lname )){
            $author_full_name = $author_fname;
        } else {
            $author_full_name = "{$author_fname} {$author_lname}";
        } ?>

        <!-- Main content -->
        <div class="section-wrap product-section campaign-single-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 bottom-order">
                        <div class="product-section__left">
                            <div class="product-section__title">
                                <h1><?php the_title(); ?></h1>
                            </div>
                            <div class="product-section__content">
                                <?php the_content(); ?>
                            </div>
                            <div class="product-section__reviews top-line">
                                <?php get_template_part( 'templates/content', 'comments' ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 top-order" id="sidebar">
                        <div class="product-section__right">
                            <div class="product-section__product-thumb">
                                <img src="<?php echo get_the_post_thumbnail_url( $post->ID, 'large' ); ?>" alt="">
                            </div>
                            <!-- Progress bar section -->
                            <div class="product-section__progress-bar">
                                <div class="row">
                                    <div class="col">
                                        <div class="progress-wrapper">
                                            <div class="progress-price">
                                                <span class="current-price">$ <?php echo $owr_client_current_money; ?></span>
                                                <span class="all-price">of $<?php echo $owr_client_total_money; ?> raised</span>
                                            </div>
                                            <div class="progress">
                                                <div id="progressBar" class="progress-bar" role="progressbar" ></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Progress bar section -->
                            <!-- Donate PayPal form -->
                            <div class="product-section__donate-wrap">
                                <?php get_template_part( 'templates/donate', 'campaign' ); ?>
                            </div>
                            <div class="product-section__author-info">
                                <div class="author-info__post-date-created">
                                    <?php echo 'Created ' . get_the_date('F j, Y'); ?>
                                </div>
                                <div class="author-info__wrap">
                                    <div class="author-info__image">
                                        <?php if ($author_image) { ?>
                                            <img style="width: 70px; height: 70px; object-fit: cover" src="<?php echo $author_image['url']; ?>" alt="<?php echo $author_image['alt']; ?>" />
                                        <?php } elseif ( get_avatar( get_the_author_meta( 'ID' ), 70 ) !== false ) {
                                            echo get_avatar( get_the_author_meta( 'ID' ), 70 );
                                        } else { ?>
                                            <img src="/wp-content/themes/owr/assets/img/no-profile-pic.png">
                                        <?php } ?>
                                    </div>
                                    <div class="author-info__bio">
                                        <span class="name"><?php echo $author_full_name; ?></span>
                                        <span class="category"><?php echo $campaign_cat_name; ?></span>
                                        <span class="location"><?php echo $owr_client_location; ?></span>
                                    </div>
                                </div>
                            </div>
							<div class="share-title">
								Share Now
							</div>
                            <ul class="product-section__share-buttons">
                                <?php get_template_part( 'templates/content', 'social_share' ); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End main content -->

        <script>
            var valueNow = parseFloat(<?php echo $current_percent; ?>).toFixed();
            $('#progressBar').css('width', valueNow + '%');
        </script>

    <?php endwhile;
endif;

get_footer(); ?>