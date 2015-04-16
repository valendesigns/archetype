<?php
/**
 * Archetype theme tests.
 *
 * @package archetype
 * @group theme
 */
class Archetype_Tests_Theme extends WP_UnitTestCase {

  /**
   * Check if 'Archetype' equals the current theme name.
   */
  function test_theme_name() {

    $this->assertEquals( 'Archetype', wp_get_theme()->Name );

  }

  /**
   * Check if the `$archetype_version` global equals the current theme version.
   */
  function test_theme_version() {
    global $archetype_version;

    $this->assertEquals( $archetype_version, wp_get_theme()->Version );

  }

}