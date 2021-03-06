/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
( function( $ ) {
	'use strict';

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a, .footer-site-title' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	wp.customize( 'archetype_full_width', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( 'body' ).addClass( 'is-full-width' );
			} else {
				$( 'body' ).removeClass( 'is-full-width' );
			}
		} );
	} );
	wp.customize( 'archetype_boxed', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( 'body' ).addClass( 'is-boxed' );
				$( 'html' ).css( 'background-color', 'transparent' );
			} else {
				$( 'body' ).removeClass( 'is-boxed' );
				$( 'html' ).css( 'background-color', $( '.site-info' ).css( 'background-color' ) );
			}
		} );
	} );
	wp.customize( 'archetype_boxed_background_color', function( value ) {
		value.bind( function( to ) {
			$( '.is-boxed .site' ).css( 'background-color', to );
		} );
	} );
	wp.customize( 'archetype_heading_color', function( value ) {
		value.bind( function( to ) {
			// Color
			$( 'h1, h2, h3, h4, h5, h6, .hentry .entry-header h1 a' ).css( 'color', to );

			// Border Color Hover
			$( '.hentry .entry-header h1 a' ).on( 'mouseenter', function() {
				$( this ).css( 'border-color', to );
			} );
		} );
	} );
	wp.customize( 'archetype_site_logo_margin_top', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$( '.site-logo-link img, .svg-site-logo' ).css( 'margin-top', to + 'em' );
			} else {
				$( '.site-logo-link img, .svg-site-logo' ).css( 'margin-top', '0' );
			}
		} );
	} );
	wp.customize( 'archetype_site_logo_margin_bottom', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$( '.site-logo-link img, .svg-site-logo' ).css( 'margin-bottom', to + 'em' );
			} else {
				$( '.site-logo-link img, .svg-site-logo' ).css( 'margin-bottom', '0' );
			}
		} );
	} );
	wp.customize( 'archetype_header_background_color', function( value ) {
		value.bind( function( to ) {
			// Background Color
			$( '.site-header' ).css( 'background-color', to );
		} );
	} );
	wp.customize( 'archetype_header_text_color', function( value ) {
		value.bind( function( to ) {
			// Color
			$( '.site-header' ).css( 'color', to );
		} );
	} );
	wp.customize( 'archetype_nav_background_color', function( value ) {
		value.bind( function( to ) {
			// Background Color
			$( '#navigation, .main-navigation ul.menu ul' ).css( 'background-color', to );
		} );
	} );
	wp.customize( 'archetype_nav_link_color', function( value ) {
		value.bind( function( to ) {
			// Link Color
			$( '.main-navigation ul li a' ).css( 'color', to ).on( 'mouseleave', function() {
				$( this ).css( 'color', to );
			} );
		} );
	} );
	wp.customize( 'archetype_nav_link_hover_color', function( value ) {
		value.bind( function( to ) {
			var $link = $( '.main-navigation ul li:not(.current-menu-item,.current_page_parent,.current-menu-ancestor) a' ),
					color = $link.css( 'color' );
			// Link Color Hover
			$link.on( 'mouseenter', function() {
				$( this ).css( 'color', to );
			} ).on( 'mouseleave', function() {
				$( this ).css( 'color', color );
			} );
		} );
	} );
	wp.customize( 'archetype_nav_link_hover_background_color', function( value ) {
		value.bind( function( to ) {
			var $link = $( '.main-navigation ul.menu ul a' ),
					color = $link.css( 'background-color' );
			// Link Color Background Hover
			$link.on( 'mouseenter', function() {
				$( this ).css( 'background-color', to );
			} ).on( 'mouseleave', function() {
				$( this ).css( 'background-color', color );
			} );
			$( '.main-navigation ul.menu ul li' ).on( 'mouseenter', function() {
				$( this ).next( 'a' ).css( 'background-color', to );
			} ).on( 'mouseleave', function() {
				$( this ).next( 'a' ).css( 'background-color', color );
			} );
		} );
	} );
	wp.customize( 'archetype_nav_link_active_color', function( value ) {
		value.bind( function( to ) {
			// Color
			$( '.main-navigation ul li.current-menu-item > a, .main-navigation ul li.current_page_parent > a, .main-navigation ul li.current-menu-ancestor > a' ).css( 'color', to );
		} );
	} );
	wp.customize( 'archetype_nav_link_active_background_color', function( value ) {
		value.bind( function( to ) {
			// Background Color
			$( '.main-navigation ul li.current-menu-item > a, .main-navigation ul li.current_page_parent > a, .main-navigation ul li.current-menu-ancestor > a' ).css( 'background-color', to );
		} );
	} );
	wp.customize( 'archetype_nav_alt_color', function( value ) {
		value.bind( function( to ) {
			// Color
			$( '.secondary-navigation' ).css( 'color', to );
		} );
	} );
	wp.customize( 'archetype_nav_alt_background_color', function( value ) {
		value.bind( function( to ) {
			// Background Color
			$( '.secondary-navigation ul.menu li ul, .site-header-cart .widget_shopping_cart' ).css( 'background-color', to );
		} );
	} );
	wp.customize( 'archetype_nav_alt_link_color', function( value ) {
		value.bind( function( to ) {
			// Link Color
			$( '.secondary-navigation ul.menu li a' ).css( 'color', to ).on( 'mouseleave', function() {
				$( this ).css( 'color', to );
			} );
		} );
	} );
	wp.customize( 'archetype_nav_alt_link_hover_color', function( value ) {
		value.bind( function( to ) {
			var $link = $( '.secondary-navigation ul.menu li:not(.current-menu-item,.current_page_parent,.current-menu-ancestor) a' ),
					color = $link.css( 'color' );
			// Link Color Hover
			$link.on( 'mouseenter', function() {
				$( this ).css( 'color', to );
			} ).on( 'mouseleave', function() {
				$( this ).css( 'color', color );
			} );
		} );
	} );
	wp.customize( 'archetype_nav_alt_link_hover_background_color', function( value ) {
		value.bind( function( to ) {
			var $link = $( '.secondary-navigation ul.menu li ul a' ),
					color = $link.css( 'background-color' );
			// Link Color Background Hover
			$link.on( 'mouseenter', function() {
				$( this ).css( 'background-color', to );
			} ).on( 'mouseleave', function() {
				$( this ).css( 'background-color', color );
			} );
			$( '.secondary-navigation ul.menu li ul li' ).on( 'mouseenter', function() {
				$( this ).next( 'a' ).css( 'background-color', to );
			} ).on( 'mouseleave', function() {
				$( this ).next( 'a' ).css( 'background-color', color );
			} );
		} );
	} );
	wp.customize( 'archetype_nav_alt_link_active_color', function( value ) {
		value.bind( function( to ) {
			// Color
			$( '.secondary-navigation ul.menu li.current-menu-item > a, .secondary-navigation ul.menu li.current_page_parent > a, .secondary-navigation ul.menu li.current-menu-ancestor > a' ).css( 'color', to );
		} );
	} );
	wp.customize( 'archetype_nav_alt_link_active_background_color', function( value ) {
		value.bind( function( to ) {
			// Background Color
			$( '.secondary-navigation ul.menu li li.current-menu-item > a, .secondary-navigation ul.menu li li.current_page_parent > a, .secondary-navigation ul.menu li li.current-menu-ancestor > a' ).css( 'background-color', to );
		} );
	} );
	wp.customize( 'archetype_nav_handheld_background_color', function( value ) {
		value.bind( function( to ) {
			$( '.handheld-navigation, .menu-toggle, a.cart-contents' ).css( 'background-color', to );
		} );
	} );
	wp.customize( 'archetype_nav_handheld_link_color', function( value ) {
		value.bind( function( to ) {
			$( '.handheld-navigation ul li:not(.current-menu-item) a, .menu-toggle, a.cart-contents' ).css( 'color', to ).on( 'mouseleave', function() {
				$( this ).css( 'color', to );
			} );
		} );
	} );
	wp.customize( 'archetype_nav_handheld_link_hover_color', function( value ) {
		value.bind( function( to ) {
			var $link = $( '.handheld-navigation ul li:not(.current-menu-item) a, .menu-toggle, a.cart-contents' ),
					color = $( '.menu-toggle' ).css( 'color' );
			// Link Color Hover
			$link.on( 'mouseenter', function() {
				$( this ).css( 'color', to );
			} ).on( 'mouseleave', function() {
				$( this ).css( 'color', color );
			} );
		} );
	} );
	wp.customize( 'archetype_nav_handheld_link_hover_background_color', function( value ) {
		value.bind( function( to ) {
			var $link = $( '.handheld-navigation ul li:not(.current-menu-item) a, .menu-toggle, a.cart-contents' ),
					color = $( '.menu-toggle' ).css( 'background-color' );
			// Link Color Background Hover
			$link.on( 'mouseenter', function() {
				$( this ).css( 'background-color', to );
			} ).on( 'mouseleave', function() {
				$( this ).css( 'background-color', color );
			} );
		} );
	} );
	wp.customize( 'archetype_nav_handheld_link_active_color', function( value ) {
		value.bind( function( to ) {
			// Color
			$( '.handheld-navigation ul li.current-menu-item > a' ).css( 'color', to );
		} );
	} );
	wp.customize( 'archetype_nav_handheld_link_active_background_color', function( value ) {
		value.bind( function( to ) {
			// Background Color
			$( '.handheld-navigation ul li.current-menu-item > a' ).css( 'background-color', to );
		} );
	} );
	wp.customize( 'archetype_homepage_hero_heading_color', function( value ) {
		value.bind( function( to ) {
			$( '.archetype-homepage-hero h1' ).css( 'color', to );
		} );
	} );
	wp.customize( 'archetype_homepage_hero_text_color', function( value ) {
		value.bind( function( to ) {
			$( '.archetype-homepage-hero .archetype-hero-body' ).css( 'color', to );
		} );
	} );
	wp.customize( 'archetype_homepage_hero_background_color', function( value ) {
		value.bind( function( to ) {
			$( '.archetype-homepage-hero' ).css( 'background-color', to );
		} );
	} );
	wp.customize( 'archetype_homepage_hero_heading_text', function( value ) {
		value.bind( function( to ) {
			$( '.archetype-homepage-hero h1:first-child' ).text( to );
		} );
	} );
	wp.customize( 'archetype_post_border_color', function( value ) {
		value.bind( function( to ) {
			// Border Bottom Color
			$( 'table thead th, #comments .commentlist .comment-meta' ).css( 'border-bottom-color', to );

			// Border Top Color
			$( 'table tfoot th, table tfoot td, .author-info, .hentry .entry-meta' ).css( 'border-top-color', to );

			// Border Color
			$( '.format-quote .author-info + .entry-meta, .single-product div.product form.cart, .single-product div.product .variations_button, .single-product div.product .woocommerce-product-rating, .single-product div.product .product_meta .posted_in, .single-product div.product .product_meta .sku_wrapper, .single-product div.product .product_meta .tagged_as, .woocommerce-breadcrumb, table.cart td.actions .coupon, #payment, #payment .payment_methods, #payment .payment_methods li, #payment .payment_methods li .payment_box, #customer_login .col-1, ul.order_details, ul.order_details li, ul.digital-downloads li, .wl-list-pop, #wl-wrapper .wl-meta-share, #wl-wrapper .wl-share-url, .single-product div.product .component_selections .component_summary' ).css( 'border-color', to );

			// Box Shadow Color
			$( '.post-navigation div + div' ).css( 'box-shadow', '0px 1px 0px ' + to + ' inset' );
		} );
	} );
	wp.customize( 'archetype_form_text_color', function( value ) {
		value.bind( function( to ) {
			// Text Color
			$( 'input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], textarea, .input-text' ).not( '.widget_search *, .widget_product_search *, .error-404-search *' ).css( 'color', to ).on( 'blur', function() {
				$( this ).css( 'color', to );
			} );
		} );
	} );
	wp.customize( 'archetype_form_background_color', function( value ) {
		value.bind( function( to ) {
			// Background Color
			$( 'input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], textarea, .input-text' ).not( '.widget_search *, .widget_product_search *, .error-404-search *' ).css( 'background-color', to ).on( 'blur', function() {
				$( this ).css( 'background-color', to );
			} );
		} );
	} );
	wp.customize( 'archetype_form_text_focus_color', function( value ) {
		value.bind( function( to ) {
			// Text Color
			$( 'input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], textarea, .input-text' ).not( '.widget_search *, .widget_product_search *, .error-404-search *' ).on( 'focus', function() {
				$( this ).css( 'color', to );
			} );
		} );
	} );
	wp.customize( 'archetype_form_background_focus_color', function( value ) {
		value.bind( function( to ) {
			var $el = $( 'input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], textarea, .input-text' ).not( '.widget_search *, .widget_product_search *, .error-404-search *' ),
					color = $el.css( 'background-color' );

			$el.on( 'focusin', function() {
				$( this ).css( 'background-color', to );
			} ).on( 'focusout', function() {
				$( this ).css( 'background-color', color );
			} );
		} );
	} );
	wp.customize( 'archetype_search_text_color', function( value ) {
		value.bind( function( to ) {
			// Text Color
			$( '.widget_search form input[type=search], .widget_product_search form input[type=search], .error-404-search form input[type=search], .widget_search form, .widget_product_search form, .error-404-search form' ).css( 'color', to );
		} );
	} );
	wp.customize( 'archetype_search_background_color', function( value ) {
		value.bind( function( to ) {
			// Background Color
			$( '.widget_search form input[type=search], .widget_product_search form input[type=search], .error-404-search form input[type=search]' ).css( 'background-color', to );
		} );
	} );
	wp.customize( 'archetype_search_shadow_color', function( value ) {
		value.bind( function( to ) {
			// Shadow Color
			$( '.widget_search form input[type=search], .widget_product_search form input[type=search], .error-404-search form input[type=search]' ).css( 'box-shadow', '0px -1px 0px ' + to + ' inset' );
		} );
	} );
	wp.customize( 'archetype_footer_subscribe_and_connect_background_color', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$( '#colophon .subscribe-and-connect-connect' ).css( 'background-color', to );
			}
		} );
	} );
	wp.customize( 'archetype_footer_info_line_height', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$( '.site-info .credit' ).css( 'line-height', to );
			}
		} );
	} );
	wp.customize( 'archetype_footer_heading_color', function( value ) {
		value.bind( function( to ) {
			// Heading Color
			$( '.site-footer h1, .site-footer h2, .site-footer h3, .site-footer h4, .site-footer h5, .site-footer h6' ).css( 'color', to );
		} );
	} );
	wp.customize( 'archetype_footer_text_color', function( value ) {
		value.bind( function( to ) {
			// Text Color
			$( '.site-footer' ).css( 'color', to );

			// Outline Color
			$( '.site-footer a:not(.button)' ).on( 'focus', function() {
				$( this ).css( 'outline-color', to );
			} );
		} );
	} );
	wp.customize( 'archetype_footer_background_color', function( value ) {
		value.bind( function( to ) {
			// Background Color
			$( '.site-footer' ).css( 'background-color', to );
		} );
	} );
	wp.customize( 'archetype_footer_info_text_color', function( value ) {
		value.bind( function( to ) {
			// Text Color
			$( '.site-info' ).css( 'color', to );

			// Outline Color
			$( '.site-info a:not(.button)' ).on( 'focus', function() {
				$( this ).css( 'outline-color', to );
			} );
		} );
	} );
	wp.customize( 'archetype_footer_info_background_color', function( value ) {
		value.bind( function( to ) {
			// Background Color
			$( '.site-info' ).css( 'background-color', to );
			if ( $( 'body' ).hasClass( 'is-boxed' ) ) {
				$( 'html' ).css( 'background-color', 'transparent' );
			} else {
				$( 'html' ).css( 'background-color', to );
			}
		} );
	} );

} )( jQuery );
