<?php

/**
 * Template Campaign category
 */

get_header();

$term             = $wp_query->get_queried_object();
$term_name        = $term->name;
$term_id          = $term->term_id;
$owr_cat_thumb_id = get_field( 'category_image', $term->taxonomy . '_' . $term_id, false);
$size             = 'full';
$owr_cat_thumb    = wp_get_attachment_image_src($owr_cat_thumb_id, $size);
$term_description = $term->description;
$term_title       = get_field( 'category_title', $term->taxonomy . '_' . $term_id); ?>

<div class="section-wrap campaign-cat-section">
    <div class="container">
        <div class="row category-page-header">
            <div class="col-md-6">
                <div class="campaign-cat-section__title">
                    <h1><?php echo $term_title; ?></h1>
                </div>
                <div class="campaign-cat-section__cat-name">
                    <?php echo $term_name; ?>
                </div>
                <div class="campaign-cat-section__description">
                    <?php echo $term_description; ?>
                </div>
                <div class="campaign-cat-section__button">
                    <a href="/sign-up-volunteer/" class="btn owr-btn">create your campaign</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="campaign-cat-section__cat-thumb" style="background: url('<?php echo $owr_cat_thumb[0]; ?>') center no-repeat;"></div>
            </div>
        </div>
        <div class="row category-page-items-wrapper">
            <div class="col-md-12 section-title">
                <h2>Trending in <span class="section-title-blue"><?php echo $term_name . " fundraising";  ?></span></h2>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <?php if ( have_posts() ) :

                        /* Start the Loop */
                        while ( have_posts() ) : the_post();

                        $owr_client_location = get_field('owr_client_location');
                        $owr_client_current_money = get_field('owr_client_current_money');
                        $owr_client_total_money = get_field('owr_client_total_money');
                        $current_percent = floor(($owr_client_current_money/$owr_client_total_money) * 100);
                        $title = get_the_title();

                        ?>

                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="category-item">
                                        <div class="category-item__thumb" style="background: url('<?php echo get_the_post_thumbnail_url( $post->ID, 'large' ); ?>') center no-repeat"></div>
                                        <div class="category-item__body">
                                            <div class="category-item__title">
                                                <h2><?php do_excerpt_symbols($title,25); ?></h2>
                                            </div>
                                            <div class="category-item__location">
                                                <?php echo $owr_client_location; ?>
                                            </div>
                                            <div class="category-item__description">
                                                <?php the_content(); ?>
                                            </div>
                                            <!-- Progress bar section -->
                                            <div class="product-section__progress-bar category-item__progress-bar">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="progress-wrapper">
                                                            <div class="progress-price">
                                                                <span class="current-price">$ <?php echo $owr_client_current_money; ?></span>
                                                                <span class="all-price">of $<?php echo $owr_client_total_money; ?> raised</span>
                                                            </div>
                                                            <div class="progress">
                                                                <div id="<?php echo 'progressBar-' . get_the_ID(); ?>" class="progress-bar" role="progressbar"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- End Progress bar section -->
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <script>
                                var valueNow = parseFloat(<?php echo $current_percent; ?>).toFixed();
                                $("<?php echo '#progressBar-' . get_the_ID(); ?>").css('width', valueNow + '%');
                            </script>

                        <?php endwhile;

                    endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
