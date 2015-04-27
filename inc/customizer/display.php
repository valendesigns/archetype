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
    $style = '/* Customizer Styles */';

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
    #comments .commentlist .bypostauthor > .comment-body cite:after {
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
    .page-links > span,
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
    
    // Link Color
    $link_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_link_color', apply_filters( 'archetype_default_link_color', '#ee543f' ) ) );

    $style.= '
    a,
    .error-404 h1
    .subscribe-and-connect-connect a:hover,
    .widget-area .widget a:hover {
      color: ' . $link_color . ';
    }
    a:focus,
    button:focus,
    input[type="button"]:focus,
    input[type="reset"]:focus,
    input[type="submit"]:focus,
    .button:focus,
    .added_to_cart:focus {
      outline-color: ' . $link_color . ';
    }
    .error-404 h1 {
      border-color: ' . $link_color . ';
    }';
    
    // Link Color Hover
    $link_color_hover = archetype_sanitize_hex_color( get_theme_mod( 'archetype_link_color_hover', apply_filters( 'archetype_default_link_color_hover', '#111' ) ) );

    $style.= '
    a:hover {
      color: ' . $link_color_hover . ';
    }';

    // Header Background Color
    $header_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_header_background_color', apply_filters( 'archetype_default_header_background_color', '#353b3f' ) ) );

    $style.= '
    .site-header {
      background-color: ' . $header_background_color . ';
    }';

    // Header Color
    $header_text_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_header_text_color', apply_filters( 'archetype_default_header_text_color', '#888' ) ) );

    $style.= '
    .site-header {
      color: ' . $header_text_color . ';
    }';

    // Header Link Color
    $header_link_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_header_link_color', apply_filters( 'archetype_default_header_link_color', '#aaa' ) ) );

    $style.= '
    .site-header a {
      color: ' . $header_link_color . ';
    }';

    // Header Link Color Hover
    $header_link_color_hover = archetype_sanitize_hex_color( get_theme_mod( 'archetype_header_link_color_hover', apply_filters( 'archetype_default_header_link_color_hover', '#ee543f' ) ) );

    $style.= '
    .site-header a:hover {
      color: ' . $header_link_color_hover . ';
    }';
    
    // Navigation Background Color
    $nav_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_background_color', apply_filters( 'archetype_default_nav_background_color', '#2f3538' ) ) );

    $style.= '
    @media screen and (min-width: 768px) {
      #navigation,
      .main-navigation ul.menu ul {
        background-color: ' . $nav_background_color . ';
      }
    }';
    
    // Navigation Link Color
    $nav_link_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_link_color', apply_filters( 'archetype_default_nav_link_color', '#bbb' ) ) );

    $style.= '
    .main-navigation ul li a {
      color: ' . $nav_link_color . ';
    }';
    
    // Navigation Link Hover Color
    $nav_link_color_hover = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_link_color_hover', apply_filters( 'archetype_default_nav_link_color_hover', '#fff' ) ) );

    $style.= '
    .main-navigation ul li a:hover {
      color: ' . $nav_link_color_hover . ';
    }';
    
    // Navigation Link Hover Background Color
    $nav_link_color_hover_bg = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_link_color_hover_bg', apply_filters( 'archetype_default_nav_link_color_hover_bg', '#2f3538' ) ) );

    $style.= '
    @media screen and (min-width: 768px) {
      .main-navigation ul.menu ul a:hover,
      .main-navigation ul.menu ul li:hover > a {
        background-color: ' . $nav_link_color_hover_bg . ';
      }
    }';
    
    // Navigation Link Active Color
    $nav_link_color_active = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_link_color_active', apply_filters( 'archetype_default_nav_link_color_active', '#fff' ) ) );
    
    // Navigation Link Active Background Color
    $nav_link_color_active_bg = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_link_color_active_bg', apply_filters( 'archetype_default_nav_link_color_active_bg', '#24282A' ) ) );

    $style.= '
    .main-navigation ul li.current-menu-item > a,
    .main-navigation ul li.current_page_parent > a,
    .main-navigation ul li.current-menu-ancestor > a {
      color: ' . $nav_link_color_active . ';
      background-color: ' . $nav_link_color_active_bg . ';
    }';
    
        // Secondary Navigation Color
        $nav_alt_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_alt_color', apply_filters( 'archetype_nav_alt_alt_color', '#bbb' ) ) );
    
        $style.= '
    .secondary-navigation {
      color: ' . $nav_alt_color . ';
    }';
    
    // Secondary Navigation Background Color
    $nav_alt_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_alt_background_color', apply_filters( 'archetype_default_nav_alt_background_color', '#41484d' ) ) );
    
    // Secondary Navigation Link Color
    $nav_alt_link_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_alt_link_color', apply_filters( 'archetype_default_nav_alt_link_color', '#ddd' ) ) );

    // Secondary Navigation Link Hover Color
    $nav_alt_link_color_hover = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_alt_link_color_hover', apply_filters( 'archetype_default_nav_alt_link_color_hover', '#fff' ) ) );
    
    // Secondary Navigation Link Hover Background Color
    $nav_alt_link_color_hover_bg = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_alt_link_color_hover_bg', apply_filters( 'archetype_default_nav_alt_link_color_hover_bg', '#464e54' ) ) );
    
    // Secondary Navigation Link Active Color
    $nav_alt_link_color_active = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_alt_link_color_active', apply_filters( 'archetype_default_nav_alt_link_color_active', '#fff' ) ) );
    
    // Secondary Navigation Link Active Background Color
    $nav_alt_link_color_active_bg = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_alt_link_color_active_bg', apply_filters( 'archetype_default_nav_alt_link_color_active_bg', '#3b4146' ) ) );

    $style.= '
    @media screen and (min-width: 768px) {
      .secondary-navigation ul.menu li a {
        color: ' . $nav_alt_link_color . ';
      }
      .secondary-navigation ul.menu li a:hover {
        color: ' . $nav_alt_link_color_hover . ';
      }
      .secondary-navigation ul.menu li ul {
        background-color: ' . $nav_alt_background_color . ';
      }
      .secondary-navigation ul.menu li ul a:hover,
      .secondary-navigation ul.menu li ul li:hover > a {
        background-color: ' . $nav_alt_link_color_hover_bg . ';
      }
      .secondary-navigation ul.menu li li.current-menu-item > a,
      .secondary-navigation ul.menu li li.current_page_parent > a,
      .secondary-navigation ul.menu li li.current-menu-ancestor > a {
        color: ' . $nav_alt_link_color_active . ';
        background-color: ' . $nav_alt_link_color_active_bg . ';
      }
    }';

    // Post Background Color
    $post_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_post_background_color', apply_filters( 'archetype_default_post_background_color', '#fff' ) ) );

    // Get the RGB value from hex and set the comment rgba `border-color` for our tricky triangle shape.
    $rgb = archetype_rgb_from_hex( $post_background_color );
    $border_color = 3 === count( $rgb ) ? 'border-color: rgba(' . $rgb[ 'r' ] . ', ' . $rgb[ 'g' ] . ', ' . $rgb[ 'b' ] . ', 0);' : '';

    $style.= '
    article + .author-info,
    #comments p.no-comments,
    #comments .comment-list .comment-content,
    #comments .commentlist .comment-content,
    #respond,
    .page-header,
    .hentry,
    .pagination,
    .image-navigation,
    .comment-navigation,
    .woocommerce-pagination,
    .post-navigation {
      background-color: ' . $post_background_color . ';
    }
    .sticky-post,
    .page-links a,
    .page-links a > span,
    .page-links a:hover,
    .page-links a:focus,
    .page-links a:hover > span,
    .page-links a:focus > span {
      color: ' . $post_background_color . ';
    }
    #comments .with-avatar > .comment-body .comment-content:after {
      ' . $border_color . '
      border-right-color: ' . $post_background_color . ';
    }';

    // Post Border Color
    $post_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_post_border_color', apply_filters( 'archetype_default_post_border_color', '#e5e5e5' ) ) );

    $style.= '
    table thead th,
    #comments .comment-list .comment-meta,
    #comments .commentlist .comment-meta {
      border-bottom-color: ' . $post_background_color. ';
    }
    table tfoot th,
    table tfoot td,
    .author-info,
    .hentry .entry-meta {
      border-top-color: ' . $post_background_color. ';
    }
    .format-quote .author-info + .entry-meta {
      border-color: ' . $post_background_color. ';
    }
    .post-navigation div + div {
      box-shadow: 0px 1px 0px ' . $post_background_color. ' inset;
    }';

    // Post Shadow Color
    $post_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_post_shadow_color', apply_filters( 'archetype_default_post_shadow_color', '#8b949b' ) ) );

    $style.= '
    article + .author-info,
    #comments .comment-list .comment-content,
    #comments .commentlist .comment-content,
    #respond,
    .hentry,
    .post-navigation {
      box-shadow: 0px -1px 0px ' . $post_background_color. ' inset;
    }';

    // Form Text Color
    $form_text_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_form_text_color', apply_filters( 'archetype_default_form_text_color', '#555' ) ) );

    // Form Background Color
    $form_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_form_background_color', apply_filters( 'archetype_default_form_background_color', '#e4e4e4' ) ) );

    // Form Focus Text Color
    $form_text_focus_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_form_text_focus_color', apply_filters( 'archetype_default_form_text_focus_color', '#3b3b3b' ) ) );

    // Form Focus Background Color
    $form_background_focus_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_form_background_focus_color', apply_filters( 'archetype_default_form_background_focus_color', '#d7d7d7' ) ) );

    $style.= '
    input[type="text"],
    input[type="email"],
    input[type="url"],
    input[type="password"],
    input[type="search"],
    textarea,
    .input-text {
      background-color: ' . $form_background_color . ';
      color: ' . $form_text_color . ';
    }
    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="url"]:focus,
    input[type="password"]:focus,
    input[type="search"]:focus,
    textarea:focus,
    .input-text:focus {
      background-color: ' . $form_background_focus_color . ';
      color: ' . $form_text_focus_color . ';
    }';

    // Search Text Color
    $search_text_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_search_text_color', apply_filters( 'archetype_default_search_text_color', '#555' ) ) );

    // Search Background Color
    $search_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_search_background_color', apply_filters( 'archetype_default_search_background_color', '#fff' ) ) );

    // Search Shadow Color
    $search_shadow_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_search_shadow_color', apply_filters( 'archetype_default_search_shadow_color', '#8b949b' ) ) );

    $style.= '
    .widget_search form input[type=search],
    .widget_product_search form input[type=search],
    .error-404-search form input[type=search] {
      background-color: ' . $search_background_color . ';
      box-shadow: 0px -1px 0px ' . $search_shadow_color . ' inset;
      color: ' . $search_text_color . ';
    }
    .widget_search form input[type=search]:focus,
    .widget_product_search form input[type=search]:focus,
    .error-404-search form input[type=search]:focus {
      color: ' . archetype_adjust_color_brightness( $search_text_color, -25.5 ) . ';
    }
    .widget_search form,
    .widget_product_search form,
    .error-404-search form {
      color: ' . $search_text_color . ';
    }';

    // Button 2D
    $button_2d = (bool) get_theme_mod( 'archetype_button_2d', apply_filters( 'archetype_default_button_2d', false ) );

    // Button Text Color
    $button_text_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_text_color', apply_filters( 'archetype_default_button_text_color', '#fff' ) ) );

    // Button Background Color
    $button_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_background_color', apply_filters( 'archetype_default_button_background_color', '#ed543f' ) ) );

    // Button Border Color
    $button_border_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_border_color', apply_filters( 'archetype_default_button_border_color', '#d94834' ) ) );

    // Button Shadow Color
    $button_shadow_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_shadow_color', apply_filters( 'archetype_default_button_shadow_color', '#d94834' ) ) );

    // Button Hover Text Color
    $button_text_hover_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_text_hover_color', apply_filters( 'archetype_default_button_text_hover_color', '#555' ) ) );

    // Button Hover Background Color
    $button_background_hover_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_background_hover_color', apply_filters( 'archetype_default_button_background_hover_color', '#fff' ) ) );

    // Button Hover Border Color
    $button_border_hover_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_border_hover_color', apply_filters( 'archetype_default_button_border_hover_color', '#8b949b' ) ) );

    // Button Hover Shadow Color
    $button_shadow_hover_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_shadow_hover_color', apply_filters( 'archetype_default_button_shadow_hover_color', '#8b949b' ) ) );

    $style.= '
    .bx-controls-direction .bx-prev, .bx-controls-direction .bx-next {
      background-color: ' . $button_background_color . ';
      color: ' . $button_text_color . ';
    }
    button, input[type="button"], input[type="reset"], input[type="submit"], .button, .added_to_cart, button.cta:hover, input[type="button"].cta:hover, input[type="reset"].cta:hover, input[type="submit"].cta:hover, .button.cta:hover, .added_to_cart.cta:hover, button.alt:hover, input[type="button"].alt:hover, input[type="reset"].alt:hover, input[type="submit"].alt:hover, .button.alt:hover, .added_to_cart.alt:hover {
      background-color: ' . $button_background_color . ';
      border-color: ' . $button_border_color . ';
      color: ' . $button_text_color . ';
      ' . ( $button_2d ? 'box-shadow: none !important;' : 'box-shadow: 0 -2px 0 ' . $button_shadow_color . ' inset;' ) . '
    }
    button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:hover, .added_to_cart:hover, button.cta, button.alt, input[type="button"].cta, input[type="button"].alt, input[type="reset"].cta, input[type="reset"].alt, input[type="submit"].cta, input[type="submit"].alt, .button.cta, .button.alt, .added_to_cart.cta, .added_to_cart.alt {
      background-color: ' . $button_background_hover_color . ';
      border-color: ' . $button_border_hover_color . ';
      color: ' . $button_text_hover_color . ';
      ' . ( $button_2d ? 'box-shadow: none !important;' : 'box-shadow: 0 -2px 0 ' . $button_shadow_hover_color . ' inset;' ) . '
    }
    .mejs-controls .mejs-time-rail .mejs-time-current {
      background: ' . $button_background_color . ' !important;
    }
    .pagination .prev:hover, .pagination .prev:focus, .pagination .next:hover, .pagination .next:focus, .pagination .nav-previous a:hover, .pagination .nav-previous a:focus, .pagination .nav-next a:hover, .pagination .nav-next a:focus, .image-navigation .prev:hover, .image-navigation .prev:focus, .image-navigation .next:hover, .image-navigation .next:focus, .image-navigation .nav-previous a:hover, .image-navigation .nav-previous a:focus, .image-navigation .nav-next a:hover, .image-navigation .nav-next a:focus, .comment-navigation .prev:hover, .comment-navigation .prev:focus, .comment-navigation .next:hover, .comment-navigation .next:focus, .comment-navigation .nav-previous a:hover, .comment-navigation .nav-previous a:focus, .comment-navigation .nav-next a:hover, .comment-navigation .nav-next a:focus, .woocommerce-pagination .prev:hover, .woocommerce-pagination .prev:focus, .woocommerce-pagination .next:hover, .woocommerce-pagination .next:focus, .woocommerce-pagination .nav-previous a:hover, .woocommerce-pagination .nav-previous a:focus, .woocommerce-pagination .nav-next a:hover, .woocommerce-pagination .nav-next a:focus {
      background-color: ' . $button_background_color . ';
    }
    .page-links a:hover, .page-links a:focus {
      background-color: ' . $button_background_color . ';
      border-color: ' . $button_background_color . ';
    }
    .format-quote .entry-header {
      background-color: ' . $button_background_color . ';
    }
    .format-quote .entry-header h1,
    .format-quote .entry-header h1 a {
      color: ' . $button_text_color . '; 
    }
    .format-quote .entry-header h1 a:hover {
      border-bottom-color: ' . $button_text_color . '; 
    }   
    .format-quote .entry-content {
      background-color: ' . $button_background_color . ';
      color: ' . $button_text_color . ';
    }
    .format-quote .entry-content .entry-body a {
      color: ' . $button_text_color . ';
      border-bottom-color: ' . $button_text_color . '; 
    }
    .format-quote .author-info, .format-quote .entry-meta {
      border-color: ' . $button_border_color . ';
    }
    .widget-area .widget a.button {
      color: ' . $button_text_color . ';
    }
    .widget-area .widget a.button:hover {
      color: ' . $button_text_hover_color . '; 
    }';

    $woocommerce_style = '';

    // Remove space after colons
    $style = str_replace( ': ', ':', $style );
    
    // Remove whitespace
    $style = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $style );

    wp_add_inline_style( 'archetype-style', $style );
    wp_add_inline_style( 'archetype-woocommerce-style', $woocommerce_style );
  }
}