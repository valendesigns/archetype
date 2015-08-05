<?php
/**
 * Jetpack Compatibility File
 *
 * @link http://jetpack.me/
 *
 * @package Archetype
 */

if ( ! function_exists( 'archetype_jetpack_setup' ) ) :
	/**
	 * Setup Jetpack theme support.
	 *
	 * @since 1.0.0
	 */
	function archetype_jetpack_setup() {
		/*
		 * Add theme support for Site Logo.
		 *
		 * @link http://jetpack.me/support/site-logo/
		 */
		add_theme_support( 'site-logo', array(
			'size'      => 'full'
		) );

		/*
		 * Add theme support for Infinite Scroll.
		 *
		 * @link http://jetpack.me/support/infinite-scroll/
		 */
		add_theme_support( 'infinite-scroll', array(
			'container' => 'main',
			'footer'    => 'page',
		) );
	}
endif;

add_action( 'after_setup_theme', 'archetype_jetpack_setup' );
