<?php
/**
 * Test setup related functions
 *
 * @package Archetype
 * @group setup
 */
class Tests_Setup extends WP_UnitTestCase {

	/**
	 * Check that `$content_width` is set correctly.
	 */
	function test_archetype_content_width() {
		global $content_width;

		$this->assertEquals( 784, $content_width );

	}

	/**
	 * Check that 'Archetype' equals the current theme name.
	 */
	function test_archetype_theme_name() {

		$this->assertEquals( 'Archetype', wp_get_theme()->Name );

	}

	/**
	 * Check that the `$archetype_version` global equals the current theme version.
	 */
	function test_archetype_theme_version() {
		global $archetype_version;

		$this->assertEquals( $archetype_version, wp_get_theme()->Version );

	}

	/**
	 * Check for theme defaults and registered support for various WordPress features.
	 */
	function test_archetype_setup() {

		archetype_setup();
		$this->assertTrue( current_theme_supports( 'automatic-feed-links' ) );
		$this->assertTrue( current_theme_supports( 'post-thumbnails' ) );
		$this->assertTrue( current_theme_supports( 'post-formats' ) );
		$this->assertTrue( current_theme_supports( 'custom-background' ) );
		$this->assertTrue( current_theme_supports( 'woocommerce' ) );

	}

	/**
	 * Check that widgets are registed.
	 */
	function test_archetype_widgets_init() {
		archetype_widgets_init();
		global $wp_registered_sidebars;

		$this->assertInternalType( 'array', $wp_registered_sidebars['sidebar-1'] );

		$header_widget_regions = apply_filters( 'archetype_header_widget_regions', 4 );
		for ( $i = 1; $i <= intval( $header_widget_regions ); $i++ ) {
			$this->assertInternalType( 'array', $wp_registered_sidebars[ 'header-' . $i ] );
		}

		$footer_widget_regions = apply_filters( 'archetype_footer_widget_regions', 4 );
		for ( $i = 1; $i <= intval( $footer_widget_regions ); $i++ ) {
			$this->assertInternalType( 'array', $wp_registered_sidebars[ 'footer-' . $i ] );
		}
	}

	/**
	 * Check that scripts and styles are enqueued.
	 */
	function test_archetype_scripts() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Check that Subscribe & Connect styles are dequeued from the footer.
	 *
	 * @todo Move to social.php & rename to test_archetype_dequeue_subscribe_and_connect
	 */
	function test_archetype_dequeue_footer_scripts() {
		global $subscribe_and_connect;
		
		$this->assertEquals( 10, has_action( 'wp_footer', array( $subscribe_and_connect->context, 'maybe_load_theme_stylesheets' ) ) );
		do_action( 'wp_footer' );
		$this->assertFalse( has_action( 'wp_footer', array( $subscribe_and_connect->context, 'maybe_load_theme_stylesheets' ) ) );
	}

	/**
	 * Check that background images are added to the post navigation via `wp_add_inline_style`.
	 */
	function test_archetype_post_nav_background() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

}
