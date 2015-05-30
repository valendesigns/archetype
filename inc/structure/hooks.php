<?php
/**
 * Archetype hooks
 *
 * @package Archetype
 * @subpackage Hooks
 * @since 1.0.0
 */

/**
 * General
 *
 * @see archetype_setup()
 * @see archetype_widgets_init()
 * @see archetype_scripts()
 * @see archetype_post_nav_background()
 * @see archetype_header_widget_region()
 * @see archetype_get_sidebar()
 */
add_action( 'after_setup_theme',        'archetype_setup',                10 );
add_action( 'widgets_init',             'archetype_widgets_init',         10 );
add_action( 'wp_enqueue_scripts',       'archetype_scripts',              10 );
add_action( 'wp_enqueue_scripts',       'archetype_post_nav_background',  20 );
add_action( 'archetype_before_content', 'archetype_header_widget_region', 10 );
add_action( 'archetype_sidebar',        'archetype_get_sidebar',          10 );


/**
 * Header
 *
 * @see archetype_skip_links()
 * @see archetype_social_icons()
 * @see archetype_site_branding()
 * @see archetype_secondary_navigation()
 */
add_action( 'archetype_before_header', 'archetype_skip_links',           0 );
add_action( 'archetype_inside_header', 'archetype_social_icons',         10 );
add_action( 'archetype_header',        'archetype_site_branding',        10 );
add_action( 'archetype_header',        'archetype_secondary_navigation', 20 );


/**
 * Navigation
 *
 * @see archetype_primary_navigation()
 */
add_action( 'archetype_navigation', 'archetype_primary_navigation', 10 );

/**
 * Footer
 *
 * @see archetype_footer_widgets()
 * @see archetype_credit()
 */
add_action( 'archetype_footer',           'archetype_footer_widgets', 10 );
add_action( 'archetype_site_info_footer', 'archetype_social_icons',   10 );
add_action( 'archetype_site_info_footer', 'archetype_credit',         20 );

/**
 * Homepage
 *
 * @see archetype_homepage_hero()
 * @see archetype_homepage_content()
 * @see archetype_homepage_custom_content()
 * @see archetype_homepage_custom_content_alt()
 */
add_action( 'homepage', 'archetype_homepage_hero',                0 );
add_action( 'homepage', 'archetype_homepage_content',            10 );
add_action( 'homepage', 'archetype_homepage_custom_content',     20 );
add_action( 'homepage', 'archetype_homepage_custom_content_alt', 80 );

/**
 * Posts
 *
 * @see archetype_post_format_media()
 * @see archetype_post_header()
 * @see archetype_post_content()
 * @see archetype_post_meta()
 * @see archetype_posts_navigation()
 * @see archetype_post_format_media()
 * @see archetype_post_header()
 * @see archetype_post_content()
 * @see archetype_post_author_bio()
 * @see archetype_post_meta()
 * @see archetype_post_navigation()
 * @see archetype_display_comments()
 */
add_action( 'archetype_loop_post',         'archetype_post_format_media', 10 );
add_action( 'archetype_loop_post',         'archetype_post_header',       20 );
add_action( 'archetype_loop_post',         'archetype_post_content',      30 );
add_action( 'archetype_loop_post',         'archetype_post_meta',         40 );
add_action( 'archetype_loop_after',        'archetype_posts_navigation',  10 );
add_action( 'archetype_single_post',       'archetype_post_format_media', 10 );
add_action( 'archetype_single_post',       'archetype_post_header',       20 );
add_action( 'archetype_single_post',       'archetype_post_content',      30 );
add_action( 'archetype_single_post',       'archetype_post_author_bio',   40 );
add_action( 'archetype_single_post',       'archetype_post_meta',         50 );
add_action( 'archetype_single_post_after', 'archetype_post_navigation',   10 );
add_action( 'archetype_single_post_after', 'archetype_display_comments',  10 );

/**
 * Pages
 *
 * @see archetype_page_header()
 * @see archetype_page_content()
 * @see archetype_display_comments()
 */
add_action( 'archetype_page',       'archetype_page_header',      10 );
add_action( 'archetype_page',       'archetype_page_content',     20 );
add_action( 'archetype_page_after', 'archetype_display_comments', 10 );

/**
 * Images
 *
 * @see archetype_image_header()
 * @see archetype_image_content()
 * @see archetype_image_meta()
 * @see archetype_image_navigation()
 * @see archetype_post_navigation()
 * @see archetype_display_comments()
 */
add_action( 'archetype_single_image_before', 'archetype_image_navigation', 10 );
add_action( 'archetype_single_image',        'archetype_image_attachment', 10 );
add_action( 'archetype_single_image',        'archetype_image_header',     20 );
add_action( 'archetype_single_image',        'archetype_image_content',    30 );
add_action( 'archetype_single_image',        'archetype_image_meta',       40 );
add_action( 'archetype_single_image_after',  'archetype_post_navigation',  10 );
add_action( 'archetype_single_image_after',  'archetype_display_comments', 20 );

/**
 * Extras
 *
 * @see archetype_body_classes()
 * @see archetype_post_search_form()
 * @see archetype_page_menu_args()
 */
add_filter( 'body_class',        'archetype_body_classes',    10 );
add_filter( 'get_search_form',   'archetype_post_search_form', 0 );
add_filter( 'wp_page_menu_args', 'archetype_page_menu_args',  10 );
