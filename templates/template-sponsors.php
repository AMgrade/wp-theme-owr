<?php
/**
 * Template Name: Sponsors page
 */
?>

<?php get_header();

$owr_st_top_background_image = get_field('owr_st_top_background_image');
$content_block = get_field('content_block');

?>

<!-- Headline Section -->
<div class="headline-section sponsor-headline" style='background: url("<?php echo $owr_st_top_background_image['url']; ?>") center no-repeat; background-size: cover;'>
    <div class="sponsor-btn-wrapper">
        <button id="sponsorBtn" class="btn btn-primary owr-btn">Become a Sponsor</button>
    </div>
</div>
<!--End Headline Section -->



<div class="section-wrap sponsors-view-section">
    <div class="container">
        <div class="row">

			<div class="col">
				<div class="section-title">
					<h2 class="section-title-blue"><span class="section-title-dark">Our</span> Sponsors</h2>
				</div>
				<div class="section-content">
					<?php echo $content_block; ?>
				</div><!--End Page content Section -->
			</div>

            <?php if( have_rows('your_sponsors') ):
                // set the id of the element to something unique
                // this id will be needed by JS to append more content
                $total = count(get_field('your_sponsors'));
                $number = 11; // the number of rows to show
                $count = 0; // a counter ?>

                <div id="sponsorsWrap">
                    <div class="row">
                        <?php // loop through the rows of data
                        while ( have_rows('your_sponsors') ) : the_row();
                            $sponsor_image    = get_sub_field('sponsors_image');
                            $sponsors_title   = get_sub_field('sponsors_title');
                            $sponsors_content = get_sub_field('sponsors_content');
                            $sponsors_link    = get_sub_field('sponsor_link'); ?>

                            <div class="col-md-3">
                                <a target="_blank" href="<?php echo $sponsors_link; ?>">
                                    <div class="sponsors-item">
                                        <div class="sponsors-item__image">
                                            <img src="<?php echo $sponsor_image['url']; ?>" alt="<?php echo $sponsor_image['alt']; ?>">
                                        </div>
                                        <div class="sponsors-item__title">
                                            <h4><?php echo $sponsors_title; ?></h4>
                                        </div>
                                        <div class="sponsors-item__content">
                                            <p><?php echo $sponsors_content; ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <?php $count++;
                            if ($count == $number) {
                                // we've shown the number, break out of loop
                                break;
                            } ?>

                        <?php endwhile; ?>

                        <div class="col-md-3" id="sponsors-show-more-link">
                            <a class="load-more" href="javascript: my_repeater_show_more();" <?php
                            if ($total < 11) {
                                ?> style="display: none;"<?php
                            }
                            ?>>
                                <h4 class="load-more__title">
                                    Load More...
                                </h4>
                                <div class="load-more__ellipse">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>

            <?php endif; ?>

        </div>
    </div>
</div>
<!-- Sponsors view section -->

<!-- End sponsors view section -->

<!-- Sponsor section -->
<div id="sponsorsAnchor" class="section-wrap sponsor-section sponsors-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-title">
                    <h2>Sponsor</h2>
                </div>
                <div class="section-content">
                    Do you want to be a sponsor for any of trips? Please fill the form below:
                </div>
                <div class="sponsor-wpar">
                    <?php echo do_shortcode('[contact-form-7 id="238" title="Sponsor contact form"]') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var my_repeater_field_post_id = <?php echo $post->ID; ?>;
    var my_repeater_field_offset = <?php echo $number; ?>;
    var my_repeater_field_nonce = '<?php echo wp_create_nonce('my_repeater_field_nonce'); ?>';
    var my_repeater_ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
    var my_repeater_more = true;

    function my_repeater_show_more() {

        // make ajax request
        jQuery.post(
            my_repeater_ajax_url, {
                // this is the AJAX action we set up in PHP
                'action': 'my_repeater_show_more',
                'post_id': my_repeater_field_post_id,
                'offset': my_repeater_field_offset,
                'nonce': my_repeater_field_nonce
            },
            function (json) {
                // add content to container
                // this ID must match the containter
                // you want to append content to
                jQuery('#sponsorsWrap .row').append(json['content']);
                // update offset
                my_repeater_field_offset = json['offset'];
                // see if there is more, if not then hide the more link
                if (!json['more']) {
                    // this ID must match the id of the show more link
                    jQuery('#sponsors-show-more-link').css('display', 'none');
                }
            },
            'json'
        );
    }

</script>

<?php get_footer(); ?>
