<?php
/**
 * Test social functions.
 *
 * @package Archetype
 * @group social
 */

class Tests_Social extends WP_UnitTestCase {

	/**
	 * Check that Subscribe & Connect content filter is removed.
	 */
	function test_archetype_subscribe_and_connect() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Check that Subscribe & Connect styles are dequeued from the footer.
	 */
	function test_archetype_dequeue_subscribe_and_connect() {
		global $subscribe_and_connect;

		$this->assertEquals( 10, has_action( 'wp_footer', array( $subscribe_and_connect->context, 'maybe_load_theme_stylesheets' ) ) );

		archetype_dequeue_subscribe_and_connect();
		$this->assertFalse( has_action( 'wp_footer', array( $subscribe_and_connect->context, 'maybe_load_theme_stylesheets' ) ) );
	}

	/**
	 * Displays the social icons
	 */
	function test_archetype_social_icons() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Displays the social icons in posts
	 */
	function test_archetype_social_icons_post() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Filters the social icon container classes
	 */
	function test_archetype_social_icons_classes() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

}
