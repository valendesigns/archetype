<?php
/**
 * Test Customizer controls.
 *
 * @package Archetype
 * @group customizer
 */

class Tests_Customizer_Controls extends WP_UnitTestCase {

	/**
	 * Instance of WP_Customize_Manager which is reset for each test.
	 *
	 * @var WP_Customize_Manager
	 */
	public $wp_customize;

	/**
	 * Set up a test case.
	 *
	 * @see WP_UnitTestCase::setup()
	 */
	function setUp() {
		parent::setUp();
		require_once ABSPATH . WPINC . '/class-wp-customize-manager.php';
		wp_set_current_user( $this->factory->user->create( array( 'role' => 'administrator' ) ) );
		global $wp_customize;
		$this->wp_customize = new WP_Customize_Manager();
		$wp_customize = $this->wp_customize;
		
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
			'post_type' => 'page'
		) );
	}

	/**
	 * Delete the $wp_customize global when cleaning up scope.
	 */
	function clean_up_global_scope() {
		global $wp_customize;
		$wp_customize = null;
		parent::clean_up_global_scope();
	}

	/**
	 * Check that the Customizer controls are added.
	 */
	function test_archetype_customize_register() {
		do_action( 'customize_register', $this->wp_customize );
		archetype_customize_register( $this->wp_customize );

		$this->assertInternalType( 'object', $this->wp_customize->get_panel( 'archetype_general' ) );

		$menu_locations = $this->wp_customize->get_section( 'menu_locations' );
		if ( is_object( $menu_locations ) ) {
			$this->assertInternalType( 'null', $this->wp_customize->get_section( 'nav' ) );
		} else {
			$this->assertInternalType( 'object', $this->wp_customize->get_section( 'nav' ) );
		}
	}

}
