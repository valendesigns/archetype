<?php
/**
 * Tests to test that that testing framework is testing tests. Meta, huh?
 *
 * @package archetype
 */
class WP_Test_Archetype extends WP_UnitTestCase {

  /**
   * Ensure the theme has been installed and activated.
   */
  function test_theme_activated() {

    $this->assertEquals( 'archetype', wp_get_theme()->stylesheet );

  }
  
  /**
   * Ensure the theme version is correct.
   */
  function test_theme_version() {

    $this->assertEquals( '1.0.0', wp_get_theme()->Version );

  }

}