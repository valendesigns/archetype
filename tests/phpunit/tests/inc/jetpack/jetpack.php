<?php
/**
 * Test Jetpack functions.
 *
 * @package Archetype
 * @group customizer
 */

class Tests_Jetpack_Functions extends WP_UnitTestCase {

	/**
	 * Check that Jetpack features are setup.
	 */
	function test_archetype_custom_header_setup() {

		archetype_jetpack_setup();
		$this->assertTrue( current_theme_supports( 'site-logo' ) );
		$this->assertTrue( current_theme_supports( 'infinite-scroll' ) );

	}

}
