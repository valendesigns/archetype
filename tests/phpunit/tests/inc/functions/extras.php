<?php
/**
 * Test extras related functions
 *
 * @package Archetype
 * @group extras
 */
class Tests_Extras extends WP_UnitTestCase {

	/**
	 * Check that the Customizer is enabled and the filter works.
	 */
	function test_is_archetype_customizer_enabled() {

		// Defaults a `true` return value.
		$this->assertTrue( is_archetype_customizer_enabled() );

		// Test that the filter return `true`.
		add_filter( 'archetype_customizer_enabled', '__return_true' );
		$this->assertTrue( is_archetype_customizer_enabled() );

		// Test that the filter return `false`.
		add_filter( 'archetype_customizer_enabled', '__return_false' );
		$this->assertFalse( is_archetype_customizer_enabled() );

		// Test that the filter returns `false` for an empty string.
		add_filter( 'archetype_customizer_enabled', '__return_empty_string' );
		$this->assertFalse( is_archetype_customizer_enabled() );

	}

	/**
	 * Check that the home link is added to `wp_page_menu_args`.
	 */
	function test_archetype_page_menu_args() {

		// Filter the args
		add_filter( 'wp_page_menu_args', 'archetype_page_menu_args' );

		// Expected value.
		$expected = '<div class="menu"><ul><li ><a href="http://example.org/">Home</a></li></ul></div>' . "\n";

		// Get the menu markup post filter.
		$menu = wp_page_menu( array( 'echo' => false ) );

		// Test that the values are equal.
		$this->assertSame( $expected, $menu );

	}

	/**
	 * Check that Archetype custom classes are added to the body.
	 */
	function test_archetype_body_classes() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Check that WooCommerce is or is not activated.
	 */
	function test_is_woocommerce_activated() {

		// @todo Add this dependancy for testing WooCommerce.
		$this->assertFalse( class_exists( 'woocommerce', false ) );

	}

	/**
	 * Check that the Schema type is correct for the context.
	 */
	function test_archetype_html_tag_schema() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Check that `true` is returned when the blog has more than 1 category.
	 */
	function test_archetype_categorized_blog() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Check that the transients is flushed.
	 */
	function test_archetype_category_transient_flusher() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Check that the markup in `get_search_form()` is replaced.
	 */
	function test_archetype_post_search_form() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Check that HEX is converted to RGB.
	 */
	function test_archetype_rgb_from_hex() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

}
