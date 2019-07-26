<?php
/**
 * Template Stories posts
 */
?>


<?php get_header(); ?>

<?php
if ( have_posts() ){
    while ( have_posts() ){ the_post();
        $owr_st_autor_foto = get_field('owr_st_autor_foto');
        $owr_st_autor_name = get_field('owr_st_autor_name'); ?>

        <div class="single-story-article">
            <!-- Headline Section -->
            <div class="headline-section" style='background: url("<?php the_post_thumbnail_url(); ?>") center no-repeat; background-size: cover;'>
                <div class="autor-wrap">
                    <div class="autor-foto">
                        <img src="<?php echo $owr_st_autor_foto['url']; ?>" alt="<?php echo $owr_st_autor_foto['alt']; ?>">
                    </div>
                    <div class="autor-name">
                        <?php echo $owr_st_autor_name; ?>
                    </div>
                </div>
            </div>
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
