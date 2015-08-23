<?php
/**
 * Integration logic for WooCommerce extensions
 *
 * @package Archetype
 * @subpackage WooCommerce
 * @since 1.0.0
 */

/**
 * Styles & Scripts
 * @return void
 */
function archetype_woocommerce_integrations_scripts() {
	global $archetype_version;

	// Checks if current locale is RTL.
	$rtl = is_rtl() ? '-rtl' : '';

	/**
	 * Bookings
	 */
	if ( is_woocommerce_extension_activated( 'WC_Bookings' ) ) {
		wp_enqueue_style( 'archetype-woocommerce-bookings-style', get_template_directory_uri() . '/inc/woocommerce/css/bookings' . $rtl . '.css', array( 'archetype-woocommerce-style' ), $archetype_version );
	}

	/**
	 * Brands
	 */
	if ( is_woocommerce_extension_activated( 'WC_Brands' ) ) {
		wp_enqueue_style( 'archetype-woocommerce-brands-style', get_template_directory_uri() . '/inc/woocommerce/css/brands' . $rtl . '.css', array( 'archetype-woocommerce-style' ), $archetype_version );
	}

	/**
	 * Wishlists
	 */
	if ( is_woocommerce_extension_activated( 'WC_Wishlists_Wishlist' ) ) {
		wp_enqueue_style( 'archetype-woocommerce-wishlists-style', get_template_directory_uri() . '/inc/woocommerce/css/wishlists' . $rtl . '.css', array( 'archetype-woocommerce-style' ), $archetype_version );
	}

	/**
	 * AJAX Layered Nav
	 */
	if ( is_woocommerce_extension_activated( 'SOD_Widget_Ajax_Layered_Nav' ) ) {
		wp_enqueue_style( 'archetype-woocommerce-ajax-layered-nav-style', get_template_directory_uri() . '/inc/woocommerce/css/ajax-layered-nav' . $rtl . '.css', array( 'archetype-woocommerce-style' ), $archetype_version );
	}

	/**
	 * Variation Swatches
	 */
	if ( is_woocommerce_extension_activated( 'WC_SwatchesPlugin' ) ) {
		wp_enqueue_style( 'archetype-variation-swatches-style', get_template_directory_uri() . '/inc/woocommerce/css/variation-swatches' . $rtl . '.css', array( 'archetype-woocommerce-style' ), $archetype_version );
	}

	/**
	 * Composite Products
	 */
	if ( is_woocommerce_extension_activated( 'WC_Composite_Products' ) ) {
		wp_enqueue_style( 'archetype-composite-products-style', get_template_directory_uri() . '/inc/woocommerce/css/composite-products' . $rtl . '.css', array( 'archetype-woocommerce-style' ), $archetype_version );
	}

	/**
	 * WooCommerce Photography
	 */
	if ( is_woocommerce_extension_activated( 'WC_Photography' ) ) {
		wp_enqueue_style( 'archetype-woocommerce-photography-style', get_template_directory_uri() . '/inc/woocommerce/css/photography' . $rtl . '.css', array( 'archetype-woocommerce-style' ), $archetype_version );
	}

	/**
	 * Product Reviews Pro
	 */
	if ( is_woocommerce_extension_activated( 'WC_Product_Reviews_Pro' ) ) {
		wp_enqueue_style( 'archetype-woocommerce-product-reviews-pro-style', get_template_directory_uri() . '/inc/woocommerce/css/product-reviews-pro' . $rtl . '.css', array( 'archetype-woocommerce-style' ), $archetype_version );
	}

	/**
	 * WooCommerce Smart Coupons
	 */
	if ( is_woocommerce_extension_activated( 'WC_Smart_Coupons' ) ) {
		wp_enqueue_style( 'archetype-woocommerce-smart-coupons-style', get_template_directory_uri() . '/inc/woocommerce/css/smart-coupons' . $rtl . '.css', array( 'archetype-woocommerce-style' ), $archetype_version );
	}

	/**
	 * WooCommerce Deposits
	 */
	if ( is_woocommerce_extension_activated( 'WC_Deposits' ) ) {
		wp_enqueue_style( 'archetype-woocommerce-deposits-style', get_template_directory_uri() . '/inc/woocommerce/css/deposits' . $rtl . '.css', array( 'archetype-woocommerce-style' ), $archetype_version );
	}
}

if ( ! function_exists( 'archetype_add_integrations_customizer_css' ) ) :
	/**
	 * Add CSS in <head> for integration styles handled by the theme customizer
	 *
	 * @since 1.0
	 */
	function archetype_add_integrations_customizer_css() {
		if ( is_archetype_customizer_enabled() ) {
			// Style comment.
			$woocommerce_style = '/* WooCommerce Customizer Styles */';

			// Text color.
			$text_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_text_color', apply_filters( 'archetype_default_text_color', '#555' ) ) );

			// Link Color.
			$link_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_link_color', apply_filters( 'archetype_default_link_color', '#ee543f' ) ) );

			// Link Color Hover.
			$link_color_hover = archetype_sanitize_hex_color( get_theme_mod( 'archetype_link_color_hover', apply_filters( 'archetype_default_link_color_hover', '#111' ) ) );

			// Secondary Navigation Background Color.
			$nav_alt_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_nav_alt_background_color', apply_filters( 'archetype_default_nav_alt_background_color', '#41484d' ) ) );

			// Post Background Color.
			$post_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_post_background_color', apply_filters( 'archetype_default_post_background_color', '#fff' ) ) );

			// Post Border Color.
			$post_border_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_post_border_color', apply_filters( 'archetype_default_post_border_color', '#e5e5e5' ) ) );

			// Post Shadow Toggle.
			$post_shadow_toggle = archetype_sanitize_checkbox( get_theme_mod( 'archetype_post_shadow_toggle', apply_filters( 'archetype_default_post_shadow_toggle', true ) ) );

			// Post Shadow Color.
			$post_shadow_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_post_shadow_color', apply_filters( 'archetype_default_post_shadow_color', '#8b949b' ) ) );

			// Button Text Color.
			$button_text_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_text_color', apply_filters( 'archetype_default_button_text_color', '#fff' ) ) );

			// Button Background Color.
			$button_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_background_color', apply_filters( 'archetype_default_button_background_color', '#ed543f' ) ) );

			// Button Border Color.
			$button_border_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_border_color', apply_filters( 'archetype_default_button_border_color', '#d94834' ) ) );

			// Button Hover Text Color.
			$button_text_hover_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_text_hover_color', apply_filters( 'archetype_default_button_text_hover_color', '#555' ) ) );

			// Button Hover Background Color.
			$button_background_hover_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_button_background_hover_color', apply_filters( 'archetype_default_button_background_hover_color', '#fff' ) ) );

			// Notice Error.
			$notice_error_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_notice_error_color', apply_filters( 'archetype_default_notice_error_color', '#f75f46' ) ) );

			// Notice Success.
			$notice_success_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_notice_success_color', apply_filters( 'archetype_default_notice_success_color', '#36c478' ) ) );

			// Notice Info.
			$notice_info_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_notice_info_color', apply_filters( 'archetype_default_notice_info_color', '#3d9cd2' ) ) );

			// Post border radius.
			$post_radius = archetype_sanitize_number( get_theme_mod( 'archetype_post_radius', apply_filters( 'archetype_default_post_radius', 0 ) ) );

			// Alignment.
			$alignment = esc_attr( get_theme_mod( 'archetype_products_alignment', 'center' ) );

			if ( '#36c478' !== $notice_success_color ) {
				$woocommerce_style .= '
				.woocommerce-message,
				.woocommerce-info,
				.woocommerce-error {
					background-color: ' . $notice_success_color . ';
				}

				.form-row.woocommerce-validated input.input-text {
					box-shadow: 2px 0 0 ' . $notice_success_color . ' inset;
				}';
			}

			if ( '#f75f46' !== $notice_error_color ) {
				$woocommerce_style .= '
				a.remove:before {
					color: ' . $notice_error_color . ';
				}

				.form-row.woocommerce-invalid input.input-text {
					box-shadow: 2px 0 0 ' . $notice_error_color . ' inset;
				}

				.woocommerce-error {
					background-color: ' . $notice_error_color . ' !important;
				}';
			}

			if ( '#3d9cd2' !== $notice_info_color ) {
				$woocommerce_style .= '
				.demo_store {
					background-color: '	. $notice_info_color . ';
				}

				.woocommerce-info {
					background-color: '	. $notice_info_color . ';
				}';
			}

			if ( '#555' !== $text_color && '#555555' !== $text_color ) {
				$woocommerce_style .= '
				ul.products li.product .price,
				p.stars a {
					color: ' . $text_color . ';
				}

				.widget_price_filter .price_slider {
					background: ' . $text_color . ' !important;
				}';
			}

			if ( ( '#555' !== $text_color && '#555555' !== $text_color ) || ( '#fff' !== $post_background_color && '#ffffff' !== $post_background_color ) ) {
				$woocommerce_style .= '
				.type-product .onsale {
					background-color: ' . $text_color . ';
					color: ' . $post_background_color . ';
				}';
			}

			if ( '#ee543f' !== $link_color ) {
				$woocommerce_style .= '
				.star-rating span:before,
				p.stars a.toggled,
				p.stars a:hover,
				.product_list_widget a:hover {
					color: ' . $link_color . ';
				}';
			}

			if ( '#41484d' !== $nav_alt_background_color ) {
				$woocommerce_style .= '
				.site-header-cart .widget_shopping_cart {
					background-color: ' . $nav_alt_background_color . ';
				}';
			}

			if ( false === $post_shadow_toggle || ( '#fff' !== $post_background_color && '#ffffff' !== $post_background_color ) || 'center' !== $alignment || 0 != $post_radius || '#8b949b' !== $post_shadow_color ) {
				$woocommerce_style .= '
				ul.products li.product {
					background: ' . $post_background_color . ';
					box-shadow: ' . ( false === $post_shadow_toggle ? 'none' : '0px -1px 0px ' . $post_shadow_color . ' inset' ) . ';
					border-radius: ' . $post_radius . 'px;
					text-align: ' . $alignment . ';
				}';
			}

			if ( 'center' !== $alignment ) {
				$woocommerce_style .= '
				ul.products li.product .star-rating {
					margin-left: ' . ( 'right' == $alignment ? 'auto' : '0' ) . ';
					margin-right: ' . ( 'left' == $alignment ? 'auto' : '0' ) . ';
				}';
			}

			if ( false === $post_shadow_toggle || ( '#fff' !== $post_background_color && '#ffffff' !== $post_background_color ) || 0 != $post_radius || '#8b949b' !== $post_shadow_color ) {
				$woocommerce_style .= '
				.single-product div.product .images .thumbnails {
					background: ' . $post_background_color . ';
					box-shadow: ' . ( false === $post_shadow_toggle ? 'none' : '0px -1px 0px ' . $post_shadow_color . ' inset' ) . ';
					border-radius: 0 0 ' . $post_radius . 'px ' . $post_radius . 'px;
				}

				.single-product div.product .summary {
					background: ' . $post_background_color . ';
					box-shadow: ' . ( false === $post_shadow_toggle ? 'none' : '0px -1px 0px ' . $post_shadow_color . ' inset' ) . ';
					border-radius: 0 0 ' . $post_radius . 'px ' . $post_radius . 'px;
				}';
			}

			if ( ( '#fff' !== $post_background_color && '#ffffff' !== $post_background_color ) || 0 != $post_radius ) {
				$woocommerce_style .= '
				.woocommerce-breadcrumb {
					background-color: ' . $post_background_color . ';
					border-radius: 0 0 ' . $post_radius . 'px ' . $post_radius . 'px;
				}';
			}

			if ( false === $post_shadow_toggle || ( '#fff' !== $post_background_color && '#ffffff' !== $post_background_color ) || '#8b949b' !== $post_shadow_color ) {
				$woocommerce_style .= '
				.woocommerce-tabs ul.tabs {
					background: ' . $post_background_color . ';
					box-shadow: ' . ( false === $post_shadow_toggle ? 'none' : '0px -1px 0px ' . $post_shadow_color . ' inset' ) . ';
				}

				.woocommerce-tabs ul.tabs li a {
					background: ' . $post_background_color . ';
					border-bottom-color: ' . ( false === $post_shadow_toggle ? 'transparent' : $post_shadow_color ) . ';
				}';
			}

			if ( false === $post_shadow_toggle || ( '#fff' !== $post_background_color && '#ffffff' !== $post_background_color ) || '#8b949b' !== $post_shadow_color || 0 != $post_radius ) {
				$woocommerce_style .= '
				.woocommerce-tabs #tab-description,
				.woocommerce-tabs #tab-additional_information {
					background: ' . $post_background_color . ';
					box-shadow: ' . ( false === $post_shadow_toggle ? 'none' : '0px -1px 0px ' . $post_shadow_color . ' inset' ) . ';
					border-radius: ' . $post_radius . 'px;
				}';
			}

			if ( '#e5e5e5' !== $post_border_color ) {
				$woocommerce_style .= '
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
				}';
			}

			if ( '#fff' !== $button_text_color && '#ffffff' !== $button_text_color ) {
				$woocommerce_style .= '
				.widget_shopping_cart p.buttons a.button {
					color: ' . $button_text_color . ';
				}';
			}

			if ( '#555' !== $button_text_hover_color && '#555555' !== $button_text_hover_color ) {
				$woocommerce_style .= '
				.widget_shopping_cart p.buttons a.button:hover {
					color: ' . $button_text_hover_color . ';
				}';
			}

			if ( '#ed543f' !== $button_background_color ) {
				$woocommerce_style .= '
				.widget_price_filter .ui-slider .ui-slider-handle,
				.widget_price_filter .ui-slider .ui-slider-range {
					border-color: ' . $button_background_color . ';
					backround-color: ' . $button_background_color . ';
				}';
			}

			if ( '#ed543f' !== $button_background_color || ( '#fff' !== $button_text_color && '#ffffff' !== $button_text_color ) || '#d94834' !== $button_border_color ) {
				$woocommerce_style .= '
				.woocommerce-tabs ul.tabs li.active a {
					color: ' . $button_text_color . ';
					backround-color: ' . $button_background_color . ';
					border-color: ' . $button_border_color . ';
				}';
			}

			$button_style = '';

			if ( '#ed543f' !== $button_background_color ) {
				$button_style .= '
				.site-header-cart .widget_shopping_cart .product_list_widget li a.remove:before {
					color: ' . $button_background_color . ';
				}';
			}

			if ( '#fff' !== $button_background_hover_color && '#ffffff' !== $button_background_hover_color ) {
				$button_style .= '
				.site-header-cart .widget_shopping_cart .product_list_widget li a.remove:hover:before {
					color: ' . $button_background_hover_color . ';
				}';
			}

			if ( '' !== $button_style ) {
				$style .= '
				@media screen and (min-width: 768px) {
					' . $button_style . '
				}';
			}

			if ( is_woocommerce_extension_activated( 'WC_Bookings' ) ) {
				if ( ( '#555' !== $text_color && '#555555' !== $text_color ) || 0 != $post_radius ) {
					$woocommerce_style .= '
					#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker-header {
						background-color: ' . $text_color . ';
						border-radius: ' . $post_radius . 'px ' . $post_radius . 'px 0 0;
					}';
				}

				if ( ( '#555' !== $text_color && '#555555' !== $text_color ) || ( '#fff' !== $button_text_color && '#ffffff' !== $button_text_color ) ) {
					$woocommerce_style .= '
					#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker .ui-datepicker-next,
					#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker .ui-datepicker-prev {
						background-color: ' . $text_color . ';
						color: ' . $button_text_color . ';
					}';
				}

				if ( '#ed543f' !== $button_background_color ) {
					$woocommerce_style .= '
					#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker .ui-datepicker-next:hover,
					#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker .ui-datepicker-next:focus,
					#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker .ui-datepicker-prev:hover,
					#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker .ui-datepicker-prev:focus {
						background-color: ' . $button_background_color . ';
					}

					#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.bookable a {
						background-color: ' . $button_background_color . ' !important;
					}';
				}

				if ( '#fff' !== $button_text_color && '#ffffff' !== $button_text_color ) {
					$woocommerce_style .= '
					#wc-bookings-booking-form .block-picker li a {
						color: ' . $button_text_color . ';
					}';
				}

				if ( ( '#555' !== $button_text_hover_color && '#555555' !== $button_text_hover_color ) || ( '#fff' !== $button_background_hover_color && '#ffffff' !== $button_background_hover_color ) ) {
					$woocommerce_style .= '
					#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.bookable a:hover {
						background-color: ' . $button_background_hover_color . ' !important;
						color: ' . $button_text_hover_color . ' !important;
					}

					#wc-bookings-booking-form .block-picker li a:hover {
						background-color: ' . $button_background_hover_color . ';
						color: ' . $button_text_hover_color . ';
					}';
				}

				if ( ( '#fff' !== $button_text_color && '#ffffff' !== $button_text_color ) || '#ed543f' !== $button_background_color ) {
					$woocommerce_style .= '
					#wc-bookings-booking-form .block-picker li a.selected {
						background-color: ' . $button_background_color . ';
						color: ' . $button_text_color . ';
					}';
				}

				if ( '#555' !== $text_color && '#555555' !== $text_color ) {
					$woocommerce_style .= '
					#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.ui-state-disabled .ui-state-default,
					#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker th {
						color: ' . $text_color . ';
					}

					#wc-bookings-booking-form .block-picker li a:hover {
						color: ' . $text_color . ';
					}';
				}

				if ( '#ee543f' !== $link_color ) {
					$woocommerce_style .= '
					#wc-bookings-booking-form .wc-bookings-date-picker-choose-date {
						color: ' . $link_color . ';
					}';
				}
			}

			if ( is_woocommerce_extension_activated( 'WC_Product_Reviews_Pro' ) ) {
				if ( '#555' !== $text_color && '#555555' !== $text_color ) {
					$woocommerce_style .= '
					.woocommerce #reviews .product-rating .product-rating-details table td.rating-graph .bar,
					.woocommerce-page #reviews .product-rating .product-rating-details table td.rating-graph .bar {
						background-color: ' . $text_color . ';
					}';
				}

				if ( '#ee543f' !== $link_color ) {
					$woocommerce_style .= '
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
					}';
				}

				if ( false === $post_shadow_toggle || ( '#fff' !== $post_background_color && '#ffffff' !== $post_background_color ) || '#8b949b' !== $post_shadow_color || 0 != $post_radius ) {
					$woocommerce_style .= '
					.woocommerce #reviews .product-rating,
					.woocommerce-page #reviews .product-rating {
						background-color: ' . $post_background_color . ';
						box-shadow: ' . ( false === $post_shadow_toggle ? 'none' : '0px -1px 0px ' . $post_shadow_color . ' inset' ) . ';
						border-radius: ' . $post_radius . 'px;
					}

					.woocommerce #reviews .contribution-form-wrapper .form-contribution,
					.woocommerce-page #reviews .contribution-form-wrapper .form-contribution {
						background: ' . $post_background_color . ';
						box-shadow: ' . ( false === $post_shadow_toggle ? 'none' : '0px -1px 0px ' . $post_shadow_color . ' inset' ) . ';
						' . (
							is_rtl() ?
							'border-radius: ' . $post_radius . 'px 0 ' . $post_radius . 'px ' . $post_radius . 'px;' :
							'border-radius: 0 ' . $post_radius . 'px ' . $post_radius . 'px ' . $post_radius . 'px;'
						) . '
					}

					.woocommerce #reviews #comments ol.commentlist li,
					.woocommerce-page #reviews #comments ol.commentlist li {
						background: ' . $post_background_color . ';
						box-shadow: ' . ( false === $post_shadow_toggle ? 'none' : '0px -1px 0px ' . $post_shadow_color . ' inset' ) . ';
						border-radius: ' . $post_radius . 'px;
					}';
				}

				if ( '#fff' !== $post_background_color && '#ffffff' !== $post_background_color ) {
					$woocommerce_style .= '
					.woocommerce #reviews .contribution-flag-form,
					.woocommerce-page #reviews .contribution-flag-form {
						background-color: ' . $post_background_color . ';
					}

					.woocommerce #reviews .contribution-type-selector > a.active,
					.woocommerce-page #reviews .contribution-type-selector > a.active {
						background: ' . $post_background_color . ';
					}';
				}
			}

			if ( is_woocommerce_extension_activated( 'WC_Smart_Coupons' ) ) {
				// Nothing to add.
			}

			if ( is_woocommerce_extension_activated( 'WC_Wishlists_Wishlist' ) ) {
				if ( '#ee543f' !== $link_color ) {
					$woocommerce_style .= '
					#wl-wrapper .wl-share-links a {
						color: ' . $link_color . ';
					}';
				}

				if ( '#111' !== $link_color_hover && '#111111' !== $link_color_hover ) {
					$woocommerce_style .= '
					#wl-wrapper .wl-share-links a:hover {
						color: ' . $link_color_hover . ';
					}';
				}

				if ( '#fff' !== $post_background_color && '#ffffff' !== $post_background_color ) {
					$woocommerce_style .= '
					#wl-wrapper ul.wl-tabs {
						background: ' . $post_background_color . ';
					}';
				}

				if ( false === $post_shadow_toggle || ( '#fff' !== $post_background_color && '#ffffff' !== $post_background_color ) || '#8b949b' !== $post_shadow_color ) {
					$woocommerce_style .= '
					#wl-wrapper ul.wl-tabs > li > a {
						background: ' . $post_background_color . ';
						box-shadow: ' . ( false === $post_shadow_toggle ? 'none' : '0px -1px 0px ' . $post_shadow_color . ' inset' ) . ';
					}';
				}

				if ( '#fff' !== $post_background_color && '#ffffff' !== $post_background_color ) {
					$woocommerce_style .= '
					#wl-wrapper ul.wl-tabs > li > a:hover {
						background: ' . $post_background_color . ';
					}';
				}

				if ( '#ed543f' !== $button_background_color || ( '#fff' !== $button_text_color && '#ffffff' !== $button_text_color ) || '#d94834' !== $button_border_color ) {
					$woocommerce_style .= '
					#wl-wrapper ul.wl-tabs > li.active a {
						color: ' . $button_text_color . ';
						background: ' . $button_background_color . ';
						border-color: ' . $button_border_color . ';
					}';
				}

				if ( false === $post_shadow_toggle || ( '#fff' !== $post_background_color && '#ffffff' !== $post_background_color ) || '#8b949b' !== $post_shadow_color || 0 != $post_radius || '#e5e5e5' !== $post_border_color ) {
					$woocommerce_style .= '
					.wl-list-pop {
						background: ' . $post_background_color . ';
						border-color: ' . $post_border_color . ';
						border-bottom-color: ' . ( false === $post_shadow_toggle ? 'transparent' : $post_shadow_color ) . ';
						border-radius: ' . $post_radius . 'px;
					}';
				}

				if ( '#e5e5e5' !== $post_border_color ) {
					$woocommerce_style .= '
					#wl-wrapper .wl-meta-share,
					#wl-wrapper .wl-share-url {
						border-bottom-color: ' . $post_border_color . ';
					}';
				}
			}

			if ( is_woocommerce_extension_activated( 'WC_Photography' ) ) {
				if ( false === $post_shadow_toggle || ( '#fff' !== $post_background_color && '#ffffff' !== $post_background_color ) || '#8b949b' !== $post_shadow_color || 0 != $post_radius ) {
					$woocommerce_style .= '
					.woocommerce .photography-products .tools,
					.woocommerce-page .photography-products .tools {
						background-color: ' . $post_background_color . ';
						box-shadow: ' . ( false === $post_shadow_toggle ? 'none' : '0px -1px 0px ' . $post_shadow_color . ' inset' ) . ';
						border-radius: ' . $post_radius . 'px;
					}';
				}
			}

			if ( is_woocommerce_extension_activated( 'WC_Composite_Products' ) ) {
				if ( '#e5e5e5' !== $post_border_color ) {
					$woocommerce_style .= '
					.single-product div.product .component_selections .component_summary {
						border-bottom-color: ' . $post_border_color . ';
					}';
				}
			}
			
			// Archive thumbnail filter.
			$thumbnail_filter = esc_attr( get_theme_mod( 'archetype_products_filter', apply_filters( 'archetype_default_products_filter', '' ) ) );

			// Archive thumbnail filter background.
			$thumbnail_filter_background = archetype_sanitize_hex_color( get_theme_mod( 'archetype_products_filter_background', apply_filters( 'archetype_default_products_filter_background', '#ffffff' ) ) );

			if ( '' !== $thumbnail_filter ) {
				$woocommerce_style .= '
				.has-product-thumbnail-filter .product.has-post-thumbnail > a {
					overflow: hidden;
				}
				.has-product-thumbnail-filter .product.has-post-thumbnail > a .product-thumbnail {
					position: relative;
					float: left;
					overflow: hidden;
					max-height: 100%;
					max-width: 100%;
				}
				.has-product-thumbnail-filter .product.has-post-thumbnail > a .product-thumbnail img {
					position: relative;
					display: block;
				}';
			}

			if ( 'lily' === $thumbnail_filter ) {
				$woocommerce_style .= '
				.has-product-lily-filter .product.has-post-thumbnail > a .product-thumbnail {
					background-color: ' . $thumbnail_filter_background . ';
					-webkit-transform: translateZ(0);
					transform: translateZ(0);
				}
				.has-product-lily-filter .product.has-post-thumbnail > a .product-thumbnail img {
					max-width: none;
					width: -webkit-calc(100% + 50px);
					width: calc(100% + 50px);
					opacity: 0.7;
					-webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
					transition: opacity 0.35s, transform 0.35s;
					-webkit-transform: translate3d(-40px, 0, 0);
					transform: translate3d(-40px, 0, 0);
				}
				.has-product-lily-filter .product.has-post-thumbnail > a:hover .product-thumbnail img {
					opacity: 1;
					-webkit-transform: translate3d(0, 0, 0);
					transform: translate3d(0, 0, 0);
				}';
			}

			if ( 'sadie' === $thumbnail_filter ) {
				list( $r, $g, $b ) = sscanf( $thumbnail_filter_background, '#%02x%02x%02x' );
				$woocommerce_style .= '
				.has-product-sadie-filter .product.has-post-thumbnail > a .product-thumbnail:before {
					position: absolute;
					top: 0;
					left: 0;
					width: 100%;
					height: 100%;
					background: -webkit-linear-gradient(top, ' . sprintf( 'rgba(%s,%s,%s,%s)', $r, $g, $b, '0' ) . ' 0%, ' . sprintf( 'rgba(%s,%s,%s,%s)', $r, $g, $b, '0.5' ) . ' 75%);
					background: linear-gradient(to bottom, ' . sprintf( 'rgba(%s,%s,%s,%s)', $r, $g, $b, '0' ) . ' 0%, ' . sprintf( 'rgba(%s,%s,%s,%s)', $r, $g, $b, '0.5' ) . ' 75%);
					content: \'\';
					opacity: 0;
					z-index: 10;
					-webkit-transform: translate3d(0, 50%, 0);
					transform: translate3d(0, 50%, 0);
					-webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
					transition: opacity 0.35s, transform 0.35s;
				}
				.has-product-sadie-filter .product.has-post-thumbnail > a:hover .product-thumbnail:before {
					opacity: 1;
					-webkit-transform: translate3d(0, 0, 0);
					transform: translate3d(0, 0, 0);
				}';
			}

			if ( 'honey' === $thumbnail_filter ) {
				$woocommerce_style .= '
				.has-product-honey-filter .product.has-post-thumbnail > a .product-thumbnail {
					background-color: ' . $thumbnail_filter_background . ';
				}
				.has-product-honey-filter .product.has-post-thumbnail > a .product-thumbnail img {
					opacity: 0.9;
					-webkit-transition: opacity 0.35s;
					transition: opacity 0.35s;
				}
				.has-product-honey-filter .product.has-post-thumbnail > a:hover .product-thumbnail img {
					opacity: 0.5;
				}';
			}

			if ( 'ruby' === $thumbnail_filter ) {
				$woocommerce_style .= '
				.has-product-ruby-filter .product.has-post-thumbnail > a .product-thumbnail {
					background-color: ' . $thumbnail_filter_background . ';
				}
				.has-product-ruby-filter .product.has-post-thumbnail > a .product-thumbnail img {
					opacity: 0.7;
					-webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
					transition: opacity 0.35s, transform 0.35s;
					-webkit-transform: scale(1.15);
					transform: scale(1.15);
				}
				.has-product-ruby-filter .product.has-post-thumbnail > a:hover .product-thumbnail img {
					opacity: 0.5;
					-webkit-transform: scale(1);
					transform: scale(1);
				}';
			}

			if ( 'layla' === $thumbnail_filter ) {
				list( $r, $g, $b ) = sscanf( $thumbnail_filter_background, '#%02x%02x%02x' );
				$woocommerce_style .= '
				.has-product-layla-filter .product.has-post-thumbnail > a .product-thumbnail {
					background: -webkit-linear-gradient(45deg, ' . sprintf( 'rgba(%s,%s,%s,%s)', $r, $g, $b, '0.75' ) . ' 0%, ' . sprintf( 'rgba(%s,%s,%s,%s)', $r, $g, $b, '0' ) . ' 100%);
					background: linear-gradient(45deg, ' . sprintf( 'rgba(%s,%s,%s,%s)', $r, $g, $b, '0.75' ) . ' 0%, ' . sprintf( 'rgba(%s,%s,%s,%s)', $r, $g, $b, '0' ) . ' 100%);
				}
				.has-product-layla-filter .product.has-post-thumbnail > a .product-thumbnail:before,
				.has-product-layla-filter .product.has-post-thumbnail > a .product-thumbnail:after {
					position: absolute;
					content: \'\';
					opacity: 0;
					z-index: 10;
				}
				.has-product-layla-filter .product.has-post-thumbnail > a .product-thumbnail:before {
					top: 50px;
					right: 30px;
					bottom: 50px;
					left: 30px;
					border-top: 1px solid rgba(255, 255, 255, 0.75);
					border-bottom: 1px solid rgba(255, 255, 255, 0.75);
					-webkit-transform: scale(0, 1);
					transform: scale(0, 1);
					-webkit-transform-origin: 0 0;
					transform-origin: 0 0;
				}
				.has-product-layla-filter .product.has-post-thumbnail > a .product-thumbnail:after {
					top: 30px;
					right: 50px;
					bottom: 30px;
					left: 50px;
					border-right: 1px solid rgba(255, 255, 255, 0.75);
					border-left: 1px solid rgba(255, 255, 255, 0.75);
					-webkit-transform: scale(1, 0);
					transform: scale(1, 0);
					-webkit-transform-origin: 100% 0;
					transform-origin: 100% 0; }
				.has-product-layla-filter .product.has-post-thumbnail > a .product-thumbnail img {
					opacity: 0.7;
				}
				.has-product-layla-filter .product.has-post-thumbnail > a .product-thumbnail img,
				.has-product-layla-filter .product.has-post-thumbnail > a .product-thumbnail:before,
				.has-product-layla-filter .product.has-post-thumbnail > a .product-thumbnail:after {
					-webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
					transition: opacity 0.35s, transform 0.35s;
				}
				.has-product-layla-filter .product.has-post-thumbnail > a:hover .product-thumbnail img {
					opacity: 0.85;
				}
				.has-product-layla-filter .product.has-post-thumbnail > a:hover .product-thumbnail:before,
				.has-product-layla-filter .product.has-post-thumbnail > a:hover .product-thumbnail:after {
					opacity: 1;
					-webkit-transform: scale(1);
					transform: scale(1);
				}
				.has-product-layla-filter .product.has-post-thumbnail > a:hover .product-thumbnail:after {
					-webkit-transition-delay: 0.15s;
					transition-delay: 0.15s;
				}';
			}

			if ( 'roxy' === $thumbnail_filter ) {
				list( $r, $g, $b ) = sscanf( $thumbnail_filter_background, '#%02x%02x%02x' );
				$woocommerce_style .= '
				.has-product-roxy-filter .product.has-post-thumbnail > a .product-thumbnail {
					background: -webkit-linear-gradient(45deg, ' . sprintf( 'rgba(%s,%s,%s,%s)', $r, $g, $b, '0' ) . ' 0%, ' . sprintf( 'rgba(%s,%s,%s,%s)', $r, $g, $b, '0.75' ) . ' 100%);
					background: linear-gradient(45deg, ' . sprintf( 'rgba(%s,%s,%s,%s)', $r, $g, $b, '0' ) . ' 0%, ' . sprintf( 'rgba(%s,%s,%s,%s)', $r, $g, $b, '0.75' ) . ' 100%);
				}
				.has-product-roxy-filter .product.has-post-thumbnail > a .product-thumbnail:before {
					position: absolute;
					top: 30px;
					right: 30px;
					bottom: 30px;
					left: 30px;
					border: 1px solid rgba(255, 255, 255, 0.75);
					content: \'\';
					opacity: 0;
					-webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
					transition: opacity 0.35s, transform 0.35s;
					-webkit-transform: translate3d(-20px, 0, 0);
					transform: translate3d(-20px, 0, 0);
					z-index: 10;
				}
				.has-product-roxy-filter .product.has-post-thumbnail > a .product-thumbnail img {
					opacity: 0.8;
					max-width: none;
					width: -webkit-calc(100% + 60px);
					width: calc(100% + 60px);
					-webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
					transition: opacity 0.35s, transform 0.35s;
					-webkit-transform: translate3d(-50px, 0, 0);
					transform: translate3d(-50px, 0, 0);
				}
				.has-product-roxy-filter .product.has-post-thumbnail > a:hover .product-thumbnail:before {
					opacity: 1;
					-webkit-transform: translate3d(0, 0, 0);
					transform: translate3d(0, 0, 0);
				}
				.has-product-roxy-filter .product.has-post-thumbnail > a:hover .product-thumbnail img {
					opacity: 0.7;
					-webkit-transform: translate3d(0, 0, 0);
					transform: translate3d(0, 0, 0);
				}';
			}

			if ( 'julia' === $thumbnail_filter ) {
				$woocommerce_style .= '
				.has-product-julia-filter .product.has-post-thumbnail > a .product-thumbnail {
					background-color: ' . $thumbnail_filter_background . ';
				}
				.has-product-julia-filter .product.has-post-thumbnail > a .product-thumbnail img {
					opacity: 0.8;
					-webkit-transition: opacity 0.5s, -webkit-transform 0.5s;
					transition: opacity 0.5s, transform 0.5s;
					-webkit-backface-visibility: hidden;
					backface-visibility: hidden;
				}
				.has-product-julia-filter .product.has-post-thumbnail > a:hover .product-thumbnail img {
					opacity: 0.4;
					-webkit-transform: scale3d(1.1, 1.1, 1);
					transform: scale3d(1.1, 1.1, 1);
				}';
			}

			// Remove space after colons.
			$woocommerce_style = str_replace( ': ', ':', $woocommerce_style );

			// Remove whitespace.
			$woocommerce_style = str_replace( array( "\r\n", "\r", "\n", "\t", '	', '		', '		' ), '', $woocommerce_style );

			if ( '/* WooCommerce Customizer Styles */' !== $woocommerce_style ) {
				wp_add_inline_style( 'archetype-woocommerce-style', $woocommerce_style );
			}
		}
	}
endif;
