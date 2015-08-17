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
	 * Check that WooCommerce is activated.
	 */
	function test_is_woocommerce_activated() {

		$this->assertTrue( is_woocommerce_activated() );

	}

	/**
	 * Check that Subscribe & Connect is activated.
	 */
	function test_is_subscribe_and_connect_activated() {

		$this->assertTrue( is_subscribe_and_connect_activated() );

	}

}
