<?php
/**
 * Template Name: Sponsor, current mission page
 */
?>

<?php get_header();

/*$owr_current_head_video = get_field('owr_current_head_video');
$owr_current_video_image_preview = get_field('owr_current_video_image_preview');*/
$owr_ab_video_url = get_field('owr_ab_video_url');

$owr_current_title = get_field('owr_current_title');
$owr_current_text = get_field('owr_current_text');
$owr_current_money = get_field('owr_client_current_money');
$owr_total_money = get_field('owr_total_money');
$owr_progress_bar_descr = get_field('owr_progress_bar_descr');

$current_percent = floor(($owr_current_money/$owr_total_money) * 100);

?>
<!-- Current mission section -->
<div class="section-wrap current-mission-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-title">
                    <h2>Help Us <span class="section-title-blue">do more</span></h2>
                </div>
                <!-- Headline Section -->
                <div class="headline-section">
                    <div class="media-preview-wrap">
                        <!--<div class="video-file-wrap">
                            <button id="playVideo" type="button"></button>
                            <button id="pauseVideo" type="button"></button>
                            <video id="videoControls" class="video-file" aria-controls="" loop preload="none" style="background: url('<?php /*echo $owr_current_video_image_preview['url']; */?>') center no-repeat; background-size: cover">
                                <source src="<?php /*echo $owr_current_head_video['url']; */?>" type="video/mp4">
                            </video>
                        </div>-->
                        <div class="embed-container">
                            <?php echo $owr_ab_video_url; ?>
                        </div>
                    </div>
                </div>
                <div class="single-article-title">
                    <div class="title-wrap">
                        <h1><?php echo $owr_current_title; ?></h1>
                    </div>
                </div>
                <div class="section-content">
                    <?php echo $owr_current_text; ?>
                </div>
            </div>
        </div>
        <!-- Progress bar section -->
        <div class="row">
            <div class="col">
                <div class="progress-wrapper">
                    <div class="progress-price">
                        <span class="current-price">$ <?php echo $owr_current_money; ?></span>
                        <span class="all-price">of $<?php echo $owr_total_money; ?> raised</span>
                    </div>
                    <div class="progress">
                        <div id="progressBar" class="progress-bar" role="progressbar" ></div>
                    </div>
                    <div class="section-content"><?php echo $owr_progress_bar_descr; ?></div>
                </div>
            </div>
        </div><!-- End Progress bar section -->
    </div>
    <!-- Donate section -->
    <div class="section-wrap efforts-section">
        <div class="container">

            <?php if( have_rows('eforts_boxes') ): ?>

                <div class="row">
                    <div class="col">
                        <div class="section-title">
                            <h2>Efforts</h2>
                        </div>
                    </div>
                </div>
                <div class="row">

                <?php while( have_rows('eforts_boxes') ): the_row();

                    $title = get_sub_field('title');
                    $description = get_sub_field('description');
                    $link = get_sub_field('link');

                    ?>

                    <div class="col-lg-4">
                        <a href="<?php echo $link; ?>" class="link-block">
                            <span class="title"><?php echo $title; ?></span>
                            <span class="hidden-description">
                                <?php echo $description; ?>
                            </span>
                        </a>
                    </div>

                <?php endwhile; ?>

                </div>

            <?php endif; ?>

        </div>
    </div>
    <!-- Donate section -->
    <div class="section-wrap donate-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-title">
                        <h2>Donate</h2>
                    </div>
                    <div class="section-content">
                        You are welcome to donate for one of our trips:
                    </div>
                    <!-- Donate PayPal form -->
                    <div class="donate-wrap">
                        <?php get_template_part( 'templates/content', 'donate' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Volunteer section -->
    <div class="section-wrap volunteer-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-title">
                        <h2>Volunteer</h2>
                    </div>
                    <div class="section-content">
                        Please select the name of one trip you want to volunteer to help on:
                    </div>
                    <div class="volunteer-wpar">
                        <?php echo do_shortcode('[contact-form-7 id="233" title="Volunteer contact form"]') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sponsor section -->
    <!--<div class="section-wrap sponsor-section">
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
                        <?php /*echo do_shortcode('[contact-form-7 id="238" title="Sponsor contact form"]') */?>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
</div>

<script>
    var valueNow = parseFloat(<?php echo $current_percent; ?>).toFixed();
    $('#progressBar').css('width', valueNow + '%');
</script>

<?php get_footer(); ?>
