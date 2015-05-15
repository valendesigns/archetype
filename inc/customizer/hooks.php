<?php
/**
 * archetype customizer hooks
 *
 * @package archetype
 */

add_action( 'init',                               'archetype_customize_init'         );
add_action( 'customize_controls_enqueue_scripts', 'archetype_customize_js'           );
add_action( 'customize_preview_init',             'archetype_customize_preview_js'   );
add_action( 'customize_controls_print_scripts',   'archetype_customize_print_js'     );
add_action( 'customize_controls_enqueue_scripts', 'archetype_customize_css'          );
add_action( 'customize_register',                 'archetype_customize_register', 21 );
add_filter( 'body_class',                         'archetype_layout_class'           );
add_action( 'wp_enqueue_scripts',                 'archetype_add_customize_css', 130 );
add_action( 'after_setup_theme',                  'archetype_custom_header_setup'    );
add_filter( 'upload_mimes',                       'archetype_customize_upload_mimes' );
add_filter( 'jetpack_the_site_logo',              'archetype_site_logo_svg', 10, 3   );