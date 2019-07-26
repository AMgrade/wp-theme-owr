<?php get_header(); ?>

    <div class="section-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <?php do_action( 'woocommerce_account_navigation' ); ?>
                </div>
                <div class="col-md-8">
                    <?php cp_edit_post_form(); ?>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>