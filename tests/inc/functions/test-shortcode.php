<?php
/**
 * Test shortcode functions
 *
 * @package Archetype
 * @group shortcode
 */
class Tests_Shortcode extends WP_UnitTestCase {

	/**
	 * Check proper return values.
	 */
	function test_archetype_do_shortcode_func() {

		// Run the function.
		$caption = archetype_do_shortcode_func( 'caption', array( 'width' => '200', 'caption' => 'The caption text' ), '<img src="http://sample.org/fake-image.jpg" />' );

		// Check for the right output.
		if ( current_theme_supports( 'html5', array( 'caption' ) ) ) {
			$expected = '<figcaption class="wp-caption-text">The caption text</figcaption>';
		} else {
			$expected = '<p class="wp-caption-text">The caption text</p>';
		}

		// Returns the shortcode as expected.
		$this->assertContains( $expected, $caption );

		// Returns `false` when the shortcode is invalid.
		$this->assertFalse( archetype_do_shortcode_func( 'invalid' ) );

	}

}
