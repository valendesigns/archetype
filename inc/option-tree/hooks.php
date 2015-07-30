<?php
/**
 * Archetype OptionTree hooks
 *
 * @package Archetype
 * @subpackage Option_Tree
 * @since 1.0.0
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
 * Register Meta Boxes
 */
add_action( 'admin_init', 'archetype_register_meta_boxes' );

/**
 * Post Formats
 */
add_action( 'archetype_post_format_media', 'archetype_post_format_audio' );
add_action( 'archetype_post_format_media', 'archetype_post_format_video' );
add_action( 'archetype_post_format_media', 'archetype_post_format_gallery' );
add_filter( 'the_content',                 'archetype_post_format_quote' );

/**
 * Filters
 */
add_filter( 'ot_meta_box_post_format_gallery', 'archetype_filter_post_format_gallery', 10, 2 );
add_filter( 'archetype_hide_title',            'archetype_hide_title_post_meta', 10, 2 );
add_filter( 'archetype_hide_author_bio',       'archetype_hide_author_bio_post_meta', 10, 2 );
