<?php
/**
 * The template for displaying all single posts.
 *
 * @package archetype
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
			do_action( 'archetype_single_post_before' );

			get_template_part( 'content', 'single' );

			/**
			 * @hooked archetype_post_navigation - 10
			 */
			do_action( 'archetype_single_post_after' );
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php do_action( 'archetype_sidebar' ); ?>
<?php get_footer(); ?>