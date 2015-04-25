<?php
/**
 * archetype Theme Customizer display functions
 *
 * @package archetype
 */

/**
 * Add CSS in <head> for styles handled by the theme customizer
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'archetype_add_customize_css' ) ) {
  function archetype_add_customize_css() {
    $style = '';

    // Site Logo
    if ( $logo_top_margin = get_theme_mod( 'archetype_site_logo_margin_top' ) ) {
      $style.= '
      .site-logo-link img {
        margin-top: ' . esc_attr( $logo_top_margin ) . 'em;
      }';
    }

    $accent_color           = archetype_sanitize_hex_color( get_theme_mod( 'archetype_accent_color', apply_filters( 'archetype_default_accent_color', '#96588a' ) ) );
    
    $background_color     = archetype_sanitize_hex_color( get_theme_mod( 'archetype_background_color', apply_filters( 'archetype_default_background_color', '#25292c' ) ) );
    
    $header_background_color     = archetype_sanitize_hex_color( get_theme_mod( 'archetype_header_background_color', apply_filters( 'archetype_default_header_background_color', '#ee543f' ) ) );
    $header_link_color         = archetype_sanitize_hex_color( get_theme_mod( 'archetype_header_link_color', apply_filters( 'archetype_default_header_link_color', '#ffffff' ) ) );
    $header_text_color        = archetype_sanitize_hex_color( get_theme_mod( 'archetype_header_text_color', apply_filters( 'archetype_default_header_text_color', '#9aa0a7' ) ) );
    
    $content_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_content_background_color' ) );
    
    $footer_background_color     = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_background_color', apply_filters( 'archetype_default_footer_background_color', '#353b3f' ) ) );
    $footer_link_color         = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_link_color', apply_filters( 'archetype_default_footer_link_color', '#96588a' ) ) );
    $footer_heading_color       = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_heading_color', apply_filters( 'archetype_default_footer_heading_color', '#494c50' ) ) );
    $footer_text_color         = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_text_color', apply_filters( 'archetype_default_footer_text_color', '#61656b' ) ) );

    $text_color           = archetype_sanitize_hex_color( get_theme_mod( 'archetype_text_color', apply_filters( 'archetype_default_text_color', '#787E87' ) ) );
    $heading_color           = archetype_sanitize_hex_color( get_theme_mod( 'archetype_heading_color', apply_filters( 'archetype_default_heading_color', '#484c51' ) ) );
    $button_background_color     = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_background_color', apply_filters( 'archetype_default_button_background_color', '#787E87' ) ) );
    $button_text_color         = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_text_color', apply_filters( 'archetype_default_button_text_color', '#ffffff' ) ) );
    $button_alt_background_color   = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_alt_background_color', apply_filters( 'archetype_default_button_alt_background_color', '#96588a' ) ) );
    $button_alt_text_color       = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_alt_text_color', apply_filters( 'archetype_default_button_alt_text_color', '#ffffff' ) ) );

    $brighten_factor          = apply_filters( 'archetype_brighten_factor', 25 );
    $darken_factor            = apply_filters( 'archetype_darken_factor', -25 );
    
    $style2               = '
    body {
      background-color: ' . $background_color . ';
    }
    .site {
      background-color: ' . ( $content_background_color ? $content_background_color : 'transparent' ) . ';
    }
    
    .main-navigation ul li a,
    .site-title a,
    ul.menu li a,
    .site-branding h1 a {
      color: ' . $header_link_color . ';
    }

    .main-navigation ul li a:hover,
    .site-title a:hover {
      color: ' . archetype_adjust_color_brightness( $header_link_color, $darken_factor ) . ';
    }

    .site-header,
    .main-navigation ul ul,
    .secondary-navigation ul ul,
    .main-navigation ul.menu > li.menu-item-has-children:after,
    .secondary-navigation ul.menu ul,
    .main-navigation ul.menu ul,
    .main-navigation ul.nav-menu ul {
      background-color: ' . $header_background_color . ';
    }

    p.site-description,
    ul.menu li.current-menu-item > a {
      color: ' . $header_text_color . ';
    }

    h1, h2, h3, h4, h5, h6 {
      color: ' . $heading_color . ';
    }

    .hentry .entry-header {
      border-color: ' . $heading_color . ';
    }

    .widget h1 {
      border-bottom-color: ' . $heading_color . ';
    }

    body,
    .secondary-navigation a,
    .widget-area .widget a,
    .onsale,
    #comments .comment-list .reply a {
      color: ' . $text_color . ';
    }

    a  {
      color: ' . $accent_color . ';
    }

    button, input[type="button"], input[type="reset"], input[type="submit"], .button, .added_to_cart, .widget-area .widget a.button, .site-header-cart .widget_shopping_cart a.button {
      background-color: ' . $button_background_color . ';
      border-color: ' . $button_background_color . ';
      color: ' . $button_text_color . ';
    }

    button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:hover, .added_to_cart:hover, .widget-area .widget a.button:hover, .site-header-cart .widget_shopping_cart a.button:hover {
      background-color: ' . archetype_adjust_color_brightness( $button_background_color, $darken_factor ) . ';
      border-color: ' . archetype_adjust_color_brightness( $button_background_color, $darken_factor ) . ';
      color: ' . $button_text_color . ';
    }

    button.alt, input[type="button"].alt, input[type="reset"].alt, input[type="submit"].alt, .button.alt, .added_to_cart.alt, .widget-area .widget a.button.alt, .added_to_cart {
      background-color: ' . $button_alt_background_color . ';
      border-color: ' . $button_alt_background_color . ';
      color: ' . $button_alt_text_color . ';
    }

    button.alt:hover, input[type="button"].alt:hover, input[type="reset"].alt:hover, input[type="submit"].alt:hover, .button.alt:hover, .added_to_cart.alt:hover, .widget-area .widget a.button.alt:hover, .added_to_cart:hover {
      background-color: ' . archetype_adjust_color_brightness( $button_alt_background_color, $darken_factor ) . ';
      border-color: ' . archetype_adjust_color_brightness( $button_alt_background_color, $darken_factor ) . ';
      color: ' . $button_alt_text_color . ';
    }

    .site-footer {
      background-color: ' . $footer_background_color . ';
      color: ' . $footer_text_color . ';
    }

    .site-footer a:not(.button) {
      color: ' . $footer_link_color . ';
    }

    .site-footer h1, .site-footer h2, .site-footer h3, .site-footer h4, .site-footer h5, .site-footer h6 {
      color: ' . $footer_heading_color . ';
    }

    @media screen and ( min-width: 768px ) {
      .main-navigation ul.menu > li > ul {
        border-top-color: ' . $header_background_color . '}
      }

      .secondary-navigation ul.menu a:hover {
        color: ' . archetype_adjust_color_brightness( $header_text_color, $brighten_factor ) . ';
      }

      .main-navigation ul.menu ul {
        background-color: ' . $header_background_color . ';
      }

      .secondary-navigation ul.menu a {
        color: ' . $header_text_color . ';
      }
    }';

    $woocommerce_style               = '
    a.cart-contents,
    .site-header-cart .widget_shopping_cart a {
      color: ' . $header_link_color . ';
    }

    a.cart-contents:hover,
    .site-header-cart .widget_shopping_cart a:hover {
      color: ' . archetype_adjust_color_brightness( $header_link_color, $darken_factor ) . ';
    }

    .site-header-cart .widget_shopping_cart {
      background-color: ' . $header_background_color . ';
    }

    .woocommerce-tabs ul.tabs li.active a,
    ul.products li.product .price,
    .onsale {
      color: ' . $text_color . ';
    }

    .onsale {
      border-color: ' . $text_color . ';
    }

    .star-rating span:before,
    .widget-area .widget a:hover,
    .product_list_widget a:hover,
    .quantity .plus, .quantity .minus,
    p.stars a:hover:after,
    p.stars a:after,
    .star-rating span:before {
      color: ' . $accent_color . ';
    }

    .widget_price_filter .ui-slider .ui-slider-range,
    .widget_price_filter .ui-slider .ui-slider-handle {
      background-color: ' . $accent_color . ';
    }

    #order_review_heading, #order_review {
      border-color: ' . $accent_color . ';
    }

    @media screen and ( min-width: 768px ) {
      .site-header-cart .widget_shopping_cart,
      .site-header .product_list_widget li .quantity {
        color: ' . $header_text_color . ';
      }
    }';

    wp_add_inline_style( 'archetype-style', $style );
    //wp_add_inline_style( 'archetype-woocommerce-style', $woocommerce_style );
  }
}