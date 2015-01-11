<?php
/**
 * archetype hooks
 *
 * @package archetype
 */

/**
 * General
 * @see archetype_setup()
 * @see archetype_widgets_init()
 * @see archetype_scripts()
 * @see archetype_header_widget_region()
 * @see archetype_get_sidebar()
 */
add_action( 'after_setup_theme',        'archetype_setup'                    );
add_action( 'widgets_init',             'archetype_widgets_init'             );
add_action( 'wp_enqueue_scripts',       'archetype_scripts',              10 );
add_action( 'wp_enqueue_scripts',       'archetype_post_nav_background',  20 );
add_action( 'archetype_before_content', 'archetype_header_widget_region', 10 );
add_action( 'archetype_sidebar',        'archetype_get_sidebar',          10 );

/**
 * Header
 * @see archetype_secondary_navigation()
 * @see archetype_site_branding()
 * @see archetype_primary_navigation()
 */
add_action( 'archetype_header', 'archetype_site_branding',        20 );
add_action( 'archetype_header', 'archetype_secondary_navigation', 30 );
add_action( 'archetype_header', 'archetype_primary_navigation',   50 );

/**
 * Footer
 * @see archetype_footer_widgets()
 * @see archetype_credit()
 */
add_action( 'archetype_footer', 'archetype_footer_widgets', 10 );
add_action( 'archetype_footer', 'archetype_credit',         20 );

/**
 * Homepage
 * @see archetype_homepage_content()
 * @see archetype_product_categories()
 * @see archetype_recent_products()
 * @see archetype_featured_products()
 * @see archetype_popular_products()
 * @see archetype_on_sale_products()
 */
add_action( 'homepage', 'archetype_homepage_content',   10 );
add_action( 'homepage', 'archetype_product_categories', 20 );
add_action( 'homepage', 'archetype_recent_products',    30 );
add_action( 'homepage', 'archetype_featured_products',  40 );
add_action( 'homepage', 'archetype_popular_products',   50 );
add_action( 'homepage', 'archetype_on_sale_products',   60 );

/**
 * Posts
 * @see archetype_post_format_media()
 * @see archetype_post_header()
 * @see archetype_post_content()
 * @see archetype_post_meta()
 * @see archetype_posts_navigation()
 * @see archetype_single_post_header()
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
add_action( 'archetype_single_post',       'archetype_post_meta',         40 );
add_action( 'archetype_single_post_after', 'archetype_post_navigation',   10 );
add_action( 'archetype_single_post_after', 'archetype_display_comments',  10 );

/**
 * Pages
 * @see archetype_page_header()
 * @see archetype_page_content()
 * @see archetype_display_comments()
 */
add_action( 'archetype_page',       'archetype_page_header',      10 );
add_action( 'archetype_page',       'archetype_page_content',     20 );
add_action( 'archetype_page_after', 'archetype_display_comments', 10 );

/**
 * Images
 * @see archetype_image_header()
 * @see archetype_image_content()
 * @see archetype_image_meta()
 * @see archetype_image_navigation()
 * @see archetype_post_navigation()
 * @see archetype_display_comments()
 */
add_action( 'archetype_single_image_before', 'archetype_image_navigation', 10 );
add_action( 'archetype_single_image',        'archetype_image_header',     10 );
add_action( 'archetype_single_image',        'archetype_image_content',    20 );
add_action( 'archetype_single_image',        'archetype_image_meta',       30 );
add_action( 'archetype_single_image_after',  'archetype_post_navigation',  10 );
add_action( 'archetype_single_image_after',  'archetype_display_comments', 20 );

/**
 * Extras
 * @see archetype_setup_author()
 * @see archetype_wp_title()
 * @see archetype_body_classes()
 * @see archetype_page_menu_args()
 */
add_action( 'wp',                'archetype_setup_author'         );
add_filter( 'wp_title',          'archetype_wp_title',      10, 2 );
add_filter( 'body_class',        'archetype_body_classes'         );
add_filter( 'wp_page_menu_args', 'archetype_page_menu_args'       );