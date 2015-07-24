<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Archetype
 */

do_action( 'archetype_get_header' ); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			/**
			 * Default hooks
			 *
			 * @hooked archetype_archive_header - 10
			 */
			do_action( 'archetype_archive_before' );

			get_template_part( 'loop' );

			do_action( 'archetype_archive_after' );

		else :

			get_template_part( 'content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php do_action( 'archetype_get_sidebar' ); ?>
<?php do_action( 'archetype_get_footer' ); ?>
