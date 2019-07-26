<?php get_header(); ?>

    <div class="section-wrap">
        <?php if ( is_cart() ) { ?>
        <div class="container cart-wrap">
        <?php } else { ?>
        <div class="container">
        <?php }

            while (have_posts()) : the_post(); ?>

                <?php the_content(); ?>

            <?php endwhile; ?>

        </div>
    </div>

<?php get_footer(); ?>