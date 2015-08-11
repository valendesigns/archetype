<?php
/**
 * Custom template tags for this theme.
 *
 * @package Archetype
 * @subpackage Template_Tags
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_get_header' ) ) :
	/**
	 * Display header template.
	 *
	 * @since 1.0.0
	 */
	function archetype_get_header() {
		get_header();
	}
endif;

if ( ! function_exists( 'archetype_get_sidebar' ) ) :
	/**
	 * Display sidebar template.
	 *
	 * @uses get_sidebar()
	 *
	 * @since 1.0.0
	 */
	function archetype_get_sidebar() {
		get_sidebar();
	}
endif;

if ( ! function_exists( 'archetype_get_footer' ) ) :
	/**
	 * Display footer template.
	 *
	 * @since 1.0.0
	 */
	function archetype_get_footer() {
		get_footer();
	}
endif;
