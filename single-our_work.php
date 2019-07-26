<?php
/**
 * Template Our Work posts
 */
?>


<?php get_header(); ?>

    <?php
    if ( have_posts() ){
        while ( have_posts() ){ the_post();?>

            <!-- Headline Section -->
            <div class="headline-section" style='background: url("<?php the_post_thumbnail_url(); ?>") center no-repeat; background-size: cover;'></div>
            <!--End Headline Section -->

            <!-- Main content -->
            <div class="section-wrap our-work-single">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="section-title">
                                <h2 class="section-title-blue"><?php the_title(); ?></h2>
                            </div>
                            <div class="section-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End main content -->

        <?php }
    } ?>

<?php get_footer(); ?>
