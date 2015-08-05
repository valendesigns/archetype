<?php
/**
 * Jetpack Compatibility File
 *
 * @link http://jetpack.me/
 *
 * @package Archetype
 */

/**
 * Add theme support for Infinite Scroll.
 *
 * @link http://jetpack.me/support/infinite-scroll/
 *
 * @since 1.0.0
 * @codeCoverageIgnore
 */
function archetype_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'archetype_jetpack_setup' );
