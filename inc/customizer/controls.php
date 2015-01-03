<?php
/**
 * archetype Theme Customizer controls
 *
 * @package archetype
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer along with several other settings.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customize_register' ) ) {
  function archetype_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    // Move background color setting alongside background image
    $wp_customize->get_control( 'background_color' )->section   = 'background_image';
    $wp_customize->get_control( 'background_color' )->priority  = 20;

    // Change background image section title & priority
    $wp_customize->get_section( 'background_image' )->title     = __( 'Background', 'archetype' );
    $wp_customize->get_section( 'background_image' )->priority  = 30;

    // Change header image section title & priority
    $wp_customize->get_section( 'header_image' )->title         = __( 'Header', 'archetype' );
    $wp_customize->get_section( 'header_image' )->priority      = 35;

    /**
     * Custom controls
     */
    require_once dirname( __FILE__ ) . '/controls/color.php';
    require_once dirname( __FILE__ ) . '/controls/divider.php';
    require_once dirname( __FILE__ ) . '/controls/export.php';
    require_once dirname( __FILE__ ) . '/controls/layout.php';
    require_once dirname( __FILE__ ) . '/controls/import.php';

    /**
     * Add the typography section
       */
    $wp_customize->add_section( 'archetype_typography' , array(
      'title'      => __( 'Typography', 'archetype' ),
      'priority'   => 45,
    ) );

    /**
     * Accent Color
     */
    $wp_customize->add_setting( 'archetype_accent_color', array(
      'default'           => apply_filters( 'archetype_default_accent_color', '#a46497' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_accent_color', array(
      'label'     => 'Link / accent color',
      'section'  => 'archetype_typography',
      'settings' => 'archetype_accent_color',
      'priority' => 20,
    ) ) );

    /**
     * Text Color
     */
    $wp_customize->add_setting( 'archetype_text_color', array(
      'default'           => apply_filters( 'archetype_default_text_color', '#787E87' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'      => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_text_color', array(
      'label'    => 'Text color',
      'section'  => 'archetype_typography',
      'settings'  => 'archetype_text_color',
      'priority'  => 30,
    ) ) );

    /**
     * Heading color
     */
    $wp_customize->add_setting( 'archetype_heading_color', array(
      'default'           => apply_filters( 'archetype_default_heading_color', '#484c51' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'      => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_heading_color', array(
      'label'     => 'Heading color',
      'section'  => 'archetype_typography',
      'settings' => 'archetype_heading_color',
      'priority' => 40,
    ) ) );

    /**
     * Header Background
     */
    $wp_customize->add_setting( 'archetype_header_background_color', array(
      'default'           => apply_filters( 'archetype_default_header_background_color', '#ee543f' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'      => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_header_background_color', array(
      'label'     => 'Background color',
      'section'  => 'header_image',
      'settings' => 'archetype_header_background_color',
      'priority' => 15,
    ) ) );

    /**
     * Header text color
     */
    $wp_customize->add_setting( 'archetype_header_text_color', array(
      'default'           => apply_filters( 'archetype_default_header_text_color', '#8a3125' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'      => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_header_text_color', array(
      'label'     => 'Text color',
      'section'  => 'header_image',
      'settings' => 'archetype_header_text_color',
      'priority' => 20,
    ) ) );

    /**
     * Header link color
     */
    $wp_customize->add_setting( 'archetype_header_link_color', array(
      'default'           => apply_filters( 'archetype_default_header_link_color', '#ffffff' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'      => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_header_link_color', array(
      'label'     => 'Link color',
      'section'  => 'header_image',
      'settings' => 'archetype_header_link_color',
      'priority' => 30,
    ) ) );
    
    /**
     * Content section
     */
    $wp_customize->add_section( 'archetype_content' , array(
      'title'        => __( 'Content', 'archetype' ),
      'priority'     => 36,
      'description'   => __( 'Customise the look & feel of your web site content area.', 'archetype' ),
    ) );

    /**
     * Content Background
     */
    $wp_customize->add_setting( 'archetype_content_background_color', array(
      'default'           => apply_filters( 'archetype_default_content_background_color', '#f1f1f1' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control( new Archetype_Color_Control( $wp_customize, 'archetype_content_background_color', array(
      'label'     => 'Background color',
      'section'   => 'archetype_content',
      'settings'  => 'archetype_content_background_color',
    ) ) );
    
    /**
     * Footer section
     */
    $wp_customize->add_section( 'archetype_footer' , array(
      'title'       => __( 'Footer', 'archetype' ),
      'priority'    => 40,
      'description' => __( 'Customise the look & feel of your web site footer.', 'archetype' ),
    ) );

    /**
     * Footer heading color
     */
    $wp_customize->add_setting( 'archetype_footer_heading_color', array(
      'default'           => apply_filters( 'archetype_default_footer_heading_color', '#646c6e' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'     => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_heading_color', array(
      'label'       => 'Heading color',
      'section'    => 'archetype_footer',
      'settings'   => 'archetype_footer_heading_color',
    ) ) );

    /**
     * Footer text color
     */
    $wp_customize->add_setting( 'archetype_footer_text_color', array(
      'default'           => apply_filters( 'archetype_default_footer_text_color', '#abb1ba' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'      => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_text_color', array(
      'label'     => 'Text color',
      'section'  => 'archetype_footer',
      'settings' => 'archetype_footer_text_color',
    ) ) );

    /**
     * Footer link color
     */
    $wp_customize->add_setting( 'archetype_footer_link_color', array(
      'default'           => apply_filters( 'archetype_default_footer_link_color', '#a46497' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'      => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_link_color', array(
      'label'     => 'Link color',
      'section'  => 'archetype_footer',
      'settings' => 'archetype_footer_link_color',
    ) ) );

    /**
     * Footer Background
     */
    $wp_customize->add_setting( 'archetype_footer_background_color', array(
      'default'           => apply_filters( 'archetype_default_footer_background_color', '#353b3f' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'      => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_background_color', array(
      'label'     => 'Background color',
      'section'  => 'archetype_footer',
      'settings' => 'archetype_footer_background_color',
    ) ) );

    /**
     * Buttons section
     */
    $wp_customize->add_section( 'archetype_buttons' , array(
      'title'        => __( 'Buttons', 'archetype' ),
      'priority'     => 45,
      'description'   => __( 'Customise the look & feel of your web site buttons.', 'archetype' ),
    ) );

    /**
     * Button background color
     */
    $wp_customize->add_setting( 'archetype_button_background_color', array(
      'default'           => apply_filters( 'archetype_default_button_background_color', '#787E87' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_background_color', array(
      'label'     => 'Background color',
      'section'  => 'archetype_buttons',
      'settings' => 'archetype_button_background_color',
      'priority' => 10,
    ) ) );

    /**
     * Button text color
     */
    $wp_customize->add_setting( 'archetype_button_text_color', array(
      'default'           => apply_filters( 'archetype_default_button_text_color', '#ffffff' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_text_color', array(
      'label'     => 'Text color',
      'section'  => 'archetype_buttons',
      'settings' => 'archetype_button_text_color',
      'priority' => 20,
    ) ) );

    /**
     * Button alt background color
     */
    $wp_customize->add_setting( 'archetype_button_alt_background_color', array(
      'default'           => apply_filters( 'archetype_default_button_alt_background_color', '#a46497' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_alt_background_color', array(
      'label'     => 'Alternate button background color',
      'section'  => 'archetype_buttons',
      'settings' => 'archetype_button_alt_background_color',
      'priority' => 30,
    ) ) );

    /**
     * Button alt text color
     */
    $wp_customize->add_setting( 'archetype_button_alt_text_color', array(
      'default'           => apply_filters( 'archetype_default_button_alt_text_color', '#ffffff' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_alt_text_color', array(
      'label'     => 'Alternate button text color',
      'section'  => 'archetype_buttons',
      'settings' => 'archetype_button_alt_text_color',
      'priority' => 40,
    ) ) );

    /**
     * Layout
     */
    $wp_customize->add_section( 'archetype_layout' , array(
      'title'        => __( 'Layout', 'archetype' ),
      'priority'     => 50,
    ) );

    $wp_customize->add_setting( 'archetype_layout', array(
      'default'           => 'right',
      'sanitize_callback' => 'archetype_sanitize_layout',
    ) );

    $wp_customize->add_control( new Archetype_Layout_Control( $wp_customize, 'archetype_layout', array(
      'label'    => __( 'General layout', 'archetype' ),
      'section'  => 'archetype_layout',
      'settings' => 'archetype_layout',
      'priority' => 1,
    ) ) );

    $wp_customize->add_control( new Archetype_Divider_Control( $wp_customize, 'archetype_layout_divider', array(
      'section'  => 'archetype_layout',
      'settings' => 'archetype_layout',
      'priority' => 2,
    ) ) );

    /**
     * Import & Export Section
     */
    $wp_customize->add_section( 'archetype_import_export', array(
      'title'    => __( 'Import & Export', 'archetype' ),
      'priority' => 10000000
    ));

    /**
     * Add an empty import & export setting.
     */ 
    $wp_customize->add_setting( 'archetype_import_export', array(
      'default' => '',
      'type'    => 'none'
    ));

    /**
     * Add the import control.
     */
    $wp_customize->add_control( new Archetype_Import_Control( $wp_customize, 'archetype_import', array(
      'label'       => __( 'Import', 'archetype' ),
      'section'     => 'archetype_import_export',
      'settings'    => 'archetype_import_export',
      'description' => __( 'Upload a file to import customization settings for this theme.', 'archetype' ),
      'priority'    => 1
    ) ) );
    
    $wp_customize->add_control( new Archetype_Divider_Control( $wp_customize, 'archetype_import_export_divider', array(
      'section'     => 'archetype_import_export',
      'settings'    => 'archetype_import_export',
      'priority'    => 2,
    ) ) );

    /**
     * Add the export control.
     */
    $wp_customize->add_control( new Archetype_Export_Control( $wp_customize, 'archetype_export', array(
      'label'       => __( 'Export', 'archetype' ),
      'section'     => 'archetype_import_export',
      'settings'    => 'archetype_import_export',
      'description' => __( 'Click the button below to export the customization settings for this theme.', 'archetype' ),
      'priority'    => 3
    ) ) );
  }
}