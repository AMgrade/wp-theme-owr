<?php
/**
 * Template Name: Login template
 */

get_header('register'); ?>

    <div class="section-wrap sign-in-section">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="section-title">
                        <h2>Sign <span class="section-title-blue">In</span></h2>
                    </div>
                </div>
            </div>
            <?php if( !is_user_logged_in() ) {
                wp_login_form( array('redirect' => '/my-account/') ); ?>
                <div class="or-line">
                    or
                </div>
                <div class="social-buttons">
                    <a href="<?php echo home_url('/wp-login.php?loginSocial=facebook') ?>" class="social_login" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="facebook" data-popupwidth="475" data-popupheight="175">
                        <img src="/wp-content/themes/owr/assets/img/continue-facebook.svg" alt="" />
                    </a>
                    <a href="<?php echo home_url('/wp-login.php?loginSocial=google') ?>" class="social_login" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="google" data-popupwidth="600" data-popupheight="600">
                        <img src="/wp-content/themes/owr/assets/img/continue-google.svg" alt="" />
                    </a>
                </div>
                <div class="forget-password">
                    <a href="<?php echo wp_lostpassword_url(); ?>">Forget Password?</a>
                </div>
            <?php } else { ?>
                <p class="logout-text">You are already logged in. Do you want to log out?</p>
                <a class="btn owr-btn logout-btn" href="<?php echo home_url('/wp-login.php?action=logout') ?>">Logout</a>
            <?php } ?>
        </div>
    </div>

<?php get_footer();