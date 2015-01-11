<?php
/**
 * The template for displaying images.
 *
 * @package archetype
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

      <?php
      /**
       * @hooked archetype_image_navigation - 10
       */
      do_action( 'archetype_single_image_before' );

      get_template_part( 'content', 'image' );
      
      /**
       * @hooked archetype_post_navigation - 10
       * @hooked archetype_display_comments - 20
       */
      do_action( 'archetype_single_image_after' );
      ?>

    <?php endwhile; // end of the loop. ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php do_action( 'archetype_sidebar' ); ?>
<?php get_footer(); ?>
