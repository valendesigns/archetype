<?php
/**
 * archetype OptionTree hooks
 *
 * @package archetype
 */

/**
 * Show OptionTree Settings Pages
 */
add_filter( 'ot_show_pages', '__return_false' );

/**
 * Use OptionTree Theme Option
 */
add_filter( 'ot_use_theme_options', '__return_false' );

/**
 * Use OptionTree Meta Boxes
 */
add_filter( 'ot_meta_boxes', '__return_true' );

/**
 * Use OptionTree post formats
 */
add_filter( 'ot_post_formats', '__return_true' );

/**
 * Post Formats
 */
add_action( 'archetype_post_format_media', 'archetype_post_format_video' );