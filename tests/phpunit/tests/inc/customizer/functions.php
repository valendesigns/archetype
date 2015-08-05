<?php
/**
 * Test Customizer functions.
 *
 * @package Archetype
 * @group customizer
 */

class Tests_Customizer_Functions extends WP_UnitTestCase {

	/**
	 * Loads the Customizer import and export scripts.
	 */
	function test_archetype_customize_js() {

		archetype_customize_js();
		$this->assertTrue( wp_script_is( 'archetype_customize' ) );

	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 */
	function test_archetype_customize_preview_js() {

		archetype_customize_preview_js();
		$this->assertTrue( wp_script_is( 'archetype_customize_preview' ) );

	}

	/**
	 * Check that emoji's are removed.
	 */
	function test_archetype_emojis() {

		$this->assertEquals( 7, has_action( 'wp_head', 'print_emoji_detection_script' ) );
		$this->assertEquals( 10, has_action( 'admin_print_scripts', 'print_emoji_detection_script' ) );
		$this->assertEquals( 10, has_action( 'wp_print_styles', 'print_emoji_styles' ) );
		$this->assertEquals( 10, has_action( 'admin_print_styles', 'print_emoji_styles' ) );

		add_filter( 'archetype_default_no_emoji', '__return_true' );
		archetype_emojis();

		$this->assertFalse( has_action( 'wp_head', 'print_emoji_detection_script' ) );
		$this->assertFalse( has_action( 'admin_print_scripts', 'print_emoji_detection_script' ) );
		$this->assertFalse( has_action( 'wp_print_styles', 'print_emoji_styles' ) );
		$this->assertFalse( has_action( 'admin_print_styles', 'print_emoji_styles' ) );

	}

	/**
	 * Filter the Homepage Control title
	 */
	function test_archetype_homepage_control_title() {

		$this->assertEquals( 'Content (1)', archetype_homepage_control_title( 'Archetype Homepage Content 1', 'archetype_homepage_content_1' ) );

	}

	/**
	 * Sanitizes an integer value.
	 */
	function test_archetype_sanitize_integer() {

		$setting = new stdClass();
		$setting->default = 1;

		$this->assertEquals( false, archetype_sanitize_integer( 'help' ) );
		$this->assertEquals( 1, archetype_sanitize_integer( 'help', $setting ) );
		$this->assertEquals( 1, archetype_sanitize_integer( '-1' ) );
		$this->assertEquals( 1, archetype_sanitize_integer( -1 ) );
		$this->assertEquals( 1, archetype_sanitize_integer( '1' ) );
		$this->assertEquals( 1, archetype_sanitize_integer( 1 ) );

	}

	/**
	 * Sanitizes an integer value or return empty.
	 */
	function test_archetype_sanitize_number() {

		$setting = new stdClass();
		$setting->default = '10';

		$this->assertEquals( 0, archetype_sanitize_number( 'help' ) );
		$this->assertEquals( 10, archetype_sanitize_number( 'help', $setting ) );
		$this->assertEquals( -1, archetype_sanitize_number( '-1' ) );
		$this->assertEquals( 1, archetype_sanitize_number( '1' ) );

	}

	/**
	 * Sanitizes a checkbox value.
	 */
	function test_archetype_sanitize_checkbox() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Sanitizes a hex color. Identical to core's sanitize_hex_color(), which is not available on the wp_head hook.
	 */
	function test_archetype_sanitize_hex_color() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Sanitizes choices (selects / radios)
	 */
	function test_archetype_sanitize_choices() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Sanitizes the layout setting
	 */
	function test_archetype_sanitize_layout() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Layout classes
	 */
	function test_archetype_layout_class() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Adjust a hex color brightness
	 */
	function test_archetype_adjust_color_brightness() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

}
