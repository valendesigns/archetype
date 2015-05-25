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

      $woocommerce_style = '/* WooCommerce Customizer Styles */';

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
      $post_border_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_post_border_color', apply_filters( 'archetype_default_post_border_color', '#e5e5e5' ) ) );

      // Post Shadow Toggle
      $post_shadow_toggle = archetype_sanitize_checkbox( get_theme_mod( 'archetype_post_shadow_toggle', apply_filters( 'archetype_default_post_shadow_toggle', true ) ) );

      // Post Shadow Color
      $post_shadow_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_post_shadow_color', apply_filters( 'archetype_default_post_shadow_color', '#8b949b' ) ) );

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
      $post_radius = archetype_sanitize_number( get_theme_mod( 'archetype_post_radius', apply_filters( 'archetype_default_post_radius', 0 ) ) );
      
      $woocommerce_style .= '
      .woocommerce-message,
      .woocommerce-info,
      .woocommerce-error {
        background-color: ' . $notice_success_color . ';
      }

      .form-row.woocommerce-validated input.input-text {
        box-shadow: 2px 0 0 ' . $notice_success_color . ' inset;
      }

      a.remove:before {
        color: ' . $notice_error_color . ';
      }

      .form-row.woocommerce-invalid input.input-text {
        box-shadow: 2px 0 0 ' . $notice_error_color . ' inset;
      }

      .woocommerce-error {
        background-color: ' . $notice_error_color . ' !important;
      }

      .demo_store {
        background-color: '  . $notice_info_color . ';
      }

      .woocommerce-info {
        background-color: '  . $notice_info_color . ';
      }

      ul.products li.product .price,
      p.stars a {
        color: ' . $text_color . ';
      }

      .widget_price_filter .price_slider {
        background: ' . $text_color . ' !important;
      }

      .type-product .onsale {
        background-color: ' . $text_color . ';
        color: ' . $post_background_color . ';
      }

      .star-rating span:before,
      p.stars a.toggled,
      p.stars a:hover,
      .product_list_widget a:hover {
        color: ' . $link_color . ';
      }

      .site-header-cart .widget_shopping_cart {
        background-color: ' . $nav_alt_background_color . ';
      }

      ul.products li.product {
        background: ' . $post_background_color . ';
        box-shadow: ' . ( false == $post_shadow_toggle ? 'none' : '0px -1px 0px ' . $post_shadow_color . ' inset' ) . ';
        border-radius: ' . $post_radius . 'px;
      }

      .single-product div.product .images .thumbnails {
        background: ' . $post_background_color . ';
        box-shadow: ' . ( false == $post_shadow_toggle ? 'none' : '0px -1px 0px ' . $post_shadow_color . ' inset' ) . ';
        border-radius: 0 0 ' . $post_radius . 'px ' . $post_radius . 'px;
      }

      .single-product div.product .summary {
        background: ' . $post_background_color . ';
        box-shadow: ' . ( false == $post_shadow_toggle ? 'none' : '0px -1px 0px ' . $post_shadow_color . ' inset' ) . ';
        border-radius: 0 0 ' . $post_radius . 'px ' . $post_radius . 'px;
      }
      
      .woocommerce-breadcrumb {
        background-color: ' . $post_background_color . ';
        border-radius: 0 0 ' . $post_radius . 'px ' . $post_radius . 'px;
      }

      .woocommerce-tabs ul.tabs {
        background: ' . $post_background_color . ';
        box-shadow: ' . ( false == $post_shadow_toggle ? 'none' : '0px -1px 0px ' . $post_shadow_color . ' inset' ) . ';
      }

      .woocommerce-tabs ul.tabs li a {
        background: ' . $post_background_color . ';
        border-bottom-color: ' . ( false == $post_shadow_toggle ? 'transparent' : $post_shadow_color ) . ';
      }

      .woocommerce-tabs #tab-description,
      .woocommerce-tabs #tab-additional_information {
        background: ' . $post_background_color . ';
        box-shadow: ' . ( false == $post_shadow_toggle ? 'none' : '0px -1px 0px ' . $post_shadow_color . ' inset' ) . ';
        border-radius: ' . $post_radius . 'px;
      }

      .single-product div.product form.cart {
        border-top-color: ' . $post_border_color . ';
        border-bottom-color: ' . $post_border_color . ';
      }

      .single-product div.product .variations_button {
        border-top-color: ' . $post_border_color . ';
      }

      .single-product div.product .woocommerce-product-rating {
        border-bottom-color: ' . $post_border_color . ';
      }

      .single-product div.product .product_meta .posted_in,
      .single-product div.product .product_meta .sku_wrapper,
      .single-product div.product .product_meta .tagged_as {
        border-bottom-color: ' . $post_border_color . ';
      }

      .woocommerce-breadcrumb {
        border-bottom-color: ' . $post_border_color . ';
      }

      table.cart td.actions .coupon {
        border-bottom-color: ' . $post_border_color . ';
      }

      #payment {
        border-top-color: ' . $post_border_color . ';
      }

      #payment .payment_methods {
        border-bottom-color: ' . $post_border_color . ';
      }

      #payment .payment_methods li {
        border-bottom-color: ' . $post_border_color . ';
      }

      #payment .payment_methods li .payment_box {
        border-top-color: ' . $post_border_color . ';
      }

      #customer_login .col-1 {
        border-bottom-color: ' . $post_border_color . ';
      }

      ul.order_details {
        border-color: ' . $post_border_color . ';
      }

      ul.order_details li {
        border-right-color: ' . $post_border_color . ';
      }

      ul.digital-downloads li {
        border-bottom-color: ' . $post_border_color . ';
      }

      @media screen and (min-width: 768px) {
        p.stars a.star-1,
        p.stars a.star-2,
        p.stars a.star-3,
        p.stars a.star-4 {
          border-right-color: ' . $post_border_color . ';
        }
        #order_review {
          border-color: ' . $post_border_color . ';
        }
      }

      .widget_shopping_cart p.buttons a.button {
        color: ' . $button_text_color . ';
      }

      .widget_shopping_cart p.buttons a.button:hover {
        color: ' . $button_text_hover_color . ';
      }

      .widget_price_filter .ui-slider .ui-slider-handle,
      .widget_price_filter .ui-slider .ui-slider-range {
        border-color: ' . $button_background_color . ';
        backround-color: ' . $button_background_color . ';
      }

      .woocommerce-tabs ul.tabs li.active a {
        color: ' . $button_text_color . ';
        backround-color: ' . $button_background_color . ';
        border-color: ' . $button_border_color . ';
      }

      @media screen and (min-width: 768px) {
        .site-header-cart .widget_shopping_cart .product_list_widget li a.remove:before {
          color: ' . $button_background_color . ';
        }
        .site-header-cart .widget_shopping_cart .product_list_widget li a.remove:hover:before {
          color: ' . $button_background_hover_color . ';
        }
      }';

      if ( is_woocommerce_extension_activated( 'WC_Bookings' ) ) {
        $woocommerce_style .= '
        #wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker-header {
          background-color: ' . $text_color . ';
          border-radius: ' . $post_radius . 'px ' . $post_radius . 'px 0 0;
        }

        #wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker .ui-datepicker-next,
        #wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker .ui-datepicker-prev {
          background-color: ' . $text_color . ';
          color: ' . $button_text_color . ';
        }

        #wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker .ui-datepicker-next:hover,
        #wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker .ui-datepicker-next:focus,
        #wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker .ui-datepicker-prev:hover,
        #wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker .ui-datepicker-prev:focus {
          background-color: ' . $button_background_color . ';
        }

        #wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.bookable a {
          background-color: ' . $button_background_color . ' !important;
        }

        #wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.bookable a:hover {
          background-color: ' . $button_background_hover_color . ' !important;
        }

        #wc-bookings-booking-form .block-picker li a {
          color: ' . $button_text_color . ';
        }

        #wc-bookings-booking-form .block-picker li a:hover {
          color: ' . $button_text_hover_color . ';
          background-color: ' . $button_background_hover_color . ';
        }

        #wc-bookings-booking-form .block-picker li a.selected {
          background-color: ' . $button_background_color . ';
          color: ' . $button_text_color . ';
        }

        #wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.ui-state-disabled .ui-state-default,
        #wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker th {
          color: ' . $text_color . ';
        }

        #wc-bookings-booking-form .block-picker li a:hover {
          color: ' . $text_color . ';
        }

        #wc-bookings-booking-form .wc-bookings-date-picker-choose-date {
          color: ' . $link_color . ';
        }';
      }

      if ( is_woocommerce_extension_activated( 'WC_Product_Reviews_Pro' ) ) {
        $woocommerce_style .= '
        .woocommerce #reviews .product-rating .product-rating-details table td.rating-graph .bar,
        .woocommerce-page #reviews .product-rating .product-rating-details table td.rating-graph .bar {
          background-color: ' . $text_color . ';
        }

        .woocommerce #reviews #comments ol.commentlist li .contribution-actions a,
        .woocommerce-page #reviews #comments ol.commentlist li .contribution-actions a {
          color: ' . $link_color . ';
        }

        .woocommerce .star-rating-selector:not(:checked) input:checked+label.checkbox:hover,
        .woocommerce .star-rating-selector:not(:checked) input:checked+label.checkbox:hover~label.checkbox,
        .woocommerce .star-rating-selector:not(:checked) input:checked~label.checkbox,
        .woocommerce .star-rating-selector:not(:checked) input:checked~label.checkbox:hover,
        .woocommerce .star-rating-selector:not(:checked) input:checked~label.checkbox:hover~label.checkbox,
        .woocommerce .star-rating-selector:not(:checked) label.checkbox:hover,
        .woocommerce .star-rating-selector:not(:checked) label.checkbox:hover~input:checked~label.checkbox,
        .woocommerce .star-rating-selector:not(:checked) label.checkbox:hover~label.checkbox,
        .woocommerce-page .star-rating-selector:not(:checked) input:checked+label.checkbox:hover,
        .woocommerce-page .star-rating-selector:not(:checked) input:checked+label.checkbox:hover~label.checkbox,
        .woocommerce-page .star-rating-selector:not(:checked) input:checked~label.checkbox,
        .woocommerce-page .star-rating-selector:not(:checked) input:checked~label.checkbox:hover,
        .woocommerce-page .star-rating-selector:not(:checked) input:checked~label.checkbox:hover~label.checkbox,
        .woocommerce-page .star-rating-selector:not(:checked) label.checkbox:hover,
        .woocommerce-page .star-rating-selector:not(:checked) label.checkbox:hover~input:checked~label.checkbox,
        .woocommerce-page .star-rating-selector:not(:checked) label.checkbox:hover~label.checkbox {
          color: ' . $link_color . ';
        }

        .woocommerce #reviews .product-rating,
        .woocommerce-page #reviews .product-rating {
          background-color: ' . $post_background_color . ';
          box-shadow: ' . ( false == $post_shadow_toggle ? 'none' : '0px -1px 0px ' . $post_shadow_color . ' inset' ) . ';
          border-radius: ' . $post_radius . 'px;
        }

        .woocommerce #reviews .contribution-form-wrapper .form-contribution,
        .woocommerce-page #reviews .contribution-form-wrapper .form-contribution {
          background: ' . $post_background_color . ';
          box-shadow: ' . ( false == $post_shadow_toggle ? 'none' : '0px -1px 0px ' . $post_shadow_color . ' inset' ) . ';
          border-radius: ' . $post_radius . 'px;
        }

        .woocommerce #reviews #comments ol.commentlist li,
        .woocommerce-page #reviews #comments ol.commentlist li {
          background: ' . $post_background_color . ';
          box-shadow: ' . ( false == $post_shadow_toggle ? 'none' : '0px -1px 0px ' . $post_shadow_color . ' inset' ) . ';
          border-radius: ' . $post_radius . 'px;
        }

        .woocommerce #reviews .contribution-flag-form,
        .woocommerce-page #reviews .contribution-flag-form {
          background-color: ' . $post_background_color . ';
        }

        .woocommerce #reviews .contribution-type-selector > a.active,
        .woocommerce-page #reviews .contribution-type-selector > a.active {
          background: ' . $post_background_color . ';
        }';
      }

      if ( is_woocommerce_extension_activated( 'WC_Smart_Coupons' ) ) {
        $woocommerce_style .= '';
      }

      if ( is_woocommerce_extension_activated( 'WC_Wishlists_Wishlist' ) ) {
        $woocommerce_style .= '
        #wl-wrapper .wl-share-links a {
          color: ' . $link_color . ';
        }

        #wl-wrapper .wl-share-links a:hover {
          color: ' . $link_color_hover . ';
        }

        #wl-wrapper ul.wl-tabs {
          background: ' . $post_background_color . ';
        }

        #wl-wrapper ul.wl-tabs > li > a {
          background: ' . $post_background_color . ';
          box-shadow: ' . ( false == $post_shadow_toggle ? 'none' : '0px -1px 0px ' . $post_shadow_color . ' inset' ) . ';
        }

        #wl-wrapper ul.wl-tabs > li > a:hover {
          background: ' . $post_background_color . ';
        }
        
        #wl-wrapper ul.wl-tabs > li.active a {
          color: ' . $button_text_color . ';
          background: ' . $button_background_color . ';
          border-color: ' . $button_border_color . ';
        }

        .wl-list-pop {
          background: ' . $post_background_color . ';
          border-color: ' . $post_border_color . ';
          border-bottom-color: ' . ( false == $post_shadow_toggle ? 'transparent' : $post_shadow_color ) . ';
          border-radius: ' . $post_radius . 'px;
        }

        #wl-wrapper .wl-meta-share,
        #wl-wrapper .wl-share-url {
          border-bottom-color: ' . $post_border_color . ';
        }';
      }

      if ( is_woocommerce_extension_activated( 'WC_Photography' ) ) {
        $woocommerce_style .= '
        .woocommerce .photography-products .tools,
        .woocommerce-page .photography-products .tools {
          background-color: ' . $post_background_color . ';
          box-shadow: ' . ( false == $post_shadow_toggle ? 'none' : '0px -1px 0px ' . $post_shadow_color . ' inset' ) . ';
          border-radius: ' . $post_radius . 'px;
        }';
      }

      if ( is_woocommerce_extension_activated( 'WC_Composite_Products' ) ) {
        $woocommerce_style .= '
        .single-product div.product .component_selections .component_summary {
          border-bottom-color: ' . $post_border_color . ';
        }';
      }

      // Remove space after colons
      $woocommerce_style = str_replace( ': ', ':', $woocommerce_style );

      // Remove whitespace
      $woocommerce_style = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $woocommerce_style );

      wp_add_inline_style( 'archetype-woocommerce-style', $woocommerce_style );

    }
  }
}
