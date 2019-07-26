<?php
/**
 * Template Past Missions posts
 */
?>


<?php get_header(); ?>

<?php
if ( have_posts() ){
    while ( have_posts() ){ the_post(); ?>

        <div class="single-past-missions-article">
            <!-- Headline Section -->
            <div class="headline-section" style='background: url("<?php the_post_thumbnail_url(); ?>") center no-repeat; background-size: cover;'></div>
            <!--End Headline Section -->

            <!-- Main content -->
            <div class="section-wrap story-single-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="single-article-title">
                                <div class="title-wrap">
                                    <h1><?php the_title(); ?></h1>
                                </div>
                                <div class="post-date">
                                    <?php echo get_the_date('M j Y'); ?>
                                </div>
                            </div>
                            <div class="section-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End main content -->
        </div>

    <?php }
} ?>

<?php get_footer(); ?>
