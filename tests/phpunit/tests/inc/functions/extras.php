<?php
/**
 * Test extras related functions
 *
 * @package Archetype
 * @group extras
 */
class Tests_Extras extends WP_UnitTestCase {

	function setUp() {
		parent::setUp();

		set_current_screen( 'front' );

		update_option( 'comments_per_page', 5 );
		update_option( 'posts_per_page', 5 );

		global $wp_rewrite;

		$wp_rewrite->init();
		$wp_rewrite->set_permalink_structure( '/%year%/%monthnum%/%day%/%postname%/' );

		create_initial_taxonomies();

		$wp_rewrite->flush_rules();
	}

	function tearDown() {
		global $wp_rewrite;
		$wp_rewrite->init();

		parent::tearDown();
	}

	/**
	 * Check that the Customizer is enabled and the filter works.
	 */
	function test_is_archetype_customizer_enabled() {

		// Defaults a `true` return value.
		$this->assertTrue( is_archetype_customizer_enabled() );

		// Test that the filter return `true`.
		add_filter( 'archetype_customizer_enabled', '__return_true' );
		$this->assertTrue( is_archetype_customizer_enabled() );

		// Test that the filter return `false`.
		add_filter( 'archetype_customizer_enabled', '__return_false' );
		$this->assertFalse( is_archetype_customizer_enabled() );

		// Test that the filter returns `false` for an empty string.
		add_filter( 'archetype_customizer_enabled', '__return_empty_string' );
		$this->assertFalse( is_archetype_customizer_enabled() );

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

		$post = array(
			'post_author' => $this->factory->user->create( array(
				'role' => 'author',
				'user_login' => 'test_author',
				'description' => 'test_author',
			) ),
			'post_status' => 'publish',
			'post_content' => rand_str(),
			'post_title' => rand_str(),
			'post_type' => 'post'
		);

		// Create a post with author #1
		$this->factory->post->create( $post );

		$post = array(
			'post_author' => $this->factory->user->create( array(
				'role' => 'author',
				'user_login' => 'test_author2',
				'description' => 'test_author2',
			) ),
			'post_status' => 'publish',
			'post_content' => rand_str(),
			'post_title' => rand_str(),
			'post_type' => 'post'
		);

		// Create a post with author #2
		$this->post_id = $this->factory->post->create( $post );
		$this->go_to( get_permalink( $this->post_id ) );

		$this->assertTrue( in_array( 'group-blog', get_body_class() ) );

	}

	/**
	 * Check 'no-wc-breadcrumb' body class
	 */
	function test_archetype_body_classes_wc_breadcrumb() {

		$this->assertFalse( in_array( 'no-wc-breadcrumb', get_body_class() ) );

		set_theme_mod( 'archetype_breadcrumb_toggle', false );
		$this->assertTrue( in_array( 'no-wc-breadcrumb', get_body_class() ) );

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
	 * Check 'is-boxed' body class
	 */
	function test_archetype_body_classes_is_padded() {

		set_theme_mod( 'archetype_padded', false );
		$this->assertFalse( in_array( 'is-padded', get_body_class() ) );

		set_theme_mod( 'archetype_padded', true );
		$this->assertTrue( in_array( 'is-padded', get_body_class() ) );

	}

	/**
	 * Check that WooCommerce is activated.
	 */
	function test_is_woocommerce_activated() {

		$this->assertTrue( is_woocommerce_activated() );

	}

	/**
	 * Check that Homepage Control is not activated.
	 */
	function test_is_homepage_control_activated() {

		$this->assertFalse( is_homepage_control_activated() );

	}


	/**
	 * Check that the Schema type is correct for the context.
	 */
	function test_archetype_html_tag_schema() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Check that `true` is returned when the blog has more than 1 category.
	 */
	function test_archetype_categorized_blog() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Check that the transients is flushed.
	 */
	function test_archetype_category_transient_flusher() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Check that the markup in `get_search_form()` is replaced.
	 */
	function test_archetype_post_search_form() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Check that HEX is converted to RGB.
	 */
	function test_archetype_rgb_from_hex() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

}
