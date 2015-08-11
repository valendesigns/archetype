<?php
/**
 * Test color functions.
 *
 * @package Archetype
 * @group color
 */

class Tests_Color extends WP_UnitTestCase {

	/**
	 * Check that HEX is converted to RGB.
	 */
	function test_archetype_rgb_from_hex() {

		// Test that the values are equal for black.
		$this->assertSame( array( 'r'=> 0, 'g' => 0, 'b' => 0 ), archetype_rgb_from_hex( '#000' ) );

		// Test that the values are equal for white.
		$this->assertSame( array( 'r'=> 255, 'g' => 255, 'b' => 255 ), archetype_rgb_from_hex( '#fff' ) );

		// Test that the values are equal for a random shade of blue.
		$this->assertSame( array( 'r'=> 59, 'g' => 121, 'b' => 183 ), archetype_rgb_from_hex( '#3b79b7' ) );

		// Test that the values are equal for a random shade of red.
		$this->assertSame( array( 'r'=> 237, 'g' => 72, 'b' => 73 ), archetype_rgb_from_hex( '#ed4849' ) );

		// Test that the return value is false.
		$this->assertFalse( archetype_rgb_from_hex( '#00' ) );

		// Test that the return value for red is 255.
		$this->assertSame( 255, archetype_rgb_from_hex( '#fff', 'r' ) );

	}

}
