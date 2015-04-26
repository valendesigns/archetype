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

    // Text color
    $text_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_text_color', apply_filters( 'archetype_default_text_color', '#555' ) ) );

    $style.= '
    body,
    button,
    input,
    select,
    textarea,
    .author-info .author-heading,
    #comments p.no-comments,
    .post-navigation .meta-nav,
    .widget-area .widget a {
      color: ' . $text_color . ';
    }
    #comments .comment-list .bypostauthor > .comment-body cite:after,
    #comments .commentlist .bypostauthor > .comment-body cite:after,
    .secondary-navigation .menu a:not(.button) {
      color: ' . archetype_adjust_color_brightness( $text_color, 51 ) . ';
    }
    .widget_search form input[type=search]:focus,
    .widget_product_search form input[type=search]:focus,
    .error-404-search form input[type=search]:focus {
      color: ' . archetype_adjust_color_brightness( $text_color, -25.5 ) . ';
    }
    .page-header,
    #comments p.no-comments,
    .post-navigation a:hover {
      box-shadow: 5px 0px 0px ' . $text_color . ' inset;
    }
    .sticky-post,
    .pagination .prev,
    .pagination .next,
    .image-navigation .nav-previous a,
    .image-navigation .nav-next a,
    .comment-navigation .prev,
    .comment-navigation .next,
    .woocommerce-pagination .prev,
    .woocommerce-pagination .next,
    .page-links a,
    .bx-controls-direction .bx-prev:hover,
    .bx-controls-direction .bx-next:hover {
      background-color: ' . $text_color . ';
    }
    .page-links a,
    .widget h3.widget-title {
      border-color: ' . $text_color . ';
    }';

    // Heading color
    $heading_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_heading_color', apply_filters( 'archetype_default_heading_color', '#333' ) ) );

    $style.= '
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    .hentry .entry-header h1 a {
      color: ' . $heading_color . ';
    }
    .hentry .entry-header h1 a:hover {
      border-color: ' . $heading_color . ';
    }';
    
    $woocommerce_style = '';

    wp_add_inline_style( 'archetype-style', $style );
    wp_add_inline_style( 'archetype-woocommerce-style', $woocommerce_style );
  }
}