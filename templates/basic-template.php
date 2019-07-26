<?php
/**
 * Template Name: Basic Page template
 */

get_header();
$select_preview = get_field('select_preview');
$owr_st_video_url = get_field('owr_st_video_url');
$owr_st_featured_image = get_field('owr_st_featured_image');
$owr_st_page_title = get_field('owr_st_page_title'); ?>

<!-- Headline Section -->
<?php if( $select_preview == 'image' ) : ?>
<div class="headline-section" style='background: url("<?php echo $owr_st_featured_image['url']; ?>") center no-repeat; background-size: cover;'></div>
<?php endif; ?>
<!--End Headline Section -->

<div class="container">
    <!-- Our History Section -->
    <div class="section-wrap our-history-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-title">
                        <h2><?php echo $owr_st_page_title; ?></h2>
                    </div>
                    <?php if( $select_preview == 'videourl' ) : ?>
                    <!-- Headline Section -->
                    <div class="headline-section">
                        <div class="media-preview-wrap">
                            <div class="embed-container">
                                <?php echo $owr_st_video_url; ?>
                            </div>
                        </div>
                    </div>
                    <!--End Headline Section -->
                    <?php endif; ?>
                    <?php while(have_posts()) : the_post(); ?>
                        <div class="section-content">
                            <?php the_content();?>
                        </div><!--End Page content Section -->
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
