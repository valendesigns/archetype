<?php
/**
 * Archetype WooCommerce hooks
 *
 * @package Archetype
 * @subpackage WooCommerce
 * @since 1.0.0
 */

/**
 * Styles
 *
 * @see archetype_woocommerce_scripts()
 */
add_action( 'wp_enqueue_scripts',           'archetype_woocommerce_scripts', 20 );
add_filter( 'woocommerce_enqueue_styles',   '__return_empty_array' );
add_filter( 'archetype_customize_register', 'archetype_woocommerce_customize_register' );
add_action( 'admin_enqueue_scripts',        'archetype_woocommerce_remove_styles', 11 );


/**
 * Layout
 *
 * @see archetype_breadcrumb()
 * @see archetype_before_content()
 * @see archetype_after_content()
 * @see archetype_shop_messages()
 */
remove_action( 'woocommerce_before_main_content',      'woocommerce_breadcrumb',              20, 0 );
remove_action( 'woocommerce_before_main_content',      'woocommerce_output_content_wrapper',     10 );
remove_action( 'woocommerce_after_main_content',       'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar',                  'woocommerce_get_sidebar',                10 );
remove_action( 'woocommerce_after_shop_loop',          'woocommerce_pagination',                 10 );
remove_action( 'woocommerce_before_shop_loop',         'woocommerce_result_count',               20 );
remove_action( 'woocommerce_before_shop_loop',         'woocommerce_catalog_ordering',           30 );
add_action( 'archetype_before_content',                'archetype_breadcrumb',                    0 );
add_action( 'woocommerce_before_main_content',         'archetype_before_content',               10 );
add_action( 'woocommerce_after_main_content',          'archetype_after_content',                10 );
add_action( 'archetype_content_top',                   'archetype_shop_messages',                 1 );
add_action( 'woocommerce_before_shop_loop_item_title', 'archetype_before_product_thumbnail',      9 );
add_action( 'woocommerce_before_shop_loop_item_title', 'archetype_after_product_thumbnail',       11 );


/**
 * Shop Heading
 *
 * @see archetype_shop_heading()
 */
add_action( 'woocommerce_before_main_content', 'archetype_shop_heading', 1000 );


/**
 * Sorting & Pagination
 *
 * @see archetype_sorting_wrapper()
 * @see archetype_sorting_wrapper_close()
 * @see archetype_woocommerce_pagination()
 */
// Shop Heading.
add_action( 'woocommerce_archive_description',    'archetype_sorting_wrapper',              19 );
add_action( 'woocommerce_archive_description',    'woocommerce_result_count',               20 );
add_action( 'woocommerce_archive_description',    'woocommerce_catalog_ordering',           30 );
add_action( 'woocommerce_archive_description',    'archetype_sorting_wrapper_close',        31 );

// Before loop.
add_action( 'woocommerce_before_shop_loop',       'archetype_woocommerce_pagination',       10 );
add_action( 'woocommerce_before_shop_loop',       'archetype_before_product_loop',        9999 );

// After loop.
add_action( 'woocommerce_after_shop_loop',        'archetype_after_product_loop',            0 );
add_action( 'woocommerce_after_shop_loop',        'archetype_sorting_wrapper',              19 );
add_action( 'woocommerce_after_shop_loop',        'woocommerce_result_count',               20 );
add_action( 'woocommerce_after_shop_loop',        'woocommerce_catalog_ordering',           30 );
add_action( 'woocommerce_after_shop_loop',        'archetype_sorting_wrapper_close',        31 );
add_action( 'woocommerce_after_shop_loop',        'archetype_woocommerce_pagination',       40 );


/**
 * Products
 *
 * @see archetype_upsell_display()
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display',               15 );
add_action( 'woocommerce_after_single_product_summary',    'archetype_upsell_display',                 15 );
remove_action( 'woocommerce_before_shop_loop_item_title',  'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'woocommerce_after_shop_loop_item_title',      'woocommerce_show_product_loop_sale_flash',  6 );

add_action( 'woocommerce_before_shop_loop_item_title',     'archetype_before_product_loop_item',       11 );
add_action( 'woocommerce_after_shop_loop_item_title',      'archetype_after_product_loop_item',      9999 );

add_action( 'woocommerce_after_shop_loop_item',            'archetype_before_product_loop_item_buttons', 9 );
add_action( 'woocommerce_after_shop_loop_item',            'archetype_after_product_loop_item_buttons', 11 );

/**
 * Header
 *
 * @see archetype_header_cart()
 */
add_action( 'archetype_secondary_navigation', 'archetype_header_cart' );


/**
 * Homepage
 *
 * @see archetype_product_categories()
 * @see archetype_recent_products()
 * @see archetype_featured_products()
 * @see archetype_top_rated_products()
 * @see archetype_on_sale_products()
 */
add_action( 'homepage', 'archetype_product_categories', 30 );
add_action( 'homepage', 'archetype_recent_products',    40 );
add_action( 'homepage', 'archetype_featured_products',  50 );
add_action( 'homepage', 'archetype_top_rated_products', 60 );
add_action( 'homepage', 'archetype_on_sale_products',   70 );


/**
 * Filters
 *
 * @see archetype_woocommerce_body_class()
 * @see archetype_woocommerce_post_class()
 * @see archetype_fix_thumbnail()
 * @see archetype_product_search_form()
 * @see archetype_thumbnail_columns()
 * @see archetype_related_products_args()
 * @see archetype_breadcrumbs_defaults()
 * @see archetype_products_per_page()
 * @see archetype_loop_columns()
 * @see archetype_cart_link_fragment()
 */
add_filter( 'body_class',                               'archetype_woocommerce_body_class' );
add_filter( 'post_class',                               'archetype_woocommerce_post_class' );
add_action( 'init',                                     'archetype_fix_thumbnail' );
add_filter( 'get_search_form',                          'archetype_product_search_form' );
add_filter( 'woocommerce_product_thumbnails_columns',   'archetype_thumbnail_columns' );
add_filter( 'woocommerce_output_related_products_args', 'archetype_related_products_args' );
add_filter( 'woocommerce_breadcrumb_defaults',          'archetype_breadcrumbs_defaults' );
add_filter( 'loop_shop_per_page',                       'archetype_products_per_page' );
add_filter( 'loop_shop_columns',                        'archetype_loop_columns' );

if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'archetype_cart_link_fragment' );
} else {
	add_filter( 'add_to_cart_fragments', 'archetype_cart_link_fragment' );
}

if ( ! class_exists( 'WC_Product_Reviews_Pro' ) ) {
	add_filter( 'woocommerce_product_review_list_args', 'archetype_product_review_list_args' );
}

/**
 * Integrations
 *
 * @see archetype_woocommerce_integrations_scripts()
 * @see archetype_add_bookings_customizer_css()
 */
add_action( 'wp_enqueue_scripts', 'archetype_woocommerce_integrations_scripts' );
add_action( 'wp_enqueue_scripts', 'archetype_add_integrations_customizer_css', 140 );
