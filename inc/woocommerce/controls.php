<?php
/**
 * WooCommerce Customizer controls
 *
 * @package Archetype
 * @subpackage WooCommerce
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_woocommerce_customize_register' ) ) :
	/**
	 * WooCommerce Theme Customizer settings.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @since 1.0.0
	 */
	function archetype_woocommerce_customize_register( $wp_customize ) {

		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_nav_alt_styles_text', array(
			'description'   => __( 'These controls also modify the look & feel of the WooCommerce cart dropdown.', 'archetype' ),
			'section'       => 'archetype_nav_alt_styles',
			'type'          => 'text',
			'priority'      => 1,
		) ) );

		$wp_customize->add_panel( 'archetype_woocommerce', array(
			'title'        => __( 'WooCommerce', 'archetype' ),
			'priority'     => 75,
		) );

		/**
		 * Notices
		 */
		$wp_customize->add_section( 'archetype_notices' , array(
			'title'        => __( 'Notices', 'archetype' ),
			'description'  => __( 'Customize the look & feel of the shop notices.', 'archetype' ),
			'priority'     => 10,
			'panel'        => 'archetype_woocommerce',
		) );

		/**
		 * Notice Error Color
		 */
		$wp_customize->add_setting( 'archetype_notice_error_color', array(
			'default'            => apply_filters( 'archetype_default_notice_error_color', '#f75f46' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_notice_error_color', array(
			'label'        => __( 'Error color', 'archetype' ),
			'section'      => 'archetype_notices',
			'settings'     => 'archetype_notice_error_color',
			'priority'     => 10,
		) ) );

		/**
		 * Notice Success Color
		 */
		$wp_customize->add_setting( 'archetype_notice_success_color', array(
			'default'            => apply_filters( 'archetype_default_notice_success_color', '#36c478' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_notice_success_color', array(
			'label'        => __( 'Success color', 'archetype' ),
			'section'      => 'archetype_notices',
			'settings'     => 'archetype_notice_success_color',
			'priority'     => 15,
		) ) );

		/**
		 * Notice Info Color
		 */
		$wp_customize->add_setting( 'archetype_notice_info_color', array(
			'default'            => apply_filters( 'archetype_default_notice_info_color', '#3D9CD2' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_notice_info_color', array(
			'label'        => __( 'Info color', 'archetype' ),
			'section'      => 'archetype_notices',
			'settings'     => 'archetype_notice_info_color',
			'priority'     => 20,
		) ) );

		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_notice_info_text', array(
			'description'   => __( 'Notices are displayed throughout your shop in three different contexts to your users. You can view the coupon info notice on the Checkout page to see one of them in action.', 'archetype' ),
			'section'       => 'archetype_notices',
			'type'          => 'text',
			'priority'      => 25,
		) ) );

		/**
		 * Breadcrumbs
		 */
		$wp_customize->add_section( 'archetype_breadcrumb' , array(
			'title'        => __( 'Breadcrumbs', 'archetype' ),
			'description'  => __( 'Customize the look & feel of the breadcrumbs.', 'archetype' ),
			'priority'     => 15,
			'panel'        => 'archetype_woocommerce',
		) );

		/**
		 * Toggle breadcrumbs
		 */
		$wp_customize->add_setting( 'archetype_breadcrumb_toggle', array(
			'default'            => true,
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_breadcrumb_toggle', array(
			'label'        => __( 'Display breadcrumbs', 'archetype' ),
			'description'  => __( 'Toggle the display of the breadcumbs.', 'archetype' ),
			'section'      => 'archetype_breadcrumb',
			'settings'     => 'archetype_breadcrumb_toggle',
			'type'         => 'checkbox',
		) );

		/**
		 * Products
		 */
		$wp_customize->add_section( 'archetype_products' , array(
			'title'        => __( 'Product Archives', 'archetype' ),
			'description'  => __( 'Customize the look & feel of your product archives.', 'archetype' ),
			'priority'     => 20,
			'panel'        => 'archetype_woocommerce',
		) );

		/**
		 * Products Per Page
		 */
		$wp_customize->add_setting( 'archetype_products_per_page', array(
			'default'            => apply_filters( 'archetype_default_products_per_page', '12' ),
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_products_per_page', array(
			'label'        => __( 'Products Per Page', 'archetype' ),
			'section'      => 'archetype_products',
			'settings'     => 'archetype_products_per_page',
			'type'         => 'select',
			'choices'      => array(
				'1'           => '1',
				'2'           => '2',
				'3'           => '3',
				'4'           => '4',
				'5'           => '5',
				'6'           => '6',
				'7'           => '7',
				'8'           => '8',
				'9'           => '9',
				'10'          => '10',
				'11'          => '11',
				'12'          => '12',
				'13'          => '13',
				'14'          => '14',
				'15'          => '15',
				'16'          => '16',
				'17'          => '17',
				'18'          => '18',
				'19'          => '19',
				'20'          => '20',
				'21'          => '21',
				'22'          => '22',
				'23'          => '23',
				'24'          => '24',
				'25'          => '25',
				'26'          => '26',
				'27'          => '27',
				'28'          => '28',
				'29'          => '29',
				'30'          => '30',
			),
		) );

		/**
		 * Products columns
		 */
		$wp_customize->add_setting( 'archetype_products_columns', array(
			'default'            => '3',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_products_columns', array(
			'label'        => __( 'Columns', 'archetype' ),
			'section'      => 'archetype_products',
			'settings'     => 'archetype_products_columns',
			'type'         => 'select',
			'choices'      => array(
				'1'           => '1',
				'2'           => '2',
				'3'           => '3',
				'4'           => '4',
				'5'           => '5',
			),
		) );

		/**
		 * Full width products
		 */
		$wp_customize->add_setting( 'archetype_products_full_width', array(
			'default'            => apply_filters( 'archetype_default_products_full_width', false ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_products_full_width', array(
			'label'        => __( 'Full width', 'archetype' ),
			'description'  => __( 'Expand product archives the entire page width. This will remove the sidebar.', 'archetype' ),
			'section'      => 'archetype_products',
			'settings'     => 'archetype_products_full_width',
			'type'         => 'checkbox',
		) );

		/**
		 * Products image
		 */
		$wp_customize->add_setting( 'archetype_products_image_toggle', array(
			'default'            => apply_filters( 'archetype_default_products_image_toggle', true ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_products_image_toggle', array(
			'label'        => __( 'Display image', 'archetype' ),
			'description'  => __( 'Toggle the display of the product image.', 'archetype' ),
			'section'      => 'archetype_products',
			'settings'     => 'archetype_products_image_toggle',
			'type'         => 'checkbox',
		) );

		/**
		 * Products title
		 */
		$wp_customize->add_setting( 'archetype_products_title_toggle', array(
			'default'            => apply_filters( 'archetype_default_products_title_toggle', true ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_products_title_toggle', array(
			'label'        => __( 'Display title', 'archetype' ),
			'description'  => __( 'Toggle the display of the product title.', 'archetype' ),
			'section'      => 'archetype_products',
			'settings'     => 'archetype_products_title_toggle',
			'type'         => 'checkbox',
		) );

		/**
		 * Products sale
		 */
		$wp_customize->add_setting( 'archetype_products_sale_toggle', array(
			'default'            => apply_filters( 'archetype_default_products_sale_toggle', true ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_products_sale_toggle', array(
			'label'        => __( 'Display sale banner', 'archetype' ),
			'description'  => __( 'Toggle the display of the product sale banner.', 'archetype' ),
			'section'      => 'archetype_products',
			'settings'     => 'archetype_products_sale_toggle',
			'type'         => 'checkbox',
		) );

		/**
		 * Products rating
		 */
		$wp_customize->add_setting( 'archetype_products_rating_toggle', array(
			'default'            => apply_filters( 'archetype_default_products_rating_toggle', true ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_products_rating_toggle', array(
			'label'        => __( 'Display rating', 'archetype' ),
			'description'  => __( 'Toggle the display of the product rating.', 'archetype' ),
			'section'      => 'archetype_products',
			'settings'     => 'archetype_products_rating_toggle',
			'type'         => 'checkbox',
		) );

		/**
		 * Products price
		 */
		$wp_customize->add_setting( 'archetype_products_price_toggle', array(
			'default'            => apply_filters( 'archetype_default_products_price_toggle', true ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_products_price_toggle', array(
			'label'        => __( 'Display price', 'archetype' ),
			'description'  => __( 'Toggle the display of the product price.', 'archetype' ),
			'section'      => 'archetype_products',
			'settings'     => 'archetype_products_price_toggle',
			'type'         => 'checkbox',
		) );

		/**
		 * Products button
		 */
		$wp_customize->add_setting( 'archetype_products_add_to_cart_toggle', array(
			'default'            => apply_filters( 'archetype_default_products_add_to_cart_toggle', true ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_products_add_to_cart_toggle', array(
			'label'        => __( 'Display add to cart button', 'archetype' ),
			'description'  => __( 'Toggle the display of the product add to cart button.', 'archetype' ),
			'section'      => 'archetype_products',
			'settings'     => 'archetype_products_add_to_cart_toggle',
			'type'         => 'checkbox',
		) );

		/**
		 * Alignment
		 */
		$wp_customize->add_setting( 'archetype_products_alignment', array(
			'default'            => 'center',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_products_alignment', array(
			'label'        => __( 'Text alignment', 'archetype' ),
			'section'      => 'archetype_products',
			'settings'     => 'archetype_products_alignment',
			'type'         => 'radio',
			'choices'      => array(
				'left'        => 'Left',
				'center'      => 'Center',
				'right'       => 'Right',
			),
		) );

		/**
		 * Product
		 */
		$wp_customize->add_section( 'archetype_product' , array(
			'title'        => __( 'Single Product', 'archetype' ),
			'description'  => __( 'Customize the look & feel of a single product.', 'archetype' ),
			'priority'     => 45,
			'panel'        => 'archetype_woocommerce',
		) );

		/**
		 * Full width product page
		 */
		$wp_customize->add_setting( 'archetype_product_full_width', array(
			'default'            => apply_filters( 'archetype_default_product_full_width', false ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_product_full_width', array(
			'label'        => __( 'Full width product', 'archetype' ),
			'description'  => __( 'Expand products the entire page width. This will remove the sidebar.', 'archetype' ),
			'section'      => 'archetype_product',
			'settings'     => 'archetype_product_full_width',
			'type'         => 'checkbox',
		) );

		/**
		 * Full width product gallery
		 */
		$wp_customize->add_setting( 'archetype_product_gallery_full_width', array(
			'default'            => apply_filters( 'archetype_default_product_gallery_full_width', false ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_product_gallery_full_width', array(
			'label'        => __( 'Full width product gallery', 'archetype' ),
			'description'  => __( 'Expand product galleries the entire content width.', 'archetype' ),
			'section'      => 'archetype_product',
			'settings'     => 'archetype_product_gallery_full_width',
			'type'         => 'checkbox',
		) );

		/**
		 * Toggle product gallery
		 */
		$wp_customize->add_setting( 'archetype_product_gallery_toggle', array(
			'default'            => apply_filters( 'archetype_default_product_gallery_toggle', true ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_product_gallery_toggle', array(
			'label'        => __( 'Display product gallery', 'archetype' ),
			'description'  => __( 'Toggle the display of the product gallery.', 'archetype' ),
			'section'      => 'archetype_product',
			'settings'     => 'archetype_product_gallery_toggle',
			'type'         => 'checkbox',
		) );

		/**
		 * Toggle product meta
		 */
		$wp_customize->add_setting( 'archetype_product_meta_toggle', array(
			'default'            => apply_filters( 'archetype_default_product_meta_toggle', true ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_product_meta_toggle', array(
			'label'        => __( 'Display product meta', 'archetype' ),
			'description'  => __( 'Toggle the display of the product meta. category/sku etc.', 'archetype' ),
			'section'      => 'archetype_product',
			'settings'     => 'archetype_product_meta_toggle',
			'type'         => 'checkbox',
		) );

		/**
		 * Toggle product tabs
		 */
		$wp_customize->add_setting( 'archetype_product_tabs_toggle', array(
			'default'            => apply_filters( 'archetype_default_product_tabs_toggle', true ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_product_tabs_toggle', array(
			'label'        => __( 'Display product tabs', 'archetype' ),
			'description'  => __( 'Toggle the display of the product tabs.', 'archetype' ),
			'section'      => 'archetype_product',
			'settings'     => 'archetype_product_tabs_toggle',
			'type'         => 'checkbox',
		) );

		/**
		 * Toggle product tabs
		 */
		$wp_customize->add_setting( 'archetype_product_tabs_toggle', array(
			'default'            => apply_filters( 'archetype_default_product_tabs_toggle', true ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_product_tabs_toggle', array(
			'label'        => __( 'Display product tabs', 'archetype' ),
			'description'  => __( 'Toggle the display of the product tabs.', 'archetype' ),
			'section'      => 'archetype_product',
			'settings'     => 'archetype_product_tabs_toggle',
			'type'         => 'checkbox',
		) );

		/**
		 * Toggle upsell products
		 */
		$wp_customize->add_setting( 'archetype_upsell_display_toggle', array(
			'default'            => apply_filters( 'archetype_default_upsell_display_toggle', true ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_upsell_display_toggle', array(
			'label'        => __( 'Display upsell products', 'archetype' ),
			'description'  => __( 'Toggle the display of the upsell products.', 'archetype' ),
			'section'      => 'archetype_product',
			'settings'     => 'archetype_upsell_display_toggle',
			'type'         => 'checkbox',
		) );

		/**
		 * Upsell products limit
		 */
		$wp_customize->add_setting( 'archetype_upsell_display_limit', array(
			'default'            => '3',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_upsell_display_limit', array(
			'label'        => __( 'Upsell Limit', 'archetype' ),
			'section'      => 'archetype_product',
			'settings'     => 'archetype_upsell_display_limit',
			'type'         => 'select',
			'choices'      => array(
				'1'           => '1',
				'2'           => '2',
				'3'           => '3',
				'4'           => '4',
				'5'           => '5',
				'6'           => '6',
				'7'           => '7',
				'8'           => '8',
				'9'           => '9',
				'10'          => '10',
				'11'          => '11',
				'12'          => '12',
			),
		) );

		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_upsell_display_limit_text', array(
			'description'  => __( 'Choose the number of upsell products to display.', 'archetype' ),
			'section'      => 'archetype_product',
			'settings'     => 'archetype_upsell_display_limit',
			'type'         => 'text',
		) ) );

		/**
		 * Upsell products columns
		 */
		$wp_customize->add_setting( 'archetype_upsell_display_columns', array(
			'default'            => '3',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_upsell_display_columns', array(
			'label'        => __( 'Upsell Columns', 'archetype' ),
			'section'      => 'archetype_product',
			'settings'     => 'archetype_upsell_display_columns',
			'type'         => 'select',
			'choices'      => array(
				'1'           => '1',
				'2'           => '2',
				'3'           => '3',
				'4'           => '4',
				'5'           => '5',
			),
		) );

		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_upsell_display_columns_text', array(
			'description'  => __( 'Choose the number of columns to display.', 'archetype' ),
			'section'      => 'archetype_product',
			'settings'     => 'archetype_upsell_display_columns',
			'type'         => 'text',
		) ) );

		/**
		 * Toggle related products
		 */
		$wp_customize->add_setting( 'archetype_related_products_toggle', array(
			'default'            => apply_filters( 'archetype_default_related_products_toggle', true ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_related_products_toggle', array(
			'label'        => __( 'Display related products', 'archetype' ),
			'description'  => __( 'Toggle the display of the related products.', 'archetype' ),
			'section'      => 'archetype_product',
			'settings'     => 'archetype_related_products_toggle',
			'type'         => 'checkbox',
		) );

		/**
		 * Related products limit
		 */
		$wp_customize->add_setting( 'archetype_related_products_limit', array(
			'default'            => '3',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_related_products_limit', array(
			'label'        => __( 'Related Products Limit', 'archetype' ),
			'section'      => 'archetype_product',
			'settings'     => 'archetype_related_products_limit',
			'type'         => 'select',
			'choices'      => array(
				'1'           => '1',
				'2'           => '2',
				'3'           => '3',
				'4'           => '4',
				'5'           => '5',
				'6'           => '6',
				'7'           => '7',
				'8'           => '8',
				'9'           => '9',
				'10'          => '10',
				'11'          => '11',
				'12'          => '12',
			),
		) );

		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_related_products_limit_text', array(
			'description'  => __( 'Choose the number of related products to display.', 'archetype' ),
			'section'      => 'archetype_product',
			'settings'     => 'archetype_related_products_limit',
			'type'         => 'text',
		) ) );

		/**
		 * Related products columns
		 */
		$wp_customize->add_setting( 'archetype_related_products_columns', array(
			'default'            => '3',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_related_products_columns', array(
			'label'        => __( 'Related Products Columns', 'archetype' ),
			'section'      => 'archetype_product',
			'settings'     => 'archetype_related_products_columns',
			'type'         => 'select',
			'choices'      => array(
				'1'           => '1',
				'2'           => '2',
				'3'           => '3',
				'4'           => '4',
				'5'           => '5',
			),
		) );

		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_related_products_columns_text', array(
			'description'  => __( 'Choose the number of columns to display.', 'archetype' ),
			'section'      => 'archetype_product',
			'settings'     => 'archetype_related_products_columns',
			'type'         => 'text',
		) ) );

		/**
		 * Product Categories
		 */
		$wp_customize->add_section( 'archetype_product_categories' , array(
			'title'        => __( 'Product Categories', 'archetype' ),
			'description'  => __( 'Customize the look & feel of the product categories component.', 'archetype' ),
			'priority'     => 20,
			'panel'        => 'archetype_homepage',
		) );

		if ( ! is_homepage_control_activated() ) {
			/**
			 * Toggle product categories
			 */
			$wp_customize->add_setting( 'archetype_product_categories_toggle', array(
				'default'            => true,
				'sanitize_callback'  => 'archetype_sanitize_checkbox',
			) );

			$wp_customize->add_control( 'archetype_product_categories_toggle', array(
				'label'        => __( 'Display product categories', 'archetype' ),
				'description'  => __( 'Toggle the display of the product categories.', 'archetype' ),
				'section'      => 'archetype_product_categories',
				'settings'     => 'archetype_product_categories_toggle',
				'type'         => 'checkbox',
			) );
		}

		/**
		 * Product categories limit
		 */
		$wp_customize->add_setting( 'archetype_product_categories_limit', array(
			'default'            => '3',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_product_categories_limit', array(
			'label'        => __( 'Limit', 'archetype' ),
			'section'      => 'archetype_product_categories',
			'settings'     => 'archetype_product_categories_limit',
			'type'         => 'select',
			'choices'      => array(
				'1'           => '1',
				'2'           => '2',
				'3'           => '3',
				'4'           => '4',
				'5'           => '5',
				'6'           => '6',
				'7'           => '7',
				'8'           => '8',
				'9'           => '9',
				'10'          => '10',
				'11'          => '11',
				'12'          => '12',
			),
		) );

		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_product_categories_limit_text', array(
			'section'      => 'archetype_product_categories',
			'description'  => __( 'Choose the number of product categories to display.', 'archetype' ),
			'settings'     => 'archetype_product_categories_limit',
			'type'         => 'text',
		) ) );

		/**
		 * Product categories columns
		 */
		$wp_customize->add_setting( 'archetype_product_categories_columns', array(
			'default'            => '3',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_product_categories_columns', array(
			'label'        => __( 'Columns', 'archetype' ),
			'section'      => 'archetype_product_categories',
			'settings'     => 'archetype_product_categories_columns',
			'type'         => 'select',
			'choices'      => array(
				'1'           => '1',
				'2'           => '2',
				'3'           => '3',
				'4'           => '4',
				'5'           => '5',
			),
		) );

		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_product_categories_columns_text', array(
			'section'      => 'archetype_product_categories',
			'description'  => __( 'Choose the number of columns to display.', 'archetype' ),
			'settings'     => 'archetype_product_categories_columns',
			'type'         => 'text',
		) ) );

		/**
		 * Heading Text
		 */
		$wp_customize->add_setting( 'archetype_product_categories_heading_text', array(
			'default'            => __( 'Product Categories', 'archetype' ),
			'sanitize_callback'  => 'sanitize_text_field',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_product_categories_heading_text', array(
			'label'        => __( 'Heading text', 'archetype' ),
			'section'      => 'archetype_product_categories',
			'settings'     => 'archetype_product_categories_heading_text',
			'type'         => 'text',
		) ) );

		/**
		 * Heading alignment
		 */
		$wp_customize->add_setting( 'archetype_product_categories_heading_alignment', array(
			'default'            => 'center',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_product_categories_heading_alignment', array(
			'label'        => __( 'Heading alignment', 'archetype' ),
			'section'      => 'archetype_product_categories',
			'settings'     => 'archetype_product_categories_heading_alignment',
			'type'         => 'radio',
			'choices'      => array(
				'left'        => 'Left',
				'center'      => 'Center',
				'right'       => 'Right',
			),
		) );

		/**
		 * Product categories heading color
		 */
		$wp_customize->add_setting( 'archetype_product_categories_heading_color', array(
			'default'            => apply_filters( 'archetype_default_product_categories_heading_color', '#333' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_product_categories_heading_color', array(
			'label'        => __( 'Heading color', 'archetype' ),
			'section'      => 'archetype_product_categories',
			'settings'     => 'archetype_product_categories_heading_color',
		) ) );

		/**
		 * Product categories background color
		 */
		$wp_customize->add_setting( 'archetype_product_categories_background_color', array(
			'default'            => apply_filters( 'archetype_default_product_categories_background_color', '#e5e5e5' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_product_categories_background_color', array(
			'label'        => __( 'Background color', 'archetype' ),
			'section'      => 'archetype_product_categories',
			'settings'     => 'archetype_product_categories_background_color',
		) ) );

		/**
		 * Recent Products
		 */
		$wp_customize->add_section( 'archetype_recent_products' , array(
			'title'        => __( 'Recent Products', 'archetype' ),
			'description'  => __( 'Customize the look & feel of the recent products component.', 'archetype' ),
			'priority'     => 25,
			'panel'        => 'archetype_homepage',
		) );

		if ( ! is_homepage_control_activated() ) {
			/**
			 * Toggle recent products
			 */
			$wp_customize->add_setting( 'archetype_recent_products_toggle', array(
				'default'            => true,
				'sanitize_callback'  => 'archetype_sanitize_checkbox',
			) );

			$wp_customize->add_control( 'archetype_recent_products_toggle', array(
				'label'        => __( 'Display recent products', 'archetype' ),
				'description'  => __( 'Toggle the display of the recent products.', 'archetype' ),
				'section'      => 'archetype_recent_products',
				'settings'     => 'archetype_recent_products_toggle',
				'type'         => 'checkbox',
			) );
		}

		/**
		 * Recent products limit
		 */
		$wp_customize->add_setting( 'archetype_recent_products_limit', array(
			'default'            => '4',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_recent_products_limit', array(
			'label'        => __( 'Limit', 'archetype' ),
			'section'      => 'archetype_recent_products',
			'settings'     => 'archetype_recent_products_limit',
			'type'         => 'select',
			'choices'      => array(
				'1'           => '1',
				'2'           => '2',
				'3'           => '3',
				'4'           => '4',
				'5'           => '5',
				'6'           => '6',
				'7'           => '7',
				'8'           => '8',
				'9'           => '9',
				'10'          => '10',
				'11'          => '11',
				'12'          => '12',
			),
		) );

		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_recent_products_limit_text', array(
			'section'      => 'archetype_recent_products',
			'description'  => __( 'Choose the number of recent products to display.', 'archetype' ),
			'settings'     => 'archetype_recent_products_limit',
			'type'         => 'text',
		) ) );

		/**
		 * Recent products columns
		 */
		$wp_customize->add_setting( 'archetype_recent_products_columns', array(
			'default'            => '4',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_recent_products_columns', array(
			'label'        => __( 'Columns', 'archetype' ),
			'section'      => 'archetype_recent_products',
			'settings'     => 'archetype_recent_products_columns',
			'type'         => 'select',
			'choices'      => array(
				'1'           => '1',
				'2'           => '2',
				'3'           => '3',
				'4'           => '4',
				'5'           => '5',
			),
		) );

		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_recent_products_columns_text', array(
			'section'      => 'archetype_recent_products',
			'description'  => __( 'Choose the number of columns to display.', 'archetype' ),
			'settings'     => 'archetype_recent_products_columns',
			'type'         => 'text',
		) ) );

		/**
		 * Heading Text
		 */
		$wp_customize->add_setting( 'archetype_recent_products_heading_text', array(
			'default'            => __( 'Recent Products', 'archetype' ),
			'sanitize_callback'  => 'sanitize_text_field',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_recent_products_heading_text', array(
			'label'        => __( 'Heading text', 'archetype' ),
			'section'      => 'archetype_recent_products',
			'settings'     => 'archetype_recent_products_heading_text',
			'type'         => 'text',
		) ) );

		/**
		 * Heading alignment
		 */
		$wp_customize->add_setting( 'archetype_recent_products_heading_alignment', array(
			'default'            => 'center',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_recent_products_heading_alignment', array(
			'label'        => __( 'Heading alignment', 'archetype' ),
			'section'      => 'archetype_recent_products',
			'settings'     => 'archetype_recent_products_heading_alignment',
			'type'         => 'radio',
			'choices'      => array(
				'left'        => 'Left',
				'center'      => 'Center',
				'right'       => 'Right',
			),
		) );

		/**
		 * Recent products heading color
		 */
		$wp_customize->add_setting( 'archetype_recent_products_heading_color', array(
			'default'            => apply_filters( 'archetype_default_recent_products_heading_color', '#333' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_recent_products_heading_color', array(
			'label'        => __( 'Heading color', 'archetype' ),
			'section'      => 'archetype_recent_products',
			'settings'     => 'archetype_recent_products_heading_color',
		) ) );

		/**
		 * Recent products background color
		 */
		$wp_customize->add_setting( 'archetype_recent_products_background_color', array(
			'default'            => apply_filters( 'archetype_default_recent_products_background_color', '#f1f1f1' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_recent_products_background_color', array(
			'label'        => __( 'Background color', 'archetype' ),
			'section'      => 'archetype_recent_products',
			'settings'     => 'archetype_recent_products_background_color',
		) ) );

		// Featured products.
		$products = do_shortcode( '[featured_products per_page="1" columns="1"]' );
		$empty = '<div class="woocommerce columns-1"></div>';

		// Has featured products.
		if ( ! empty( $products ) && $empty !== $products ) {

			/**
			 * Featured Products
			 */
			$wp_customize->add_section( 'archetype_featured_products' , array(
				'title'        => __( 'Featured Products', 'archetype' ),
				'description'  => __( 'Customize the look & feel of the featured products component.', 'archetype' ),
				'priority'     => 30,
				'panel'        => 'archetype_homepage',
			) );

			if ( ! is_homepage_control_activated() ) {
				/**
				 * Toggle featured products
				 */
				$wp_customize->add_setting( 'archetype_featured_products_toggle', array(
					'default'            => true,
					'sanitize_callback'  => 'archetype_sanitize_checkbox',
				) );

				$wp_customize->add_control( 'archetype_featured_products_toggle', array(
					'label'        => __( 'Display featured products', 'archetype' ),
					'description'  => __( 'Toggle the display of the featured products.', 'archetype' ),
					'section'      => 'archetype_featured_products',
					'settings'     => 'archetype_featured_products_toggle',
					'type'         => 'checkbox',
				) );
			}

			/**
			 * Featured products limit
			 */
			$wp_customize->add_setting( 'archetype_featured_products_limit', array(
				'default'            => '4',
				'sanitize_callback'  => 'archetype_sanitize_choices',
			) );

			$wp_customize->add_control( 'archetype_featured_products_limit', array(
				'label'        => __( 'Limit', 'archetype' ),
				'section'      => 'archetype_featured_products',
				'settings'     => 'archetype_featured_products_limit',
				'type'         => 'select',
				'choices'      => array(
					'1'           => '1',
					'2'           => '2',
					'3'           => '3',
					'4'           => '4',
					'5'           => '5',
					'6'           => '6',
					'7'           => '7',
					'8'           => '8',
					'9'           => '9',
					'10'          => '10',
					'11'          => '11',
					'12'          => '12',
				),
			) );

			$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_featured_products_limit_text', array(
				'section'      => 'archetype_featured_products',
				'description'  => __( 'Choose the number of featured products to display.', 'archetype' ),
				'settings'     => 'archetype_featured_products_limit',
				'type'         => 'text',
			) ) );

			/**
			 * Featured products columns
			 */
			$wp_customize->add_setting( 'archetype_featured_products_columns', array(
				'default'            => '4',
				'sanitize_callback'  => 'archetype_sanitize_choices',
			) );

			$wp_customize->add_control( 'archetype_featured_products_columns', array(
				'label'        => __( 'Columns', 'archetype' ),
				'section'      => 'archetype_featured_products',
				'settings'     => 'archetype_featured_products_columns',
				'type'         => 'select',
				'choices'      => array(
					'1'           => '1',
					'2'           => '2',
					'3'           => '3',
					'4'           => '4',
					'5'           => '5',
				),
			) );

			$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_featured_products_columns_text', array(
				'section'      => 'archetype_featured_products',
				'description'  => __( 'Choose the number of columns to display.', 'archetype' ),
				'settings'     => 'archetype_featured_products_columns',
				'type'         => 'text',
			) ) );

			/**
			 * Heading Text
			 */
			$wp_customize->add_setting( 'archetype_featured_products_heading_text', array(
				'default'            => __( 'Featured Products', 'archetype' ),
				'sanitize_callback'  => 'sanitize_text_field',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_featured_products_heading_text', array(
				'label'        => __( 'Heading text', 'archetype' ),
				'section'      => 'archetype_featured_products',
				'settings'     => 'archetype_featured_products_heading_text',
				'type'         => 'text',
			) ) );

			/**
			 * Heading alignment
			 */
			$wp_customize->add_setting( 'archetype_featured_products_heading_alignment', array(
				'default'            => 'center',
				'sanitize_callback'  => 'archetype_sanitize_choices',
			) );

			$wp_customize->add_control( 'archetype_featured_products_heading_alignment', array(
				'label'        => __( 'Heading alignment', 'archetype' ),
				'section'      => 'archetype_featured_products',
				'settings'     => 'archetype_featured_products_heading_alignment',
				'type'         => 'radio',
				'choices'      => array(
					'left'        => 'Left',
					'center'      => 'Center',
					'right'       => 'Right',
				),
			) );

			/**
			 * Featured products heading color
			 */
			$wp_customize->add_setting( 'archetype_featured_products_heading_color', array(
				'default'            => apply_filters( 'archetype_default_featured_products_heading_color', '#333' ),
				'sanitize_callback'  => 'archetype_sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_featured_products_heading_color', array(
				'label'        => __( 'Heading color', 'archetype' ),
				'section'      => 'archetype_featured_products',
				'settings'     => 'archetype_featured_products_heading_color',
			) ) );

			/**
			 * Featured products background color
			 */
			$wp_customize->add_setting( 'archetype_featured_products_background_color', array(
				'default'            => apply_filters( 'archetype_default_featured_products_background_color', '#e5e5e5' ),
				'sanitize_callback'  => 'archetype_sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_featured_products_background_color', array(
				'label'        => __( 'Background color', 'archetype' ),
				'section'      => 'archetype_featured_products',
				'settings'     => 'archetype_featured_products_background_color',
			) ) );

		}

		/**
		 * Top rated Products
		 */
		$wp_customize->add_section( 'archetype_top_rated_products' , array(
			'title'        => __( 'Top Rated Products', 'archetype' ),
			'description'  => __( 'Customize the look & feel of the top rated products component.', 'archetype' ),
			'priority'     => 35,
			'panel'        => 'archetype_homepage',
		) );

		if ( ! is_homepage_control_activated() ) {
			/**
			 * Toggle top rated products
			 */
			$wp_customize->add_setting( 'archetype_top_rated_products_toggle', array(
				'default'            => true,
				'sanitize_callback'  => 'archetype_sanitize_checkbox',
			) );

			$wp_customize->add_control( 'archetype_top_rated_products_toggle', array(
				'label'        => __( 'Display top rated products', 'archetype' ),
				'description'  => __( 'Toggle the display of the top rated products.', 'archetype' ),
				'section'      => 'archetype_top_rated_products',
				'settings'     => 'archetype_top_rated_products_toggle',
				'type'         => 'checkbox',
			) );
		}

		/**
		 * Top rated products limit
		 */
		$wp_customize->add_setting( 'archetype_top_rated_products_limit', array(
			'default'            => '4',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_top_rated_products_limit', array(
			'label'        => __( 'Limit', 'archetype' ),
			'section'      => 'archetype_top_rated_products',
			'settings'     => 'archetype_top_rated_products_limit',
			'type'         => 'select',
			'choices'      => array(
				'1'           => '1',
				'2'           => '2',
				'3'           => '3',
				'4'           => '4',
				'5'           => '5',
				'6'           => '6',
				'7'           => '7',
				'8'           => '8',
				'9'           => '9',
				'10'          => '10',
				'11'          => '11',
				'12'          => '12',
			),
		) );

		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_top_rated_products_limit_text', array(
			'section'      => 'archetype_top_rated_products',
			'description'  => __( 'Choose the number of top rated products to display.', 'archetype' ),
			'settings'     => 'archetype_top_rated_products_limit',
			'type'         => 'text',
		) ) );

		/**
		 * Top rated products columns
		 */
		$wp_customize->add_setting( 'archetype_top_rated_products_columns', array(
			'default'            => '4',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_top_rated_products_columns', array(
			'label'        => __( 'Columns', 'archetype' ),
			'section'      => 'archetype_top_rated_products',
			'settings'     => 'archetype_top_rated_products_columns',
			'type'         => 'select',
			'choices'      => array(
				'1'           => '1',
				'2'           => '2',
				'3'           => '3',
				'4'           => '4',
				'5'           => '5',
			),
		) );

		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_top_rated_products_columns_text', array(
			'section'      => 'archetype_top_rated_products',
			'description'  => __( 'Choose the number of columns to display.', 'archetype' ),
			'settings'     => 'archetype_top_rated_products_columns',
			'type'         => 'text',
		) ) );

		/**
		 * Heading Text
		 */
		$wp_customize->add_setting( 'archetype_top_rated_products_heading_text', array(
			'default'            => __( 'Top Rated Products', 'archetype' ),
			'sanitize_callback'  => 'sanitize_text_field',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_top_rated_products_heading_text', array(
			'label'        => __( 'Heading text', 'archetype' ),
			'section'      => 'archetype_top_rated_products',
			'settings'     => 'archetype_top_rated_products_heading_text',
			'type'         => 'text',
		) ) );

		/**
		 * Heading alignment
		 */
		$wp_customize->add_setting( 'archetype_top_rated_products_heading_alignment', array(
			'default'            => 'center',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_top_rated_products_heading_alignment', array(
			'label'        => __( 'Heading alignment', 'archetype' ),
			'section'      => 'archetype_top_rated_products',
			'settings'     => 'archetype_top_rated_products_heading_alignment',
			'type'         => 'radio',
			'choices'      => array(
				'left'        => 'Left',
				'center'      => 'Center',
				'right'       => 'Right',
			),
		) );

		/**
		 * Top rated products heading color
		 */
		$wp_customize->add_setting( 'archetype_top_rated_products_heading_color', array(
			'default'            => apply_filters( 'archetype_default_top_rated_products_heading_color', '#333' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_top_rated_products_heading_color', array(
			'label'        => __( 'Heading color', 'archetype' ),
			'section'      => 'archetype_top_rated_products',
			'settings'     => 'archetype_top_rated_products_heading_color',
		) ) );

		/**
		 * Top rated products background color
		 */
		$wp_customize->add_setting( 'archetype_top_rated_products_background_color', array(
			'default'            => apply_filters( 'archetype_default_top_rated_products_background_color', '#f1f1f1' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_top_rated_products_background_color', array(
			'label'        => __( 'Background color', 'archetype' ),
			'section'      => 'archetype_top_rated_products',
			'settings'     => 'archetype_top_rated_products_background_color',
		) ) );

		/**
		 * On Sale Products
		 */
		$wp_customize->add_section( 'archetype_on_sale_products' , array(
			'title'        => __( 'On Sale Products', 'archetype' ),
			'description'  => __( 'Customize the look & feel of the on sale products component.', 'archetype' ),
			'priority'     => 40,
			'panel'        => 'archetype_homepage',
		) );

		if ( ! is_homepage_control_activated() ) {
			/**
			 * Toggle on sale products
			 */
			$wp_customize->add_setting( 'archetype_on_sale_products_toggle', array(
				'default'            => true,
				'sanitize_callback'  => 'archetype_sanitize_checkbox',
			) );

			$wp_customize->add_control( 'archetype_on_sale_products_toggle', array(
				'label'        => __( 'Display on sale products', 'archetype' ),
				'description'  => __( 'Toggle the display of the on sale products.', 'archetype' ),
				'section'      => 'archetype_on_sale_products',
				'settings'     => 'archetype_on_sale_products_toggle',
				'type'         => 'checkbox',
			) );
		}

		/**
		 * On Sale products limit
		 */
		$wp_customize->add_setting( 'archetype_on_sale_products_limit', array(
			'default'            => '4',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_on_sale_products_limit', array(
			'label'        => __( 'Limit', 'archetype' ),
			'section'      => 'archetype_on_sale_products',
			'settings'     => 'archetype_on_sale_products_limit',
			'type'         => 'select',
			'choices'      => array(
				'1'           => '1',
				'2'           => '2',
				'3'           => '3',
				'4'           => '4',
				'5'           => '5',
				'6'           => '6',
				'7'           => '7',
				'8'           => '8',
				'9'           => '9',
				'10'          => '10',
				'11'          => '11',
				'12'          => '12',
			),
		) );

		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_on_sale_products_limit_text', array(
			'section'      => 'archetype_on_sale_products',
			'description'  => __( 'Choose the number of on sale products to display.', 'archetype' ),
			'settings'     => 'archetype_on_sale_products_limit',
			'type'         => 'text',
		) ) );

		/**
		 * On Sale products columns
		 */
		$wp_customize->add_setting( 'archetype_on_sale_products_columns', array(
			'default'            => '4',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_on_sale_products_columns', array(
			'label'        => __( 'Columns', 'archetype' ),
			'section'      => 'archetype_on_sale_products',
			'settings'     => 'archetype_on_sale_products_columns',
			'type'         => 'select',
			'choices'      => array(
				'1'           => '1',
				'2'           => '2',
				'3'           => '3',
				'4'           => '4',
				'5'           => '5',
			),
		) );

		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_on_sale_products_columns_text', array(
			'section'      => 'archetype_on_sale_products',
			'description'  => __( 'Choose the number of columns to display.', 'archetype' ),
			'settings'     => 'archetype_on_sale_products_columns',
			'type'         => 'text',
		) ) );

		/**
		 * Heading Text
		 */
		$wp_customize->add_setting( 'archetype_on_sale_products_heading_text', array(
			'default'            => __( 'On Sale Products', 'archetype' ),
			'sanitize_callback'  => 'sanitize_text_field',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_on_sale_products_heading_text', array(
			'label'        => __( 'Heading text', 'archetype' ),
			'section'      => 'archetype_on_sale_products',
			'settings'     => 'archetype_on_sale_products_heading_text',
			'type'         => 'text',
		) ) );

		/**
		 * Heading alignment
		 */
		$wp_customize->add_setting( 'archetype_on_sale_products_heading_alignment', array(
			'default'            => 'center',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_on_sale_products_heading_alignment', array(
			'label'        => __( 'Heading alignment', 'archetype' ),
			'section'      => 'archetype_on_sale_products',
			'settings'     => 'archetype_on_sale_products_heading_alignment',
			'type'         => 'radio',
			'choices'      => array(
				'left'        => 'Left',
				'center'      => 'Center',
				'right'       => 'Right',
			),
		) );

		/**
		 * On Sale products heading color
		 */
		$wp_customize->add_setting( 'archetype_on_sale_products_heading_color', array(
			'default'            => apply_filters( 'archetype_default_on_sale_products_heading_color', '#333' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_on_sale_products_heading_color', array(
			'label'        => __( 'Heading color', 'archetype' ),
			'section'      => 'archetype_on_sale_products',
			'settings'     => 'archetype_on_sale_products_heading_color',
		) ) );

		/**
		 * On Sale products background color
		 */
		$wp_customize->add_setting( 'archetype_on_sale_products_background_color', array(
			'default'            => apply_filters( 'archetype_default_on_sale_products_background_color', '#e5e5e5' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_on_sale_products_background_color', array(
			'label'        => __( 'Background color', 'archetype' ),
			'section'      => 'archetype_on_sale_products',
			'settings'     => 'archetype_on_sale_products_background_color',
		) ) );

	}
endif;
