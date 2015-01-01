<?php
/**
 * Archetype theme tests.
 *
 * @package archetype
 * @group theme
 */
class Archetype_Tests_Theme extends WP_UnitTestCase {
  
  /**
   * Ensures the Archetype theme has been installed and activated by testing 
   * if the `$archetype_version` global equals the current theme version.
   */
  function test_theme_version() {
    global $archetype_version;
    
    $this->assertEquals( $archetype_version, wp_get_theme()->Version );

  }

}