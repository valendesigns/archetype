<?php
/**
 * Test Customizer hooks.
 *
 * @package Archetype
 * @group customizer
 */

class Tests_Customizer_Hooks extends WP_UnitTestCase {

	/**
	 * Verify all the hooks and filters are loaded.
	 */
	function test_archetype_setup_customizer_hooks() {

		archetype_setup_customizer_hooks();
		$this->assertEquals( 10, has_action( 'customize_controls_enqueue_scripts', 'archetype_customize_js' ) );
		$this->assertEquals( 10, has_action( 'customize_preview_init', 'archetype_customize_preview_js' ) );
		$this->assertEquals( 21, has_action( 'customize_register', 'archetype_customize_register' ) );
		$this->assertEquals( 10, has_action( 'body_class', 'archetype_layout_class' ) );
		$this->assertEquals( 130, has_action( 'wp_enqueue_scripts', 'archetype_add_customize_css' ) );
		$this->assertEquals( 10, has_action( 'after_setup_theme', 'archetype_custom_header_setup' ) );
		$this->assertEquals( 10, has_action( 'homepage_control_title', 'archetype_homepage_control_title' ) );
		$this->assertEquals( 10, has_action( 'init', 'archetype_emojis' ) );

	}

}
