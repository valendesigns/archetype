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
      'priority'        => 70,
    ) );

    /**
     * Notices
     */
    $wp_customize->add_section( 'archetype_notices' , array(
      'title'       => __( 'Notices', 'archetype' ),
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
      'priority'    => 15,
      'panel'       => 'archetype_woocommerce'
    ) );

    /**
     * Notice Error Color
     */
    $wp_customize->add_setting( 'archetype_breadcrumb_hide', array(
      'default'     => apply_filters( 'archetype_default_breadcrumb_hide', false ),
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_breadcrumb_hide', array(
      'label'       => __( 'Hide Breadcrumbs', 'archetype' ),
      'section'     => 'archetype_breadcrumb',
      'settings'    => 'archetype_breadcrumb_hide',
      'priority'    => 10,
      'type'        => 'checkbox',
    ) ) );

  }

}