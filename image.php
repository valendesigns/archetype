<?php
/**
 * The template for displaying images.
 *
 * @package Archetype
 */

do_action( 'archetype_get_header' ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
			/**
			 * Default hooks
			 *
			 * @hooked archetype_image_navigation - 10
			 */
			do_action( 'archetype_single_image_before' );

			get_template_part( 'content', 'image-attachment' );

			/**
			 * Default hooks
			 *
			 * @hooked archetype_post_navigation - 10
			 * @hooked archetype_display_comments - 20
			 */
			do_action( 'archetype_single_image_after' );
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php do_action( 'archetype_get_sidebar' ); ?>
<?php do_action( 'archetype_get_footer' ); ?>
