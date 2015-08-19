<?php
/**
 * Archetype Customizer hooks
 *
 * @package Archetype
 * @subpackage Customize
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_setup_customizer_hooks' ) ) :
	/**
	 * Setup the Customizer hooks.
	 *
	 * @since 1.0.0
	 */
	function archetype_setup_customizer_hooks() {
		add_action( 'customize_controls_enqueue_scripts',    'archetype_customize_css',                     10 );
		add_action( 'customize_controls_enqueue_scripts',    'archetype_customize_js',                      10 );
		add_action( 'customize_controls_print_scripts',      'archetype_customize_print_js',                10 );
		add_action( 'customize_preview_init',                'archetype_customize_preview_js',              10 );
		add_action( 'customize_register',                    'archetype_customize_register',                21 );
		add_filter( 'body_class',                            'archetype_layout_class',                      10 );
		add_action( 'wp_enqueue_scripts',                    'archetype_add_customize_css',                130 );
		add_action( 'after_setup_theme',                     'archetype_custom_header_setup',               10 );
		add_action( 'init',                                  'archetype_emojis',                            10 );
		add_action( 'init',                                  'archetype_tools_init',                        10 );
		add_filter( 'upload_mimes',                          'archetype_svg_mime',                          10 );
		add_filter( 'jetpack_the_site_logo',                 'archetype_site_logo_svg',                  10, 3 );
		add_action( 'wp_ajax_archetype-get-logo-url',        'archetype_get_logo_url',                      10 );
		add_action( 'archetype_primary_navigation_classes',  'archetype_get_primary_navigation_classes',    10 );
		add_action( 'archetype_homepage_hero_content_after', 'archetype_homepage_hero_media',               10 );
		add_action( 'archetype_homepage_hero_buttons',       'archetype_homepage_hero_add_button',          10 );
		add_action( 'archetype_site_info_footer',            'archetype_site_info_footer_branding',          0 );
		add_filter( 'archetype_site_info_styles',            'archetype_get_site_info_styles',              10 );
		add_filter( 'archetype_site_footer_styles',          'archetype_get_site_footer_styles',            10 );
	}
endif;

// Load it this way so we can unit test.
archetype_setup_customizer_hooks();
