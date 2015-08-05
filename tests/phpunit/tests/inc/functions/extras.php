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

		global $wp_rewrite, $sidebars_widgets;

		unset( $GLOBALS['_wp_sidebars_widgets'] ); // clear out cache set by wp_get_sidebars_widgets()
		$sidebars_widgets = wp_get_sidebars_widgets();

		$wp_rewrite->init();
		$wp_rewrite->set_permalink_structure( '/%year%/%monthnum%/%postname%/' );
		$wp_rewrite->flush_rules();

		// Create author #1
		$this->author_id = $this->factory->user->create( array(
			'role' => 'author',
			'user_login' => 'test_author',
			'description' => 'test_author',
		) );

		// Create a post for author #1
		$this->post_id = $this->factory->post->create( array(
			'post_author' => $this->author_id,
			'post_status' => 'publish',
			'post_content' => rand_str(),
			'post_title' => rand_str(),
			'post_type' => 'post'
		) );
	}

	function tearDown() {
		global $wp_rewrite;
		$wp_rewrite->init();

		parent::tearDown();
	}

	/**
	 * Check that the the header is loaded.
	 */
	function test_archetype_get_header() {

		ob_start();
		archetype_get_header();
		$buffer = ob_get_contents();
		ob_end_clean();

		$this->assertEquals( 1, did_action( 'archetype_header' ) );

	}

	/**
	 * Check that the the footer is loaded.
	 */
	function test_archetype_get_footer() {

		ob_start();
		archetype_get_footer();
		$buffer = ob_get_contents();
		ob_end_clean();

		$this->assertEquals( 1, did_action( 'archetype_footer' ) );

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

		// Create author #2
		$this->author_id_2 = $this->factory->user->create( array(
			'role' => 'author',
			'user_login' => 'test_author_2',
			'description' => 'test_author_2',
		) );

		// Create a post for author #2
		$this->post_id_2 = $this->factory->post->create( array(
			'post_author' => $this->author_id_2,
			'post_status' => 'publish',
			'post_content' => rand_str(),
			'post_title' => rand_str(),
			'post_type' => 'post'
		) );

		$this->go_to( get_permalink( $this->post_id_2 ) );

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
	 * Check that Subscribe & Connect is not activated.
	 */
	function test_is_subscribe_and_connect_activated() {

		$this->assertFalse( is_subscribe_and_connect_activated() );

	}

	/**
	 * Check that the Schema type is correct for the default context.
	 */
	function test_archetype_html_tag_schema_default() {

		$this->assertSame( 'itemscope="itemscope" itemtype="http://schema.org/WebPage"', archetype_html_tag_schema( false ) );

	}
	
	/**
	 * Check that the Schema type is correct for the default context during echo.
	 */
	function test_archetype_html_tag_schema_default_echo() {

		ob_start();
		archetype_html_tag_schema( true );
		$buffer = ob_get_contents();
		ob_end_clean();

		$this->assertSame( 'itemscope="itemscope" itemtype="http://schema.org/WebPage"', $buffer );

	}

	/**
	 * Check that the Schema type is correct for the post context.
	 */
	function test_archetype_html_tag_schema_post() {

		$this->go_to( get_permalink( $this->post_id ) );

		$this->assertSame( 'itemscope="itemscope" itemtype="http://schema.org/Article"', archetype_html_tag_schema( false ) );

	}

	/**
	 * Check that the Schema type is correct for the author context.
	 */
	function test_archetype_html_tag_schema_author() {

		$this->go_to( get_author_posts_url( $this->author_id ) );

		$this->assertSame( 'itemscope="itemscope" itemtype="http://schema.org/ProfilePage"', archetype_html_tag_schema( false ) );

	}

	/**
	 * Check that the Schema type is correct for the search context.
	 */
	function test_archetype_html_tag_schema_search() {

		$this->go_to( '/?s=a' );

		$this->assertSame( 'itemscope="itemscope" itemtype="http://schema.org/SearchResultsPage"', archetype_html_tag_schema( false ) );

	}

	/**
	 * Check that `true` is returned when the blog has more than 1 category.
	 */
	function test_archetype_categorized_blog() {

		$this->assertFalse( archetype_categorized_blog() );

		$c1 = $this->factory->category->create( array(
			'name' => 'Test Category 1',
			'slug' => 'test_category_1',
		) );

		$c2 = $this->factory->category->create( array(
			'name' => 'Test Category 2',
			'slug' => 'test_category_2',
		) );
		
		wp_set_object_terms( $this->post_id, array( $c1, $c2 ), 'category' );

		archetype_category_transient_flusher();

		$this->assertTrue( archetype_categorized_blog() );

	}

	/**
	 * Check that the markup in `get_search_form()` is replaced.
	 */
	function test_archetype_post_search_form() {

		add_filter( 'archetype_post_search_form', '__return_false' );
		$this->assertNotContains( '<input type="hidden" name="post_type" value="post" />', archetype_post_search_form( '' ) );
		add_filter( 'archetype_post_search_form', '__return_true' );

		$this->assertContains( '<input type="hidden" name="post_type" value="post" />', archetype_post_search_form( '' ) );

	}
	
	/**
	 * Check proper return values.
	 */
	function test_archetype_do_shortcode_func() {

		// Run the function.
		$caption = archetype_do_shortcode_func( 'caption', array( 'width' => '200', 'caption' => 'The caption text' ), '<img src="http://sample.org/fake-image.jpg" />' );

		// Check for the right output.
		if ( current_theme_supports( 'html5', 'caption' ) ) {
			$expected = '<figcaption class="wp-caption-text">The caption text</figcaption>';
		} else {
			$expected = '<p class="wp-caption-text">The caption text</p>';
		}

		// Returns the shortcode as expected.
		$this->assertContains( $expected, $caption );

		// Returns `false` when the shortcode is invalid.
		$this->assertFalse( archetype_do_shortcode_func( 'invalid' ) );

	}

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
