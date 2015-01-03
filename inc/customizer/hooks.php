<?php
/**
 * archetype customizer hooks
 *
 * @package archetype
 */

add_action( 'init',                               'archetype_customizer_init'         );
add_action( 'customize_controls_enqueue_scripts', 'archetype_customizer_js'           );
add_action( 'customize_preview_init',             'archetype_customizer_preview_js'   );
add_action( 'customize_controls_print_scripts',   'archetype_customizer_print_js'     );
add_action( 'customize_controls_enqueue_scripts', 'archetype_customizer_css'          );
add_action( 'customize_register',                 'archetype_customizer_register'     );
add_filter( 'body_class',                         'archetype_layout_class'            );
add_action( 'wp_enqueue_scripts',                 'archetype_add_customizer_css', 130 );
add_action( 'after_setup_theme',                  'archetype_custom_header_setup'     );
add_filter( 'upload_mimes',                       'archetype_customizer_upload_mimes' );