<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Archetype
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> <?php archetype_html_tag_schema(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<?php
	/**
	 * Default hooks
	 *
	 * @hooked archetype_skip_links - 0
	 */
	do_action( 'archetype_before_header' ); ?>

	<header id="masthead" class="site-header" role="banner" <?php if ( get_header_image() != '' ) { echo 'style="background-image: url(' . esc_url( get_header_image() ) . ');"'; } ?>>

		<?php
		/**
		 * Default hooks
		 *
		 * @hooked archetype_social_icons - 10
		 * @hooked archetype_site_header - 20
		 * @hooked archetype_primary_navigation - 30
		 */
		do_action( 'archetype_header' ); ?>

	</header><!-- #masthead -->

	<?php do_action( 'archetype_after_header' ); ?>

	<?php
	/**
	 * Default hooks
	 *
	 * @hooked archetype_header_widget_region - 10
	 */
	do_action( 'archetype_before_content' ); ?>

	<div id="content" class="site-content" tabindex="-1">
		<div class="col-full">

		<?php
		/**
		 * Default hooks
		 *
		 * @hooked woocommerce_breadcrumb - 10
		 */
		do_action( 'archetype_content_top' ); ?>
