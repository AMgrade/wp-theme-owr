<?php get_header(); ?>

    <div class="container">
        <div class="search-wrapper">
            <?php if ( have_posts() ) : ?>

                <header class="page-header">
                    <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'webcap' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                </header>

                <?php while ( have_posts() ) : the_post();

                    get_template_part( 'templates/content', 'search' );

                endwhile;
                else :

                    get_template_part( 'templates/content', 'none' );

            endif;?>
        </div>
    </div>

<?php get_footer(); ?>