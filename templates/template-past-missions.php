<?php
/**
 * Template Name: Past missions page
 */
?>

<?php get_header();

$owr_st_top_background_image = get_field('owr_st_top_background_image');

?>

<!-- Headline Section -->
<div class="headline-section" style='background: url("<?php echo $owr_st_top_background_image['url']; ?>") center no-repeat; background-size: cover;'></div>
<!--End Headline Section -->

<!-- Past missions section -->
<div class="section-wrap stories-section missions-sections">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-title">
                    <div class="section-title">
                        <h2>Past <span class="section-title-blue">Missions</span></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
            $args = array(
                'post_type' => 'past_missions',
                'posts_per_page' => '5',
                'order' => 'DESC',
                'orderby' => 'date',
                'paged' => $paged
            );
            $old_query = $wp_query;
            $wp_query = new WP_Query( $args );

            $big = 999999999;
            $paged_stories = array(
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
                $description = get_field('owr_pm_except');
                $thumbnail = get_the_post_thumbnail_url();
                $select_preview = get_field('select_preview');
                $owr_pm_video_file = get_field('owr_pm_video_file');
                $owr_pm_video_url = get_field('owr_pm_video_url');
                $owr_pm_featured_image = get_field('owr_pm_featured_image'); ?>

                <div class="col-md-12">
                    <div class="stories-item">
                        <div class="row">
                            <div class="col-md-12 col-lg-7">
                                <div class="stories-header">
                                    <div class="row justify-content-between">
                                        <div class="col-sm-12">
                                            <div class="stories-title">
                                                <h2><?php the_title(); ?></h2>
                                                <div class="post-date">
                                                    <?php echo get_the_date('M j Y'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="stories-except">
                                    <?php do_excerpt_symbols( $description,450 ); ?>
                                </div>
                                <div class="learn-more">
                                    <a href="<?php echo get_permalink() ?>">Learn more</a>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-5">
                                <div class="media-preview-wrap">
                                    <?php if( $select_preview == 'image' ) : ?>
                                        <div class="thumb-wrap" style="background: url(' <?php echo $owr_pm_featured_image['url']; ?> ') center no-repeat; background-size: cover"></div>
                                    <?php elseif( $select_preview == 'videofile' ) : ?>
                                        <div class="video-file-wrap">
                                            <button id="playVideo" type="button"></button>
                                            <button id="pauseVideo" type="button"></button>
                                            <video id="videoControls" width="470" height="215" class="video-file" aria-controls="" loop>
                                                <source src="<?php echo $owr_pm_video_file['url']; ?>" type="video/mp4">
                                            </video>
                                        </div>
                                    <?php elseif( $select_preview == 'videourl' ) : ?>
                                        <div class="embed-container">
                                            <?php echo $owr_pm_video_url; ?>
                                        </div>
                                    <?php elseif( $select_preview == null ) : ?>
                                        <div class="thumb-wrap" style="background: url(' <?php echo $thumbnail; ?> ') center no-repeat; background-size: cover"></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endwhile;
            $wp_query = $old_query;
            ?>

            <!-- Post navigation -->
            <div class="stories-navigation">
                <?php echo paginate_links( $paged_stories ) ?>
            </div>

        </div>
    </div>
</div><!-- End Past missions section -->

<?php get_footer(); ?>
