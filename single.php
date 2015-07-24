<?php
/**
 * The template for displaying all single posts.
 *
 * @package Archetype
 */

do_action( 'archetype_get_header' ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
			do_action( 'archetype_single_post_before' );

			get_template_part( 'content', 'single' );

			/**
			 * Default hooks
			 *
			 * @hooked archetype_post_navigation - 10
			 */
			do_action( 'archetype_single_post_after' );
			?>

		<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php do_action( 'archetype_get_sidebar' ); ?>
<?php do_action( 'archetype_get_footer' ); ?>
