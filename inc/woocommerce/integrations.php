<?php
/**
 * Integration logic for WooCommerce extensions
 *
 * @package archetype
 */

/**
 * Styles & Scripts
 * @return void
 */
function archetype_woocommerce_integrations_scripts() {
  /**
   * Bookings
   */
  if ( is_woocommerce_extension_activated( 'WC_Bookings' ) ) {
    wp_enqueue_style( 'archetype-woocommerce-bookings-style', get_template_directory_uri() . '/inc/woocommerce/css/bookings.css' );
  }

  /**
   * Brands
   */
  if ( is_woocommerce_extension_activated( 'WC_Brands' ) ) {
    wp_enqueue_style( 'archetype-woocommerce-brands-style', get_template_directory_uri() . '/inc/woocommerce/css/brands.css' );
  }

  /**
   * Wishlists
   */
  if ( is_woocommerce_extension_activated( 'WC_Wishlists_Wishlist' ) ) {
    wp_enqueue_style( 'archetype-woocommerce-wishlists-style', get_template_directory_uri() . '/inc/woocommerce/css/wishlists.css' );
  }

  /**
   * AJAX Layered Nav
   */
  if ( is_woocommerce_extension_activated( 'SOD_Widget_Ajax_Layered_Nav' ) ) {
    wp_enqueue_style( 'archetype-woocommerce-ajax-layered-nav-style', get_template_directory_uri() . '/inc/woocommerce/css/ajax-layered-nav.css' );
  }

  /**
   * Variation Swatches
   */
  if ( is_woocommerce_extension_activated( 'WC_SwatchesPlugin' ) ) {
    wp_enqueue_style( 'archetype-variation-swatches-style', get_template_directory_uri() . '/inc/woocommerce/css/variation-swatches.css' );
  }

  /**
   * Composite Products
   */
  if ( is_woocommerce_extension_activated( 'WC_Composite_Products' ) ) {
    wp_enqueue_style( 'archetype-composite-products-style', get_template_directory_uri() . '/inc/woocommerce/css/composite-products.css' );
  }

  /**
   * WooCommerce Photography
   */
  if ( is_woocommerce_extension_activated( 'WC_Photography' ) ) {
    wp_enqueue_style( 'archetype-woocommerce-photography-style', get_template_directory_uri() . '/inc/woocommerce/css/photography.css' );
  }

  /**
   * Product Reviews Pro
   */
  if ( is_woocommerce_extension_activated( 'WC_Product_Reviews_Pro' ) ) {
    wp_enqueue_style( 'archetype-woocommerce-product-reviews-pro-style', get_template_directory_uri() . '/inc/woocommerce/css/product-reviews-pro.css' );
  }

  /**
   * WooCommerce Smart Coupons
   */
  if ( is_woocommerce_extension_activated( 'WC_Smart_Coupons' ) ) {
    wp_enqueue_style( 'archetype-woocommerce-smart-coupons-style', get_template_directory_uri() . '/inc/woocommerce/css/smart-coupons.css' );
  }
}

/**
 * Add CSS in <head> for integration styles handled by the theme customizer
 *
 * @since 1.0
 */
if ( ! function_exists( 'archetype_add_integrations_customizer_css' ) ) {
  function archetype_add_integrations_customizer_css() {

    if ( is_archetype_customizer_enabled() ) {
      $accent_color           = archetype_sanitize_hex_color( get_theme_mod( 'archetype_accent_color', apply_filters( 'archetype_default_accent_color', '#a46497' ) ) );
      $header_text_color         = archetype_sanitize_hex_color( get_theme_mod( 'archetype_header_text_color', apply_filters( 'archetype_default_header_text_color', '#8a3125' ) ) );
      $header_background_color     = archetype_sanitize_hex_color( get_theme_mod( 'archetype_header_background_color', apply_filters( 'archetype_default_header_background_color', '#ee543f' ) ) );
      $text_color           = archetype_sanitize_hex_color( get_theme_mod( 'archetype_text_color', apply_filters( 'archetype_default_text_color', '#787E87' ) ) );
      $button_background_color     = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_background_color', apply_filters( 'archetype_default_button_background_color', '#787E87' ) ) );
      $button_text_color         = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_text_color', apply_filters( 'archetype_default_button_text_color', '#ffffff' ) ) );

      $woocommerce_style         = '';

      if ( is_woocommerce_extension_activated( 'WC_Bookings' ) ) {
        $woocommerce_style           .= '
        #wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.bookable a,
        #wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.bookable a:hover,
        #wc-bookings-booking-form .block-picker li a:hover,
        #wc-bookings-booking-form .block-picker li a.selected {
          background-color: ' . $accent_color . ' !important;
        }

        #wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.ui-state-disabled .ui-state-default,
        #wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker th {
          color:' . $text_color . ';
        }

        #wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker-header {
          background-color: ' . $header_background_color . ';
          color: ' . $header_text_color . ';
        }';
      }

      if ( is_woocommerce_extension_activated( 'WC_Product_Reviews_Pro' ) ) {
        $woocommerce_style           .= '
        .woocommerce #reviews .product-rating .product-rating-details table td.rating-graph .bar,
        .woocommerce-page #reviews .product-rating .product-rating-details table td.rating-graph .bar {
          background-color: ' . $text_color . ' !important;
        }

        .woocommerce #reviews .contribution-actions .feedback,
        .woocommerce-page #reviews .contribution-actions .feedback,
        .star-rating-selector:not(:checked) label.checkbox {
          color: ' . $text_color . ';
        }

        .woocommerce #reviews #comments ol.commentlist li .contribution-actions a,
        .woocommerce-page #reviews #comments ol.commentlist li .contribution-actions a,
        .star-rating-selector:not(:checked) input:checked ~ label.checkbox,
        .star-rating-selector:not(:checked) label.checkbox:hover ~ label.checkbox,
        .star-rating-selector:not(:checked) label.checkbox:hover,
        .woocommerce #reviews #comments ol.commentlist li .contribution-actions a,
        .woocommerce-page #reviews #comments ol.commentlist li .contribution-actions a,
        .woocommerce #reviews .form-contribution .attachment-type:not(:checked) label.checkbox:before,
        .woocommerce-page #reviews .form-contribution .attachment-type:not(:checked) label.checkbox:before {
          color: ' . $accent_color . ' !important;
        }';
      }

      if ( is_woocommerce_extension_activated( 'WC_Smart_Coupons' ) ) {
        $woocommerce_style           .= '
        .coupon-container {
          background-color: ' . $button_background_color . ' !important;
        }

        .coupon-content {
          border-color: ' . $button_text_color . ' !important;
          color: ' . $button_text_color . ';
        }

        .sd-buttons-transparent.woocommerce .coupon-content,
        .sd-buttons-transparent.woocommerce-page .coupon-content {
          border-color: ' . $button_background_color . ' !important;
        }';
      }

      wp_add_inline_style( 'archetype-style', $woocommerce_style );

    }
  }
}
