<?php
/**
 * Test Custom Header functions.
 *
 * @package Archetype
 * @group customizer
 */

class Tests_Custom_Header_Functions extends WP_UnitTestCase {

	/**
	 * Check that the WordPress core custom header feature is setup.
	 */
	function test_archetype_custom_header_setup() {

		archetype_custom_header_setup();
		$this->assertTrue( current_theme_supports( 'custom-header' ) );

	}

}
