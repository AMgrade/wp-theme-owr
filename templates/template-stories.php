<?php
/**
 * Template Name: Stories page
 */
?>


<?php get_header();

$owr_st_top_background_image = get_field('owr_st_top_background_image');

?>

<!-- Headline Section -->
<div class="headline-section" style='background: url("<?php echo $owr_st_top_background_image['url']; ?>") center no-repeat; background-size: cover;'></div>
<!--End Headline Section -->

<!-- Stories section -->
<div class="section-wrap stories-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-title">
                    <h2>Stories</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
            $args = array(
                'post_type' => 'stories',
                'posts_per_page' => '3',
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
                $description = get_field('owr_st_except');
                $thumbnail = get_the_post_thumbnail_url();
                $select_preview = get_field('select_preview');
                $owr_st_video_file = get_field('owr_st_video_file');
                $owr_st_video_url = get_field('owr_st_video_url');
                $owr_st_featured_image = get_field('owr_st_featured_image');
                $owr_st_autor_foto = get_field('owr_st_autor_foto');
                $owr_st_autor_name = get_field('owr_st_autor_name'); ?>

                <div class="col-md-12">
                    <div class="stories-item">
                        <div class="row">
                            <div class="col-md-12 col-lg-7">
                                <div class="stories-header">
                                    <div class="row justify-content-between">
                                        <div class="col-sm-8 col-md-8">
                                            <div class="stories-title">
                                                <h2><?php the_title(); ?></h2>
                                                <div class="post-date">
                                                    <?php echo get_the_date('M j Y'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4">
                                            <div class="stories-autor-wrapper">
                                                <div class="row justify-content-end align-items-center no-gutters">
                                                    <div class="col-sm-7 col-md-6">
                                                        <div class="autor-name">
                                                            <?php echo $owr_st_autor_name; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-5 col-md-4">
                                                        <div class="autor-foto">
                                                            <img src="<?php echo $owr_st_autor_foto['url'] ?>" alt="<?php echo $owr_st_autor_foto['alt'] ?>">
                                                        </div>
                                                    </div>
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
                                        <div class="thumb-wrap" style="background: url(' <?php echo $owr_st_featured_image['url']; ?> ') center no-repeat; background-size: cover"></div>
                                    <?php elseif( $select_preview == 'videofile' ) : ?>
                                        <div class="video-file-wrap">
                                            <button id="playVideo" type="button"></button>
                                            <button id="pauseVideo" type="button"></button>
                                            <video style="background: url('<?php echo $thumbnail; ?>') center no-repeat; background-size: cover" id="videoControls" class="video-file" aria-controls="" loop preload="none"">
                                                <source src="<?php echo $owr_st_video_file['url']; ?>" type="video/mp4">
                                            </video>
                                        </div>
                                    <?php elseif( $select_preview == 'videourl' ) : ?>
                                        <div class="embed-container">
                                            <?php echo $owr_st_video_url; ?>
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
            <?php if( paginate_links( $paged_stories ) ) { ?>
                <div class="stories-navigation">
                    <?php echo paginate_links( $paged_stories ); ?>
                </div>
            <?php } ?>

        </div>
        <!-- Story form -->
        <div class="row">
            <div class="col-md-12">
                <div class="story-wrap-form">
                    <button type="button" id="storyBtnForm" class="btn btn-primary owr-btn story-btn">Tell us your story</button>
                    <?php echo do_shortcode('[contact-form-7 id="172" title="Stories contact form"]') ?>
                </div>
            </div>
        </div><!-- End Story form -->
        <!-- CF7 popup -->
        <div class="modal" id="storyModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        Thanks for telling us your story!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary owr-btn modal-owr-btn" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Stories section -->

<?php get_footer(); ?>

