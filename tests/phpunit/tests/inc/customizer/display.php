<?php
/**
 * Test Customizer display.
 *
 * @package Archetype
 * @group customizer
 */

class Tests_Customizer_Display extends WP_UnitTestCase {

	/**
	 * Test the color filters.
	 */
	function archetype_default_color() {
		return '#000000';
	}

	/**
	 * Check that Customizer CSS is empty wothout theme mods.
	 */
	function test_archetype_add_customize_css() {

		do_action( 'wp_enqueue_scripts' );
		$this->assertFalse( wp_styles()->print_inline_style( 'archetype-style', false ) );

	}

	/**
	 * Check that boxed background is filtered.
	 */
	function test_archetype_default_boxed_background_color() {

		add_filter( 'archetype_default_boxed_background_color', array( $this, 'archetype_default_color' ) );
		do_action( 'wp_enqueue_scripts' );
		$this->assertContains( '.is-boxed .site {background-color:#000000;}', wp_styles()->print_inline_style( 'archetype-style', false ) );

	}

	/**
	 * Check that text color is filtered.
	 */
	function test_archetype_default_text_color() {

		add_filter( 'archetype_default_text_color', array( $this, 'archetype_default_color' ) );
		do_action( 'wp_enqueue_scripts' );
		$styles = wp_styles()->print_inline_style( 'archetype-style', false );
		$this->assertContains( '.widget-area .widget a {color:#000000;}', $styles );
		$this->assertContains( '.is-padded .post-navigation a:hover {box-shadow:5px 0px 0px #000000 inset;}', $styles );
		$this->assertContains( '.bx-controls-direction .bx-next:hover {background-color:#000000;}', $styles );
		$this->assertContains( '.widget h3.widget-title {border-color:#000000;}', $styles );

	}

	/**
	 * Check that heading color is filtered.
	 */
	function test_archetype_default_heading_color() {

		add_filter( 'archetype_default_heading_color', array( $this, 'archetype_default_color' ) );
		do_action( 'wp_enqueue_scripts' );
		$styles = wp_styles()->print_inline_style( 'archetype-style', false );
		$this->assertContains( '.hentry .entry-header h1 a {color:#000000;}', $styles );
		$this->assertContains( '.hentry .entry-header h1 a:hover {border-color:#000000;}', $styles );

	}

	/**
	 * Check that link color is filtered.
	 */
	function test_archetype_default_link_color() {

		add_filter( 'archetype_default_link_color', array( $this, 'archetype_default_color' ) );
		do_action( 'wp_enqueue_scripts' );
		$styles = wp_styles()->print_inline_style( 'archetype-style', false );
		$this->assertContains( 'widget-area .widget a:hover {color:#000000;}', $styles );
		$this->assertContains( '.added_to_cart:focus {outline-color:#000000;}', $styles );
		$this->assertContains( '.error-404 h1 {border-color:#000000;}', $styles );

	}

}
