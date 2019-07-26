<?php
/**
 * Template Name: About Page
 */
?>

<?php get_header();

$owr_oh_text = get_field('owr_oh_text');
/*$owr_about_head_video = get_field('owr_about_head_video');
$owr_about_video_image_preview = get_field('owr_about_video_image_preview');*/
$owr_ab_video_url = get_field('owr_ab_video_url');

?>

<div class="container">
    <!-- Our History Section -->
    <div class="section-wrap our-history-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-title">
                        <h2>Our <span class="section-title-blue">history</span></h2>
                    </div>
                    <!-- Headline Section -->
                    <div class="headline-section">
                        <div class="media-preview-wrap">
                            <!--<div class="video-file-wrap">
                                <button id="playVideo" type="button"></button>
                                <button id="pauseVideo" type="button"></button>
                                <video id="videoControls" class="video-file" aria-controls="" loop preload="none" style="background: url('<?php /*echo $owr_about_video_image_preview['url']; */?>') center no-repeat; background-size: cover">
                                    <source src="<?php /*echo $owr_about_head_video['url']; */?>" type="video/mp4">
                                </video>
                            </div>-->
                            <div class="embed-container">
                                <?php echo $owr_ab_video_url; ?>
                            </div>
                        </div>
                    </div>
                    <!--End Headline Section -->

                    <!-- Page content Section -->
                    <div class="about-description">
                        <?php echo $owr_oh_text; ?>
                    </div><!--End Page content Section -->
                </div>
            </div>
        </div>
    </div><!-- End Our History Section -->

    <!-- Our Team Section -->
    <div class="section-wrap our-team-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-title">
                        <h2>Our <span class="section-title-blue">team</span></h2>
                    </div>
                </div>
            </div>
            <div class="team-members-wrap">
                <div class="row justify-content-center">
                    <?php if( have_rows('owr_team_members_info') ):

                        while ( have_rows('owr_team_members_info') ) : the_row();
                            $owr_team_foto = get_sub_field('owr_team_foto');
                            $owr_team_first_name = get_sub_field('owr_team_first_name');
                            $owr_team_last_name = get_sub_field('owr_team_last_name');
                            $owr_team_position = get_sub_field('owr_team_position');
                            $owr_team_description = get_sub_field('owr_team_description');
                            $owr_linkedin_profile_link = get_sub_field('owr_linkedin_profile_link')?>

                            <div class="col-md-6 col-lg-4">
                                <div class="team-member">
                                    <div class="member-foto" style="background: url('<?php echo $owr_team_foto['url'] ?>') no-repeat; background-size: cover">
                                    <!--<img src="<?php /*echo $owr_team_foto['url'] */?>" alt="<?php /*echo $owr_team_foto['alt'] */?>">-->
                                    </div>
                                    <div class="member-name">
                                        <span class="name"><?php echo $owr_team_first_name; ?></span>
                                        <span class="name"><?php echo $owr_team_last_name; ?></span>
                                        <span class="position"><?php echo $owr_team_position; ?></span>
                                    </div>
                                    <div class="member-info">
                                        <div class="member-name">
                                            <span class="name"><?php echo $owr_team_first_name; ?></span>
                                            <span class="name"><?php echo $owr_team_last_name; ?></span>
                                            <span class="position"><?php echo $owr_team_position; ?></span>
                                        </div>
                                        <div class="member-description">
                                            <?php do_excerpt_symbols( $owr_team_description,220 ); ?>
                                        </div>
                                        <div class="linkendin-btn-wrap">
                                            <a class="linkedin-btn" href="<?php echo $owr_linkedin_profile_link; ?>"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile;

                    endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="section-title">
                        <h2>Advisory <span class="section-title-blue">Board</span></h2>
                    </div>
                </div>
            </div>
            <div class="team-members-wrap">
                <div class="row justify-content-center">
                    <?php if( have_rows('advisory_board_info') ):

                        while ( have_rows('advisory_board_info') ) : the_row();
                            $owr_team_foto = get_sub_field('photo');
                            $owr_team_first_name = get_sub_field('first_name');
                            $owr_team_last_name = get_sub_field('last_name');
                            $owr_team_position = get_sub_field('position');
                            $owr_team_description = get_sub_field('description');
                            $owr_linkedin_profile_link = get_sub_field('linkedin_profile_link')?>

                            <div class="col-md-6 col-lg-4">
                                <div class="team-member">
                                    <div class="member-foto" style="background: url('<?php echo $owr_team_foto['url'] ?>') no-repeat; background-size: cover">
                                        <!--<img src="<?php /*echo $owr_team_foto['url'] */?>" alt="<?php /*echo $owr_team_foto['alt'] */?>">-->
                                    </div>
                                    <div class="member-name">
                                        <span class="name"><?php echo $owr_team_first_name; ?></span>
                                        <span class="name"><?php echo $owr_team_last_name; ?></span>
                                        <span class="position"><?php echo $owr_team_position; ?></span>
                                    </div>
                                    <div class="member-info">
                                        <div class="member-name">
                                            <span class="name"><?php echo $owr_team_first_name; ?></span>
                                            <span class="name"><?php echo $owr_team_last_name; ?></span>
                                            <span class="position"><?php echo $owr_team_position; ?></span>
                                        </div>
                                        <div class="member-description">
                                            <?php do_excerpt_symbols( $owr_team_description,220 ); ?>
                                        </div>
                                        <div class="linkendin-btn-wrap">
                                            <a class="linkedin-btn" href="<?php echo $owr_linkedin_profile_link; ?>"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile;

                    endif; ?>
                </div>
            </div>
        </div>
    </div><!-- End Our Team Section -->

</div>

<?php get_footer(); ?>
