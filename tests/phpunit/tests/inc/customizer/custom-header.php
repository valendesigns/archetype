<?php
/**
 * Test Customizer custom header.
 *
 * @package Archetype
 * @group customizer
 */

class Tests_Customizer_Custom_Header extends WP_UnitTestCase {

	/**
	 * Check that the WordPress core custom header feature is setup.
	 */
	function test_archetype_custom_header_setup() {

		archetype_custom_header_setup();
		$this->assertTrue( current_theme_supports( 'custom-header' ) );

	}

}
