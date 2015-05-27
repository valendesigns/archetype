<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. 
 * To change the order or toggle these components use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage
 *
 * @package archetype
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			/**
			 * @hooked archetype_homepage_hero - 0
			 * @hooked archetype_homepage_content - 10
			 * @hooked archetype_homepage_custom_content - 20
			 * @hooked archetype_product_categories - 30
			 * @hooked archetype_recent_products - 40
			 * @hooked archetype_featured_products - 50
			 * @hooked archetype_popular_products - 60
			 * @hooked archetype_on_sale_products - 70
			 * @hooked archetype_homepage_custom_content_alt - 80
			 */
			do_action( 'homepage' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
