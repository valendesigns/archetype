<?php
/**
 * archetype customizer hooks
 *
 * @package archetype
 */

add_action( 'customize_preview_init',   'archetype_customize_preview_js' );
add_action( 'customize_register',     'archetype_customize_register' );
add_filter( 'body_class',         'archetype_layout_class' );
add_action( 'wp_enqueue_scripts',     'archetype_add_customizer_css', 130 );
add_action( 'after_setup_theme',     'archetype_custom_header_setup' );