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
    
    // Change navigation section title, panel, & priority
    $wp_customize->get_section( 'nav' )->title                  = __( 'Menus', 'archetype' );
    $wp_customize->get_section( 'nav' )->panel                  = 'archetype_navigation';
    $wp_customize->get_section( 'nav' )->priority               = 10;

    /**
     * Custom controls
     */
    require_once dirname( __FILE__ ) . '/controls/color.php';
    require_once dirname( __FILE__ ) . '/controls/arbitrary.php';
    require_once dirname( __FILE__ ) . '/controls/number.php';
    require_once dirname( __FILE__ ) . '/controls/export.php';
    require_once dirname( __FILE__ ) . '/controls/layout.php';
    require_once dirname( __FILE__ ) . '/controls/import.php';

    /**
     * Add customizer settings without reloading the environment.
     *
     * @param WP_Customize_Manager $wp_customize Theme Customizer object.
     * @since 1.0.0
     */
    do_action( 'archetype_customize_register', $wp_customize );

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
        'priority'    => 40,
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
        'priority'    => 50,
      ) ) );
    } else {
      $wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_site_logo_info', array(
        'section'     => 'title_tagline',
        'type'        => 'text',
        'description' => sprintf( __( 'Want to add your logo? Install %sJetpack%s!', 'archetype' ), '<a href="https://wordpress.org/plugins/jetpack/" target="_blank">', '</a>' ),
        'priority'    => 40,
      ) ) );
    }

    // START Layout

    /**
     * Layout
     */
    $wp_customize->add_section( 'archetype_layout' , array(
      'title'       => __( 'Layout', 'archetype' ),
      'priority'    => 21,
    ) );

    $wp_customize->add_setting( 'archetype_layout', array(
      'default'           => 'right',
      'sanitize_callback' => 'archetype_sanitize_layout',
    ) );

    $wp_customize->add_control( new Archetype_Layout_Control( $wp_customize, 'archetype_layout', array(
      'label'       => __( 'Sidebar Position', 'archetype' ),
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
     * Sidebar columns
     */
    $wp_customize->add_setting( 'archetype_columns', array(
      'default'     => apply_filters( 'archetype_default_columns', '3' ),
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_columns', array(
      'label'       => __( 'Sidebar Columns', 'archetype' ),
      'section'     => 'archetype_layout',
      'settings'    => 'archetype_columns',
      'priority'    => 1,
      'type'        => 'radio',
      'choices'     => array(
        '3'         => '3 of 12',
        '4'         => '4 of 12',
      )
    ) ) );

    // END Layout

    // BEGIN Typography

    /**
     * Add the typography section
     */
    $wp_customize->add_section( 'archetype_typography' , array(
      'title'       => __( 'Typography', 'archetype' ),
      'priority'    => 31,
    ) );

    /**
     * Text Color
     */
    $wp_customize->add_setting( 'archetype_text_color', array(
      'default'           => apply_filters( 'archetype_default_text_color', '#555' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_text_color', array(
      'label'       => __( 'Text color', 'archetype' ),
      'section'     => 'archetype_typography',
      'settings'    => 'archetype_text_color',
      'priority'    => 1,
    ) ) );

    /**
     * Heading Color
     */
    $wp_customize->add_setting( 'archetype_heading_color', array(
      'default'           => apply_filters( 'archetype_default_heading_color', '#333' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_heading_color', array(
      'label'       => __( 'Heading color', 'archetype' ),
      'section'     => 'archetype_typography',
      'settings'    => 'archetype_heading_color',
      'priority'    => 2,
    ) ) );

    /**
     * Link Color
     */
    $wp_customize->add_setting( 'archetype_link_color', array(
      'default'           => apply_filters( 'archetype_default_link_color', '#ee543f' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_link_color', array(
      'label'       => __( 'Link color', 'archetype' ),
      'section'     => 'archetype_typography',
      'settings'    => 'archetype_link_color',
      'priority'    => 3,
    ) ) );

    /**
     * Link Color Hover
     */
    $wp_customize->add_setting( 'archetype_link_color_hover', array(
      'default'           => apply_filters( 'archetype_default_link_color_hover', '#111' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_link_color_hover', array(
      'label'       => __( 'Link hover color', 'archetype' ),
      'section'     => 'archetype_typography',
      'settings'    => 'archetype_link_color_hover',
      'priority'    => 4,
    ) ) );

    // END Typography

    // BEGIN Header

    /**
     * Header Background
     */
    $wp_customize->add_setting( 'archetype_header_background_color', array(
      'default'           => apply_filters( 'archetype_default_header_background_color', '#353b3f' ),
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
     * Header Text Color
     */
    $wp_customize->add_setting( 'archetype_header_text_color', array(
      'default'           => apply_filters( 'archetype_default_header_text_color', '#888' ),
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
     * Header Link Color
     */
    $wp_customize->add_setting( 'archetype_header_link_color', array(
      'default'           => apply_filters( 'archetype_default_header_link_color', '#aaa' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_header_link_color', array(
      'label'       => __( 'Link color', 'archetype' ),
      'section'     => 'header_image',
      'settings'    => 'archetype_header_link_color',
      'priority'    => 25,
    ) ) );

    /**
     * Header Link Color Hover
     */
    $wp_customize->add_setting( 'archetype_header_link_color_hover', array(
      'default'           => apply_filters( 'archetype_default_header_link_color_hover', '#ee543f' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_header_link_color_hover', array(
      'label'       => __( 'Link hover color', 'archetype' ),
      'section'     => 'header_image',
      'settings'    => 'archetype_header_link_color_hover',
      'priority'    => 30,
    ) ) );

    // END Header

    // BEGIN Navigation

    $wp_customize->add_panel( 'archetype_navigation', array(
      'theme_supports'  => 'menus',
      'title'           => __( 'Navigation', 'archetype' ),
      'description'     => __( 'Customize menu locations & styles.', 'archetype' ),
      'priority'        => 40,
    ) );

    /**
     * Add the Primary Menu Styles section
     */
    $wp_customize->add_section( 'archetype_nav_styles' , array(
      'title'       => __( 'Primary Menu Styles', 'archetype' ),
      'priority'    => 20,
      'description' => __( 'You must choose a menu location, in the Menus tab above, for the primary navigation styles to work.', 'archetype' ),
      'panel'       => 'archetype_navigation',
    ) );

    /**
     * Primary Navigation Background Color
     */
    $wp_customize->add_setting( 'archetype_nav_background_color', array(
      'default'           => apply_filters( 'archetype_default_nav_background_color', '#292E31' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_background_color', array(
      'label'       => __( 'Background color', 'archetype' ),
      'section'     => 'archetype_nav_styles',
      'settings'    => 'archetype_nav_background_color',
      'priority'    => 10,
    ) ) );

    /**
     * Primary Navigation Link Color
     */
    $wp_customize->add_setting( 'archetype_nav_link_color', array(
      'default'           => apply_filters( 'archetype_default_nav_link_color', '#bbb' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_link_color', array(
      'label'       => __( 'Link color', 'archetype' ),
      'section'     => 'archetype_nav_styles',
      'settings'    => 'archetype_nav_link_color',
      'priority'    => 15,
    ) ) );

    /**
     * Primary Navigation Link Hover Color
     */
    $wp_customize->add_setting( 'archetype_nav_link_color_hover', array(
      'default'           => apply_filters( 'archetype_default_nav_link_color_hover', '#fff' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_link_color_hover', array(
      'label'       => __( 'Link hover color', 'archetype' ),
      'section'     => 'archetype_nav_styles',
      'settings'    => 'archetype_nav_link_color_hover',
      'priority'    => 20,
    ) ) );

    /**
     * Primary Navigation Link Hover Background Color
     */
    $wp_customize->add_setting( 'archetype_nav_link_color_hover_bg', array(
      'default'           => apply_filters( 'archetype_default_nav_link_color_hover_bg', '#2f3538' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_link_color_hover_bg', array(
      'label'       => __( 'Link hover background color', 'archetype' ),
      'section'     => 'archetype_nav_styles',
      'settings'    => 'archetype_nav_link_color_hover_bg',
      'priority'    => 25,
    ) ) );

    /**
     * Primary Navigation Link Active Color
     */
    $wp_customize->add_setting( 'archetype_nav_link_color_active', array(
      'default'           => apply_filters( 'archetype_default_nav_link_color_active', '#fff' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_link_color_active', array(
      'label'       => __( 'Link active color', 'archetype' ),
      'section'     => 'archetype_nav_styles',
      'settings'    => 'archetype_nav_link_color_active',
      'priority'    => 30,
    ) ) );

    /**
     * Primary Navigation Link Active Background Color
     */
    $wp_customize->add_setting( 'archetype_nav_link_color_active_bg', array(
      'default'           => apply_filters( 'archetype_default_nav_link_color_active_bg', '#24282A' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_link_color_active_bg', array(
      'label'       => __( 'Link active background color', 'archetype' ),
      'section'     => 'archetype_nav_styles',
      'settings'    => 'archetype_nav_link_color_active_bg',
      'priority'    => 35,
    ) ) );

    /**
     * Add the Secondary Menu Styles section
     */
    $wp_customize->add_section( 'archetype_nav_alt_styles' , array(
      'title'       => __( 'Secondary Menu Styles', 'archetype' ),
      'priority'    => 20,
      'description' => __( 'You must choose a menu location, in the Menus tab above, for the secondary navigation styles to work.', 'archetype' ),
      'panel'       => 'archetype_navigation',
    ) );

    /**
     * Secondary Navigation Color
     */
    $wp_customize->add_setting( 'archetype_nav_alt_color', array(
      'default'           => apply_filters( 'archetype_default_nav_alt_color', '#bbb' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_alt_color', array(
      'label'       => __( 'Text color', 'archetype' ),
      'section'     => 'archetype_nav_alt_styles',
      'settings'    => 'archetype_nav_alt_color',
      'priority'    => 10,
    ) ) );

    /**
     * Secondary Navigation Background Color
     */
    $wp_customize->add_setting( 'archetype_nav_alt_background_color', array(
      'default'           => apply_filters( 'archetype_default_nav_alt_background_color', '#41484d' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_alt_background_color', array(
      'label'       => __( 'Background color', 'archetype' ),
      'section'     => 'archetype_nav_alt_styles',
      'settings'    => 'archetype_nav_alt_background_color',
      'priority'    => 15,
    ) ) );

    /**
     * Secondary Navigation Link Color
     */
    $wp_customize->add_setting( 'archetype_nav_alt_link_color', array(
      'default'           => apply_filters( 'archetype_default_nav_alt_link_color', '#ddd' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_alt_link_color', array(
      'label'       => __( 'Link color', 'archetype' ),
      'section'     => 'archetype_nav_alt_styles',
      'settings'    => 'archetype_nav_alt_link_color',
      'priority'    => 20,
    ) ) );

    /**
     * Secondary Navigation Link Hover Color
     */
    $wp_customize->add_setting( 'archetype_nav_alt_link_color_hover', array(
      'default'           => apply_filters( 'archetype_default_nav_alt_link_color_hover', '#fff' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_alt_link_color_hover', array(
      'label'       => __( 'Link hover color', 'archetype' ),
      'section'     => 'archetype_nav_alt_styles',
      'settings'    => 'archetype_nav_alt_link_color_hover',
      'priority'    => 25,
    ) ) );

    /**
     * Secondary Navigation Link Hover Background Color
     */
    $wp_customize->add_setting( 'archetype_nav_alt_link_color_hover_bg', array(
      'default'           => apply_filters( 'archetype_default_nav_alt_link_color_hover_bg', '#464e54' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_alt_link_color_hover_bg', array(
      'label'       => __( 'Link hover background color', 'archetype' ),
      'section'     => 'archetype_nav_alt_styles',
      'settings'    => 'archetype_nav_alt_link_color_hover_bg',
      'priority'    => 30,
    ) ) );

    /**
     * Secondary Navigation Link Active Color
     */
    $wp_customize->add_setting( 'archetype_nav_alt_link_color_active', array(
      'default'           => apply_filters( 'archetype_default_nav_alt_link_color_active', '#fff' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_alt_link_color_active', array(
      'label'       => __( 'Link active color', 'archetype' ),
      'section'     => 'archetype_nav_alt_styles',
      'settings'    => 'archetype_nav_alt_link_color_active',
      'priority'    => 35,
    ) ) );

    /**
     * Secondary Navigation Link Active Background Color
     */
    $wp_customize->add_setting( 'archetype_nav_alt_link_color_active_bg', array(
      'default'           => apply_filters( 'archetype_default_nav_alt_link_color_active_bg', '#3b4146' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_alt_link_color_active_bg', array(
      'label'       => __( 'Link active background color', 'archetype' ),
      'section'     => 'archetype_nav_alt_styles',
      'settings'    => 'archetype_nav_alt_link_color_active_bg',
      'priority'    => 40,
    ) ) );

    // END Navigation

    // BEGIN Post

    /**
     * Add the Post section
     */
    $wp_customize->add_section( 'archetype_post' , array(
      'title'       => __( 'Post', 'archetype' ),
      'priority'    => 45,
    ) );

    /**
     * Post Radius
     */
    $wp_customize->add_setting( 'archetype_post_radius', array(
      'default'     => apply_filters( 'archetype_default_post_radius', '0' ),
    ) );

    $wp_customize->add_control( new Archetype_Number_Customizer_Control( $wp_customize, 'archetype_post_radius', array(
      'label'       => __( 'Post Border Radius', 'archetype' ),
      'section'     => 'archetype_post',
      'settings'    => 'archetype_post_radius',
      'priority'    => 5,
    ) ) );

    /**
     * Avatar Radius
     */
    $wp_customize->add_setting( 'archetype_avatar_radius', array(
      'default'     => apply_filters( 'archetype_default_avatar_radius', '3' ),
    ) );

    $wp_customize->add_control( new Archetype_Number_Customizer_Control( $wp_customize, 'archetype_avatar_radius', array(
      'label'       => __( 'Avatar Border Radius', 'archetype' ),
      'section'     => 'archetype_post',
      'settings'    => 'archetype_avatar_radius',
      'priority'    => 6,
    ) ) );

    /**
     * Post Background
     */
    $wp_customize->add_setting( 'archetype_post_background_color', array(
      'default'           => apply_filters( 'archetype_default_post_background_color', '#fff' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_post_background_color', array(
      'label'       => __( 'Background color', 'archetype' ),
      'section'     => 'archetype_post',
      'settings'    => 'archetype_post_background_color',
      'priority'    => 10,
    ) ) );

    /**
     * Post Border
     */
    $wp_customize->add_setting( 'archetype_post_border_color', array(
      'default'           => apply_filters( 'archetype_default_post_border_color', '#e5e5e5' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_post_border_color', array(
      'label'       => __( 'Border color', 'archetype' ),
      'section'     => 'archetype_post',
      'settings'    => 'archetype_post_border_color',
      'priority'    => 15,
    ) ) );

    /**
     * Post Shadow
     */
    $wp_customize->add_setting( 'archetype_post_shadow_color', array(
      'default'           => apply_filters( 'archetype_default_post_shadow_color', '#8b949b' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_post_shadow_color', array(
      'label'       => __( 'Shadow color', 'archetype' ),
      'section'     => 'archetype_post',
      'settings'    => 'archetype_post_shadow_color',
      'priority'    => 20,
    ) ) );

    // END Post

    // START Forms

    /**
     * Add the Forms section
     */
    $wp_customize->add_section( 'archetype_forms' , array(
      'title'       => __( 'Form Inputs & Textareas', 'archetype' ),
      'priority'    => 50,
    ) );

    /**
     * Form Text Color
     */
    $wp_customize->add_setting( 'archetype_form_text_color', array(
      'default'           => apply_filters( 'archetype_default_form_text_color', '#555' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_form_text_color', array(
      'label'       => __( 'Text color', 'archetype' ),
      'section'     => 'archetype_forms',
      'settings'    => 'archetype_form_text_color',
      'priority'    => 10,
    ) ) );

    /**
     * Form Background Color
     */
    $wp_customize->add_setting( 'archetype_form_background_color', array(
      'default'           => apply_filters( 'archetype_default_form_background_color', '#e4e4e4' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_form_background_color', array(
      'label'       => __( 'Background color', 'archetype' ),
      'section'     => 'archetype_forms',
      'settings'    => 'archetype_form_background_color',
      'priority'    => 15,
    ) ) );

    /**
     * Form Focus Text Color
     */
    $wp_customize->add_setting( 'archetype_form_text_focus_color', array(
      'default'           => apply_filters( 'archetype_default_form_text_focus_color', '#3b3b3b' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_form_text_focus_color', array(
      'label'       => __( 'Text focus color', 'archetype' ),
      'section'     => 'archetype_forms',
      'settings'    => 'archetype_form_text_focus_color',
      'priority'    => 20,
    ) ) );

    /**
     * Form Focus Background Color
     */
    $wp_customize->add_setting( 'archetype_form_background_focus_color', array(
      'default'           => apply_filters( 'archetype_default_form_background_focus_color', '#d7d7d7' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_form_background_focus_color', array(
      'label'       => __( 'Background focus color', 'archetype' ),
      'section'     => 'archetype_forms',
      'settings'    => 'archetype_form_background_focus_color',
      'priority'    => 25,
    ) ) );

    // END Forms

    // BEGIN Search Widget

    /**
     * Add the Search Widget section
     */
    $wp_customize->add_section( 'archetype_search' , array(
      'title'       => __( 'Search Widget', 'archetype' ),
      'priority'    => 55,
    ) );

    /**
     * Search Widget Text Color
     */
    $wp_customize->add_setting( 'archetype_search_text_color', array(
      'default'           => apply_filters( 'archetype_default_search_text_color', '#555' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_search_text_color', array(
      'label'       => __( 'Text color', 'archetype' ),
      'section'     => 'archetype_search',
      'settings'    => 'archetype_search_text_color',
      'priority'    => 10,
    ) ) );

    /**
     * Search Widget Background Color
     */
    $wp_customize->add_setting( 'archetype_search_background_color', array(
      'default'           => apply_filters( 'archetype_default_search_background_color', '#fff' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_search_background_color', array(
      'label'       => __( 'Background color', 'archetype' ),
      'section'     => 'archetype_search',
      'settings'    => 'archetype_search_background_color',
      'priority'    => 10,
    ) ) );

    /**
     * Search Widget Shadow Color
     */
    $wp_customize->add_setting( 'archetype_search_shadow_color', array(
      'default'           => apply_filters( 'archetype_default_search_shadow_color', '#8b949b' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_search_shadow_color', array(
      'label'       => __( 'Shadow color', 'archetype' ),
      'section'     => 'archetype_search',
      'settings'    => 'archetype_search_shadow_color',
      'priority'    => 10,
    ) ) );

    // END Search Widget

    // START Buttons

    /**
     * Buttons section
     */
    $wp_customize->add_section( 'archetype_buttons' , array(
      'title'       => __( 'Buttons', 'archetype' ),
      'priority'    => 60,
    ) );

    /**
     * Button 2D
     */
    $wp_customize->add_setting( 'archetype_button_2d', array(
      'default'     => apply_filters( 'archetype_default_button_2d', false ),
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_button_2d', array(
      'label'       => __( '2D Buttons', 'archetype' ),
      'section'     => 'archetype_buttons',
      'settings'    => 'archetype_button_2d',
      'priority'    => 1,
      'type'        => 'checkbox',
    ) ) );

    $wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_button_2d_text', array(
      'section'     => 'archetype_buttons',
      'type'        => 'text',
      'description' => __( 'Checking 2D will remove the shadow effect.', 'archetype' ),
      'priority'    => 2,
    ) ) );

    /**
     * Button Radius
     */
    $wp_customize->add_setting( 'archetype_button_radius', array(
      'default'     => apply_filters( 'archetype_default_button_radius', '3' ),
    ) );

    $wp_customize->add_control( new Archetype_Number_Customizer_Control( $wp_customize, 'archetype_button_radius', array(
      'label'       => __( 'Border Radius', 'archetype' ),
      'section'     => 'archetype_buttons',
      'settings'    => 'archetype_button_radius',
      'priority'    => 3,
    ) ) );

    $wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_button_text', array(
      'section'     => 'archetype_buttons',
      'type'        => 'text',
      'description' => __( "It's important to note that the default button colors are used in many places as an accent color.", 'archetype' ),
      'priority'    => 4,
    ) ) );

    /**
     * Button text color
     */
    $wp_customize->add_setting( 'archetype_button_text_color', array(
      'default'           => apply_filters( 'archetype_default_button_text_color', '#fff' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_text_color', array(
      'label'       => __( 'Text color', 'archetype' ),
      'section'     => 'archetype_buttons',
      'settings'    => 'archetype_button_text_color',
      'priority'    => 10,
    ) ) );

    /**
     * Button background color
     */
    $wp_customize->add_setting( 'archetype_button_background_color', array(
      'default'           => apply_filters( 'archetype_default_button_background_color', '#ed543f' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_background_color', array(
      'label'       => __( 'Background color', 'archetype' ),
      'section'     => 'archetype_buttons',
      'settings'    => 'archetype_button_background_color',
      'priority'    => 15,
    ) ) );

    /**
     * Button border color
     */
    $wp_customize->add_setting( 'archetype_button_border_color', array(
      'default'           => apply_filters( 'archetype_default_button_border_color', '#d94834' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_border_color', array(
      'label'       => __( 'Border color', 'archetype' ),
      'section'     => 'archetype_buttons',
      'settings'    => 'archetype_button_border_color',
      'priority'    => 20,
    ) ) );

    /**
     * Button shadow color
     */
    $wp_customize->add_setting( 'archetype_button_shadow_color', array(
      'default'           => apply_filters( 'archetype_default_button_shadow_color', '#d94834' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_shadow_color', array(
      'label'       => __( 'Shadow color', 'archetype' ),
      'section'     => 'archetype_buttons',
      'settings'    => 'archetype_button_shadow_color',
      'priority'    => 25,
    ) ) );

    $wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_button_hover_text', array(
      'section'     => 'archetype_buttons',
      'type'        => 'text',
      'description' => sprintf( __( "Adding the %s class to your buttons will inverse their styles. Which means the hover colors will become the default state, and vice versa.", 'archetype' ), '<code>.alt</code>' ),
      'priority'    => 29,
    ) ) );

    /**
     * Button text hover color
     */
    $wp_customize->add_setting( 'archetype_button_text_hover_color', array(
      'default'           => apply_filters( 'archetype_default_button_text_hover_color', '#555' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_text_hover_color', array(
      'label'       => __( 'Text alt/hover color', 'archetype' ),
      'section'     => 'archetype_buttons',
      'settings'    => 'archetype_button_text_hover_color',
      'priority'    => 30,
    ) ) );

    /**
     * Button background hover color
     */
    $wp_customize->add_setting( 'archetype_button_background_hover_color', array(
      'default'           => apply_filters( 'archetype_default_button_background_hover_color', '#fff' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_background_hover_color', array(
      'label'       => __( 'Background alt/hover color', 'archetype' ),
      'section'     => 'archetype_buttons',
      'settings'    => 'archetype_button_background_hover_color',
      'priority'    => 35,
    ) ) );

    /**
     * Button border hover color
     */
    $wp_customize->add_setting( 'archetype_button_border_hover_color', array(
      'default'           => apply_filters( 'archetype_default_button_border_hover_color', '#8b949b' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_border_hover_color', array(
      'label'       => __( 'Border alt/hover color', 'archetype' ),
      'section'     => 'archetype_buttons',
      'settings'    => 'archetype_button_border_hover_color',
      'priority'    => 40,
    ) ) );

    /**
     * Button shadow hover color
     */
    $wp_customize->add_setting( 'archetype_button_shadow_hover_color', array(
      'default'           => apply_filters( 'archetype_default_button_shadow_hover_color', '#8b949b' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_shadow_hover_color', array(
      'label'       => __( 'Shadow alt/hover color', 'archetype' ),
      'section'     => 'archetype_buttons',
      'settings'    => 'archetype_button_shadow_hover_color',
      'priority'    => 45,
    ) ) );

    // END Buttons

    // START Footer

    /**
     * Footer section
     */
    $wp_customize->add_section( 'archetype_footer' , array(
      'title'       => __( 'Footer', 'archetype' ),
      'priority'    => 65,
    ) );

    $wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_footer_upper', array(
      'section'     => 'archetype_footer',
      'type'        => 'heading',
      'label'       => __( 'Upper Footer', 'archetype' ),
    ) ) );

    /**
     * Footer heading color
     */
    $wp_customize->add_setting( 'archetype_footer_heading_color', array(
      'default'           => apply_filters( 'archetype_default_footer_heading_color', '#eee' ),
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
      'default'           => apply_filters( 'archetype_default_footer_text_color', '#888' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_text_color', array(
      'label'       => __( 'Text color', 'archetype' ),
      'section'     => 'archetype_footer',
      'settings'    => 'archetype_footer_text_color',
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
     * Footer link color
     */
    $wp_customize->add_setting( 'archetype_footer_link_color', array(
      'default'           => apply_filters( 'archetype_default_footer_link_color', '#ee543f' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_link_color', array(
      'label'       => __( 'Link color', 'archetype' ),
      'section'     => 'archetype_footer',
      'settings'    => 'archetype_footer_link_color',
    ) ) );

    /**
     * Footer link hover color
     */
    $wp_customize->add_setting( 'archetype_footer_link_hover_color', array(
      'default'           => apply_filters( 'archetype_default_footer_link_hover_color', '#fff' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_link_hover_color', array(
      'label'       => __( 'Link hover color', 'archetype' ),
      'section'     => 'archetype_footer',
      'settings'    => 'archetype_footer_link_hover_color',
    ) ) );

    $wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_footer_lower_divider', array(
      'section'     => 'archetype_footer',
      'type'        => 'divider',
      'description' => __( '', 'archetype' ),
    ) ) );

    $wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_footer_lower_text', array(
      'section'     => 'archetype_footer',
      'type'        => 'heading',
      'label'       => __( 'Lower Footer', 'archetype' ),
    ) ) );

    /**
     * Lower footer text color
     */
    $wp_customize->add_setting( 'archetype_footer_lower_text_color', array(
      'default'           => apply_filters( 'archetype_default_footer_lower_text_color', '#888' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_lower_text_color', array(
      'label'       => __( 'Text color', 'archetype' ),
      'section'     => 'archetype_footer',
      'settings'    => 'archetype_footer_lower_text_color',
    ) ) );

    /**
     * Lower footer Background
     */
    $wp_customize->add_setting( 'archetype_footer_lower_background_color', array(
      'default'           => apply_filters( 'archetype_default_footer_lower_background_color', '#292e31' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
      'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_lower_background_color', array(
      'label'       => __( 'Background color', 'archetype' ),
      'section'     => 'archetype_footer',
      'settings'    => 'archetype_footer_lower_background_color',
    ) ) );

    /**
     * Lower footer link color
     */
    $wp_customize->add_setting( 'archetype_footer_lower_link_color', array(
      'default'           => apply_filters( 'archetype_default_footer_lower_link_color', '#ee543f' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_lower_link_color', array(
      'label'       => __( 'Link color', 'archetype' ),
      'section'     => 'archetype_footer',
      'settings'    => 'archetype_footer_lower_link_color',
    ) ) );

    /**
     * Lower footer link hover color
     */
    $wp_customize->add_setting( 'archetype_footer_lower_link_hover_color', array(
      'default'           => apply_filters( 'archetype_default_footer_lower_link_hover_color', '#fff' ),
      'sanitize_callback' => 'archetype_sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_lower_link_hover_color', array(
      'label'       => __( 'Link hover color', 'archetype' ),
      'section'     => 'archetype_footer',
      'settings'    => 'archetype_footer_lower_link_hover_color',
    ) ) );

    // END Footer

    // START Import/Export

    /**
     * Import & Export Section
     */
    $wp_customize->add_section( 'archetype_import_export', array(
      'title'       => __( 'Import & Export', 'archetype' ),
      'priority'    => 10000000,
    ));

    if ( ! current_user_can( 'manage_options' ) ) {
      /**
       * Add the import Customizer control.
       */
      $wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_import_export_missing', array(
        'section'     => 'archetype_import_export',
        'type'        => 'text',
        'description' => __( 'You do not have the capability role to import or export customizer settings.', 'archetype' ),
        'priority'    => 1,
      ) ) );
    }

    /**
     * Add an empty import & export setting.
     */ 
    $wp_customize->add_setting( 'archetype_import_export', array(
      'capability'  => 'manage_options',
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

    // END Import/Export

  }
}