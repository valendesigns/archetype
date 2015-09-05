<?php
/**
 * Archetype hooks
 *
 * @package Archetype
 * @subpackage Hooks
 * @since 1.0.0
 */

/**
 * Template
 *
 * @see archetype_get_header()
 * @see archetype_get_sidebar()
 * @see archetype_get_footer()
 */
add_action( 'archetype_get_header',     'archetype_get_header',           10 );
add_action( 'archetype_get_sidebar',    'archetype_get_sidebar',          10 );
add_action( 'archetype_get_footer',     'archetype_get_footer',           10 );

/**
 * Setup
 *
 * @see archetype_setup()
 * @see archetype_widgets_init()
 * @see archetype_scripts()
 * @see archetype_post_nav_background()
 */
add_action( 'after_setup_theme',        'archetype_setup',                10 );
add_action( 'widgets_init',             'archetype_widgets_init',         10 );
add_action( 'wp_enqueue_scripts',       'archetype_scripts',              10 );
add_action( 'wp_enqueue_scripts',       'archetype_post_nav_background',  20 );

/**
 * Header
 *
 * @see archetype_skip_links()
 * @see archetype_social_icons()
 * @see archetype_site_header()
 * @see archetype_primary_navigation()
 */
add_action( 'archetype_before_header', 'archetype_skip_links',          0 );
add_action( 'archetype_header',        'archetype_social_icons',       10 );
add_action( 'archetype_header',        'archetype_site_header',        20 );
add_action( 'archetype_header',        'archetype_primary_navigation', 30 );

/**
 * Site Header
 *
 * @see archetype_site_branding()
 * @see archetype_secondary_navigation()
 */
add_action( 'archetype_site_header', 'archetype_site_branding',        10 );
add_action( 'archetype_site_header', 'archetype_secondary_navigation', 20 );

/**
 * Header widgets
 *
 * @see archetype_header_widget_region()
 * @see archetype_header_widgets()
 */
add_action( 'archetype_before_content', 'archetype_header_widget_region', 10 );
add_action( 'archetype_header_widgets', 'archetype_header_widgets',       10 );

/**
 * Footer
 *
 * @see archetype_site_footer()
 * @see archetype_social_icons()
 * @see archetype_site_info()
 * @see archetype_footer_widgets()
 * @see archetype_credit()
 */
add_action( 'archetype_footer',           'archetype_site_footer',    10 );
add_action( 'archetype_footer',           'archetype_social_icons',   20 );
add_action( 'archetype_footer',           'archetype_site_info',      30 );
add_action( 'archetype_footer_widgets',   'archetype_footer_widgets', 10 );
add_action( 'archetype_site_info_footer', 'archetype_credit',         20 );


/**
 * Homepage
 *
 * @see archetype_homepage_widgets()
 * @see archetype_homepage_hero()
 */
add_action( 'init',     'archetype_homepage_widgets', 0 );
add_action( 'homepage', 'archetype_homepage_hero',    0 );

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
 * @see archetype_social_icons_post()
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
add_filter( 'archetype_single_post',       'archetype_social_icons_post', 35 );
add_action( 'archetype_single_post',       'archetype_post_author_bio',   40 );
add_action( 'archetype_single_post',       'archetype_post_meta',         50 );
add_action( 'archetype_single_post_after', 'archetype_post_navigation',   10 );
add_action( 'archetype_single_post_after', 'archetype_display_comments',  10 );

/**
 * Archive
 *
 * @see archetype_archive_header()
 */
add_action( 'archetype_archive_before', 'archetype_archive_header', 10 );

/**
 * Pages
 *
 * @see archetype_page_media()
 * @see archetype_page_header()
 * @see archetype_page_content()
 * @see archetype_display_comments()
 */
add_action( 'archetype_page',       'archetype_page_media',       10 );
add_action( 'archetype_page',       'archetype_page_header',      20 );
add_action( 'archetype_page',       'archetype_page_content',     30 );
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
 * Chat
 *
 * @see archetype_chat_content()
 */
add_filter( 'the_content',         'archetype_chat_content', 10 );
add_filter( 'archetype_chat_text', 'wpautop',                10 );

/**
 * Extras
 *
 * @see archetype_body_classes()
 * @see archetype_page_menu_args()
 */
add_filter( 'body_class',        'archetype_body_classes',   10 );
add_filter( 'wp_page_menu_args', 'archetype_page_menu_args', 10 );

/**
 * Search
 *
 * @see archetype_post_search_form()
 */
add_filter( 'get_search_form',   'archetype_post_search_form', 0 );

/**
 * Social
 *
 * @see archetype_subscribe_and_connect()
 * @see archetype_dequeue_subscribe_and_connect()
 */
add_filter( 'wp_head',           'archetype_subscribe_and_connect',         0 );
add_action( 'wp_footer',         'archetype_dequeue_subscribe_and_connect', 0 );

/**
 * Taxonomy
 *
 * @see archetype_category_transient_flusher()
 */
add_action( 'edit_category',     'archetype_category_transient_flusher', 10 );
add_action( 'save_post',         'archetype_category_transient_flusher', 10 );
