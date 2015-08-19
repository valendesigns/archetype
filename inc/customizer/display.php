<?php
/**
 * Archetype Theme Customizer display functions
 *
 * @package Archetype
 * @subpackage Customize
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_add_customize_css' ) ) :

	/**
	 * Add CSS in <head> for styles handled by the theme customizer
	 *
	 * @since 1.0.0
	 */
	function archetype_add_customize_css() {

		$style = '/* Customizer Styles */';

		// Boxed background color.
		$boxed_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_boxed_background_color', apply_filters( 'archetype_default_boxed_background_color', '#f1f1f1' ) ) );

		if ( '#f1f1f1' !== $boxed_background_color ) {
			$style .= '
			.is-boxed .site {
				background-color: ' . $boxed_background_color . ';
			}';
		}

		// Text color.
		$text_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_text_color', apply_filters( 'archetype_default_text_color', '#555' ) ) );

		if ( '#555' !== $text_color && '#555555' !== $text_color ) {
			$style .= '
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
			#comments .commentlist .bypostauthor > .comment-body cite:after {
				color: ' . archetype_adjust_color_brightness( $text_color, 51 ) . ';
			}
			.widget_search form input[type=search]:focus,
			.widget_product_search form input[type=search]:focus,
			.error-404-search form input[type=search]:focus {
				color: ' . archetype_adjust_color_brightness( $text_color, -25.5 ) . ';
			}
			.is-padded .page-header,
			.is-padded #comments p.no-comments,
			.is-padded .post-navigation a:hover {
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
		}

		// Heading color.
		$heading_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_heading_color', apply_filters( 'archetype_default_heading_color', '#333' ) ) );

		if ( '#333' !== $heading_color && '#333333' !== $heading_color ) {
			$style .= '
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
		}

		// Link Color.
		$link_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_link_color', apply_filters( 'archetype_default_link_color', '#ee543f' ) ) );

		if ( '#ee543f' !== $link_color ) {
			$style .= '
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
		}

		// Link Color Hover.
		$link_color_hover = archetype_sanitize_hex_color( get_theme_mod( 'archetype_link_color_hover', apply_filters( 'archetype_default_link_color_hover', '#111' ) ) );

		if ( '#111' !== $link_color_hover && '#111111' !== $link_color_hover ) {
			$style .= '
			a:hover {
				color: ' . $link_color_hover . ';
			}';
		}

		// Widget Link Color.
		$widget_link_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_widget_link_color', apply_filters( 'archetype_default_widget_link_color', '#333' ) ) );

		// Widget Link Color Hover.
		$widget_link_color_hover = archetype_sanitize_hex_color( get_theme_mod( 'archetype_widget_link_color_hover', apply_filters( 'archetype_default_widget_link_color_hover', '#ee543f' ) ) );

		if ( '#333' !== $widget_link_color && '#333' !== $widget_link_color ) {
			$style .= '
			.widget-area .widget a,
			.widget-area .widget .checkboxes label {
				color: ' . $widget_link_color . ';
			}
			.widget-area .widget a:focus {
				outline: 1px dotted ' . $widget_link_color . ';
			}';
		}

		if ( '#ee543f' !== $widget_link_color_hover ) {
			$style .= '
			.widget-area .widget a:hover,
			.widget-area .widget .checkboxes label:hover {
				color: ' . $widget_link_color_hover . ';
			}';
		}





		// Site Header padding.
		$header_padding_top = archetype_sanitize_number( get_theme_mod( 'archetype_site_header_padding_top' ) );
		$header_padding_bottom = archetype_sanitize_number( get_theme_mod( 'archetype_site_header_padding_bottom' ) );
		if ( $header_padding_top || $header_padding_bottom ) {
			$attrs = '';
			if ( $header_padding_top ) {
				$attrs .= 'padding-top: ' . esc_attr( $header_padding_top ) . 'em;';
			}
			if ( $header_padding_bottom ) {
				$attrs .= 'padding-bottom: ' . esc_attr( $header_padding_bottom ) . 'em;';
			}
			$style .= '
			.site-header > .col-full {
				' . $attrs . '
			}';
		}

		// Header Subscribe & Connect background Color.
		$header_subscribe_and_connect_bg = archetype_sanitize_hex_color( get_theme_mod( 'archetype_header_subscribe_and_connect_background_color', apply_filters( 'archetype_default_header_subscribe_and_connect_background_color', '' ) ) );

		if ( '' !== $header_subscribe_and_connect_bg ) {
			$style .= '
			.site-header .subscribe-and-connect-connect {
				background-color: ' . $header_subscribe_and_connect_bg . ';
				border-color: transparent;
			}';
		}

		$logo_svg = wp_get_attachment_image_src( get_theme_mod( 'archetype_site_logo_svg' ), 'full', false );

		// We have a logo. Logo is go.
		if ( isset( $logo_svg[0] ) && ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) ) {
			$image = wp_get_attachment_image_src( jetpack_get_site_logo( 'id' ), 'full', false );

			if ( count( $image ) >= 3 ) {
				$style .= sprintf( '
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

		// Site Logo Margin.
		$logo_top_margin = archetype_sanitize_number( get_theme_mod( 'archetype_site_logo_margin_top' ) );
		$logo_bottom_margin = archetype_sanitize_number( get_theme_mod( 'archetype_site_logo_margin_bottom' ) );
		if ( $logo_top_margin || $logo_bottom_margin ) {
			$attrs = '';
			if ( $logo_top_margin ) {
				$attrs .= 'margin-top: ' . esc_attr( $logo_top_margin ) . 'em;';
			}
			if ( $logo_bottom_margin ) {
				$attrs .= 'margin-bottom: ' . esc_attr( $logo_bottom_margin ) . 'em;';
			}
			$style .= '
			.site-logo-link .site-logo,
			.svg .site-logo-link .svg-site-logo {
				' . $attrs . '
			}';
		}

		// Header background image.
		if ( get_header_image() != '' ) {
			$header_background_repeat = esc_attr( get_theme_mod( 'archetype_header_background_repeat', apply_filters( 'archetype_default_header_background_repeat', 'no-repeat' ) ) );

			$header_background_position = esc_attr( get_theme_mod( 'archetype_header_background_position', apply_filters( 'archetype_default_header_background_position', 'center' ) ) );

			$header_background_size = esc_attr( get_theme_mod( 'archetype_header_background_size', apply_filters( 'archetype_default_header_background_size', 'cover' ) ) );

			$style .= '
			.site-header {
				background-image: url(' . esc_url( get_header_image() ) . ');
				background-position: ' . str_replace( '-', ' ', $header_background_position ) . ';
				background-repeat: ' . $header_background_repeat . ';
				background-size: ' . $header_background_size . ';
			}';
		}

		// Header Background Color.
		$header_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_header_background_color', apply_filters( 'archetype_default_header_background_color', '#353b3f' ) ) );
		
		// Handheld Navigation pinned.
		$nav_handheld_pinned = archetype_sanitize_checkbox( get_theme_mod( 'archetype_nav_handheld_pinned', apply_filters( 'archetype_default_nav_handheld_pinned', true ) ) );

		if ( '#353b3f' !== $header_background_color ) {
			$style .= '
			.site-header {
				background-color: ' . $header_background_color . ';
			}';
		}

		if (  true === $nav_handheld_pinned && '#353b3f' !== $header_background_color ) {
			list( $r, $g, $b ) = sscanf( $header_background_color, '#%02x%02x%02x' );
			$style .= '
			.site-header.pinned {
				background-color: ' . sprintf( 'rgba(%s,%s,%s,%s)', $r, $g, $b, '0.95' ) . ';
			}';
		}

		// Header Color.
		$header_text_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_header_text_color', apply_filters( 'archetype_default_header_text_color', '#888' ) ) );

		if ( '#888' !== $header_text_color && '#888888' !== $header_text_color ) {
			$style .= '
			.site-header {
				color: ' . $header_text_color . ';
			}';
		}

		$header_links = false;

		// Header Link Color.
		$header_link_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_header_link_color', apply_filters( 'archetype_default_header_link_color', '#aaa' ) ) );

		if ( '#aaa' !== $header_link_color && '#aaaaaa' !== $header_link_color ) {
			$style .= '
			.site-header a {
				color: ' . $header_link_color . ';
			}';
			$header_links = true;
		}

		// Header Link Color Hover.
		$header_link_color_hover = archetype_sanitize_hex_color( get_theme_mod( 'archetype_header_link_color_hover', apply_filters( 'archetype_default_header_link_color_hover', '#ee543f' ) ) );

		if ( '#ee543f' !== $header_link_color_hover ) {
			$style .= '
			.site-header a:hover {
				color: ' . $header_link_color_hover . ';
			}';
			$header_links = true;
		}

		// Primary Navigation alignment.
		$nav_alignment = esc_attr( get_theme_mod( 'archetype_nav_alignment', apply_filters( 'archetype_default_nav_alignment', 'left' ) ) );

		// Primary Navigation pinned.
		$nav_pinned = archetype_sanitize_checkbox( get_theme_mod( 'archetype_nav_pinned', apply_filters( 'archetype_default_nav_pinned', true ) ) );

		// Navigation Background Color.
		$nav_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_background_color', apply_filters( 'archetype_default_nav_background_color', '#292e31' ) ) );

		if ( 'right' === $nav_alignment ) {
			$style .= '
			.primary-navigation .menu {
				float: right;
			}';
		}

		if ( '#292e31' !== $nav_background_color ) {
			$style .= '
			@media screen and (min-width: 768px) {
				#navigation,
				.main-navigation ul.menu ul {
					background-color: ' . $nav_background_color . ';
				}
			}';
		}

		if ( true === $nav_pinned && '#292e31' !== $nav_background_color ) {
			list( $r, $g, $b ) = sscanf( $nav_background_color, '#%02x%02x%02x' );
			$style .= '
			#navigation.pinned,
			#navigation.pinned ul.menu ul {
				background-color: ' . sprintf( 'rgba(%s,%s,%s,%s)', $r, $g, $b, '0.95' ) . ';
			}';
		}

		// Navigation Link Color.
		$nav_link_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_link_color', apply_filters( 'archetype_default_nav_link_color', '#bbb' ) ) );

		if ( $header_links || '#bbb' !== $nav_link_color && '#bbbbbb' !== $nav_link_color ) {
			$style .= '
			.main-navigation ul li a {
				color: ' . $nav_link_color . ';
			}';
		}

		// Navigation Link Hover Color.
		$nav_link_color_hover = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_link_hover_color', apply_filters( 'archetype_default_nav_link_hover_color', '#fff' ) ) );

		if ( $header_links || '#fff' !== $nav_link_color_hover && '#ffffff' !== $nav_link_color_hover ) {
			$style .= '
			.main-navigation ul li a:hover {
				color: ' . $nav_link_color_hover . ';
			}';
		}

		// Navigation Link Hover Background Color.
		$nav_link_color_hover_bg = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_link_hover_background_color', apply_filters( 'archetype_default_nav_link_hover_background_color', '#2f3538' ) ) );

		if ( '#2f3538' !== $nav_link_color_hover_bg ) {
			$style .= '
			@media screen and (min-width: 768px) {
				.main-navigation ul.menu ul a:hover,
				.main-navigation ul.menu ul li:hover > a {
					background-color: ' . $nav_link_color_hover_bg . ';
				}
			}';
		}

		// Navigation Link Active Color.
		$nav_link_color_active = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_link_active_color', apply_filters( 'archetype_default_nav_link_active_color', '#fff' ) ) );

		// Navigation Link Active Background Color.
		$nav_link_color_active_bg = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_link_active_background_color', apply_filters( 'archetype_default_nav_link_active_background_color', '#24282a' ) ) );

		if ( ( '#fff' !== $nav_link_color_active && '#ffffff' !== $nav_link_color_active ) || '#24282a' !== $nav_link_color_active_bg ) {
			$style .= '
			.main-navigation ul li.current-menu-item > a {
				color: ' . $nav_link_color_active . ';
				background-color: ' . $nav_link_color_active_bg . ';
			}';

			$style .= '
			@media screen and (min-width: 768px) {
				.main-navigation ul li.current_page_parent > a,
				.main-navigation ul li.current-menu-ancestor > a {
					color: ' . $nav_link_color_active . ';
					background-color: ' . $nav_link_color_active_bg . ';
				}
			}';
		}

		// Secondary Navigation Color.
		$nav_alt_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_alt_color', apply_filters( 'archetype_nav_alt_alt_color', '#bbb' ) ) );

		if ( '#bbb' !== $nav_alt_color && '#bbbbbb' !== $nav_alt_color ) {
			$style .= '
			.secondary-navigation {
				color: ' . $nav_alt_color . ';
			}';
		}

		// Secondary Navigation Background Color.
		$nav_alt_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_alt_background_color', apply_filters( 'archetype_default_nav_alt_background_color', '#41484d' ) ) );

		// Secondary Navigation Link Color.
		$nav_alt_link_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_alt_link_color', apply_filters( 'archetype_default_nav_alt_link_color', '#ddd' ) ) );

		// Secondary Navigation Link Hover Color.
		$nav_alt_link_color_hover = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_alt_link_hover_color', apply_filters( 'archetype_default_nav_alt_link_hover_color', '#fff' ) ) );

		// Secondary Navigation Link Hover Background Color.
		$nav_alt_link_color_hover_bg = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_alt_link_hover_background_color', apply_filters( 'archetype_default_nav_alt_link_hover_background_color', '#464e54' ) ) );

		// Secondary Navigation Link Active Color.
		$nav_alt_link_color_active = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_alt_link_active_color', apply_filters( 'archetype_default_nav_alt_link_active_color', '#fff' ) ) );

		// Secondary Navigation Link Active Background Color.
		$nav_alt_link_color_active_bg = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_alt_link_active_background_color', apply_filters( 'archetype_default_nav_alt_link_active_background_color', '#3b4146' ) ) );

		$nav_alt_style = '';

		if ( $header_links || '#ddd' !== $nav_alt_link_color && '#dddddd' !== $nav_alt_link_color ) {
			$nav_alt_style .= '
			.secondary-navigation ul.menu li a {
				color: ' . $nav_alt_link_color . ';
			}';
		}

		if ( $header_links || '#fff' !== $nav_alt_link_color_hover && '#ffffff' !== $nav_alt_link_color_hover ) {
			$nav_alt_style .= '
			.secondary-navigation ul.menu li a:hover {
				color: ' . $nav_alt_link_color_hover . ';
			}';
		}

		if ( '#41484d' !== $nav_alt_background_color ) {
			$nav_alt_style .= '
			.secondary-navigation ul.menu li ul {
				background-color: ' . $nav_alt_background_color . ';
			}';
		}

		if ( $header_links || '#464e54' !== $nav_alt_link_color_hover_bg ) {
			$nav_alt_style .= '
			.secondary-navigation ul.menu li ul a:hover,
			.secondary-navigation ul.menu li ul li:hover > a {
				background-color: ' . $nav_alt_link_color_hover_bg . ';
			}';
		}

		if ( $header_links || ( '#fff' !== $nav_alt_link_color_active && '#ffffff' !== $nav_alt_link_color_active ) || '#3b4146' !== $nav_alt_link_color_active_bg ) {
			$nav_alt_style .= '
			.secondary-navigation ul.menu li li.current-menu-item > a,
			.secondary-navigation ul.menu li li.current_page_parent > a,
			.secondary-navigation ul.menu li li.current-menu-ancestor > a {
				color: ' . $nav_alt_link_color_active . ';
				background-color: ' . $nav_alt_link_color_active_bg . ';
			}';
		}

		if ( '' !== $nav_alt_style ) {
			$style .= '@media screen and (min-width: 768px) {
				' . $nav_alt_style . '
			}';
		}

		// Handheld Navigation Background Color.
		$nav_handheld_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_handheld_background_color', apply_filters( 'archetype_default_nav_handheld_background_color', '#292e31' ) ) );

		if ( '#292e31' !== $nav_handheld_background_color ) {
			$style .= '
			.handheld-navigation,
			.menu-toggle,
			.site-header .site-header-cart a.cart-contents {
				background-color: ' . $nav_handheld_background_color . ';
			}';
		}

		// Handheld Navigation Link Color.
		$nav_handheld_link_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_handheld_link_color', apply_filters( 'archetype_default_nav_handheld_link_color', '#bbb' ) ) );

		if ( $header_links || '#bbb' !== $nav_handheld_link_color && '#bbbbbb' !== $nav_handheld_link_color ) {
			$style .= '
			.handheld-navigation ul li a,
			.menu-toggle,
			.site-header .site-header-cart a.cart-contents {
				color: ' . $nav_handheld_link_color . ';
			}';
		}

		// Handheld Navigation Link Hover Color.
		$nav_handheld_link_color_hover = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_handheld_link_hover_color', apply_filters( 'archetype_default_nav_handheld_link_hover_color', '#fff' ) ) );

		// Handheld Navigation Link Hover Background Color.
		$nav_handheld_link_color_hover_bg = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_handheld_link_hover_background_color', apply_filters( 'archetype_default_nav_handheld_link_hover_background_color', '#2f3538' ) ) );

		if ( $header_links || ( '#fff' !== $nav_handheld_link_color_hover && '#ffffff' !== $nav_handheld_link_color_hover ) || '#2f3538' !== $nav_handheld_link_color_hover_bg ) {
			$style .= '
			.handheld-navigation ul li a:hover,
			.menu-toggle:hover,
			.site-header .site-header-cart a.cart-contents:hover {
				color: ' . $nav_handheld_link_color_hover . ';
				background-color: ' . $nav_handheld_link_color_hover_bg . ';
			}';
		}

		// Handheld Navigation Link Active Color.
		$nav_handheld_link_color_active = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_handheld_link_active_color', apply_filters( 'archetype_default_nav_handheld_link_active_color', '#fff' ) ) );

		// Handheld Navigation Link Active Background Color.
		$nav_handheld_link_color_active_bg = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_handheld_link_active_background_color', apply_filters( 'archetype_default_nav_handheld_link_active_background_color', '#24282a' ) ) );

		if ( $header_links || ( '#fff' !== $nav_handheld_link_color_active && '#ffffff' !== $nav_handheld_link_color_active ) || '#24282a' !== $nav_handheld_link_color_active_bg ) {
			$style .= '
			.handheld-navigation ul li.current-menu-item > a {
				color: ' . $nav_handheld_link_color_active . ';
				background-color: ' . $nav_handheld_link_color_active_bg . ';
			}';
		}

		// Hero Unit.
		if ( is_page_template( 'template-homepage.php' ) ) {

			// Hero overlay background color.
			$overlay_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_homepage_hero_overlay_background_color', apply_filters( 'archetype_default_homepage_hero_overlay_background_color', '#000000' ) ) );

			// Hero overlay opacity.
			$overlay_opacity = archetype_sanitize_integer( get_theme_mod( 'archetype_homepage_hero_overlay_opacity', apply_filters( 'archetype_default_homepage_hero_overlay_opacity', '2' ) ) );

			if ( '' !== $overlay_background_color && '0' !== $overlay_opacity ) {
				list( $r, $g, $b ) = sscanf( $overlay_background_color, '#%02x%02x%02x' );
				$style .= '
				.archetype-homepage-hero .archetype-hero-overlay {
					background-color: ' . sprintf( 'rgba(%s,%s,%s,%s)', $r, $g, $b, ( $overlay_opacity / 10 ) ) . ';
				}';
			}

			// Hero position.
			$hero_image_position = archetype_sanitize_checkbox( get_theme_mod( 'archetype_homepage_hero_image_position_toggle', apply_filters( 'archetype_default_homepage_hero_image_position_toggle', true ) ) );

			// Hero grid.
			$hero_image_grid = archetype_sanitize_integer( get_theme_mod( 'archetype_homepage_hero_image_columns', apply_filters( 'archetype_default_homepage_hero_image_columns', '12' ) ) );

			// Hero alignment.
			$hero_image_alignment = esc_attr( get_theme_mod( 'archetype_homepage_hero_image_alignment', apply_filters( 'archetype_default_homepage_hero_image_alignment', 'right' ) ) );

			// Hero left & right grid classes.
			$hero_image_left = ( 'left' === $hero_image_alignment ? '.archetype-hero-media' : '.archetype-hero-content' );
			$hero_image_right = ( 'right' === $hero_image_alignment ? '.archetype-hero-media' : '.archetype-hero-content' );

			if ( true === $hero_image_position ) {
				$style .= '
				@media screen and (min-width: 768px) {
					.archetype-hero-position-media .archetype-hero-media {
						margin-top: -2.625em;
					}
				}
				@media screen and (min-width: 768px) and (max-width: 74em) {
					.archetype-hero-position-media .archetype-hero-media {
						margin-top: -2.125em;
					}
				}';
			}

			if ( ( 3 === $hero_image_grid && 'right' === $hero_image_alignment ) || ( 9 === $hero_image_grid && 'left' === $hero_image_alignment ) ) {
				$style .= '
				@media screen and (min-width: 768px) {
					.archetype-hero-has-grid ' . $hero_image_left . ' {
						width: 74.0384615385%;
						float: left;
						margin-right: 3.8461538462%;
					}
					.archetype-hero-has-grid ' . $hero_image_right . ' {
						width: 22.1153846154%;
						float: right;
						margin-right: 0;
					}
				}';
			} else if ( ( 4 === $hero_image_grid && 'right' === $hero_image_alignment ) || ( 8 === $hero_image_grid && 'left' === $hero_image_alignment ) ) {
				$style .= '
				@media screen and (min-width: 768px) {
					.archetype-hero-has-grid ' . $hero_image_left . ' {
						width: 65.3846153846%;
						float: left;
						margin-right: 3.8461538462%;
					}
					.archetype-hero-has-grid ' . $hero_image_right . ' {
						width: 30.7692307692%;
						float: right;
						margin-right: 0;
					}
				}';
			} else if ( ( 5 === $hero_image_grid && 'right' === $hero_image_alignment ) || ( 7 === $hero_image_grid && 'left' === $hero_image_alignment ) ) {
				$style .= '
				@media screen and (min-width: 768px) {
					.archetype-hero-has-grid ' . $hero_image_left . ' {
						width: 56.7307692308%;
						float: left;
						margin-right: 3.8461538462%;
					}
					.archetype-hero-has-grid ' . $hero_image_right . ' {
						width: 39.4230769231%;
						float: right;
						margin-right: 0;
					}
				}';
			} else if ( ( 6 === $hero_image_grid && 'right' === $hero_image_alignment ) || ( 6 === $hero_image_grid && 'left' === $hero_image_alignment ) ) {
				$style .= '
				@media screen and (min-width: 768px) {
					.archetype-hero-has-grid ' . $hero_image_left . ' {
						width: 48.0769230769%;
						float: left;
						margin-right: 3.8461538462%;
					}
					.archetype-hero-has-grid ' . $hero_image_right . ' {
						width: 48.0769230769%;
						float: right;
						margin-right: 0;
					}
				}';
			} else if ( ( 7 === $hero_image_grid && 'right' === $hero_image_alignment ) || ( 5 === $hero_image_grid && 'left' === $hero_image_alignment ) ) {
				$style .= '
				@media screen and (min-width: 768px) {
					.archetype-hero-has-grid ' . $hero_image_left . ' {
						width: 39.4230769231%;
						float: left;
						margin-right: 3.8461538462%;
					}
					.archetype-hero-has-grid ' . $hero_image_right . ' {
						width: 56.7307692308%;
						float: right;
						margin-right: 0;
					}
				}';
			} else if ( ( 8 === $hero_image_grid && 'right' === $hero_image_alignment ) || ( 4 === $hero_image_grid && 'left' === $hero_image_alignment ) ) {
				$style .= '
				@media screen and (min-width: 768px) {
					.archetype-hero-has-grid ' . $hero_image_left . ' {
						width: 30.7692307692%;
						float: left;
						margin-right: 3.8461538462%;
					}
					.archetype-hero-has-grid ' . $hero_image_right . ' {
						width: 65.3846153846%;
						float: right;
						margin-right: 0;
					}
				}';
			} else if ( ( 9 === $hero_image_grid && 'right' === $hero_image_alignment ) || ( 3 === $hero_image_grid && 'left' === $hero_image_alignment ) ) {
				$style .= '
				@media screen and (min-width: 768px) {
					.archetype-hero-has-grid ' . $hero_image_left . ' {
						width: 22.1153846154%;
						float: left;
						margin-right: 3.8461538462%;
					}
					.archetype-hero-has-grid ' . $hero_image_right . ' {
						width: 74.0384615385%;
						float: right;
						margin-right: 0;
					}
				}';
			}
		}

		// Post border radius.
		$post_radius = archetype_sanitize_number( get_theme_mod( 'archetype_post_radius', apply_filters( 'archetype_default_post_radius', 0 ) ) );

		if ( 0 != $post_radius ) {
			$style .= '
			article + .author-info,
			#comments .commentlist .comment-content,
			#respond,
			.hentry,
			.post-navigation {
				border-radius: ' . $post_radius. 'px;
			}';

			if ( is_rtl() ) {
				$style .= '
				#comments p.no-comments,
				.page-header {
					border-radius: ' . $post_radius. 'px 0 0 ' . $post_radius. 'px;
				}
				.sticky-post {
					border-radius: 0 0 0 ' . $post_radius. 'px;
				}';
			} else {
				$style .= '
				#comments p.no-comments,
				.page-header {
					border-radius: 0 ' . $post_radius. 'px ' . $post_radius. 'px 0;
				}
				.sticky-post {
					border-radius: 0 0 ' . $post_radius. 'px 0;
				}';
			}
		}

		// Avatar border radius.
		$avatar_radius = archetype_sanitize_number( get_theme_mod( 'archetype_avatar_radius', apply_filters( 'archetype_default_avatar_radius', 3 ) ) );

		if ( 3 != $avatar_radius ) {
			$style .= '
			.author-info .avatar, 
			#comments .commentlist .comment-meta .avatar {
				border-radius: ' . $avatar_radius . 'px;
			}';
		}

		// Post Background Color.
		$post_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_post_background_color', apply_filters( 'archetype_default_post_background_color', '#fff' ) ) );

		if ( '#fff' !== $post_background_color && '#ffffff' !== $post_background_color ) {
			// Get the RGB value from hex and set the comment rgba `border-color` for our tricky triangle shape.
			$rgb = archetype_rgb_from_hex( $post_background_color );
			$border_color = ( 3 === count( $rgb ) ) ? 'border-color: rgba(' . $rgb['r'] . ', ' . $rgb['g'] . ', ' . $rgb['b'] . ', 0);' : '';

			$style .= '
			article + .author-info,
			#comments p.no-comments,
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
		}

		// Post Border Color.
		$post_border_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_post_border_color', apply_filters( 'archetype_default_post_border_color', '#e5e5e5' ) ) );

		if ( '#e5e5e5' !== $post_border_color ) {
			$style .= '
			table thead th,
			#comments .commentlist .comment-meta {
				border-bottom-color: ' . $post_border_color. ';
			}
			table tfoot th,
			table tfoot td,
			.author-info,
			.hentry .entry-meta {
				border-top-color: ' . $post_border_color. ';
			}
			.post-navigation div + div {
				box-shadow: 0px 1px 0px ' . $post_border_color. ' inset;
			}';
		}

		// Post Shadow Toggle.
		$post_shadow_toggle = archetype_sanitize_checkbox( get_theme_mod( 'archetype_post_shadow_toggle', apply_filters( 'archetype_default_post_shadow_toggle', true ) ) );

		// Post Shadow Color.
		$post_shadow_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_post_shadow_color', apply_filters( 'archetype_default_post_shadow_color', '#8b949b' ) ) );

		if ( false === $post_shadow_toggle || '#8b949b' !== $post_shadow_color ) {
			$style .= '
			article + .author-info,
			#comments .commentlist .comment-content,
			#respond,
			.hentry,
			.post-navigation {
				box-shadow: ' . ( false === $post_shadow_toggle ? 'none' : '0px -1px 0px ' . $post_shadow_color. ' inset' ) . ';
			}';
		}

		// Form padding.
		$form_padding = sanitize_text_field( get_theme_mod( 'archetype_form_padding', apply_filters( 'archetype_default_form_padding', '.75em' ) ) );

		// Form border radius.
		$form_radius = archetype_sanitize_number( get_theme_mod( 'archetype_form_radius', apply_filters( 'archetype_default_form_radius', 0 ) ) );

		// Form border size.
		$form_border_size = archetype_sanitize_number( get_theme_mod( 'archetype_form_border_size', apply_filters( 'archetype_default_form_border_size', 0 ) ) );

		// Form border color.
		$form_border_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_form_border_color', apply_filters( 'archetype_default_form_border_color', '' ) ) );

		// Form inputs and textareas.
		if ( '.75em' !== $form_padding || 0 !== $form_radius || 0 !== $form_border_size || ! empty( $form_border_color ) ) {
			$attrs = '';
			if ( 0 !== $form_radius ) {
				$attrs .= 'border-radius: ' . $form_radius . 'px;';
			}
			if ( 0 !== $form_border_size ) {
				$attrs .= 'border: ' . $form_border_size . 'px solid transparent;';
			}
			if ( ! empty( $form_border_color ) ) {
				$attrs .= 'border-color: ' . $form_border_color . ';';
			}
			if ( ! empty( $form_padding ) ) {
				$attrs .= 'padding: ' . $form_padding . ';';
			}
			if ( ! empty( $attrs ) ) {
				$style .= '
				input[type="text"],
				input[type="email"],
				input[type="url"],
				input[type="password"],
				input[type="search"],
				textarea,
				.input-text {
					' . $attrs . '
				}';
			}
		}

		// Form Text Color.
		$form_text_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_form_text_color', apply_filters( 'archetype_default_form_text_color', '#555' ) ) );

		// Form Background Color.
		$form_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_form_background_color', apply_filters( 'archetype_default_form_background_color', '#e4e4e4' ) ) );

		// Form Focus Text Color.
		$form_text_focus_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_form_text_focus_color', apply_filters( 'archetype_default_form_text_focus_color', '#3b3b3b' ) ) );

		// Form Focus Background Color.
		$form_background_focus_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_form_background_focus_color', apply_filters( 'archetype_default_form_background_focus_color', '#d7d7d7' ) ) );

		if ( ( '#555' !== $form_text_color && '#555555' !== $form_text_color ) || '#e4e4e4' !== $form_background_color ) {
			$style .= '
			input[type="text"],
			input[type="email"],
			input[type="url"],
			input[type="password"],
			input[type="search"],
			textarea,
			.input-text {
				background-color: ' . $form_background_color . ';
				color: ' . $form_text_color . ';
			}';
		}

		if ( '#d7d7d7' !== $form_background_focus_color || '#3b3b3b' !== $form_text_focus_color ) {
			$style .= '
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
		}

		// Search padding.
		$search_padding = sanitize_text_field( get_theme_mod( 'archetype_search_padding', apply_filters( 'archetype_default_search_padding', '0.75em 1em 0.75em 2.625em' ) ) );

		// Search icon toggle.
		$search_icon_toggle = archetype_sanitize_checkbox( get_theme_mod( 'archetype_search_icon_toggle', apply_filters( 'archetype_default_search_icon_toggle', true ) ) );

		// Search icon top.
		$search_icon_top = sanitize_text_field( get_theme_mod( 'archetype_search_icon_top', apply_filters( 'archetype_default_search_icon_top', '.813em' ) ) );

		// Search icon indent.
		$search_icon_indent = sanitize_text_field( get_theme_mod( 'archetype_search_icon_indent', apply_filters( 'archetype_default_search_icon_indent', '1em' ) ) );

		// Search border size.
		$search_border_size = archetype_sanitize_number( get_theme_mod( 'archetype_search_border_size', apply_filters( 'archetype_default_search_border_size', 0 ) ) );

		// Search border color.
		$search_border_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_search_border_color', apply_filters( 'archetype_default_search_border_color', '' ) ) );

		// Search border radius.
		$search_radius = archetype_sanitize_number( get_theme_mod( 'archetype_search_radius', apply_filters( 'archetype_default_search_radius', 0 ) ) );

		if ( 0 != $search_radius ) {
			$style .= '
			.widget_search form input[type=search],
			.widget_product_search form input[type=search],
			.error-404-search form input[type=search] {
				border-radius: ' . $search_radius. 'px;
			}';
		}

		// Search.
		if ( 0 !== $form_border_size || 0 !== $search_border_size || ! empty( $search_border_color ) || '0.75em 1em 0.75em 2.625em' !== $search_padding ) {
			$attrs = '';
			if ( 0 !== $form_border_size || 0 !== $search_border_size ) {
				$attrs .= 'border: ' . $search_border_size . 'px solid transparent;';
			}
			if ( ! empty( $search_border_color ) ) {
				$attrs .= 'border-color: ' . $search_border_color . ';';
			}
			if ( ! empty( $search_padding ) ) {
				$attrs .= 'padding: ' . $search_padding . ';';
			}
			if ( ! empty( $attrs ) ) {
				$style .= '
				.widget_search form input[type=search],
				.widget_product_search form input[type=search],
				.error-404-search form input[type=search] {
					' . $attrs . '
				}';
			}
		}

		// Search icon.
		if ( false === $search_icon_toggle || '.813em' !== $search_icon_top || '1em' !== $search_icon_indent ) {
			$attrs = '';
			if ( false === $search_icon_toggle ) {
				$attrs .= 'display: none;';
			}
			if ( ! empty( $search_icon_top ) ) {
				$attrs .= 'top: ' . $search_icon_top . ';';
			}
			if ( ! empty( $search_icon_indent ) ) {
				$attrs .= ( is_rtl() ? 'right' : 'left' ) . ': ' . $search_icon_indent . ';';
			}
			if ( ! empty( $attrs ) ) {
				$style .= '
				.widget_search form:before,
				.widget_product_search form:before,
				.error-404-search form:before {
					' . $attrs . '
				}';
			}
		}

		// Search Text Color.
		$search_text_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_search_text_color', apply_filters( 'archetype_default_search_text_color', '#555' ) ) );

		// Search Background Color.
		$search_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_search_background_color', apply_filters( 'archetype_default_search_background_color', '#fff' ) ) );

		// Search Shadow Toggle.
		$search_shadow_toggle = archetype_sanitize_checkbox( get_theme_mod( 'archetype_search_shadow_toggle', apply_filters( 'archetype_default_search_shadow_toggle', true ) ) );

		// Search Shadow Color.
		$search_shadow_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_search_shadow_color', apply_filters( 'archetype_default_search_shadow_color', '#8b949b' ) ) );

		if ( false === $search_shadow_toggle || ( '#555' !== $search_text_color && '#555555' !== $search_text_color ) || '#8b949b' !== $search_shadow_color ) {
			$style .= '
			.widget_search form input[type=search],
			.widget_product_search form input[type=search],
			.error-404-search form input[type=search] {
				background-color: ' . $search_background_color . ';
				box-shadow: ' . ( false === $search_shadow_toggle ? 'none' : '0px -1px 0px ' . $search_shadow_color. ' inset' ) . ';
				color: ' . $search_text_color . ';
			}';
		}

		if ( '#555' !== $search_text_color && '#555555' !== $search_text_color ) {
			$style .= '
			.widget_search form input[type=search]:focus,
			.widget_product_search form input[type=search]:focus,
			.error-404-search form input[type=search]:focus {
				color: ' . archetype_adjust_color_brightness( $search_text_color, -25.5 ) . ';
			}';

			$style .= '
			.widget_search form,
			.widget_product_search form,
			.error-404-search form {
				color: ' . $search_text_color . ';
			}';
		}

		// Button 2D.
		$button_2d = archetype_sanitize_checkbox( get_theme_mod( 'archetype_button_2d', apply_filters( 'archetype_default_button_2d', 0 ) ) );

		// Button border radius.
		$button_radius = archetype_sanitize_number( get_theme_mod( 'archetype_button_radius', apply_filters( 'archetype_default_button_radius', 3 ) ) );

		// Button border size.
		$button_border_size = archetype_sanitize_number( get_theme_mod( 'archetype_button_border_size', apply_filters( 'archetype_default_button_border_size', 1 ) ) );

		// Button border toggle.
		$button_border_toggle = archetype_sanitize_checkbox( get_theme_mod( 'archetype_button_border_toggle', apply_filters( 'archetype_default_button_border_toggle', false ) ) );

		// Button italic toggle.
		$button_italic_toggle = archetype_sanitize_checkbox( get_theme_mod( 'archetype_button_italic_toggle', apply_filters( 'archetype_default_button_italic_toggle', false ) ) );

		// Button small-caps toggle.
		$button_small_caps_toggle = archetype_sanitize_checkbox( get_theme_mod( 'archetype_button_small_caps_toggle', apply_filters( 'archetype_default_button_small_caps_toggle', false ) ) );

		// Button font-weight.
		$button_font_weight = archetype_sanitize_number( get_theme_mod( 'archetype_buttons_font_weight', apply_filters( 'archetype_default_buttons_font_weight', '400' ) ) );

		// Button Text Color.
		$button_text_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_text_color', apply_filters( 'archetype_default_button_text_color', '#fff' ) ) );

		// Button Background Color.
		$button_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_background_color', apply_filters( 'archetype_default_button_background_color', '#ed543f' ) ) );

		// Button Border Color.
		$button_border_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_border_color', apply_filters( 'archetype_default_button_border_color', '#d94834' ) ) );

		// Button Shadow Color.
		$button_shadow_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_shadow_color', apply_filters( 'archetype_default_button_shadow_color', '#d94834' ) ) );

		// Button Hover Text Color.
		$button_text_hover_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_text_hover_color', apply_filters( 'archetype_default_button_text_hover_color', '#555' ) ) );

		// Button Hover Background Color.
		$button_background_hover_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_background_hover_color', apply_filters( 'archetype_default_button_background_hover_color', '#fff' ) ) );

		// Button Hover Border Color.
		$button_border_hover_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_border_hover_color', apply_filters( 'archetype_default_button_border_hover_color', '#8b949b' ) ) );

		// Button Hover Shadow Color.
		$button_shadow_hover_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_shadow_hover_color', apply_filters( 'archetype_default_button_shadow_hover_color', '#8b949b' ) ) );

		$button_style = '';

		if ( 3 != $button_radius ) {
			$button_style .= '
			button, input[type="button"], input[type="reset"], input[type="submit"], .button, .added_to_cart {
				border-radius: ' . $button_radius. 'px;
			}';
		}

		if ( 1 !== $button_border_size || true === $button_italic_toggle || true === $button_small_caps_toggle || '400' !== $button_font_weight ) {
			$attrs = '';
			if ( 1 !== $button_border_size ) {
				$attrs .= 'border-width: ' . $button_border_size . 'px;';
			}
			if ( true === $button_italic_toggle ) {
				$attrs .= 'font-style: italic;';
			}
			if ( true === $button_small_caps_toggle ) {
				$attrs .= 'font-variant: small-caps;';
			}
			if ( '400' !== $button_font_weight ) {
				$attrs .= 'font-weight: ' . $button_font_weight. ';';
			}
			if ( ! empty( $attrs ) ) {
				$button_style .= '
				button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.button,
				.added_to_cart {
					' . $attrs . '
				}';
			}
		}

		if ( true === $button_border_toggle ) {
			$button_style .= '
			button,
			button:hover,
			input[type="button"],
			input[type="button"]:hover,
			input[type="reset"],
			input[type="reset"]:hover,
			input[type="submit"],
			input[type="submit"]:hover,
			.button,
			.button:hover,
			.added_to_cart,
			.added_to_cart:hover {
				border-color: transparent !important;
			}';
		}

		if ( ( '#fff' !== $button_text_color && '#ffffff' !== $button_text_color ) || '#ed543f' !== $button_background_color ) {
			$button_style .= '
			.bx-controls-direction .bx-prev, .bx-controls-direction .bx-next {
				background-color: ' . $button_background_color . ';
				color: ' . $button_text_color . ';
			}';
			$button_style .= '	
			.format-quote .entry-content {
				background-color: ' . $button_background_color . ';
				color: ' . $button_text_color . ';
			}';
		}

		if ( true === $button_2d || ( '#fff' !== $button_text_color && '#ffffff' !== $button_text_color ) || '#ed543f' !== $button_background_color || '#d94834' !== $button_border_color || '#d94834' !== $button_shadow_color ) {
			$button_style .= '
			button, input[type="button"], input[type="reset"], input[type="submit"], .button, .added_to_cart, button.cta:hover, input[type="button"].cta:hover, input[type="reset"].cta:hover, input[type="submit"].cta:hover, .button.cta:hover, .added_to_cart.cta:hover, button.alt:hover, input[type="button"].alt:hover, input[type="reset"].alt:hover, input[type="submit"].alt:hover, .button.alt:hover, .added_to_cart.alt:hover {
				background-color: ' . $button_background_color . ';
				border-color: ' . $button_border_color . ';
				color: ' . $button_text_color . ';
				' . ( true === $button_2d ? 'box-shadow: none !important;' : 'box-shadow: 0 -2px 0 ' . $button_shadow_color . ' inset;' ) . '
			}';
		}

		if ( true === $button_2d || ( '#555' !== $button_text_hover_color && '#555555' !== $button_text_hover_color ) || ( '#fff' !== $button_background_hover_color && '#ffffff' !== $button_background_hover_color ) || '#8b949b' !== $button_border_hover_color || '#8b949b' !== $button_shadow_hover_color ) {
			$button_style .= '
			button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:hover, .added_to_cart:hover, button.cta, button.alt, input[type="button"].cta, input[type="button"].alt, input[type="reset"].cta, input[type="reset"].alt, input[type="submit"].cta, input[type="submit"].alt, .button.cta, .button.alt, .added_to_cart.cta, .added_to_cart.alt {
				background-color: ' . $button_background_hover_color . ';
				border-color: ' . $button_border_hover_color . ';
				color: ' . $button_text_hover_color . ';
				' . ( true === $button_2d ? 'box-shadow: none !important;' : 'box-shadow: 0 -2px 0 ' . $button_shadow_hover_color . ' inset;' ) . '
			}';
		}

		if ( '#ed543f' !== $button_background_color ) {
			$button_style .= '
			.mejs-controls .mejs-time-rail .mejs-time-current {
				background: ' . $button_background_color . ' !important;
			}';
			$button_style .= '
			.pagination .prev:hover, .pagination .prev:focus, .pagination .next:hover, .pagination .next:focus, .pagination .nav-previous a:hover, .pagination .nav-previous a:focus, .pagination .nav-next a:hover, .pagination .nav-next a:focus, .image-navigation .prev:hover, .image-navigation .prev:focus, .image-navigation .next:hover, .image-navigation .next:focus, .image-navigation .nav-previous a:hover, .image-navigation .nav-previous a:focus, .image-navigation .nav-next a:hover, .image-navigation .nav-next a:focus, .comment-navigation .prev:hover, .comment-navigation .prev:focus, .comment-navigation .next:hover, .comment-navigation .next:focus, .comment-navigation .nav-previous a:hover, .comment-navigation .nav-previous a:focus, .comment-navigation .nav-next a:hover, .comment-navigation .nav-next a:focus, .woocommerce-pagination .prev:hover, .woocommerce-pagination .prev:focus, .woocommerce-pagination .next:hover, .woocommerce-pagination .next:focus, .woocommerce-pagination .nav-previous a:hover, .woocommerce-pagination .nav-previous a:focus, .woocommerce-pagination .nav-next a:hover, .woocommerce-pagination .nav-next a:focus {
				background-color: ' . $button_background_color . ';
			}
			.page-links a:hover, .page-links a:focus {
				background-color: ' . $button_background_color . ';
				border-color: ' . $button_background_color . ';
			}
			.format-quote .entry-header {
				background-color: ' . $button_background_color . ';
			}';
		}

		if ( '#fff' !== $button_text_color && '#ffffff' !== $button_text_color ) {
			$button_style .= '
			.format-quote .entry-header h1,
			.format-quote .entry-header h1 a {
				color: ' . $button_text_color . '; 
			}
			.format-quote .entry-header h1 a:hover {
				border-bottom-color: ' . $button_text_color . '; 
			} ';
			$button_style .= '
			.format-quote .entry-content .entry-body a {
				color: ' . $button_text_color . ';
				border-bottom-color: ' . $button_text_color . '; 
			}';
			$button_style .= '
			.widget-area .widget a.button {
				color: ' . $button_text_color . ';
			}';
		}

		if ( '#d94834' !== $button_border_color ) {
			$button_style .= '
			.format-quote .entry-content + .subscribe-and-connect-connect,
			.format-quote .entry-content + .author-info,
			.format-quote .entry-content + .entry-meta {
				border-top-color: ' . $button_border_color . ';
			}';
		}

		if ( '#555' !== $button_text_hover_color && '#555555' !== $button_text_hover_color ) {
			$button_style .= '
			.widget-area .widget a.button:hover {
				color: ' . $button_text_hover_color . '; 
			}';
		}

		if ( '' !== $button_style ) {
			$style .= $button_style;
		}

		// Footer heading.
		$footer_heading_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_heading_color', apply_filters( 'archetype_default_footer_heading_color', '#f1f1f1' ) ) );

		// Footer text.
		$footer_text_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_text_color', apply_filters( 'archetype_default_footer_text_color', '#888' ) ) );

		// Footer background.
		$footer_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_background_color', apply_filters( 'archetype_default_footer_background_color', '#353b3f' ) ) );

		// Footer link.
		$footer_link_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_link_color', apply_filters( 'archetype_default_footer_link_color', '#aaa' ) ) );

		// Footer link hover.
		$footer_link_hover_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_link_hover_color', apply_filters( 'archetype_default_footer_link_hover_color', '#fff' ) ) );

		// Lower footer text.
		$footer_lower_text_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_info_text_color', apply_filters( 'archetype_default_footer_info_text_color', '#888' ) ) );

		// Lower footer background.
		$footer_lower_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_info_background_color', apply_filters( 'archetype_default_footer_info_background_color', '#292e31' ) ) );

		// Lower footer link.
		$footer_lower_link_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_info_link_color', apply_filters( 'archetype_default_footer_info_link_color', '#aaa' ) ) );

		// Lower footer link hover.
		$footer_lower_link_hover_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_info_link_hover_color', apply_filters( 'archetype_default_footer_info_link_hover_color', '#fff' ) ) );
		
		// Footer Subscribe & Connect background Color.
		$footer_subscribe_and_connect_bg = archetype_sanitize_hex_color( get_theme_mod( 'archetype_footer_subscribe_and_connect_background_color', apply_filters( 'archetype_default_footer_subscribe_and_connect_background_color', '#24282a' ) ) );

		// Lower footer line-height.
		$footer_lower_line_height = archetype_sanitize_number( get_theme_mod( 'archetype_footer_info_line_height' ) );

		if ( '#24282a' !== $footer_subscribe_and_connect_bg ) {
			$style .= '
			#colophon .subscribe-and-connect-connect {
				background-color: ' . $footer_subscribe_and_connect_bg . ';
			}';
		}

		if ( 0 !== $footer_lower_line_height ) {
			$style .= '
			@media screen and (min-width: 768px) {
				.site-info .credit {
					line-height: ' . esc_attr( $footer_lower_line_height ) . ';
				}
			}';
		}

		if ( '#353b3f' !== $footer_background_color || ( '#888' !== $footer_text_color && '#888888' !== $footer_text_color ) ) {
			$style .= '.site-footer {
				background-color: ' . $footer_background_color . ';
				color: ' . $footer_text_color . ';
			}';
		}

		if ( '#f1f1f1' !== $footer_heading_color ) {
			$style .= '
			.site-footer h1, .site-footer h2, .site-footer h3, .site-footer h4, .site-footer h5, .site-footer h6 {
				color: ' . $footer_heading_color . ';
			}';
		}

		if ( '#aaa' !== $footer_link_color && '#aaaaaa' !== $footer_link_color ) {
			$style .= '
			.site-footer a:not(.button) {
				color: ' . $footer_link_color . ';
			}
			.site-footer a:not(.button):focus {
				outline-color: ' . $footer_link_color . ';
			}';
		}

		if ( '#fff' !== $footer_link_hover_color && '#ffffff' !== $footer_link_hover_color ) {
			$style .= '
			.site-footer a:not(.button):hover {
				color: ' . $footer_link_hover_color . ';
			}';
		}

		if ( '#292e31' !== $footer_lower_background_color || ( '#888' !== $footer_lower_text_color && '#888888' !== $footer_lower_text_color ) ) {
			$style .= '
			.site-info {
				background-color: ' . $footer_lower_background_color . ';
				color: ' . $footer_lower_text_color . ';
			}';
		}

		if ( '#aaa' !== $footer_lower_link_color && '#aaaaaa' !== $footer_lower_link_color ) {
			$style .= '
			.site-info a:not(.button) {
				color: ' . $footer_lower_link_color . ';
			}
			.site-info a:not(.button):focus {
				outline-color: ' . $footer_lower_link_color . ';
			}';
		}

		if ( '#fff' !== $footer_lower_link_hover_color && '#ffffff' !== $footer_lower_link_hover_color ) {
			$style .= '
			.site-info a:not(.button):hover {
				color: ' . $footer_lower_link_hover_color . ';
			}';
		}

		// Account for a boxed layout.
		if ( true === archetype_sanitize_checkbox( get_theme_mod( 'archetype_boxed', apply_filters( 'archetype_default_boxed', false ) ) ) ) {
			$style .= 'html {
				background-color: transparent;
			}';
		} else if ( '#292e31' !== $footer_lower_background_color ) {
			$style .= 'html {
				background-color: ' . $footer_lower_background_color . ';
			}';
		}

		/**
		 * Filter the styles added with the customizer.
		 *
		 * @since 1.0.0
		 *
		 * @param string $style Customize CSS styles.
		 */
		$style = apply_filters( 'archetype_add_customize_css', $style );

		// Remove space after colons.
		$style = str_replace( ': ', ':', $style );

		// Remove whitespace.
		$style = str_replace( array( "\r\n", "\r", "\n", "\t", '	', '		', '		' ), '', $style );

		if ( '/* Customizer Styles */' !== $style ) {
			wp_add_inline_style( 'archetype-style', $style );
		}
	}

endif;
