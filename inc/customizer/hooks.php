<?php
/**
 * Archetype customizer hooks
 *
 * @package Archetype
 * @subpackage Customize
 * @since 1.0.0
 */

add_action( 'init',                               'archetype_customize_init',         10 );
add_action( 'customize_controls_enqueue_scripts', 'archetype_customize_js',           10 );
add_action( 'customize_preview_init',             'archetype_customize_preview_js',   10 );
add_action( 'customize_controls_print_scripts',   'archetype_customize_print_js',     10 );
add_action( 'customize_controls_enqueue_scripts', 'archetype_customize_css',          10 );
add_action( 'customize_register',                 'archetype_customize_register',     21 );
add_filter( 'body_class',                         'archetype_layout_class',           10 );
add_action( 'wp_enqueue_scripts',                 'archetype_add_customize_css',      130 );
add_action( 'after_setup_theme',                  'archetype_custom_header_setup',    10 );
add_filter( 'upload_mimes',                       'archetype_customize_upload_mimes', 10 );
add_filter( 'jetpack_the_site_logo',              'archetype_site_logo_svg',          10, 3 );
add_action( 'wp_ajax_archetype-get-logo-url',     'archetype_customize_get_logo_url', 10 );
