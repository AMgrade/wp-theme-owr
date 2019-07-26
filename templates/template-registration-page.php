<?php session_start();
/**
 * Template Name: Registration template
 */

get_header('register'); ?>

    <div class="section-wrap sign-in-section sign-up-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-title text-center">
                        <h2>Sign up <span class="section-title-blue">volunteers</span></h2>
                    </div>
                    <?php if( !is_user_logged_in() ) {
                        vb_registration_form(); ?>
                        <div class="help-message">
                            Do you already have an account? <a href="/sign-in/">Sign in here.</a>
                        </div>
                    <?php } else { ?>
                        <p class="logout-text">You are already logged in. Do you want to log out?</p>
                        <a class="btn owr-btn logout-btn" href="<?php echo home_url('/wp-login.php?action=logout') ?>">Logout</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

<?php get_footer();