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

    $logo_svg = wp_get_attachment_image_src( get_theme_mod( 'archetype_site_logo_svg' ), 'full' );

    // We have a logo. Logo is go.
    if ( isset( $logo_svg[0] ) && ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) ) {
      $image = wp_get_attachment_image_src( jetpack_get_site_logo( 'id' ), 'full', false );

      if ( count( $image ) >= 3 ) {
        $style.= sprintf( '
          .svg .site-logo,
          .no-svg .svg-site-logo {
            display: none;
          }
          .svg .svg-site-logo {
            display: block;
            background-image: url(%1$s);
            background-repeat: no-repeat;
            background-size: contain;
            width: %2$spx;
            height: %3$spx
          }',
          esc_url_raw( $logo_svg[0] ),
          esc_attr( $image[1] ),
          esc_attr( $image[2] )
        );
      }
    }

    // Site Logo
    if ( $logo_top_margin = archetype_sanitize_number( get_theme_mod( 'archetype_site_logo_margin_top' ) ) ) {
      $style.= '
      .site-logo-link .site-logo,
      .svg .site-logo-link .svg-site-logo {
        margin-top: ' . esc_attr( $logo_top_margin ) . 'em;
      }';
    }

    // Boxed background color
    $boxed_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_boxed_background_color', apply_filters( 'archetype_default_boxed_background_color', '#f1f1f1' ) ) );

    $style.= '
    .is-boxed .site {
      background-color: ' . $boxed_background_color . ';
    }';

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
    $nav_link_color_hover = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_link_hover_color', apply_filters( 'archetype_default_nav_link_hover_color', '#fff' ) ) );

    $style.= '
    .main-navigation ul li a:hover {
      color: ' . $nav_link_color_hover . ';
    }';
    
    // Navigation Link Hover Background Color
    $nav_link_color_hover_bg = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_link_hover_background_color', apply_filters( 'archetype_default_nav_link_hover_background_color', '#2f3538' ) ) );

    $style.= '
    @media screen and (min-width: 768px) {
      .main-navigation ul.menu ul a:hover,
      .main-navigation ul.menu ul li:hover > a {
        background-color: ' . $nav_link_color_hover_bg . ';
      }
    }';
    
    // Navigation Link Active Color
    $nav_link_color_active = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_link_active_color', apply_filters( 'archetype_default_nav_link_active_color', '#fff' ) ) );
    
    // Navigation Link Active Background Color
    $nav_link_color_active_bg = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_link_active_background_color', apply_filters( 'archetype_default_nav_link_active_background_color', '#24282A' ) ) );

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
    $nav_alt_link_color_hover = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_alt_link_hover_color', apply_filters( 'archetype_default_nav_alt_link_hover_color', '#fff' ) ) );
    
    // Secondary Navigation Link Hover Background Color
    $nav_alt_link_color_hover_bg = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_alt_link_hover_background_color', apply_filters( 'archetype_default_nav_alt_link_hover_background_color', '#464e54' ) ) );
    
    // Secondary Navigation Link Active Color
    $nav_alt_link_color_active = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_alt_link_active_color', apply_filters( 'archetype_default_nav_alt_link_active_color', '#fff' ) ) );
    
    // Secondary Navigation Link Active Background Color
    $nav_alt_link_color_active_bg = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_alt_link_active_background_color', apply_filters( 'archetype_default_nav_alt_link_active_background_color', '#3b4146' ) ) );

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
    $button_2d = archetype_sanitize_checkbox( get_theme_mod( 'archetype_button_2d', apply_filters( 'archetype_default_button_2d', 0 ) ) );

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

    // Post border radius
    $post_radius = archetype_sanitize_number( get_theme_mod( 'archetype_post_radius', apply_filters( 'archetype_default_post_radius', 0 ) ) );

    $style.= '
    article + .author-info,
    #comments .comment-list .comment-content, #comments .commentlist .comment-content,
    #respond,
    .hentry,
    .post-navigation,
    .widget_search form input[type=search], .widget_product_search form input[type=search], .error-404-search form input[type=search] {
      border-radius: ' . $post_radius. 'px;
    }';

    if ( is_rtl() ) {
      $style.= '
      #comments p.no-comments,
      .page-header {
        border-radius: ' . $post_radius. 'px 0 0 ' . $post_radius. 'px;
      }
      .sticky-post {
        border-radius: 0 0 0 ' . $post_radius. 'px;
      }';
    } else {
      $style.= '
      #comments p.no-comments,
      .page-header {
        border-radius: 0 ' . $post_radius. 'px ' . $post_radius. 'px 0;
      }
      .sticky-post {
        border-radius: 0 0 ' . $post_radius. 'px 0;
      }';
    }

    // Button border radius
    $button_radius = archetype_sanitize_number( get_theme_mod( 'archetype_button_radius', apply_filters( 'archetype_default_button_radius', 3 ) ) );

    $style.= '
    button, input[type="button"], input[type="reset"], input[type="submit"], .button, .added_to_cart {
      border-radius: ' . $button_radius. 'px;
    }';

    // Avatar border radius
    $avatar_radius = archetype_sanitize_number( get_theme_mod( 'archetype_avatar_radius', apply_filters( 'archetype_default_avatar_radius', 3 ) ) );

    $style.= '
    .author-info .avatar,
    #comments .comment-list .comment-meta .avatar, 
    #comments .commentlist .comment-meta .avatar {
      border-radius: ' . $avatar_radius . 'px;
    }';

    // Footer heading
    $footer_heading_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_heading_color', apply_filters( 'archetype_default_footer_heading_color', '#eee' ) ) );

    // Footer text
    $footer_text_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_text_color', apply_filters( 'archetype_default_footer_text_color', '#888' ) ) );

    // Footer background
    $footer_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_background_color', apply_filters( 'archetype_default_footer_background_color', '#353b3f' ) ) );

    // Footer link
    $footer_link_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_link_color', apply_filters( 'archetype_default_footer_link_color', '#ee543f' ) ) );

    // Footer link hover
    $footer_link_hover_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_link_hover_color', apply_filters( 'archetype_default_footer_link_hover_color', '#fff' ) ) );

    // Lower footer text
    $footer_lower_text_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_lower_text_color', apply_filters( 'archetype_default_footer_lower_text_color', '#888' ) ) );

    // Lower footer background
    $footer_lower_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_lower_background_color', apply_filters( 'archetype_default_footer_lower_background_color', '#292e31' ) ) );

    // Lower footer link
    $footer_lower_link_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_lower_link_color', apply_filters( 'archetype_default_footer_lower_link_color', '#ee543f' ) ) );

    // Lower footer link hover
    $footer_lower_link_hover_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_lower_link_hover_color', apply_filters( 'archetype_default_footer_lower_link_hover_color', '#fff' ) ) );

    $style.= '.site-footer {
      background-color: ' . $footer_background_color . ';
      color: ' . $footer_text_color . ';
    }
    .site-footer h1, .site-footer h2, .site-footer h3, .site-footer h4, .site-footer h5, .site-footer h6 {
      color: ' . $footer_heading_color . ';
    }
    .site-footer a:not(.button) {
      color: ' . $footer_link_color . ';
    }
    .site-footer a:not(.button):hover {
      color: ' . $footer_link_hover_color . ';
    }
    .site-footer a:not(.button):focus {
      outline-color: ' . $footer_link_color . ';
    }
    .site-info {
      background-color: ' . $footer_lower_background_color . ';
      color: ' . $footer_lower_text_color . ';
    }
    .site-info a:not(.button) {
      color: ' . $footer_lower_link_color . ';
    }
    .site-info a:not(.button):hover {
      color: ' . $footer_lower_link_hover_color . ';
    }
    .site-info a:not(.button):focus {
      outline-color: ' . $footer_lower_link_color . ';
    }';

    // Remove space after colons
    $style = str_replace( ': ', ':', $style );

    // Remove whitespace
    $style = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $style );

    wp_add_inline_style( 'archetype-style', $style );
  }
}

/**
 * Display the Homepage Hero
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_homepage_hero_active' ) ) {
  function archetype_homepage_hero() {
    if ( false == archetype_sanitize_checkbox( get_theme_mod( 'archetype_homepage_hero_active', true ) ) ) {
      return false;
    }

    // Layout
    $layout               = archetype_sanitize_checkbox( get_theme_mod( 'archetype_homepage_hero_layout', true ) ) ? 'expand-full-width' : '';

    // Alignment
    $alignment            = esc_attr( get_theme_mod( 'archetype_homepage_hero_alignment', 'center' ) );

    // Background image
    $background_img_src   = wp_get_attachment_image_src( get_theme_mod( 'archetype_homepage_hero_background_image', '' ), 'full' );
    $background_img       = isset( $background_img_src[0] ) ? esc_url_raw( $background_img_src[0] ) : '';

    // Background image size
    $background_img_size  = esc_attr( get_theme_mod( 'archetype_homepage_hero_background_image_size', 'auto' ) );

    // Background color
    $background_color     = sanitize_text_field( get_theme_mod( 'archetype_homepage_hero_background_color', apply_filters( 'archetype_default_homepage_hero_background_color', '#353b3f' ) ) );

    // Heading color
    $heading_text_color   = archetype_sanitize_hex_color( get_theme_mod( 'archetype_homepage_hero_heading_color', apply_filters( 'archetype_default_homepage_hero_heading_color', '#fff' ) ) );

    // Body color
    $body_text_color      = archetype_sanitize_hex_color( get_theme_mod( 'archetype_homepage_hero_text_color', apply_filters( 'archetype_default_homepage_hero_text_color', '#888' ) ) );

    // Heading text
    $heading_text         = sanitize_text_field( get_theme_mod( 'archetype_homepage_hero_heading_text', __( 'Heading Text', 'archetype' ) ) );

    // Body Text
    $body_text            = wp_kses_post( get_theme_mod( 'archetype_homepage_hero_text', __( 'Body Text', 'archetype' ) ) );

    // Button text
    $button_text          = sanitize_text_field( get_theme_mod( 'archetype_homepage_hero_button_text', __( 'Call to Action', 'archetype' ) ) );

    // Button URL
    $button_url           = sanitize_text_field( get_theme_mod( 'archetype_homepage_hero_button_url', home_url() ) );

    // CSS classes
    $classes = array( 'archetype-homepage-hero' );
    $classes[] = $alignment;
    $classes[] = $layout;

    // CSS style attributes
    $styles = array();
    $styles[] = "color: $body_text_color;";
    $styles[] = "background-color: $background_color;";
    $styles[] = "background-image: url($background_img);";
    $styles[] = "background-size: $background_img_size;";
    $styles[] = "background-repeat: no-repeat;";
    ?>
    <section class="<?php echo implode( ' ', $classes ); ?>" style="<?php echo implode( ' ', $styles ); ?>;">
      <div class="col-full">
        <?php do_action( 'archetype_homepage_hero_content_before' ); ?>
        <?php echo sprintf( '<h1 style="color: %s">%s</h1>', $heading_text_color, $heading_text ); ?>
        <div class="archetype-homepage-hero-body">
          <?php echo wpautop( $body_text ); ?>
          <?php if ( $button_text && $button_url ) { ?>
            <?php echo sprintf( '<p><a href="%s" class="button">%s</a></p>', $button_url, $button_text ); ?>
          <?php } ?>
        </div>
        <?php do_action( 'archetype_homepage_hero_content_after' ); ?>
      </div>
    </section>
    <?php
  }
}