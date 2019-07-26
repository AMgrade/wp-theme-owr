</div><!--end .page-content-->

</div> <!--end .content-->

<footer class="footer">

    <?php
    $owr_footer_logo                   = get_field('owr_footer_logo', 'option');
    $owr_footer_description            = get_field('owr_footer_description', 'option');
    $owr_footer_copyright              = get_field('owr_footer_copyright', 'option');
    $owr_footer_contact_form_title     = get_field('owr_footer_contact_form_title', 'option');
    $owr_footer_contact_form_shortcode = get_field('owr_footer_contact_form_shortcode', 'option') ;
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="logo-wrap">
                    <img src="<?php echo $owr_footer_logo['url'] ?>" alt="<?php echo $owr_footer_logo['alt'] ?>">
                </div>
                <div class="footer-description">
                    <p><?php echo $owr_footer_description; ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="footer-form-wrap">
                    <div class="row">
                        <div class="col">
                            <div class="footer-form-title">
                                <h3><?php echo $owr_footer_contact_form_title; ?></h3>
                            </div>
                        </div>
                    </div>
                    <?php echo do_shortcode($owr_footer_contact_form_shortcode) ?>
                    <div class="social-items">
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
            </div>
        </div>
        <div class="copyright-wrap">
            <div class="copyright">
                <p><?php echo $owr_footer_copyright; ?> &copy; <?php echo get_the_date('Y'); ?></p>
            </div>
            <div class="hub">
                <a href="https://hubfuelinc.com/"><img src="/wp-content/themes/owr/assets/img/footer-hub.png" alt=""></a>
                <p>Powered by HubFuel</br>
                    <a href="https://hubfuelinc.com/" style="color: #fff">Hubfuelinc.com</a></p>
            </div>
        </div>
    </div>

</footer><!--end footer-->

<?php wp_footer(); ?>
</body>
</html>
