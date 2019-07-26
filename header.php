<!doctype html>
<html <?php language_attributes(); ?> >
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="theme-color" content="#ffffff">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="content content-wrap">
    <?php
    //based on template
    $template_file = get_post_meta( get_queried_object_id(), '_wp_page_template', true );
    if( $template_file != 'templates/template-sponsor.php' && !is_singular( 'campaign' ) ) {
    $owr_donate_paypal_email  = get_field('owr_donate_paypal_email', 'option');
    $owr_donate_use_sandbox   = get_field('owr_donate_use_sandbox', 'option');
    ?>

    <form target="paypal" action="<?php if(!$owr_donate_use_sandbox){echo 'https://www.paypal.com/cgi-bin/webscr';}else{ echo 'https://www.sandbox.paypal.com/cgi-bin/webscr';} ?>" method="post" name="myform" style="position: absolute">
        <!-- If using a Business or Company Logo Graphic, include the "cpp_header_image" variable in your View Cart code. -->
        <input type="hidden" name="cpp_header_image"
               value="https://pbs.twimg.com/profile_images/932350418918633472/_stJ_IZk_400x400.jpg">
        <input type="hidden" name="on0" value="Donation Amount">
        <button class="btn btn-primary owr-btn sticky-btn donate-owr-btn">Donate</button>

        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        <input type="hidden" name="cmd" value="_donations">
        <!-- Replace "business" value with your PayPal Email Address or Account ID -->
        <input type="hidden" name="business" value="<?php echo $owr_donate_paypal_email; ?>">
        <input type="hidden" name="item_number" value="WF-0-00">
        <input type="hidden" id="itemNamePayPal" name="item_name" value="">
        <input type="hidden" name="amount" value="0.00">
        <input type="hidden" name="no_shipping" value="2">
        <input type="hidden" name="no_note" value="1">
        <input type="hidden" name="tax" value="0">
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="lc" value="US">
        <!-- Replace value with the web page you want the customer to return to after a successful transaction -->
        <input type="hidden" name="return" value="<?php echo esc_url( home_url( '/current-mission/' ) ); ?>">
        <!-- Replace value with the web page you want the customer to return to after item cancellation -->
        <input type="hidden" name="cancel_return" value="<?php echo esc_url( home_url( '/current-mission/' ) ); ?>">
        <!-- Replace with page for parse request -->
        <input type="hidden" name="notify_url"
               value="<?php echo esc_url( home_url( '/wp-admin/admin-post.php?action=paypal_donate' ) ); ?>">
        <input type="hidden" name="button_subtype" value="products">
        <input type="hidden" name="no_note" value="0">
        <input type="hidden" name="cn" value="Add special instructions to the seller:">
        <input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHosted">
    </form>
    <?php }
    ?>

    <?php $owr_header_logo = get_field('owr_header_logo', 'option') ?>

    <!-- Header -->
    <header class="header">
        <!-- Begin menu -->
        <div class="menu-top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <nav class="navbar navbar-expand-xl">
                            <div class="logo-wrap">
                                <a class="navbar-brand" href="<?php echo home_url();  ?>"><img src="<?php echo $owr_header_logo['url'] ?>" alt="<?php echo $owr_header_logo['alt'] ?>"></a>
                            </div>
                            <div class="nav-item social-item-icon__mobile">
                                <ul class="social-icon-wrap">
                                    <?php if( !is_user_logged_in() ) {
                                        do_action('owr_shop_cart');
                                    } else { ?>
                                        <?php do_action('owr_shop_cart'); ?>
                                        <li class="social-icon sign-in-user">
                                            <?php
                                            if ( current_user_can( 'administrator' ) || current_user_can( 'volunteer' ) ) { ?>
                                                <a href="/wp-admin/"></a>
                                            <?php } else { ?>
                                                <a href="/my-account/"></a>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <button id="nav-icon2" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                                <span class="navbar-toggler-icon"></span>
                                <span class="navbar-toggler-icon"></span>
                                <span class="navbar-toggler-icon"></span>
                                <span class="navbar-toggler-icon"></span>
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse menu-top-wrap" id="navbarSupportedContent">
                                <div id="mobileSearch" class="search-input-wrapper mobile-search">
                                    <?php get_search_form(); ?>
                                </div>
                                <?php wp_nav_menu(array(
                                    'menu' => 'Main Menu',
                                    'container_id' => 'mobileMenu',
                                    'walker' => new CSS_Menu_Walker()
                                )); ?>
                                <div class="nav-item social-item-icon">
                                    <ul class="social-icon-wrap desctop">
                                        <li id="searchIcon" class="social-icon search-icon"></li>
                                        <div id="desctopSearch" class="search-input-wrapper">
                                            <?php get_search_form(); ?>
                                        </div>
                                        <?php if( !is_user_logged_in() ) {
                                            do_action('owr_shop_cart');
                                        } else { ?>
                                            <?php do_action('owr_shop_cart'); ?>
                                            <li class="social-icon sign-in-user">
                                                <?php
                                                if ( current_user_can( 'administrator' ) ) { ?>
                                                    <a href="/wp-admin/"></a>
                                                <?php } else { ?>
                                                    <a href="/my-account/"></a>
                                                <?php } ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                    <div class="sign-group-buttons">
                                        <?php if( !is_user_logged_in() ) { ?>
                                            <a href="/sign-up-volunteer/" class="btn owr-btn sign-up-btn">sign up</a>
                                            <a href="/sign-in/" class="btn owr-btn sign-in-btn">sign in</a>
                                        <?php } else { ?>
                                            <a href="<?php echo home_url('/wp-login.php?action=logout') ?>" class="btn owr-btn sign-in-btn">Logout</a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="mobile-social-icons-wrap">
                                    <ul>
                                        <?php
                                        $owr_facebook_link  = get_field('owr_facebook_link', 'option');
                                        $owr_twitter_link   = get_field('owr_twitter_link', 'option');
                                        $owr_instagram_link = get_field('owr_instagram_link', 'option');
                                        $owr_linkendin_link = get_field('owr_linkendin_link', 'option');
                                        ?>
                                        <?php if($owr_facebook_link) : ?>
                                            <li class="social-icon facebook-icon"><a target="_blank" href="<?php echo $owr_facebook_link; ?>"></a></li>
                                        <?php endif; ?>
                                        <?php if($owr_twitter_link) : ?>
                                            <li class="social-icon twitter-icon"><a target="_blank" href="<?php echo $owr_twitter_link; ?>"></a></li>
                                        <?php endif; ?>
                                        <?php if($owr_instagram_link) : ?>
                                            <li class="social-icon instagram-icon"><a target="_blank" href="<?php echo $owr_instagram_link; ?>"></a></li>
                                        <?php endif; ?>
                                        <?php if($owr_linkendin_link) : ?>
                                            <!--<li class="social-icon linkendin-icon"><a target="_blank" href="<?php /*echo $owr_linkendin_link; */?>"></a></li>-->
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div> <!-- End menu -->
    </header> <!-- End header -->
    <div class="page-content">
