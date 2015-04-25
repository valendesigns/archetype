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
    require_once dirname( __FILE__ ) . '/controls/arbitrary.php';
    require_once dirname( __FILE__ ) . '/controls/number.php';
    require_once dirname( __FILE__ ) . '/controls/export.php';
    require_once dirname( __FILE__ ) . '/controls/layout.php';
    require_once dirname( __FILE__ ) . '/controls/import.php';

    if ( current_theme_supports( 'site-logo' ) && class_exists( 'Site_Logo', false ) ) {
      // Add the setting for our svg logo.
      $wp_customize->add_setting( 'archetype_site_logo_svg', array(
        'capability'  => 'manage_options',
        'transport'   => 'postMessage',
      ) );

      // Add our image uploader.
      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'archetype_site_logo_svg', array(
        'label'       => __( 'Logo SVG (logo above required)', 'archetype' ),
        'section'     => 'title_tagline',
        'settings'    => 'archetype_site_logo_svg',
      ) ) );

      /**
       * Logo Top Margin
       */
      $wp_customize->add_setting( 'archetype_site_logo_margin_top', array(
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
      ) );

      $wp_customize->add_control( new Archetype_Number_Customizer_Control( $wp_customize, 'archetype_site_logo_margin_top', array(
        'label'       => __( 'Logo Margin Top (em)', 'archetype' ),
        'section'     => 'title_tagline',
        'settings'    => 'archetype_site_logo_margin_top',
      ) ) );
    }
    
    /**
     * Add the typography section
     */
    $wp_customize->add_section( 'archetype_typography' , array(
      'title'       => __( 'Typography', 'archetype' ),
      'priority'    => 45,
    ) );

    /**
     * Accent Color
     */
    $wp_customize->add_setting( 'archetype_accent_color', array(
      'default'           => apply_filters( 'archetype_default_accent_color', '#96588a' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_accent_color', array(
      'label'       => __( 'Link / accent color', 'archetype' ),
      'section'     => 'archetype_typography',
      'settings'    => 'archetype_accent_color',
      'priority'    => 20,
    ) ) );

    /**
     * Text Color
     */
    $wp_customize->add_setting( 'archetype_text_color', array(
      'default'           => apply_filters( 'archetype_default_text_color', '#60646c' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_text_color', array(
      'label'       => __( 'Text color', 'archetype' ),
      'section'     => 'archetype_typography',
      'settings'    => 'archetype_text_color',
      'priority'    => 30,
    ) ) );

    /**
     * Heading color
     */
    $wp_customize->add_setting( 'archetype_heading_color', array(
      'default'           => apply_filters( 'archetype_default_heading_color', '#484c51' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_heading_color', array(
      'label'       => __( 'Heading color', 'archetype' ),
      'section'     => 'archetype_typography',
      'settings'    => 'archetype_heading_color',
      'priority'    => 40,
    ) ) );

    /**
     * Header Background
     */
    $wp_customize->add_setting( 'archetype_header_background_color', array(
      'default'           => apply_filters( 'archetype_default_header_background_color', '#ee543f' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_header_background_color', array(
      'label'       => __( 'Background color', 'archetype' ),
      'section'     => 'header_image',
      'settings'    => 'archetype_header_background_color',
      'priority'    => 15,
    ) ) );

    /**
     * Header text color
     */
    $wp_customize->add_setting( 'archetype_header_text_color', array(
      'default'           => apply_filters( 'archetype_default_header_text_color', '#8a3125' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_header_text_color', array(
      'label'       => __( 'Text color', 'archetype' ),
      'section'     => 'header_image',
      'settings'    => 'archetype_header_text_color',
      'priority'    => 20,
    ) ) );

    /**
     * Header link color
     */
    $wp_customize->add_setting( 'archetype_header_link_color', array(
      'default'           => apply_filters( 'archetype_default_header_link_color', '#ffffff' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_header_link_color', array(
      'label'       => __( 'Link color', 'archetype' ),
      'section'     => 'header_image',
      'settings'    => 'archetype_header_link_color',
      'priority'    => 30,
    ) ) );
    
    /**
     * Content section
     */
    $wp_customize->add_section( 'archetype_content' , array(
      'title'       => __( 'Content', 'archetype' ),
      'priority'    => 36,
      'description' => __( 'Customize the look & feel of your web site content area.', 'archetype' ),
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
      'label'       => __( 'Background color', 'archetype' ),
      'section'     => 'archetype_content',
      'settings'    => 'archetype_content_background_color',
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
      'default'           => apply_filters( 'archetype_default_footer_heading_color', '#494c50' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_heading_color', array(
      'label'       => __( 'Heading color', 'archetype' ),
      'section'     => 'archetype_footer',
      'settings'    => 'archetype_footer_heading_color',
    ) ) );

    /**
     * Footer text color
     */
    $wp_customize->add_setting( 'archetype_footer_text_color', array(
      'default'           => apply_filters( 'archetype_default_footer_text_color', '#61656b' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_text_color', array(
      'label'       => __( 'Text color', 'archetype' ),
      'section'     => 'archetype_footer',
      'settings'    => 'archetype_footer_text_color',
    ) ) );

    /**
     * Footer link color
     */
    $wp_customize->add_setting( 'archetype_footer_link_color', array(
      'default'           => apply_filters( 'archetype_default_footer_link_color', '#96588a' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_link_color', array(
      'label'       => __( 'Link color', 'archetype' ),
      'section'     => 'archetype_footer',
      'settings'    => 'archetype_footer_link_color',
    ) ) );

    /**
     * Footer Background
     */
    $wp_customize->add_setting( 'archetype_footer_background_color', array(
      'default'           => apply_filters( 'archetype_default_footer_background_color', '#353b3f' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_background_color', array(
      'label'       => __( 'Background color', 'archetype' ),
      'section'     => 'archetype_footer',
      'settings'    => 'archetype_footer_background_color',
    ) ) );

    /**
     * Buttons section
     */
    $wp_customize->add_section( 'archetype_buttons' , array(
      'title'       => __( 'Buttons', 'archetype' ),
      'priority'    => 45,
      'description' => __( 'Customise the look & feel of your web site buttons.', 'archetype' ),
    ) );

    /**
     * Button background color
     */
    $wp_customize->add_setting( 'archetype_button_background_color', array(
      'default'           => apply_filters( 'archetype_default_button_background_color', '#60646c' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_background_color', array(
      'label'       => __( 'Background color', 'archetype' ),
      'section'     => 'archetype_buttons',
      'settings'    => 'archetype_button_background_color',
      'priority'    => 10,
    ) ) );

    /**
     * Button text color
     */
    $wp_customize->add_setting( 'archetype_button_text_color', array(
      'default'           => apply_filters( 'archetype_default_button_text_color', '#ffffff' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_text_color', array(
      'label'       => __( 'Text color', 'archetype' ),
      'section'     => 'archetype_buttons',
      'settings'    => 'archetype_button_text_color',
      'priority'    => 20,
    ) ) );

    /**
     * Button alt background color
     */
    $wp_customize->add_setting( 'archetype_button_alt_background_color', array(
      'default'           => apply_filters( 'archetype_default_button_alt_background_color', '#96588a' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_alt_background_color', array(
      'label'       => __( 'Alternate button background color', 'archetype' ),
      'section'     => 'archetype_buttons',
      'settings'    => 'archetype_button_alt_background_color',
      'priority'    => 30,
    ) ) );

    /**
     * Button alt text color
     */
    $wp_customize->add_setting( 'archetype_button_alt_text_color', array(
      'default'           => apply_filters( 'archetype_default_button_alt_text_color', '#ffffff' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_alt_text_color', array(
      'label'       => __( 'Alternate button text color', 'archetype' ),
      'section'     => 'archetype_buttons',
      'settings'    => 'archetype_button_alt_text_color',
      'priority'    => 40,
    ) ) );

    /**
     * Layout
     */
    $wp_customize->add_section( 'archetype_layout' , array(
      'title'       => __( 'Layout', 'archetype' ),
      'priority'    => 50,
    ) );

    $wp_customize->add_setting( 'archetype_layout', array(
      'default'           => 'right',
      'sanitize_callback' => 'archetype_sanitize_layout',
    ) );

    $wp_customize->add_control( new Archetype_Layout_Control( $wp_customize, 'archetype_layout', array(
      'label'       => __( 'General layout', 'archetype' ),
      'section'     => 'archetype_layout',
      'settings'    => 'archetype_layout',
      'priority'    => 1,
    ) ) );

    $wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_layout_divider', array(
      'section'     => 'archetype_layout',
      'settings'    => 'archetype_layout',
      'type'        => 'divider',
      'priority'    => 2,
    ) ) );

    /**
     * Import & Export Section
     */
    $wp_customize->add_section( 'archetype_import_export', array(
      'title'       => __( 'Import & Export', 'archetype' ),
      'priority'    => 10000000,
    ));

    /**
     * Add an empty import & export setting.
     */ 
    $wp_customize->add_setting( 'archetype_import_export', array(
      'default'     => '',
      'type'        => 'none',
    ));

    /**
     * Add the import Customizer control.
     */
    $wp_customize->add_control( new Archetype_Import_Customizer_Control( $wp_customize, 'archetype_import_customizer', array(
      'label'       => __( 'Import Customizer', 'archetype' ),
      'section'     => 'archetype_import_export',
      'settings'    => 'archetype_import_export',
      'description' => __( 'Upload a file to import customization settings for this theme.', 'archetype' ),
      'priority'    => 1,
    ) ) );
    
    $wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_import_customizer_divider', array(
      'section'     => 'archetype_import_export',
      'settings'    => 'archetype_import_export',
      'type'        => 'divider',
      'priority'    => 2,
    ) ) );
    
    /**
     * Add the export Customizer control.
     */
    $wp_customize->add_control( new Archetype_Export_Customizer_Control( $wp_customize, 'archetype_export_customizer', array(
      'label'       => __( 'Export Customizer', 'archetype' ),
      'section'     => 'archetype_import_export',
      'settings'    => 'archetype_import_export',
      'description' => __( 'Click the button below to export the customization settings for this theme.', 'archetype' ),
      'priority'    => 3,
    ) ) );
    
    $wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_export_customizer_divider', array(
      'section'     => 'archetype_import_export',
      'settings'    => 'archetype_import_export',
      'type'        => 'divider',
      'priority'    => 4,
    ) ) );
    
    /**
     * Add the import Widgets control.
     */
    $wp_customize->add_control( new Archetype_Import_Widgets_Control( $wp_customize, 'archetype_import_widgets', array(
      'label'       => __( 'Import Widgets', 'archetype' ),
      'section'     => 'archetype_import_export',
      'settings'    => 'archetype_import_export',
      'description' => __( 'Upload a file to import widget settings for this theme.', 'archetype' ),
      'priority'    => 5,
    ) ) );
    
    $wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_import_widgets_divider', array(
      'section'     => 'archetype_import_export',
      'settings'    => 'archetype_import_export',
      'type'        => 'divider',
      'priority'    => 6,
    ) ) );
    
    /**
     * Add the export Widgets control.
     */
    $wp_customize->add_control( new Archetype_Export_Widgets_Control( $wp_customize, 'archetype_export_widgets', array(
      'label'       => __( 'Export Widgets', 'archetype' ),
      'section'     => 'archetype_import_export',
      'settings'    => 'archetype_import_export',
      'description' => __( 'Click the button below to export the widgets for this theme.', 'archetype' ),
      'priority'    => 7,
    ) ) );
  }
}