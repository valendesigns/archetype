<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Archetype
 */

do_action( 'archetype_get_header' ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				do_action( 'archetype_page_before' );
				?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
				/**
				 * Default hooks
				 *
				 * @hooked archetype_display_comments - 10
				 */
				do_action( 'archetype_page_after' );
				?>

			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php do_action( 'archetype_get_sidebar' ); ?>
<?php do_action( 'archetype_get_footer' ); ?>
