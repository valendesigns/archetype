<?php
/**
 * Archetype customizer hooks
 *
 * @package Archetype
 * @subpackage Customize
 * @since 1.0.0
 */

// @codeCoverageIgnoreStart
add_action( 'customize_controls_enqueue_scripts', 'archetype_customize_js',           10 );
add_action( 'customize_preview_init',             'archetype_customize_preview_js',   10 );
add_action( 'customize_register',                 'archetype_customize_register',     21 );
add_filter( 'body_class',                         'archetype_layout_class',           10 );
add_action( 'wp_enqueue_scripts',                 'archetype_add_customize_css',      130 );
add_action( 'after_setup_theme',                  'archetype_custom_header_setup',    10 );
add_action( 'homepage_control_title',             'archetype_homepage_control_title', 10, 2 );
add_action( 'init',                               'archetype_emojis',                 10 );
// @codeCoverageIgnoreEnd
