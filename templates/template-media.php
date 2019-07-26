<?php
/**
 * Template Name: Media Page
 */
?>

<?php get_header();

$owr_top_background_image_media = get_field( 'top_background_image_media', $post_id );
$owr_top_title_headline_media   = get_field( 'top_title_headline_media', $post_id );

?>

<!-- Creates the bootstrap modal where the image will appear -->
<!-- Modal -->
<div class="modal fade" id="imageGalleryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="header-info">
            <div class="slider-index">
                <span></span>
            </div>
            <div class="close-button">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>Close</span>
                </button>
            </div>
        </div>
        <div class="modal-content">
            <div class="modal-body">
                <div id="photoSlider">
                    <?php

                    // check if the repeater field has rows of data
                    if( have_rows('photo_gallery', 'option') ):

                        // loop through the rows of data
                        while ( have_rows('photo_gallery', 'option') ) : the_row();
                            $photo_src = get_sub_field('photo');
                            $url = $photo_src['url'];
                            $alt = $photo_src['alt'];
                            $size = 'large';
                            $thumb = $photo_src['sizes'][ $size ]; ?>

                            <img class="slider-image" src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" />

                        <?php endwhile;

                    endif;

                    ?>
                </div>
                <div class="arrows next-arrow"></div>
                <div class="arrows prev-arrow"></div>
            </div>
        </div>
        <div class="footer-content">
            <div id="photoSliderBot">
                <?php

                // check if the repeater field has rows of data
                if( have_rows('photo_gallery', 'option') ):

                    // loop through the rows of data
                    while ( have_rows('photo_gallery', 'option') ) : the_row();
                        $photo_src = get_sub_field('photo');
                        $url = $photo_src['url'];
                        $alt = $photo_src['alt'];
                        $size = 'thumbnail';
                        $thumb = $photo_src['sizes'][ $size ]; ?>

                        <div class="mini-slide-photo-wrap" style="height: 70px;">
                            <img class="mini-slide-photo" src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>">
                        </div>

                    <?php endwhile;

                endif;

                ?>
            </div>
            <div class="arrows-mini next-arrow-mini"></div>
            <div class="arrows-mini prev-arrow-mini"></div>
        </div>
    </div>
</div>

<!-- Headline Section -->
<div class="headline-section" style='background: url("<?php echo $owr_top_background_image_media['url']; ?>") center no-repeat; background-size: cover;'>
    <!-- Begin Headline text -->
    <div class="headline-text-wrap">
        <div class="headline-text">
            <h1><?php echo $owr_top_title_headline_media; ?></h1>
        </div>
    </div><!-- End Headline text -->
</div><!--End Headline Section -->

<!--Media gallery Section -->
<div class="section-wrap media-gallery-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-title">
                    <h2>Media <span class="section-title-blue">Gallery</span></h2>
                </div>
                <div class="single-article-title">
                    <div class="title-wrap">
                        <h1>Photos</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="photo-gallery-wrap">

            <div class="flexbin flexbin-margin">
                <?php global $post_id;

                // check if the repeater field has rows of data
                if( have_rows('photo_gallery', 'option') ):
                    $i = 0;

                    // loop through the rows of data
                    while ( have_rows('photo_gallery', 'option') ) : the_row();
                        $photo_src = get_sub_field('photo');
                        $url = $photo_src['url'];
                        $alt = $photo_src['alt'];
                        $size = 'medium';
                        $thumb = $photo_src['sizes'][ $size ];
                        $photo_short_description = get_sub_field('photo_short_description'); ?>

                        <div>
                            <img data-value="<?php echo get_row_index(); ?>" class="popup-photo-image" src="<?php echo $thumb; ?>" alt="" />
                            <div class="overlay">
                                <?php echo $photo_short_description; ?>
                            </div>
                        </div>

                    <?php endwhile;

                endif;

                ?>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>