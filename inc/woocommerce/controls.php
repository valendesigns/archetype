<?php
/**
 * archetype Theme Customizer controls
 *
 * @package archetype
 */

/**
 * WooCommerce Theme Customizer settings.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_woocommerce_customize_register' ) ) {
  function archetype_woocommerce_customize_register( $wp_customize ) {

    $wp_customize->add_panel( 'archetype_woocommerce', array(
      'title'           => __( 'WooCommerce', 'archetype' ),
      'priority'        => 75,
    ) );

    /**
     * Notices
     */
    $wp_customize->add_section( 'archetype_notices' , array(
      'title'       => __( 'Notices', 'archetype' ),
      'description' => __( 'Customize the look & feel of the shop notices.', 'archetype' ),
      'priority'    => 10,
      'panel'       => 'archetype_woocommerce'
    ) );

    /**
     * Notice Error Color
     */
    $wp_customize->add_setting( 'archetype_notice_error_color', array(
      'default'           => apply_filters( 'archetype_default_notice_error_color', '#f75f46' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_notice_error_color', array(
      'label'       => __( 'Error color', 'archetype' ),
      'section'     => 'archetype_notices',
      'settings'    => 'archetype_notice_error_color',
      'priority'    => 10,
    ) ) );

    /**
     * Notice Success Color
     */
    $wp_customize->add_setting( 'archetype_notice_success_color', array(
      'default'           => apply_filters( 'archetype_default_notice_success_color', '#36c478' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_notice_success_color', array(
      'label'       => __( 'Success color', 'archetype' ),
      'section'     => 'archetype_notices',
      'settings'    => 'archetype_notice_success_color',
      'priority'    => 15,
    ) ) );

    /**
     * Notice Info Color
     */
    $wp_customize->add_setting( 'archetype_notice_info_color', array(
      'default'           => apply_filters( 'archetype_default_notice_info_color', '#3D9CD2' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_notice_info_color', array(
      'label'       => __( 'Info color', 'archetype' ),
      'section'     => 'archetype_notices',
      'settings'    => 'archetype_notice_info_color',
      'priority'    => 20,
    ) ) );
    
    /**
     * Breadcrumbs
     */
    $wp_customize->add_section( 'archetype_breadcrumb' , array(
      'title'       => __( 'Breadcrumbs', 'archetype' ),
      'description' => __( 'Customize the look & feel of the breadcrumbs.', 'archetype' ),
      'priority'    => 15,
      'panel'       => 'archetype_woocommerce'
    ) );
  
    /**
     * Toggle breadcrumbs
     */
    $wp_customize->add_setting( 'archetype_breadcrumb_toggle', array(
      'default'           => true,
      'sanitize_callback' => 'archetype_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'archetype_breadcrumb_toggle', array(
      'label'       => __( 'Display breadcrumbs', 'archetype' ),
      'description' => __( 'Toggle the display of the breadcumbs.', 'archetype' ),
      'section'     => 'archetype_breadcrumb',
      'settings'    => 'archetype_breadcrumb_toggle',
      'type'        => 'checkbox',
    ) );

    /**
     * Product Categories
     */
    $wp_customize->add_section( 'archetype_product_categories' , array(
      'title'       => __( 'Product Categories', 'archetype' ),
      'priority'    => 20,
      'panel'       => 'archetype_homepage'
    ) );

    /**
     * Toggle product categories
     */
    $wp_customize->add_setting( 'archetype_product_categories_toggle', array(
      'default'           => true,
      'sanitize_callback' => 'archetype_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'archetype_product_categories_toggle', array(
      'label'       => __( 'Display product categories', 'archetype' ),
      'description' => __( 'Toggle the display of the product categories.', 'archetype' ),
      'section'     => 'archetype_product_categories',
      'settings'    => 'archetype_product_categories_toggle',
      'type'        => 'checkbox',
    ) );

    /**
     * Product categories limit
     */
    $wp_customize->add_setting( 'archetype_product_categories_limit', array(
      'default'           => '3',
      'sanitize_callback' => 'archetype_sanitize_choices',
    ) );

    $wp_customize->add_control( 'archetype_product_categories_limit', array(
      'label'       => __( 'Limit', 'archetype' ),
      'section'     => 'archetype_product_categories',
      'settings'    => 'archetype_product_categories_limit',
      'type'        => 'select',
      'choices'     => array(
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
      'section'     => 'archetype_product_categories',
      'description' => __( 'Choose the number of product categories to display.', 'archetype' ),
      'settings'    => 'archetype_product_categories_limit',
      'type'        => 'text',
    ) ) );

    /**
     * Product categories columns
     */
    $wp_customize->add_setting( 'archetype_product_categories_columns', array(
      'default'           => '3',
      'sanitize_callback' => 'archetype_sanitize_choices',
    ) );

    $wp_customize->add_control( 'archetype_product_categories_columns', array(
      'label'       => __( 'Columns', 'archetype' ),
      'section'     => 'archetype_product_categories',
      'settings'    => 'archetype_product_categories_columns',
      'type'        => 'select',
      'choices'     => array(
        '1'           => '1',
        '2'           => '2',
        '3'           => '3',
        '4'           => '4',
        '5'           => '5',
      ),
    ) );

    $wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_product_categories_columns_text', array(
      'section'     => 'archetype_product_categories',
      'description' => __( 'Choose the number of columns to display.', 'archetype' ),
      'settings'    => 'archetype_product_categories_columns',
      'type'        => 'text',
    ) ) );

    /**
     * Heading Text
     */
    $wp_customize->add_setting( 'archetype_product_categories_heading_text', array(
      'default'           => __( 'Product Categories', 'archetype' ),
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_product_categories_heading_text', array(
      'label'       => __( 'Heading text', 'archetype' ),
      'section'     => 'archetype_product_categories',
      'settings'    => 'archetype_product_categories_heading_text',
      'type'        => 'text',
    ) ) );

    /**
     * Heading alignment
     */
    $wp_customize->add_setting( 'archetype_product_categories_heading_alignment', array(
      'default'           => 'center',
      'sanitize_callback' => 'archetype_sanitize_choices',
    ) );

    $wp_customize->add_control( 'archetype_product_categories_heading_alignment', array(
      'label'       => __( 'Heading alignment', 'archetype' ),
      'section'     => 'archetype_product_categories',
      'settings'    => 'archetype_product_categories_heading_alignment',
      'type'        => 'radio',
      'choices'     => array(
        'left'        => 'Left',
        'center'      => 'Center',
        'right'       => 'Right',
      ),
    ) );

    /**
     * Product categories heading color
     */
    $wp_customize->add_setting( 'archetype_product_categories_heading_color', array(
      'default'           => apply_filters( 'archetype_default_product_categories_heading_color', '#333' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_product_categories_heading_color', array(
      'label'       => __( 'Heading color', 'archetype' ),
      'section'     => 'archetype_product_categories',
      'settings'    => 'archetype_product_categories_heading_color',
    ) ) );

    /**
     * Product categories background color
     */
    $wp_customize->add_setting( 'archetype_product_categories_background_color', array(
      'default'           => apply_filters( 'archetype_default_product_categories_background_color', '#e5e5e5' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_product_categories_background_color', array(
      'label'       => __( 'Background color', 'archetype' ),
      'section'     => 'archetype_product_categories',
      'settings'    => 'archetype_product_categories_background_color',
    ) ) );

    /**
     * Recent Products
     */
    $wp_customize->add_section( 'archetype_recent_products' , array(
      'title'       => __( 'Recent Products', 'archetype' ),
      'priority'    => 25,
      'panel'       => 'archetype_homepage'
    ) );

    /**
     * Toggle recent products
     */
    $wp_customize->add_setting( 'archetype_recent_products_toggle', array(
      'default'           => true,
      'sanitize_callback' => 'archetype_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'archetype_recent_products_toggle', array(
      'label'       => __( 'Display recent products', 'archetype' ),
      'description' => __( 'Toggle the display of the recent products.', 'archetype' ),
      'section'     => 'archetype_recent_products',
      'settings'    => 'archetype_recent_products_toggle',
      'type'        => 'checkbox',
    ) );

    /**
     * Recent products limit
     */
    $wp_customize->add_setting( 'archetype_recent_products_limit', array(
      'default'           => '4',
      'sanitize_callback' => 'archetype_sanitize_choices',
    ) );

    $wp_customize->add_control( 'archetype_recent_products_limit', array(
      'label'       => __( 'Limit', 'archetype' ),
      'section'     => 'archetype_recent_products',
      'settings'    => 'archetype_recent_products_limit',
      'type'        => 'select',
      'choices'     => array(
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
      'section'     => 'archetype_recent_products',
      'description' => __( 'Choose the number of recent products to display.', 'archetype' ),
      'settings'    => 'archetype_recent_products_limit',
      'type'        => 'text',
    ) ) );

    /**
     * Recent products columns
     */
    $wp_customize->add_setting( 'archetype_recent_products_columns', array(
      'default'           => '4',
      'sanitize_callback' => 'archetype_sanitize_choices',
    ) );

    $wp_customize->add_control( 'archetype_recent_products_columns', array(
      'label'       => __( 'Columns', 'archetype' ),
      'section'     => 'archetype_recent_products',
      'settings'    => 'archetype_recent_products_columns',
      'type'        => 'select',
      'choices'     => array(
        '1'           => '1',
        '2'           => '2',
        '3'           => '3',
        '4'           => '4',
        '5'           => '5',
      ),
    ) );

    $wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_recent_products_columns_text', array(
      'section'     => 'archetype_recent_products',
      'description' => __( 'Choose the number of columns to display.', 'archetype' ),
      'settings'    => 'archetype_recent_products_columns',
      'type'        => 'text',
    ) ) );

    /**
     * Heading Text
     */
    $wp_customize->add_setting( 'archetype_recent_products_heading_text', array(
      'default'           => __( 'Recent Products', 'archetype' ),
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_recent_products_heading_text', array(
      'label'       => __( 'Heading text', 'archetype' ),
      'section'     => 'archetype_recent_products',
      'settings'    => 'archetype_recent_products_heading_text',
      'type'        => 'text',
    ) ) );

    /**
     * Heading alignment
     */
    $wp_customize->add_setting( 'archetype_recent_products_heading_alignment', array(
      'default'           => 'center',
      'sanitize_callback' => 'archetype_sanitize_choices',
    ) );

    $wp_customize->add_control( 'archetype_recent_products_heading_alignment', array(
      'label'       => __( 'Heading alignment', 'archetype' ),
      'section'     => 'archetype_recent_products',
      'settings'    => 'archetype_recent_products_heading_alignment',
      'type'        => 'radio',
      'choices'     => array(
        'left'        => 'Left',
        'center'      => 'Center',
        'right'       => 'Right',
      ),
    ) );

    /**
     * Recent products heading color
     */
    $wp_customize->add_setting( 'archetype_recent_products_heading_color', array(
      'default'           => apply_filters( 'archetype_default_recent_products_heading_color', '#333' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_recent_products_heading_color', array(
      'label'       => __( 'Heading color', 'archetype' ),
      'section'     => 'archetype_recent_products',
      'settings'    => 'archetype_recent_products_heading_color',
    ) ) );

    /**
     * Recent products background color
     */
    $wp_customize->add_setting( 'archetype_recent_products_background_color', array(
      'default'           => apply_filters( 'archetype_default_recent_products_background_color', '#f1f1f1' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_recent_products_background_color', array(
      'label'       => __( 'Background color', 'archetype' ),
      'section'     => 'archetype_recent_products',
      'settings'    => 'archetype_recent_products_background_color',
    ) ) );

    // BEGIN featured products

    $products = do_shortcode( '[featured_products per_page="1" columns="1"]' );
    $empty = '<div class="woocommerce columns-1"></div>';

    // Has featured products
    if ( ! empty( $products ) && $empty !== $products ) {
      
    /**
     * Featured Products
     */
    $wp_customize->add_section( 'archetype_featured_products' , array(
      'title'       => __( 'Featured Products', 'archetype' ),
      'priority'    => 30,
      'panel'       => 'archetype_homepage'
    ) );

    /**
     * Toggle featured products
     */
    $wp_customize->add_setting( 'archetype_featured_products_toggle', array(
      'default'           => true,
      'sanitize_callback' => 'archetype_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'archetype_featured_products_toggle', array(
      'label'       => __( 'Display featured products', 'archetype' ),
      'description' => __( 'Toggle the display of the featured products.', 'archetype' ),
      'section'     => 'archetype_featured_products',
      'settings'    => 'archetype_featured_products_toggle',
      'type'        => 'checkbox',
    ) );

    /**
     * Featured products limit
     */
    $wp_customize->add_setting( 'archetype_featured_products_limit', array(
      'default'           => '4',
      'sanitize_callback' => 'archetype_sanitize_choices',
    ) );

    $wp_customize->add_control( 'archetype_featured_products_limit', array(
      'label'       => __( 'Limit', 'archetype' ),
      'section'     => 'archetype_featured_products',
      'settings'    => 'archetype_featured_products_limit',
      'type'        => 'select',
      'choices'     => array(
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
      'section'     => 'archetype_featured_products',
      'description' => __( 'Choose the number of featured products to display.', 'archetype' ),
      'settings'    => 'archetype_featured_products_limit',
      'type'        => 'text',
    ) ) );

    /**
     * Featured products columns
     */
    $wp_customize->add_setting( 'archetype_featured_products_columns', array(
      'default'           => '4',
      'sanitize_callback' => 'archetype_sanitize_choices',
    ) );

    $wp_customize->add_control( 'archetype_featured_products_columns', array(
      'label'       => __( 'Columns', 'archetype' ),
      'section'     => 'archetype_featured_products',
      'settings'    => 'archetype_featured_products_columns',
      'type'        => 'select',
      'choices'     => array(
        '1'           => '1',
        '2'           => '2',
        '3'           => '3',
        '4'           => '4',
        '5'           => '5',
      ),
    ) );

    $wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_featured_products_columns_text', array(
      'section'     => 'archetype_featured_products',
      'description' => __( 'Choose the number of columns to display.', 'archetype' ),
      'settings'    => 'archetype_featured_products_columns',
      'type'        => 'text',
    ) ) );

    /**
     * Heading Text
     */
    $wp_customize->add_setting( 'archetype_featured_products_heading_text', array(
      'default'           => __( 'Featured Products', 'archetype' ),
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_featured_products_heading_text', array(
      'label'       => __( 'Heading text', 'archetype' ),
      'section'     => 'archetype_featured_products',
      'settings'    => 'archetype_featured_products_heading_text',
      'type'        => 'text',
    ) ) );

    /**
     * Heading alignment
     */
    $wp_customize->add_setting( 'archetype_featured_products_heading_alignment', array(
      'default'           => 'center',
      'sanitize_callback' => 'archetype_sanitize_choices',
    ) );

    $wp_customize->add_control( 'archetype_featured_products_heading_alignment', array(
      'label'       => __( 'Heading alignment', 'archetype' ),
      'section'     => 'archetype_featured_products',
      'settings'    => 'archetype_featured_products_heading_alignment',
      'type'        => 'radio',
      'choices'     => array(
        'left'        => 'Left',
        'center'      => 'Center',
        'right'       => 'Right',
      ),
    ) );

    /**
     * Featured products heading color
     */
    $wp_customize->add_setting( 'archetype_featured_products_heading_color', array(
      'default'           => apply_filters( 'archetype_default_featured_products_heading_color', '#333' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_featured_products_heading_color', array(
      'label'       => __( 'Heading color', 'archetype' ),
      'section'     => 'archetype_featured_products',
      'settings'    => 'archetype_featured_products_heading_color',
    ) ) );

    /**
     * Featured products background color
     */
    $wp_customize->add_setting( 'archetype_featured_products_background_color', array(
      'default'           => apply_filters( 'archetype_default_featured_products_background_color', '#e5e5e5' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_featured_products_background_color', array(
      'label'       => __( 'Background color', 'archetype' ),
      'section'     => 'archetype_featured_products',
      'settings'    => 'archetype_featured_products_background_color',
    ) ) );

    } // END Featured Products

    /**
     * Top rated Products
     */
    $wp_customize->add_section( 'archetype_top_rated_products' , array(
      'title'       => __( 'Top Rated Products', 'archetype' ),
      'priority'    => 35,
      'panel'       => 'archetype_homepage'
    ) );

    /**
     * Toggle top rated products
     */
    $wp_customize->add_setting( 'archetype_top_rated_products_toggle', array(
      'default'           => true,
      'sanitize_callback' => 'archetype_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'archetype_top_rated_products_toggle', array(
      'label'       => __( 'Display top rated products', 'archetype' ),
      'description' => __( 'Toggle the display of the top rated products.', 'archetype' ),
      'section'     => 'archetype_top_rated_products',
      'settings'    => 'archetype_top_rated_products_toggle',
      'type'        => 'checkbox',
    ) );

    /**
     * Top rated products limit
     */
    $wp_customize->add_setting( 'archetype_top_rated_products_limit', array(
      'default'           => '4',
      'sanitize_callback' => 'archetype_sanitize_choices',
    ) );

    $wp_customize->add_control( 'archetype_top_rated_products_limit', array(
      'label'       => __( 'Limit', 'archetype' ),
      'section'     => 'archetype_top_rated_products',
      'settings'    => 'archetype_top_rated_products_limit',
      'type'        => 'select',
      'choices'     => array(
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
      'section'     => 'archetype_top_rated_products',
      'description' => __( 'Choose the number of top rated products to display.', 'archetype' ),
      'settings'    => 'archetype_top_rated_products_limit',
      'type'        => 'text',
    ) ) );

    /**
     * Top rated products columns
     */
    $wp_customize->add_setting( 'archetype_top_rated_products_columns', array(
      'default'           => '4',
      'sanitize_callback' => 'archetype_sanitize_choices',
    ) );

    $wp_customize->add_control( 'archetype_top_rated_products_columns', array(
      'label'       => __( 'Columns', 'archetype' ),
      'section'     => 'archetype_top_rated_products',
      'settings'    => 'archetype_top_rated_products_columns',
      'type'        => 'select',
      'choices'     => array(
        '1'           => '1',
        '2'           => '2',
        '3'           => '3',
        '4'           => '4',
        '5'           => '5',
      ),
    ) );

    $wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_top_rated_products_columns_text', array(
      'section'     => 'archetype_top_rated_products',
      'description' => __( 'Choose the number of columns to display.', 'archetype' ),
      'settings'    => 'archetype_top_rated_products_columns',
      'type'        => 'text',
    ) ) );

    /**
     * Heading Text
     */
    $wp_customize->add_setting( 'archetype_top_rated_products_heading_text', array(
      'default'           => __( 'Top Rated Products', 'archetype' ),
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_top_rated_products_heading_text', array(
      'label'       => __( 'Heading text', 'archetype' ),
      'section'     => 'archetype_top_rated_products',
      'settings'    => 'archetype_top_rated_products_heading_text',
      'type'        => 'text',
    ) ) );

    /**
     * Heading alignment
     */
    $wp_customize->add_setting( 'archetype_top_rated_products_heading_alignment', array(
      'default'           => 'center',
      'sanitize_callback' => 'archetype_sanitize_choices',
    ) );

    $wp_customize->add_control( 'archetype_top_rated_products_heading_alignment', array(
      'label'       => __( 'Heading alignment', 'archetype' ),
      'section'     => 'archetype_top_rated_products',
      'settings'    => 'archetype_top_rated_products_heading_alignment',
      'type'        => 'radio',
      'choices'     => array(
        'left'        => 'Left',
        'center'      => 'Center',
        'right'       => 'Right',
      ),
    ) );

    /**
     * Top rated products heading color
     */
    $wp_customize->add_setting( 'archetype_top_rated_products_heading_color', array(
      'default'           => apply_filters( 'archetype_default_top_rated_products_heading_color', '#333' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_top_rated_products_heading_color', array(
      'label'       => __( 'Heading color', 'archetype' ),
      'section'     => 'archetype_top_rated_products',
      'settings'    => 'archetype_top_rated_products_heading_color',
    ) ) );

    /**
     * Top rated products background color
     */
    $wp_customize->add_setting( 'archetype_top_rated_products_background_color', array(
      'default'           => apply_filters( 'archetype_default_top_rated_products_background_color', '#f1f1f1' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_top_rated_products_background_color', array(
      'label'       => __( 'Background color', 'archetype' ),
      'section'     => 'archetype_top_rated_products',
      'settings'    => 'archetype_top_rated_products_background_color',
    ) ) );

    /**
     * On Sale Products
     */
    $wp_customize->add_section( 'archetype_on_sale_products' , array(
      'title'       => __( 'On Sale Products', 'archetype' ),
      'priority'    => 40,
      'panel'       => 'archetype_homepage'
    ) );

    /**
     * Toggle on sale products
     */
    $wp_customize->add_setting( 'archetype_on_sale_products_toggle', array(
      'default'           => true,
      'sanitize_callback' => 'archetype_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'archetype_on_sale_products_toggle', array(
      'label'       => __( 'Display on sale products', 'archetype' ),
      'description' => __( 'Toggle the display of the on sale products.', 'archetype' ),
      'section'     => 'archetype_on_sale_products',
      'settings'    => 'archetype_on_sale_products_toggle',
      'type'        => 'checkbox',
    ) );

    /**
     * On Sale products limit
     */
    $wp_customize->add_setting( 'archetype_on_sale_products_limit', array(
      'default'           => '4',
      'sanitize_callback' => 'archetype_sanitize_choices',
    ) );

    $wp_customize->add_control( 'archetype_on_sale_products_limit', array(
      'label'       => __( 'Limit', 'archetype' ),
      'section'     => 'archetype_on_sale_products',
      'settings'    => 'archetype_on_sale_products_limit',
      'type'        => 'select',
      'choices'     => array(
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
      'section'     => 'archetype_on_sale_products',
      'description' => __( 'Choose the number of on sale products to display.', 'archetype' ),
      'settings'    => 'archetype_on_sale_products_limit',
      'type'        => 'text',
    ) ) );

    /**
     * On Sale products columns
     */
    $wp_customize->add_setting( 'archetype_on_sale_products_columns', array(
      'default'           => '4',
      'sanitize_callback' => 'archetype_sanitize_choices',
    ) );

    $wp_customize->add_control( 'archetype_on_sale_products_columns', array(
      'label'       => __( 'Columns', 'archetype' ),
      'section'     => 'archetype_on_sale_products',
      'settings'    => 'archetype_on_sale_products_columns',
      'type'        => 'select',
      'choices'     => array(
        '1'           => '1',
        '2'           => '2',
        '3'           => '3',
        '4'           => '4',
        '5'           => '5',
      ),
    ) );

    $wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_on_sale_products_columns_text', array(
      'section'     => 'archetype_on_sale_products',
      'description' => __( 'Choose the number of columns to display.', 'archetype' ),
      'settings'    => 'archetype_on_sale_products_columns',
      'type'        => 'text',
    ) ) );

    /**
     * Heading Text
     */
    $wp_customize->add_setting( 'archetype_on_sale_products_heading_text', array(
      'default'           => __( 'On Sale Products', 'archetype' ),
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_on_sale_products_heading_text', array(
      'label'       => __( 'Heading text', 'archetype' ),
      'section'     => 'archetype_on_sale_products',
      'settings'    => 'archetype_on_sale_products_heading_text',
      'type'        => 'text',
    ) ) );

    /**
     * Heading alignment
     */
    $wp_customize->add_setting( 'archetype_on_sale_products_heading_alignment', array(
      'default'           => 'center',
      'sanitize_callback' => 'archetype_sanitize_choices',
    ) );

    $wp_customize->add_control( 'archetype_on_sale_products_heading_alignment', array(
      'label'       => __( 'Heading alignment', 'archetype' ),
      'section'     => 'archetype_on_sale_products',
      'settings'    => 'archetype_on_sale_products_heading_alignment',
      'type'        => 'radio',
      'choices'     => array(
        'left'        => 'Left',
        'center'      => 'Center',
        'right'       => 'Right',
      ),
    ) );

    /**
     * On Sale products heading color
     */
    $wp_customize->add_setting( 'archetype_on_sale_products_heading_color', array(
      'default'           => apply_filters( 'archetype_default_on_sale_products_heading_color', '#333' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_on_sale_products_heading_color', array(
      'label'       => __( 'Heading color', 'archetype' ),
      'section'     => 'archetype_on_sale_products',
      'settings'    => 'archetype_on_sale_products_heading_color',
    ) ) );

    /**
     * On Sale products background color
     */
    $wp_customize->add_setting( 'archetype_on_sale_products_background_color', array(
      'default'           => apply_filters( 'archetype_default_on_sale_products_background_color', '#e5e5e5' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_on_sale_products_background_color', array(
      'label'       => __( 'Background color', 'archetype' ),
      'section'     => 'archetype_on_sale_products',
      'settings'    => 'archetype_on_sale_products_background_color',
    ) ) );

    /**
     * Product
     */
    $wp_customize->add_section( 'archetype_product' , array(
      'title'           => __( 'Product', 'archetype' ),
      'description'     => __( 'Customize the look & feel of a single product.', 'archetype' ),
      'priority'        => 45,
      'panel'           => 'archetype_woocommerce',
    ) );

    /**
     * Full width product page
     */
    $wp_customize->add_setting( 'archetype_product_full_width', array(
      'default'           => apply_filters( 'archetype_default_product_full_width', false ),
      'sanitize_callback' => 'archetype_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'archetype_product_full_width', array(
      'label'       => __( 'Full width product', 'archetype' ),
      'description' => __( 'Expand products the entire page width. This will remove the sidebar.', 'archetype' ),
      'section'     => 'archetype_product',
      'settings'    => 'archetype_product_full_width',
      'type'        => 'checkbox',
    ) );
    
    /**
     * Full width product gallery
     */
    $wp_customize->add_setting( 'archetype_product_gallery_full_width', array(
      'default'           => apply_filters( 'archetype_default_product_gallery_full_width', false ),
      'sanitize_callback' => 'archetype_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'archetype_product_gallery_full_width', array(
      'label'       => __( 'Full width product gallery', 'archetype' ),
      'description' => __( 'Expand product galleries the entire content width.', 'archetype' ),
      'section'     => 'archetype_product',
      'settings'    => 'archetype_product_gallery_full_width',
      'type'        => 'checkbox',
    ) );

    /**
     * Toggle product gallery
     */
    $wp_customize->add_setting( 'archetype_product_gallery_toggle', array(
      'default'           => apply_filters( 'archetype_default_product_gallery_toggle', true ),
      'sanitize_callback' => 'archetype_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'archetype_product_gallery_toggle', array(
      'label'       => __( 'Display product gallery', 'archetype' ),
      'description' => __( 'Toggle the display of the product gallery.', 'archetype' ),
      'section'     => 'archetype_product',
      'settings'    => 'archetype_product_gallery_toggle',
      'type'        => 'checkbox',
    ) );

    /**
     * Toggle product meta
     */
    $wp_customize->add_setting( 'archetype_product_meta_toggle', array(
      'default'           => apply_filters( 'archetype_default_product_meta_toggle', true ),
      'sanitize_callback' => 'archetype_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'archetype_product_meta_toggle', array(
      'label'       => __( 'Display product meta', 'archetype' ),
      'description' => __( 'Toggle the display of the product meta. category/sku etc.', 'archetype' ),
      'section'     => 'archetype_product',
      'settings'    => 'archetype_product_meta_toggle',
      'type'        => 'checkbox',
    ) );

    /**
     * Toggle product tabs
     */
    $wp_customize->add_setting( 'archetype_product_tabs_toggle', array(
      'default'           => apply_filters( 'archetype_default_product_tabs_toggle', true ),
      'sanitize_callback' => 'archetype_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'archetype_product_tabs_toggle', array(
      'label'       => __( 'Display product tabs', 'archetype' ),
      'description' => __( 'Toggle the display of the product tabs.', 'archetype' ),
      'section'     => 'archetype_product',
      'settings'    => 'archetype_product_tabs_toggle',
      'type'        => 'checkbox',
    ) );
  
    /**
     * Toggle related products
     */
    $wp_customize->add_setting( 'archetype_related_products_toggle', array(
      'default'           => apply_filters( 'archetype_default_related_products_toggle', true ),
      'sanitize_callback' => 'archetype_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'archetype_related_products_toggle', array(
      'label'       => __( 'Display related products', 'archetype' ),
      'description' => __( 'Toggle the display of the related products.', 'archetype' ),
      'section'     => 'archetype_product',
      'settings'    => 'archetype_related_products_toggle',
      'type'        => 'checkbox',
    ) );

    /**
     * Related products limit
     */
    $wp_customize->add_setting( 'archetype_related_products_limit', array(
      'default'           => '3',
      'sanitize_callback' => 'archetype_sanitize_choices',
    ) );

    $wp_customize->add_control( 'archetype_related_products_limit', array(
      'label'       => __( 'Limit', 'archetype' ),
      'section'     => 'archetype_product',
      'settings'    => 'archetype_related_products_limit',
      'type'        => 'select',
      'choices'     => array(
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
      'description' => __( 'Choose the number of related products to display.', 'archetype' ),
      'section'     => 'archetype_product',
      'settings'    => 'archetype_related_products_limit',
      'type'        => 'text',
    ) ) );

    /**
     * Related products columns
     */
    $wp_customize->add_setting( 'archetype_related_products_columns', array(
      'default'           => '3',
      'sanitize_callback' => 'archetype_sanitize_choices',
    ) );

    $wp_customize->add_control( 'archetype_related_products_columns', array(
      'label'       => __( 'Columns', 'archetype' ),
      'section'     => 'archetype_product',
      'settings'    => 'archetype_related_products_columns',
      'type'        => 'select',
      'choices'     => array(
        '1'           => '1',
        '2'           => '2',
        '3'           => '3',
        '4'           => '4',
        '5'           => '5',
      ),
    ) );

    $wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_related_products_columns_text', array(
      'description' => __( 'Choose the number of columns to display.', 'archetype' ),
      'section'     => 'archetype_product',
      'settings'    => 'archetype_related_products_columns',
      'type'        => 'text',
    ) ) );

  }

}