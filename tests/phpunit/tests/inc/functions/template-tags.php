<?php
/**
 * Test Template Tag functions.
 *
 * @package Archetype
 * @group template-tags
 */

class Tests_Template_Tags extends WP_UnitTestCase {

	/**
	 * Check that the the header is loaded.
	 */
	function test_archetype_get_header() {

		ob_start();
		archetype_get_header();
		$buffer = ob_get_contents();
		ob_end_clean();

		$this->assertEquals( 1, did_action( 'archetype_header' ) );

	}

	/**
	 * Check that the the sidebar is loaded.
	 */
	function test_archetype_get_sidebar() {

		ob_start();
		archetype_get_sidebar();
		$buffer = ob_get_contents();
		ob_end_clean();

		$this->assertEquals( 1, did_action( 'archetype_sidebar' ) );

	}

	/**
	 * Check that the the footer is loaded.
	 */
	function test_archetype_get_footer() {

		ob_start();
		archetype_get_footer();
		$buffer = ob_get_contents();
		ob_end_clean();

		$this->assertEquals( 1, did_action( 'archetype_footer' ) );

	}

}
