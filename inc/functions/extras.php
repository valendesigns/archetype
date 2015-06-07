<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * @package Archetype
 * @subpackage Functions
 * @since 1.0.0
 */

/**
 * Check whether the Archetype Customizer settings ar enabled
 *
 * @since 1.0.0
 *
 * @return boolean
 */
function is_archetype_customizer_enabled() {
	return (bool) apply_filters( 'archetype_customizer_enabled', true );
}

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since 1.0.0
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function archetype_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @since 1.0.0
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function archetype_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-wc-breadcrumb when WooCommerce isn't activated or has been filtered off.
	if ( ! function_exists( 'woocommerce_breadcrumb' ) || false == archetype_sanitize_checkbox( get_theme_mod( 'archetype_breadcrumb_toggle', true ) ) ) {
		$classes[]	= 'no-wc-breadcrumb';
	}

	// Add full width 404.
	if ( is_404() ) {
		$classes[]	= 'archetype-full-width-content';
	}

	/**
	 * What is this?!
	 *
	 * Take the blue pill, close this file and forget you saw the following code.
	 * Or take the red pill, filter `archetype_make_me_cute` and see how deep the rabbit hole goes...
	 *
	 * @since 1.0.0
	 */
	$cute = apply_filters( 'archetype_make_me_cute', false );
	if ( true === $cute ) {
		$classes[] = 'archetype-cute';
	}

	// 4 out of 12 columns.
	if ( 4 == get_theme_mod( 'archetype_columns', apply_filters( 'archetype_default_columns', '3' ) ) ) {
		$classes[] = 'grid-alt';
	}

	// Full width.
	if ( 1 === archetype_sanitize_checkbox( get_theme_mod( 'archetype_full_width', apply_filters( 'archetype_default_full_width', false ) ) ) ) {
		$classes[] = 'is-full-width';
	}

	// Boxed.
	if ( 1 === archetype_sanitize_checkbox( get_theme_mod( 'archetype_boxed', apply_filters( 'archetype_default_boxed', false ) ) ) ) {
		$classes[] = 'is-boxed';
	}

	// Padding.
	if ( 1 === archetype_sanitize_checkbox( get_theme_mod( 'archetype_padded', apply_filters( 'archetype_default_padded', true ) ) ) ) {
		$classes[] = 'is-padded';
	}

	return $classes;
}

if ( ! function_exists( 'is_woocommerce_activated' ) ) :
	/**
	 * Query WooCommerce activation
	 *
	 * @since 1.0.0
	 */
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce', false ) ? true : false;
	}
endif;

if ( ! function_exists( 'is_homepage_control_activated' ) ) :
	/**
	 * Query Homepage Control activation
	 *
	 * @since 1.0.0
	 */
	function is_homepage_control_activated() {
		return class_exists( 'Homepage_Control', false ) ? true : false;
	}
endif;

/**
 * Schema type
 *
 * @since 1.0.0
 *
 * @param bool $echo Whether to eco or return.
 * @return string
 */
function archetype_html_tag_schema( $echo = true ) {
	$schema  = 'http://schema.org/';
	$type    = 'WebPage';

	if ( is_singular( 'post' ) ) { // Is single post.
		$type = 'Article';
	} elseif ( is_author() ) { // Is author page.
		$type = 'ProfilePage';
	} elseif ( is_search() ) { // Is search results page.
		$type = 'SearchResultsPage';
	}

	$content = 'itemscope="itemscope" itemtype="' . esc_attr( $schema ) . esc_attr( $type ) . '"';

	if ( $echo ) {
		echo $content;
	} else {
		return $content;
	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @since 1.0.0
 *
 * @return bool
 */
function archetype_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'archetype_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'archetype_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so archetype_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so archetype_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in archetype_categorized_blog.
 *
 * @since 1.0.0
 */
function archetype_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'archetype_categories' );
}
add_action( 'edit_category', 'archetype_category_transient_flusher' );
add_action( 'save_post',     'archetype_category_transient_flusher' );

if ( ! function_exists( 'archetype_post_search_form' ) ) :
	/**
	 * Replaces `get_search_form()` with post only search.
	 *
	 * @since 1.0.0
	 *
	 * @param string $form The form markup.
	 * @return string
	 */
	function archetype_post_search_form( $form ) {
		if ( true === apply_filters( 'archetype_post_search_form', true ) ) {
			$form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
				<label>
					<span class="screen-reader-text">' . _x( 'Search for:', 'label', 'archetype' ) . '</span>
					<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder', 'archetype' ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Search for:', 'label', 'archetype' ) . '" />
				</label>
				<input type="submit" class="search-submit" value="'. esc_attr_x( 'Search', 'submit button', 'archetype' ) .'" />
				<input type="hidden" name="post_type" value="post" />
			</form>';
		}
		return $form;
	}
endif;

if ( ! function_exists( 'archetype_rgb_from_hex' ) ) :
	/**
	 * Converts HEX to RGB
	 *
	 * @since 1.0.0
	 *
	 * @param string $hex The hexidecimal color code.
	 * @param string $color Set to r, g, or b to return a specific color.
	 * @return mixed An array of color values or a single color when $color is set. False when it can't be converted.
	 */
	function archetype_rgb_from_hex( $hex, $color = '' ) {

		$hex = str_replace( '#', '', $hex );

		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ).substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ).substr( $hex, 2, 1 ) );
		} else if ( strlen( $hex ) == 6 ) {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		} else {
			return false;
		}

		$rgb = array();
		$rgb['r'] = $r;
		$rgb['g'] = $g;
		$rgb['b'] = $b;

		if ( isset( $rgb[ $color ] ) ) {
			return $rgb[ $color ];
		}

		return $rgb;
	}
endif;
