<?php
/**
 * The template for displaying full width pages.
 *
 * Template Name: Full width
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

<?php get_footer(); ?>
