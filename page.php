<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package archetype
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

      <?php while ( have_posts() ) : the_post(); ?>

        <?php
        do_action( 'archetype_page_before' );
        ?>

        <?php get_template_part( 'content', 'page' ); ?>

        <?php
        /**
         * @hooked archetype_display_comments - 10
         */
        do_action( 'archetype_page_after' );
        ?>

      <?php endwhile; // end of the loop. ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php do_action( 'archetype_sidebar' ); ?>
<?php get_footer(); ?>
