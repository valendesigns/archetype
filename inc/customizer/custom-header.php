<?php
/**
 * Implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Archetype
 * @subpackage Customize
 * @since 1.0.0
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses archetype_header_style()
 * @uses archetype_admin_header_style()
 * @uses archetype_admin_header_image()
 *
 * @since 1.0.0
 */
function archetype_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'archetype_custom_header_args', array(
		'default-image' => '',
		'header-text' 	=> false,
		'width' 				=> 1920,
		'height'				=> 240,
		'flex-width'		=> true,
		'flex-height' 	=> true,
	) ) );
}
