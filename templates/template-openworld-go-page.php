<?php

/**
 * Template Name: Campaign categories
 */

get_header();

$campTerms = get_terms('campaign_categories', array('hide_empty' => 0, 'parent' =>0));
$owr_top_background_image = get_field( 'owr_top_background_image', $post_id );
$owr_top_button_name = get_field( 'owr_top_button_name', $post_id );
$top_button_link = get_field( 'top_button_link', $post_id );

?>

<!-- Headline Section -->
<div class="headline-section button-wrap" style='background: url("<?php echo $owr_top_background_image['url']; ?>") center no-repeat; background-size: cover;'>
    <!--<a href="<?php /*echo $top_button_link; */?>" class="btn btn-primary owr-btn"><?php /*echo $owr_top_button_name; */?></a>-->
</div><!--End Headline Section -->

<div class="section-wrap campaign-cats-section campaign-cat-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <!--<div class="section-title">
                    <h2>Fundraising <span class="section-title-blue">categories</span></h2>
                </div>
                <div class="section-subtitle-content">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </div>-->
                <div class="section-button text-center">
                    <a href="/sign-up-volunteer/" class="btn btn-primary owr-btn">Help Us Fundraise</a>
                </div>
            </div>
        </div>

        <div class="row category-page-items-wrapper">
            <div class="col-md-12">
                <div class="section-title">
                    <h2>Top <span class="section-title-blue">Campaigns</span></h2>
                </div>
                <div class="row">
                    <?php
                    $the_query = new WP_Query(array(
                        'posts_per_page' => 9,
                        'meta_key'	=> 'owr_client_current_money',
                        'orderby'	=> 'meta_value_num',
                        'order'		=> 'DESC',
                        'post_type' => 'campaign',
                        'suppress_filters' => true,
                    ));

                    if( $the_query->have_posts() ): ?>
                        <?php while( $the_query->have_posts() ) : $the_query->the_post();

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
                        endif;
                    wp_reset_query(); ?>
                </div>
            </div>
        </div>

        <!--<div class="row campaign-cats-section__categories">
            <?php /*foreach($campTerms as $campTerm) :
                $owr_cat_thumb_id = get_field( 'category_image', $campTerm->taxonomy . '_' . $campTerm->term_id, false);
                $size = 'large';
                $owr_cat_thumb = wp_get_attachment_image_src($owr_cat_thumb_id, $size); */?>
                <div class="col-sm-6 col-md-4">
                    <div class="categories__item">
                        <a href="<?php /*echo get_term_link( $campTerm->slug, $campTerm->taxonomy ); */?>">
                            <div class="categories__item-image-wrap" style="background: url('<?php /*echo $owr_cat_thumb[0]; */?>') center no-repeat;"></div>
                            <div class="categories__item-cat-name">
                                <?php /*echo $campTerm->name; */?>
                            </div>
                        </a>
                    </div>
                </div>
            <?php
/*            endforeach; */?>
        </div>-->
    </div>
</div>

<?php get_footer();