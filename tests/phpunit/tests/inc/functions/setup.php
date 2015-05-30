<?php
/**
 * Test setup related functions
 *
 * @package Archetype
 * @group setup
 */
class Tests_Setup extends WP_UnitTestCase {

	/**
	 * Check that `$content_width` is set correctly.
	 */
	function test_archetype_content_width() {
		global $content_width;

		$this->assertEquals( 784, $content_width );

	}

	/**
	 * Check that the current version of WordPress is compatible with Archetype.
	 */
	function test_archetype_back_compat() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Check that 'Archetype' equals the current theme name.
	 */
	function test_archetype_theme_name() {

		$this->assertEquals( 'Archetype', wp_get_theme()->Name );

	}

	/**
	 * Check that the `$archetype_version` global equals the current theme version.
	 */
	function test_archetype_theme_version() {
		global $archetype_version;

		$this->assertEquals( $archetype_version, wp_get_theme()->Version );

	}

	/**
	 * Check for theme defaults and registered support for various WordPress features.
	 */
	function test_archetype_setup() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Check that widgets are registed.
	 */
	function test_archetype_widgets_init() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Check that scripts and styles are enqueued.
	 */
	function test_archetype_scripts() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Check that background images are added to the post navigation via `wp_add_inline_style`.
	 */
	function test_archetype_post_nav_background() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

}
