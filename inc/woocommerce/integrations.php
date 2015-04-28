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

  // Checks if current locale is RTL
  $rtl = is_rtl() ? '-rtl' : '';

  /**
   * Bookings
   */
  if ( is_woocommerce_extension_activated( 'WC_Bookings' ) ) {
    wp_enqueue_style( 'archetype-woocommerce-bookings-style', get_template_directory_uri() . '/inc/woocommerce/css/bookings' . $rtl . '.css' );
  }

  /**
   * Brands
   */
  if ( is_woocommerce_extension_activated( 'WC_Brands' ) ) {
    wp_enqueue_style( 'archetype-woocommerce-brands-style', get_template_directory_uri() . '/inc/woocommerce/css/brands' . $rtl . '.css' );
  }

  /**
   * Wishlists
   */
  if ( is_woocommerce_extension_activated( 'WC_Wishlists_Wishlist' ) ) {
    wp_enqueue_style( 'archetype-woocommerce-wishlists-style', get_template_directory_uri() . '/inc/woocommerce/css/wishlists' . $rtl . '.css' );
  }

  /**
   * AJAX Layered Nav
   */
  if ( is_woocommerce_extension_activated( 'SOD_Widget_Ajax_Layered_Nav' ) ) {
    wp_enqueue_style( 'archetype-woocommerce-ajax-layered-nav-style', get_template_directory_uri() . '/inc/woocommerce/css/ajax-layered-nav' . $rtl . '.css' );
  }

  /**
   * Variation Swatches
   */
  if ( is_woocommerce_extension_activated( 'WC_SwatchesPlugin' ) ) {
    wp_enqueue_style( 'archetype-variation-swatches-style', get_template_directory_uri() . '/inc/woocommerce/css/variation-swatches' . $rtl . '.css' );
  }

  /**
   * Composite Products
   */
  if ( is_woocommerce_extension_activated( 'WC_Composite_Products' ) ) {
    wp_enqueue_style( 'archetype-composite-products-style', get_template_directory_uri() . '/inc/woocommerce/css/composite-products' . $rtl . '.css' );
  }

  /**
   * WooCommerce Photography
   */
  if ( is_woocommerce_extension_activated( 'WC_Photography' ) ) {
    wp_enqueue_style( 'archetype-woocommerce-photography-style', get_template_directory_uri() . '/inc/woocommerce/css/photography' . $rtl . '.css' );
  }

  /**
   * Product Reviews Pro
   */
  if ( is_woocommerce_extension_activated( 'WC_Product_Reviews_Pro' ) ) {
    wp_enqueue_style( 'archetype-woocommerce-product-reviews-pro-style', get_template_directory_uri() . '/inc/woocommerce/css/product-reviews-pro' . $rtl . '.css' );
  }

  /**
   * WooCommerce Smart Coupons
   */
  if ( is_woocommerce_extension_activated( 'WC_Smart_Coupons' ) ) {
    wp_enqueue_style( 'archetype-woocommerce-smart-coupons-style', get_template_directory_uri() . '/inc/woocommerce/css/smart-coupons' . $rtl . '.css' );
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

      $woocommerce_style = '';

      // Text color
      $text_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_text_color', apply_filters( 'archetype_default_text_color', '#555' ) ) );

      // Link Color
      $link_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_link_color', apply_filters( 'archetype_default_link_color', '#ee543f' ) ) );

      // Link Color Hover
      $link_color_hover = archetype_sanitize_hex_color( get_theme_mod( 'archetype_link_color_hover', apply_filters( 'archetype_default_link_color_hover', '#111' ) ) );

      // Secondary Navigation Background Color
      $nav_alt_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_alt_background_color', apply_filters( 'archetype_default_nav_alt_background_color', '#41484d' ) ) );

      // Post Background Color
      $post_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_post_background_color', apply_filters( 'archetype_default_post_background_color', '#fff' ) ) );

      // Post Border Color
      $post_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_post_border_color', apply_filters( 'archetype_default_post_border_color', '#e5e5e5' ) ) );

      // Post Shadow Color
      $post_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_post_shadow_color', apply_filters( 'archetype_default_post_shadow_color', '#8b949b' ) ) );

      // Button Text Color
      $button_text_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_text_color', apply_filters( 'archetype_default_button_text_color', '#fff' ) ) );

      // Button Background Color
      $button_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_background_color', apply_filters( 'archetype_default_button_background_color', '#ed543f' ) ) );

      // Button Border Color
      $button_border_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_border_color', apply_filters( 'archetype_default_button_border_color', '#d94834' ) ) );

      // Button Hover Text Color
      $button_text_hover_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_text_hover_color', apply_filters( 'archetype_default_button_text_hover_color', '#555' ) ) );

      // Button Hover Background Color
      $button_background_hover_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_background_hover_color', apply_filters( 'archetype_default_button_background_hover_color', '#fff' ) ) );

      // Notice Error
      $notice_error_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_notice_error_color', apply_filters( 'archetype_default_notice_error_color', '#f75f46' ) ) );

      // Notice Success
      $notice_success_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_notice_success_color', apply_filters( 'archetype_default_notice_success_color', '#36c478' ) ) );

      // Notice Info
      $notice_info_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_notice_info_color', apply_filters( 'archetype_default_notice_info_color', '#3D9CD2' ) ) );

      // Post border radius
      $post_radius = (int) get_theme_mod( 'archetype_post_radius', apply_filters( 'archetype_default_post_radius', '0' ) );
      
      $woocommerce_style .= '
      ul.products li.product .price,
      p.stars a {
        color: ' . $text_color . ';
      }
      .widget_price_filter .price_slider {
        background: ' . $text_color . ' !important;
      }
      .type-product .onsale {
        background-color: ' . $text_color . ';
      }';

      if ( is_woocommerce_extension_activated( 'WC_Bookings' ) ) {
        $woocommerce_style .= '
        #wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker-header,
        #wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker .ui-datepicker-next,
        #wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker .ui-datepicker-prev {
          background-color: ' . $text_color . ';
        }

        #wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.ui-state-disabled .ui-state-default,
        #wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker th {
          color: ' . $text_color . ';
        }
        
        #wc-bookings-booking-form .block-picker li a:hover {
          color: ' . $text_color . ';
        }';
      }

      if ( is_woocommerce_extension_activated( 'WC_Product_Reviews_Pro' ) ) {
        $woocommerce_style .= '
        .woocommerce #reviews .product-rating .product-rating-details table td.rating-graph .bar,
        .woocommerce-page #reviews .product-rating .product-rating-details table td.rating-graph .bar {
          background-color: ' . $text_color . ';
        }';
      }

      if ( is_woocommerce_extension_activated( 'WC_Smart_Coupons' ) ) {
        $woocommerce_style .= '';
      }

      // Remove space after colons
      $woocommerce_style = str_replace( ': ', ':', $woocommerce_style );

      // Remove whitespace
      $woocommerce_style = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $woocommerce_style );

      wp_add_inline_style( 'archetype-woocommerce-style', $woocommerce_style );

    }
  }
}
