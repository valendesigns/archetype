<?php
/**
 * archetype WooCommerce hooks
 *
 * @package archetype
 */

/**
 * Styles
 * @see  archetype_woocommerce_scripts()
 */
add_action( 'wp_enqueue_scripts',         'archetype_woocommerce_scripts', 20 );
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array'              );

/**
 * Layout
 * @see  archetype_before_content()
 * @see  archetype_after_content()
 * @see  woocommerce_breadcrumb()
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb',                 20, 0 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper',     10    );
remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10    );
remove_action( 'woocommerce_sidebar',             'woocommerce_get_sidebar',                10    );
add_action( 'woocommerce_before_main_content',    'archetype_before_content',               10    );
add_action( 'woocommerce_after_main_content',     'archetype_after_content',                10    );
//add_action( 'archetype_content_top',             'woocommerce_breadcrumb',                 10    );

/**
 * Products
 * @see  archetype_upsell_display()
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display',               15 );
add_action( 'woocommerce_after_single_product_summary',    'archetype_upsell_display',                 15 );
remove_action( 'woocommerce_before_shop_loop_item_title',  'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'woocommerce_after_shop_loop_item_title',      'woocommerce_show_product_loop_sale_flash', 6  );


/**
 * Header
 * @see  archetype_product_search()
 * @see  archetype_header_cart()
 */
add_action( 'archetype_header', 'archetype_product_search', 40 );
add_action( 'archetype_header', 'archetype_header_cart',    60 );

/**
 * Filters
 * @see  archetype_woocommerce_body_class()
 * @see  archetype_cart_link_fragment()
 * @see  archetype_thumbnail_columns()
 * @see  archetype_related_products_args()
 * @see  archetype_products_per_page()
 * @see  archetype_loop_columns()
 * @see  archetype_breadcrumb_delimeter()
 */
add_filter( 'body_class',                               'archetype_woocommerce_body_class' );
add_filter( 'woocommerce_product_thumbnails_columns',   'archetype_thumbnail_columns'      );
add_filter( 'woocommerce_output_related_products_args', 'archetype_related_products_args'  );
add_filter( 'loop_shop_per_page',                       'archetype_products_per_page'      );
add_filter( 'loop_shop_columns',                        'archetype_loop_columns'           );

if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
  add_filter( 'woocommerce_add_to_cart_fragments', 'archetype_cart_link_fragment' );
} else {
  add_filter( 'add_to_cart_fragments', 'archetype_cart_link_fragment' );
}

/**
 * Integrations
 * @see  archetype_woocommerce_integrations_scripts()
 * @see  archetype_woocommerce_integrations_layout()
 * @see  archetype_add_bookings_customizer_css()
 */
add_action( 'wp_enqueue_scripts',  'archetype_woocommerce_integrations_scripts' );
add_action( 'wp',                  'archetype_woocommerce_integrations_layout'  );
//add_action( 'wp_enqueue_scripts', 'archetype_add_integrations_customizer_css'  );