<?php
/**
 * Test setup related functions
 *
 * @package Archetype
 * @group setup
 */
class Tests_Setup extends WP_UnitTestCase {

	function setUp() {
		parent::setUp();

		global $wp_rewrite, $sidebars_widgets;

		unset( $GLOBALS['_wp_sidebars_widgets'] ); // clear out cache set by wp_get_sidebars_widgets()
		$sidebars_widgets = wp_get_sidebars_widgets();

		$wp_rewrite->init();
		$wp_rewrite->set_permalink_structure( '/%year%/%monthnum%/%postname%/' );
		$wp_rewrite->flush_rules();
	}

	function tearDown() {
		global $wp_rewrite;
		$wp_rewrite->init();

		parent::tearDown();
	}

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
		$this->assertInternalType( 'array', $wp_registered_sidebars['header-1'] );
		$this->assertInternalType( 'array', $wp_registered_sidebars['footer-1'] );
	}

	/**
	 * Check that scripts and styles are enqueued.
	 */
	function test_archetype_scripts() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Check that background images are added to the post navigation via `wp_add_inline_style`.
	 */
	function test_archetype_post_nav_background() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Check that the home link is added with the `wp_page_menu_args` filter.
	 */
	function test_archetype_page_menu_args() {

		// Expected value.
		$expected = '<div class="menu"><ul><li ><a href="http://example.org/">Home</a></li></ul></div>' . "\n";

		// Get the menu markup post filter.
		$menu = wp_page_menu( array( 'echo' => false ) );

		// Test that the values are equal.
		$this->assertSame( $expected, $menu );

	}

	/**
	 * Check that the home link is not added without the `wp_page_menu_args` filter.
	 */
	function test_archetype_page_menu_args_without_filter() {

		// Expected value.
		$expected = '<div class="menu"></div>' . "\n";

		// Remove the filter
		remove_filter( 'wp_page_menu_args', 'archetype_page_menu_args' );

		// Get the menu markup without the filter.
		$menu = wp_page_menu( array( 'echo' => false ) );

		// Add the filter back
		add_filter( 'wp_page_menu_args', 'archetype_page_menu_args' );

		// Test that the values are equal.
		$this->assertSame( $expected, $menu );

	}

	/**
	 * Check 'group-blog' body class
	 */
	function test_archetype_body_classes_is_multi_author() {

		$this->assertFalse( in_array( 'group-blog', get_body_class() ) );

		// Create authors
		$a1 = $this->factory->user->create( array(
			'role' => 'author',
			'user_login' => 'test_author',
			'description' => 'test_author',
		) );
		$a2 = $this->factory->user->create( array(
			'role' => 'author',
			'user_login' => 'test_author_2',
			'description' => 'test_author_2',
		) );

		// Create posts
		$p1 = $this->factory->post->create( array(
			'post_author' => $a1,
			'post_status' => 'publish',
			'post_content' => rand_str(),
			'post_title' => rand_str(),
			'post_type' => 'post'
		) );
		$p2 = $this->factory->post->create( array(
			'post_author' => $a2,
			'post_status' => 'publish',
			'post_content' => rand_str(),
			'post_title' => rand_str(),
			'post_type' => 'post'
		) );

		$this->go_to( get_permalink( $p2 ) );

		$this->assertTrue( in_array( 'group-blog', get_body_class() ) );

	}

	/**
	 * Check 'no-wc-breadcrumb' body class
	 */
	function test_archetype_body_classes_wc_breadcrumb() {

		$this->assertTrue( in_array( 'no-wc-breadcrumb', get_body_class() ) );

		set_theme_mod( 'archetype_breadcrumb_toggle', true );
		$this->assertFalse( in_array( 'no-wc-breadcrumb', get_body_class() ) );

	}

	/**
	 * Check 'archetype-full-width-content' body class
	 */
	function test_archetype_body_classes_is_404_full_width() {

		$this->assertFalse( in_array( 'archetype-full-width-content', get_body_class() ) );

		$this->go_to( '/' . rand_str() );
		$this->assertTrue( in_array( 'archetype-full-width-content', get_body_class() ) );

	}

	/**
	 * Check 'archetype-cute' body class
	 */
	function test_archetype_body_classes_make_me_cute() {

		$this->assertFalse( in_array( 'archetype-cute', get_body_class() ) );

		add_filter( 'archetype_make_me_cute', '__return_true' );
		$this->assertTrue( in_array( 'archetype-cute', get_body_class() ) );

	}

	/**
	 * Check 'grid-alt' body class
	 */
	function test_archetype_body_classes_grid_alt() {

		set_theme_mod( 'archetype_columns', '3' );
		$this->assertFalse( in_array( 'grid-alt', get_body_class() ) );

		set_theme_mod( 'archetype_columns', '4' );
		$this->assertTrue( in_array( 'grid-alt', get_body_class() ) );

	}

	/**
	 * Check 'is-full-width' body class
	 */
	function test_archetype_body_classes_is_full_width() {

		set_theme_mod( 'archetype_full_width', false );
		$this->assertFalse( in_array( 'is-full-width', get_body_class() ) );

		set_theme_mod( 'archetype_full_width', true );
		$this->assertTrue( in_array( 'is-full-width', get_body_class() ) );

	}

	/**
	 * Check 'is-boxed' body class
	 */
	function test_archetype_body_classes_is_boxed() {

		set_theme_mod( 'archetype_boxed', false );
		$this->assertFalse( in_array( 'is-boxed', get_body_class() ) );

		set_theme_mod( 'archetype_boxed', true );
		$this->assertTrue( in_array( 'is-boxed', get_body_class() ) );

	}

	/**
	 * Check 'is-padded' body class
	 */
	function test_archetype_body_classes_is_padded() {

		set_theme_mod( 'archetype_padded', false );
		$this->assertFalse( in_array( 'is-padded', get_body_class() ) );

		set_theme_mod( 'archetype_padded', true );
		$this->assertTrue( in_array( 'is-padded', get_body_class() ) );

	}

	/**
	 * Check 'archetype-has-header-widgets' body class
	 */
	function test_archetype_body_classes_has_header_widgets() {
		global $_wp_sidebars_widgets;

		$cache = $_wp_sidebars_widgets;

		$_wp_sidebars_widgets['header-1'] = $_wp_sidebars_widgets['sidebar-1'];
		unset( $_wp_sidebars_widgets['sidebar-1'] );

		$this->assertTrue( is_active_sidebar( 'header-1' ) );
		$this->assertTrue( in_array( 'archetype-has-header-widgets', get_body_class() ) );

		$_wp_sidebars_widgets = $cache;
	}

}
