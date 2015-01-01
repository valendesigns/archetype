<?php
/**
 * Archetype theme tests.
 *
 * @package archetype
 * @group theme
 */
class Archetype_Tests_Theme extends WP_UnitTestCase {

  /**
   * Ensure the theme has been installed and activated and the theme version is correct.
   */
  function test_theme_version() {
    global $archetype_version;
    
    $this->assertEquals( $archetype_version, wp_get_theme()->Version );

  }

}