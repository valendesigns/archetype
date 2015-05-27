<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package archetype
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header>
					<h1 class="page-title"><?php _e( '404', 'archetype' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<h2><?php _e( 'Oops!', 'archetype' ); ?></h2>

					<p><?php _e( 'The page you\'re looking for could not be found. Try searching.', 'archetype' ); ?></p>

					<div class="error-404-search">
						<?php get_search_form(); ?>
					</div>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
