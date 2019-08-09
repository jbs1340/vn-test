<?php
/**
 * Template Name: Single Custom
 */
die;
get_header(); ?>

    <section id="primary" class="content-area col-sm-12 col-lg-12 col-md-12">
        <main id="main" class="site-main" role="main">
            <h1>55</h1>
            <?php
            while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/content-custom', get_post_format() );

                the_post_navigation();

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </section><!-- #primary -->

<?php
get_sidebar();
get_footer();
