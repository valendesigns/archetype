<?php
/**
 * Archetype Theme Customizer controls
 *
 * @package Archetype
 * @subpackage Customize
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_customize_register' ) ) :

	/**
	 * Add postMessage support for site title and description for the Theme Customizer along with several other settings.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function archetype_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		// Move background color setting alongside background image.
		$wp_customize->get_control( 'background_color' )->section   = 'background_image';
		$wp_customize->get_control( 'background_color' )->priority  = 20;

		// Change background image section title & priority.
		$wp_customize->get_section( 'background_image' )->title     = __( 'Background', 'archetype' );
		$wp_customize->get_section( 'background_image' )->priority  = 30;
		$wp_customize->get_section( 'background_image' )->panel     = 'archetype_general';

		// Change header image title, priority & panel.
		$wp_customize->get_section( 'header_image' )->title         = __( 'Background Image', 'archetype' );
		$wp_customize->get_section( 'header_image' )->priority      = 15;
		$wp_customize->get_section( 'header_image' )->panel         = 'archetype_header';

		// Change navigation panel or section.
		$menu_locations = $wp_customize->get_section( 'menu_locations' );
		if ( is_object( $menu_locations ) && 'nav_menus' === $menu_locations->panel ) {
			$wp_customize->get_panel( 'nav_menus' )->priority          = 40;
		} else {
			$wp_customize->get_section( 'nav' )->title                 = __( 'Menus Locations', 'archetype' );
			$wp_customize->get_section( 'nav' )->panel                 = 'archetype_header';
			$wp_customize->get_section( 'nav' )->priority              = 25;
		}

		// Change the title of the Site Title & Tagline.
		$wp_customize->get_section( 'title_tagline' )->title        = __( 'Branding', 'archetype' );
		$wp_customize->get_section( 'title_tagline' )->priority     = 10;
		$wp_customize->get_section( 'title_tagline' )->panel        = 'archetype_header';

		// Change the Static Front Page panel, & priority.
		$wp_customize->get_section( 'static_front_page' )->panel    = 'archetype_general';
		$wp_customize->get_section( 'static_front_page' )->priority = 1;

		/**
		 * Custom controls
		 */
		require_once dirname( __FILE__ ) . '/controls/arbitrary.php';
		require_once dirname( __FILE__ ) . '/controls/number.php';
		require_once dirname( __FILE__ ) . '/controls/radio.php';

		// Set the path to the customizer images directory.
		$customizer_images = get_template_directory_uri() . '/inc/customizer/controls/img/';

		/**
		 * Add customizer settings without reloading the environment.
		 *
		 * @since 1.0.0
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		do_action( 'archetype_customize_register', $wp_customize );

		if ( current_theme_supports( 'site-logo' ) && ! class_exists( 'Site_Logo', false ) ) {
			$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_site_logo_info', array(
				'section'     => 'title_tagline',
				'description' => sprintf( __( 'Want to add your logo? Install %sJetpack%s!', 'archetype' ), '<a href="https://wordpress.org/plugins/jetpack/" target="_blank">', '</a>' ),
				'type'        => 'text',
				'priority'    => 40,
			) ) );
		}

		/**
		 * Add the General panel
		 */
		$wp_customize->add_panel( 'archetype_general' , array(
			'title'        => __( 'General', 'archetype' ),
			'description'  => __( 'Customize the look & feel of your website.', 'archetype' ),
			'priority'     => 1,
		) );

		/**
		 * Layout
		 */
		$wp_customize->add_section( 'archetype_layout' , array(
			'title'        => __( 'Layout', 'archetype' ),
			'priority'     => 21,
			'panel'        => 'archetype_general',
		) );

		$wp_customize->add_setting( 'archetype_layout', array(
			'default'            => 'right',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( new Archetype_Radio_Image_Control( $wp_customize, 'archetype_layout', array(
			'label'        => __( 'Sidebar Position', 'archetype' ),
			'section'      => 'archetype_layout',
			'settings'     => 'archetype_layout',
			'priority'     => 5,
			'columns'      => 3,
			'choices'      => array(
				'left'        => esc_url_raw( $customizer_images . ( is_rtl() ? '2cr' : '2cl' ) . '.png' ),
				'right'       => esc_url_raw( $customizer_images . ( is_rtl() ? '2cl' : '2cr' ) . '.png' ),
				'none'        => esc_url_raw( $customizer_images . '1c.png' ),
			),
		) ) );

		/**
		 * Sidebar columns
		 */
		$wp_customize->add_setting( 'archetype_columns', array(
			'default'            => apply_filters( 'archetype_default_columns', '3' ),
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_columns', array(
			'label'        => __( 'Sidebar Columns', 'archetype' ),
			'description'  => __( 'Choose the number of columns, out of a 12 column grid, that the sidebar will occupy.', 'archetype' ),
			'section'      => 'archetype_layout',
			'settings'     => 'archetype_columns',
			'priority'     => 10,
			'type'         => 'select',
			'choices'      => array(
				'3'           => __( '3', 'archetype' ),
				'4'           => __( '4', 'archetype' ),
			),
		) ) );

		/**
		 * Full width
		 */
		$wp_customize->add_setting( 'archetype_full_width', array(
			'default'            => (bool) apply_filters( 'archetype_default_full_width', false ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( 'archetype_full_width', array(
			'label'        => __( 'Full Width', 'archetype' ),
			'description'  => __( 'Expand the sites width to fill all of the browser window space.', 'archetype' ),
			'section'      => 'archetype_layout',
			'settings'     => 'archetype_full_width',
			'priority'     => 15,
			'type'         => 'checkbox',
		) );

		/**
		 * Boxed
		 */
		$wp_customize->add_setting( 'archetype_boxed', array(
			'default'            => (bool) apply_filters( 'archetype_default_boxed', false ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( 'archetype_boxed', array(
			'label'        => __( 'Boxed', 'archetype' ),
			'description'  => __( 'Adds a wrapper to the content of the site which creates a boxed look.', 'archetype' ),
			'section'      => 'archetype_layout',
			'settings'     => 'archetype_boxed',
			'priority'     => 20,
			'type'         => 'checkbox',
		) );

		/**
		 * Boxed background color
		 */
		$wp_customize->add_setting( 'archetype_boxed_background_color', array(
			'default'            => apply_filters( 'archetype_default_boxed_background_color', '#f1f1f1' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_boxed_background_color', array(
			'label'        => __( 'Boxed background color', 'archetype' ),
			'description'  => __( 'Changes the background color of the boxed content wrapper. Does not affect change on the homepage.', 'archetype' ),
			'section'      => 'archetype_layout',
			'settings'     => 'archetype_boxed_background_color',
			'priority'     => 25,
		) ) );

		/**
		 * Emoji
		 */
		$wp_customize->add_section( 'archetype_emoji' , array(
			'title'        => __( 'Emoji', 'archetype' ),
			'priority'     => 30,
			'panel'        => 'archetype_general',
		) );

		$wp_customize->add_setting( 'archetype_no_emoji', array(
			'default'            => (bool) apply_filters( 'archetype_default_no_emoji', false ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_no_emoji', array(
			'label'        => __( 'No Emoji\'s', 'archetype' ),
			'description'  => __( 'Check this option to remove the Emoji resources from the document head.', 'archetype' ),
			'section'      => 'archetype_emoji',
			'settings'     => 'archetype_no_emoji',
			'type'         => 'checkbox',
		) );

		/**
		 * Add the Header panel
		 */
		$wp_customize->add_panel( 'archetype_header' , array(
			'title'        => __( 'Header', 'archetype' ),
			'description'  => __( 'Customize the look & feel of your header.', 'archetype' ),
			'priority'     => 35,
		) );

		/**
		 * Add the Header layout section
		 */
		$wp_customize->add_section( 'archetype_header_layout' , array(
			'title'        => __( 'Layout', 'archetype' ),
			'description'  => __( 'Customize the look & feel of your header layout.', 'archetype' ),
			'priority'     => 1,
			'panel'        => 'archetype_header',
		) );

		$wp_customize->add_setting( 'archetype_header_layout', array(
			'default'            => 'version-1',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( new Archetype_Radio_Image_Control( $wp_customize, 'archetype_header_layout', array(
			'label'        => __( 'Header Versions', 'archetype' ),
			'section'      => 'archetype_header_layout',
			'settings'     => 'archetype_header_layout',
			'priority'     => 5,
			'choices'      => array(
				'version-1'   => esc_url_raw( $customizer_images . 'header/version-1.png' ),
				'version-2'   => esc_url_raw( $customizer_images . 'header/version-2.png' ),
			),
		) ) );

		/**
		 * Header Background repeat
		 */
		$wp_customize->add_setting( 'archetype_header_background_repeat', array(
			'default'            => apply_filters( 'archetype_default_header_background_repeat', 'no-repeat' ),
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( new Archetype_Background_Repeat_Control( $wp_customize, 'archetype_header_background_repeat', array(
			'label'        => __( 'Background Repeat', 'archetype' ),
			'section'      => 'header_image',
			'settings'     => 'archetype_header_background_repeat',
			'priority'     => 20,
		) ) );

		/**
		 * Header Background position
		 */
		$wp_customize->add_setting( 'archetype_header_background_position', array(
			'default'            => apply_filters( 'archetype_default_header_background_position', 'center' ),
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( new Archetype_Background_Position_Control( $wp_customize, 'archetype_header_background_position', array(
			'label'        => __( 'Background Position', 'archetype' ),
			'section'      => 'header_image',
			'settings'     => 'archetype_header_background_position',
			'priority'     => 25,
		) ) );

		/**
		 * Header Background size
		 */
		$wp_customize->add_setting( 'archetype_header_background_size', array(
			'default'            => apply_filters( 'archetype_default_header_background_size', 'cover' ),
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_header_background_size', array(
			'label'        => __( 'Background Size', 'archetype' ),
			'section'      => 'header_image',
			'settings'     => 'archetype_header_background_size',
			'priority'     => 30,
			'type'         => 'select',
			'choices'      => array(
				'auto'        => 'Auto',
				'cover'       => 'Cover',
			),
		) );

		/**
		 * Add the Header colors section
		 */
		$wp_customize->add_section( 'archetype_header_colors' , array(
			'title'        => __( 'Colors', 'archetype' ),
			'description'  => __( 'Customize the look & feel of your header. These controls do not change menu colors.', 'archetype' ),
			'priority'     => 20,
			'panel'        => 'archetype_header',
		) );

		/**
		 * Header Background color
		 */
		$wp_customize->add_setting( 'archetype_header_background_color', array(
			'default'            => apply_filters( 'archetype_default_header_background_color', '#353b3f' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_header_background_color', array(
			'label'        => __( 'Background color', 'archetype' ),
			'section'      => 'archetype_header_colors',
			'settings'     => 'archetype_header_background_color',
			'priority'     => 10,
		) ) );

		/**
		 * Header Text Color
		 */
		$wp_customize->add_setting( 'archetype_header_text_color', array(
			'default'            => apply_filters( 'archetype_default_header_text_color', '#888' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_header_text_color', array(
			'label'        => __( 'Text color', 'archetype' ),
			'section'      => 'archetype_header_colors',
			'settings'     => 'archetype_header_text_color',
			'priority'     => 15,
		) ) );

		/**
		 * Header Link Color
		 */
		$wp_customize->add_setting( 'archetype_header_link_color', array(
			'default'            => apply_filters( 'archetype_default_header_link_color', '#aaa' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_header_link_color', array(
			'label'        => __( 'Link color', 'archetype' ),
			'section'      => 'archetype_header_colors',
			'settings'     => 'archetype_header_link_color',
			'priority'     => 20,
		) ) );

		/**
		 * Header Link Color Hover
		 */
		$wp_customize->add_setting( 'archetype_header_link_color_hover', array(
			'default'            => apply_filters( 'archetype_default_header_link_color_hover', '#ee543f' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_header_link_color_hover', array(
			'label'        => __( 'Link hover color', 'archetype' ),
			'section'      => 'archetype_header_colors',
			'settings'     => 'archetype_header_link_color_hover',
			'priority'     => 25,
		) ) );

		/**
		 * Add the Primary Menu Styles section
		 */
		$wp_customize->add_section( 'archetype_nav_styles' , array(
			'title'        => __( 'Primary Menu', 'archetype' ),
			'priority'     => 30,
			'description'  => __( 'The Primary Menu must be set to a menu location in order to preview style changes.', 'archetype' ),
			'panel'        => 'archetype_header',
		) );

		/**
		 * Primary Navigation Background Color
		 */
		$wp_customize->add_setting( 'archetype_nav_background_color', array(
			'default'            => apply_filters( 'archetype_default_nav_background_color', '#292e31' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_background_color', array(
			'label'        => __( 'Background color', 'archetype' ),
			'section'      => 'archetype_nav_styles',
			'settings'     => 'archetype_nav_background_color',
			'priority'     => 10,
		) ) );

		/**
		 * Primary Navigation Link Color
		 */
		$wp_customize->add_setting( 'archetype_nav_link_color', array(
			'default'            => apply_filters( 'archetype_default_nav_link_color', '#bbb' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_link_color', array(
			'label'        => __( 'Link color', 'archetype' ),
			'section'      => 'archetype_nav_styles',
			'settings'     => 'archetype_nav_link_color',
			'priority'     => 15,
		) ) );

		/**
		 * Primary Navigation Link Hover Color
		 */
		$wp_customize->add_setting( 'archetype_nav_link_hover_color', array(
			'default'            => apply_filters( 'archetype_default_nav_link_hover_color', '#fff' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_link_hover_color', array(
			'label'        => __( 'Link hover color', 'archetype' ),
			'section'      => 'archetype_nav_styles',
			'settings'     => 'archetype_nav_link_hover_color',
			'priority'     => 20,
		) ) );

		/**
		 * Primary Navigation Link Hover Background Color
		 */
		$wp_customize->add_setting( 'archetype_nav_link_hover_background_color', array(
			'default'            => apply_filters( 'archetype_default_nav_link_hover_background_color', '#2f3538' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_link_hover_background_color', array(
			'label'        => __( 'Link hover background color', 'archetype' ),
			'description'  => __( 'This setting does not effect top level links, only sub menus.', 'archetype' ),
			'section'      => 'archetype_nav_styles',
			'settings'     => 'archetype_nav_link_hover_background_color',
			'priority'     => 25,
		) ) );

		/**
		 * Primary Navigation Link Active Color
		 */
		$wp_customize->add_setting( 'archetype_nav_link_active_color', array(
			'default'            => apply_filters( 'archetype_default_nav_link_active_color', '#fff' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_link_active_color', array(
			'label'        => __( 'Link active color', 'archetype' ),
			'section'      => 'archetype_nav_styles',
			'settings'     => 'archetype_nav_link_active_color',
			'priority'     => 30,
		) ) );

		/**
		 * Primary Navigation Link Active Background Color
		 */
		$wp_customize->add_setting( 'archetype_nav_link_active_background_color', array(
			'default'            => apply_filters( 'archetype_default_nav_link_active_background_color', '#24282a' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_link_active_background_color', array(
			'label'        => __( 'Link active background color', 'archetype' ),
			'section'      => 'archetype_nav_styles',
			'settings'     => 'archetype_nav_link_active_background_color',
			'priority'     => 35,
		) ) );

		/**
		 * Add the Secondary Menu Styles section
		 */
		$wp_customize->add_section( 'archetype_nav_alt_styles' , array(
			'title'        => __( 'Secondary Menu', 'archetype' ),
			'priority'     => 35,
			'description'  => __( 'The Secondary Menu must be set to a menu location in order to preview style changes.', 'archetype' ),
			'panel'        => 'archetype_header',
		) );

		/**
		 * Secondary Navigation Color
		 */
		$wp_customize->add_setting( 'archetype_nav_alt_color', array(
			'default'            => apply_filters( 'archetype_default_nav_alt_color', '#bbb' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_alt_color', array(
			'label'        => __( 'Text color', 'archetype' ),
			'section'      => 'archetype_nav_alt_styles',
			'settings'     => 'archetype_nav_alt_color',
			'priority'     => 10,
		) ) );

		/**
		 * Secondary Navigation Background Color
		 */
		$wp_customize->add_setting( 'archetype_nav_alt_background_color', array(
			'default'            => apply_filters( 'archetype_default_nav_alt_background_color', '#41484d' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_alt_background_color', array(
			'label'        => __( 'Background color', 'archetype' ),
			'section'      => 'archetype_nav_alt_styles',
			'settings'     => 'archetype_nav_alt_background_color',
			'priority'     => 15,
		) ) );

		/**
		 * Secondary Navigation Link Color
		 */
		$wp_customize->add_setting( 'archetype_nav_alt_link_color', array(
			'default'            => apply_filters( 'archetype_default_nav_alt_link_color', '#ddd' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_alt_link_color', array(
			'label'        => __( 'Link color', 'archetype' ),
			'section'      => 'archetype_nav_alt_styles',
			'settings'     => 'archetype_nav_alt_link_color',
			'priority'     => 20,
		) ) );

		/**
		 * Secondary Navigation Link Hover Color
		 */
		$wp_customize->add_setting( 'archetype_nav_alt_link_hover_color', array(
			'default'            => apply_filters( 'archetype_default_nav_alt_link_hover_color', '#fff' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_alt_link_hover_color', array(
			'label'        => __( 'Link hover color', 'archetype' ),
			'section'      => 'archetype_nav_alt_styles',
			'settings'     => 'archetype_nav_alt_link_hover_color',
			'priority'     => 25,
		) ) );

		/**
		 * Secondary Navigation Link Hover Background Color
		 */
		$wp_customize->add_setting( 'archetype_nav_alt_link_hover_background_color', array(
			'default'            => apply_filters( 'archetype_default_nav_alt_link_hover_background_color', '#464e54' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_alt_link_hover_background_color', array(
			'label'        => __( 'Link hover background color', 'archetype' ),
			'description'  => __( 'This setting does not effect top level links, only sub menus.', 'archetype' ),
			'section'      => 'archetype_nav_alt_styles',
			'settings'     => 'archetype_nav_alt_link_hover_background_color',
			'priority'     => 30,
		) ) );

		/**
		 * Secondary Navigation Link Active Color
		 */
		$wp_customize->add_setting( 'archetype_nav_alt_link_active_color', array(
			'default'            => apply_filters( 'archetype_default_nav_alt_link_active_color', '#fff' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_alt_link_active_color', array(
			'label'        => __( 'Link active color', 'archetype' ),
			'section'      => 'archetype_nav_alt_styles',
			'settings'     => 'archetype_nav_alt_link_active_color',
			'priority'     => 35,
		) ) );

		/**
		 * Secondary Navigation Link Active Background Color
		 */
		$wp_customize->add_setting( 'archetype_nav_alt_link_active_background_color', array(
			'default'            => apply_filters( 'archetype_default_nav_alt_link_active_background_color', '#3b4146' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_alt_link_active_background_color', array(
			'label'        => __( 'Link active background color', 'archetype' ),
			'section'      => 'archetype_nav_alt_styles',
			'settings'     => 'archetype_nav_alt_link_active_background_color',
			'priority'     => 40,
		) ) );

		/**
		 * Add the Handheld Menu Styles section
		 */
		$wp_customize->add_section( 'archetype_nav_handheld_styles' , array(
			'title'        => __( 'Handheld Menu', 'archetype' ),
			'priority'     => 40,
			'description'  => __( 'The Handheld Menu must be set to a menu location in order to preview style changes, and your browser window must be below 768px for the menu to be visible.', 'archetype' ),
			'panel'        => 'archetype_header',
		) );

		/**
		 * Handheld Navigation Background Color
		 */
		$wp_customize->add_setting( 'archetype_nav_handheld_background_color', array(
			'default'            => apply_filters( 'archetype_default_nav_background_color', '#292e31' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_handheld_background_color', array(
			'label'        => __( 'Background color', 'archetype' ),
			'section'      => 'archetype_nav_handheld_styles',
			'settings'     => 'archetype_nav_handheld_background_color',
			'priority'     => 10,
		) ) );

		/**
		 * Handheld Navigation Link Color
		 */
		$wp_customize->add_setting( 'archetype_nav_handheld_link_color', array(
			'default'            => apply_filters( 'archetype_default_nav_link_color', '#bbb' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_handheld_link_color', array(
			'label'        => __( 'Link color', 'archetype' ),
			'section'      => 'archetype_nav_handheld_styles',
			'settings'     => 'archetype_nav_handheld_link_color',
			'priority'     => 15,
		) ) );

		/**
		 * Handheld Navigation Link Hover Color
		 */
		$wp_customize->add_setting( 'archetype_nav_handheld_link_hover_color', array(
			'default'            => apply_filters( 'archetype_default_nav_link_hover_color', '#fff' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_handheld_link_hover_color', array(
			'label'        => __( 'Link hover color', 'archetype' ),
			'section'      => 'archetype_nav_handheld_styles',
			'settings'     => 'archetype_nav_handheld_link_hover_color',
			'priority'     => 20,
		) ) );

		/**
		 * Handheld Navigation Link Hover Background Color
		 */
		$wp_customize->add_setting( 'archetype_nav_handheld_link_hover_background_color', array(
			'default'            => apply_filters( 'archetype_default_nav_link_hover_background_color', '#2f3538' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_handheld_link_hover_background_color', array(
			'label'        => __( 'Link hover background color', 'archetype' ),
			'section'      => 'archetype_nav_handheld_styles',
			'settings'     => 'archetype_nav_handheld_link_hover_background_color',
			'priority'     => 25,
		) ) );

		/**
		 * Handheld Navigation Link Active Color
		 */
		$wp_customize->add_setting( 'archetype_nav_handheld_link_active_color', array(
			'default'            => apply_filters( 'archetype_default_nav_link_active_color', '#fff' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_handheld_link_active_color', array(
			'label'        => __( 'Link active color', 'archetype' ),
			'section'      => 'archetype_nav_handheld_styles',
			'settings'     => 'archetype_nav_handheld_link_active_color',
			'priority'     => 30,
		) ) );

		/**
		 * Handheld Navigation Link Active Background Color
		 */
		$wp_customize->add_setting( 'archetype_nav_handheld_link_active_background_color', array(
			'default'            => apply_filters( 'archetype_default_nav_link_active_background_color', '#24282a' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_nav_handheld_link_active_background_color', array(
			'label'        => __( 'Link active background color', 'archetype' ),
			'section'      => 'archetype_nav_handheld_styles',
			'settings'     => 'archetype_nav_handheld_link_active_background_color',
			'priority'     => 35,
		) ) );

		/**
		 * Add the Homepage panel
		 */
		$wp_customize->add_panel( 'archetype_homepage' , array(
			'title'            => __( 'Homepage', 'archetype' ),
			'description'      => __( 'Customize the look & feel of your homepage.', 'archetype' ),
			'priority'         => 45,
			'active_callback'  => 'is_front_page',
		) );

		/**
		 * Add the Hero section
		 */
		$wp_customize->add_section( 'archetype_homepage_hero' , array(
			'title'        => __( 'Hero', 'archetype' ),
			'priority'     => 10,
			'description'  => __( 'Customize the look & feel of the hero component.', 'archetype' ),
			'panel'        => 'archetype_homepage',
		) );

		/**
		 * Layout
		 */
		$wp_customize->add_setting( 'archetype_homepage_hero_layout', array(
			'default'            => true,
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_homepage_hero_layout', array(
			'label'        => __( 'Full Width', 'archetype' ),
			'description'  => __( 'Toggle the width of the hero component.', 'archetype' ),
			'section'      => 'archetype_homepage_hero',
			'settings'     => 'archetype_homepage_hero_layout',
			'priority'     => 10,
			'type'         => 'checkbox',
		) );

		/**
		 * Alignment
		 */
		$wp_customize->add_setting( 'archetype_homepage_hero_alignment', array(
			'default'            => 'center',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_homepage_hero_alignment', array(
			'label'        => __( 'Text alignment', 'archetype' ),
			'section'      => 'archetype_homepage_hero',
			'settings'     => 'archetype_homepage_hero_alignment',
			'priority'     => 15,
			'type'         => 'radio',
			'choices'      => array(
				'left'        => 'Left',
				'center'      => 'Center',
				'right'       => 'Right',
			),
		) );

		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_homepage_hero_display_divider', array(
			'section'      => 'archetype_homepage_hero',
			'type'         => 'divider',
			'priority'     => 16,
		) ) );

		/**
		 * Background image
		 */
		$wp_customize->add_setting( 'archetype_homepage_hero_background_image', array(
			'default'            => '',
			'sanitize_callback'  => 'archetype_sanitize_integer',
		) );

		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'archetype_homepage_hero_background_image', array(
			'label'        => __( 'Background image', 'archetype' ),
			'section'      => 'archetype_homepage_hero',
			'settings'     => 'archetype_homepage_hero_background_image',
			'mime_type'    => 'image',
			'priority'     => 20,
		) ) );

		/**
		 * Background size
		 */
		$wp_customize->add_setting( 'archetype_homepage_hero_background_image_size', array(
			'default'            => 'auto',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_homepage_hero_background_image_size', array(
			'label'        => __( 'Background image size', 'archetype' ),
			'section'      => 'archetype_homepage_hero',
			'settings'     => 'archetype_homepage_hero_background_image_size',
			'priority'     => 25,
			'type'         => 'select',
			'choices'      => array(
				'auto'        => 'Auto',
				'cover'       => 'Cover',
			),
		) );

		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_homepage_hero_background_image_divider', array(
			'section'      => 'archetype_homepage_hero',
			'type'         => 'divider',
			'priority'     => 26,
		) ) );

		/**
		 * Background Color
		 */
		$wp_customize->add_setting( 'archetype_homepage_hero_background_color', array(
			'default'            => apply_filters( 'archetype_default_homepage_hero_background_color', '#353b3f' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_homepage_hero_background_color', array(
			'label'        => __( 'Background color', 'archetype' ),
			'section'      => 'archetype_homepage_hero',
			'settings'     => 'archetype_homepage_hero_background_color',
			'priority'     => 30,
		) ) );

		/**
		 * Heading text color
		 */
		$wp_customize->add_setting( 'archetype_homepage_hero_heading_color', array(
			'default'            => apply_filters( 'archetype_default_header_link_color', '#fff' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_homepage_hero_heading_color', array(
			'label'        => __( 'Heading text color', 'archetype' ),
			'section'      => 'archetype_homepage_hero',
			'settings'     => 'archetype_homepage_hero_heading_color',
			'priority'     => 35,
		) ) );

		/**
		 * Text color
		 */
		$wp_customize->add_setting( 'archetype_homepage_hero_text_color', array(
			'default'            => apply_filters( 'archetype_default_homepage_hero_text_color', '#888' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_homepage_hero_text_color', array(
			'label'        => __( 'Body text color', 'archetype' ),
			'section'      => 'archetype_homepage_hero',
			'settings'     => 'archetype_homepage_hero_text_color',
			'priority'     => 40,
		) ) );

		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_homepage_hero_color_divider', array(
			'section'      => 'archetype_homepage_hero',
			'type'         => 'divider',
			'priority'     => 41,
		) ) );

		/**
		 * Heading Text
		 */
		$wp_customize->add_setting( 'archetype_homepage_hero_heading_text', array(
			'default'            => __( 'Heading Text', 'archetype' ),
			'sanitize_callback'  => 'sanitize_text_field',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_homepage_hero_heading_text', array(
			'label'        => __( 'Heading text', 'archetype' ),
			'section'      => 'archetype_homepage_hero',
			'settings'     => 'archetype_homepage_hero_heading_text',
			'priority'     => 50,
			'type'         => 'text',
		) ) );

		/**
		 * Body Text
		 */
		$wp_customize->add_setting( 'archetype_homepage_hero_text', array(
			'default'            => __( 'Body Text', 'archetype' ),
			'sanitize_callback'  => 'archetype_sanitize_html',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_homepage_hero_text', array(
			'label'        => __( 'Body text', 'archetype' ),
			'section'      => 'archetype_homepage_hero',
			'settings'     => 'archetype_homepage_hero_text',
			'priority'     => 55,
			'type'         => 'textarea',
		) ) );

		/**
		 * Button Text
		 */
		$wp_customize->add_setting( 'archetype_homepage_hero_button_text', array(
			'default'            => __( 'Call to Action', 'archetype' ),
			'sanitize_callback'  => 'sanitize_text_field',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_homepage_hero_button_text', array(
			'label'        => __( 'Button text', 'archetype' ),
			'section'      => 'archetype_homepage_hero',
			'settings'     => 'archetype_homepage_hero_button_text',
			'priority'     => 60,
			'type'         => 'text',
		) ) );

		/**
		 * Button URL
		 */
		$wp_customize->add_setting( 'archetype_homepage_hero_button_url', array(
			'default'            => home_url(),
			'sanitize_callback'  => 'sanitize_text_field',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_homepage_hero_button_url', array(
			'label'        => __( 'Button url', 'archetype' ),
			'section'      => 'archetype_homepage_hero',
			'settings'     => 'archetype_homepage_hero_button_url',
			'priority'     => 65,
			'type'         => 'text',
		) ) );

		/** This filter is documented in inc/structure/homepage.php */
		$components = apply_filters( 'archetype_homepage_content_components', 3 );

		// Loop to create content sections.
		for ( $id = 1; $id <= absint( $components ); $id++ ) {
			$modifier = 2 < $id ? 5 : 0;
			$priority = ( $id + $modifier ) * 10;
			/**
			 * Content
			 */
			$wp_customize->add_section( 'archetype_homepage_content_' . $id, array(
				'title'        => sprintf( __( 'Content (%s)', 'archetype' ), $id ),
				'description'  => __( 'Customize the look & feel of this content component.', 'archetype' ),
				'priority'     => $priority,
				'panel'        => 'archetype_homepage',
			) );

			/**
			 * Content page
			 */
			$wp_customize->add_setting( 'archetype_homepage_content_' . $id, array(
				'default'            => 1 === $id ? get_option( 'page_on_front' ) : '',
				'sanitize_callback'  => 'archetype_sanitize_integer',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_homepage_content_' . $id, array(
				'label'        => __( 'Content page', 'archetype' ),
				'description'  => __( 'Choose which page the content is pulled from.', 'archetype' ),
				'section'      => 'archetype_homepage_content_' . $id,
				'settings'     => 'archetype_homepage_content_' . $id,
				'type'         => 'dropdown-pages',
			) ) );

			/**
			 * Alignment
			 */
			$wp_customize->add_setting( 'archetype_homepage_content_' . $id . '_alignment', array(
				'default'            => 'left',
				'sanitize_callback'  => 'archetype_sanitize_choices',
			) );

			$wp_customize->add_control( 'archetype_homepage_content_' . $id . '_alignment', array(
				'label'        => __( 'Text alignment', 'archetype' ),
				'section'      => 'archetype_homepage_content_' . $id,
				'settings'     => 'archetype_homepage_content_' . $id . '_alignment',
				'type'         => 'radio',
				'choices'      => array(
					'left'        => 'Left',
					'center'      => 'Center',
					'right'       => 'Right',
				),
			) );

			/**
			 * Content color
			 */
			$wp_customize->add_setting( 'archetype_homepage_content_' . $id . '_text_color', array(
				'default'            => apply_filters( 'archetype_default_homepage_content_' . $id . '_text_color', '#555' ),
				'sanitize_callback'  => 'archetype_sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_homepage_content_' . $id . '_text_color', array(
				'label'        => __( 'Text color', 'archetype' ),
				'section'      => 'archetype_homepage_content_' . $id,
				'settings'     => 'archetype_homepage_content_' . $id . '_text_color',
			) ) );

			/**
			 * Content background color
			 */
			$wp_customize->add_setting( 'archetype_homepage_content_' . $id . '_background_color', array(
				'default'            => apply_filters( 'archetype_default_homepage_content_' . $id . '_background_color', '#fff' ),
				'sanitize_callback'  => 'archetype_sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_homepage_content_' . $id . '_background_color', array(
				'label'        => __( 'Background color', 'archetype' ),
				'section'      => 'archetype_homepage_content_' . $id,
				'settings'     => 'archetype_homepage_content_' . $id . '_background_color',
			) ) );
		}

		/**
		 * Add the Content panel
		 */
		$wp_customize->add_panel( 'archetype_content' , array(
			'title'        => __( 'Content', 'archetype' ),
			'description'  => __( 'Customize the look & feel of your content.', 'archetype' ),
			'priority'     => 50,
		) );

		/**
		 * Add the Post section
		 */
		$wp_customize->add_section( 'archetype_post' , array(
			'title'        => __( 'Post', 'archetype' ),
			'priority'     => 5,
			'panel'        => 'archetype_content',
		) );

		/**
		 * Padded
		 */
		$wp_customize->add_setting( 'archetype_padded', array(
			'default'            => apply_filters( 'archetype_default_padded', true ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_padded', array(
			'label'        => __( 'Padded', 'archetype' ),
			'description'  => __( 'Adds padding to various elements such as page titles, posts and comments. Useful when the post background is a different color than the website background.', 'archetype' ),
			'section'      => 'archetype_post',
			'settings'     => 'archetype_padded',
			'type'         => 'checkbox',
			'priority'     => 1,
		) ) );

		/**
		 * Post Radius
		 */
		$wp_customize->add_setting( 'archetype_post_radius', array(
			'default'            => apply_filters( 'archetype_default_post_radius', 0 ),
			'sanitize_callback'  => 'archetype_sanitize_number',
		) );

		$wp_customize->add_control( new Archetype_Number_Customizer_Control( $wp_customize, 'archetype_post_radius', array(
			'label'        => __( 'Post border radius', 'archetype' ),
			'description'  => __( 'Adds border radius to various elements such as page titles, posts and comments.', 'archetype' ),
			'section'      => 'archetype_post',
			'settings'     => 'archetype_post_radius',
			'priority'     => 5,
		) ) );

		/**
		 * Avatar Radius
		 */
		$wp_customize->add_setting( 'archetype_avatar_radius', array(
			'default'            => apply_filters( 'archetype_default_avatar_radius', 3 ),
			'sanitize_callback'  => 'archetype_sanitize_number',
		) );

		$wp_customize->add_control( new Archetype_Number_Customizer_Control( $wp_customize, 'archetype_avatar_radius', array(
			'label'        => __( 'Avatar border radius', 'archetype' ),
			'description'  => __( 'Adds border radius to comment and author avatars.', 'archetype' ),
			'section'      => 'archetype_post',
			'settings'     => 'archetype_avatar_radius',
			'priority'     => 6,
		) ) );

		/**
		 * Post Background
		 */
		$wp_customize->add_setting( 'archetype_post_background_color', array(
			'default'            => apply_filters( 'archetype_default_post_background_color', '#fff' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_post_background_color', array(
			'label'        => __( 'Background color', 'archetype' ),
			'section'      => 'archetype_post',
			'settings'     => 'archetype_post_background_color',
			'priority'     => 10,
		) ) );

		/**
		 * Post Border
		 */
		$wp_customize->add_setting( 'archetype_post_border_color', array(
			'default'            => apply_filters( 'archetype_default_post_border_color', '#e5e5e5' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_post_border_color', array(
			'label'        => __( 'Border color', 'archetype' ),
			'section'      => 'archetype_post',
			'settings'     => 'archetype_post_border_color',
			'priority'     => 15,
		) ) );

		/**
		 * Post shadow toggle
		 */
		$wp_customize->add_setting( 'archetype_post_shadow_toggle', array(
			'default'            => apply_filters( 'archetype_default_post_shadow_toggle', true ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_post_shadow_toggle', array(
			'label'        => __( 'Display the post box shadow', 'archetype' ),
			'description'  => __( 'Toggle the display of the post box shadow.', 'archetype' ),
			'section'      => 'archetype_post',
			'settings'     => 'archetype_post_shadow_toggle',
			'type'         => 'checkbox',
			'priority'     => 20,
		) ) );

		/**
		 * Post shadow
		 */
		$wp_customize->add_setting( 'archetype_post_shadow_color', array(
			'default'            => apply_filters( 'archetype_default_post_shadow_color', '#8b949b' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_post_shadow_color', array(
			'label'        => __( 'Box shadow color', 'archetype' ),
			'section'      => 'archetype_post',
			'settings'     => 'archetype_post_shadow_color',
			'priority'     => 25,
		) ) );

		/**
		 * Add the typography section
		 */
		$wp_customize->add_section( 'archetype_typography' , array(
			'title'        => __( 'Typography', 'archetype' ),
			'description'  => __( 'Customize the look & feel of your typography.', 'archetype' ),
			'priority'     => 10,
			'panel'        => 'archetype_content',
		) );

		/**
		 * Text Color
		 */
		$wp_customize->add_setting( 'archetype_text_color', array(
			'default'            => apply_filters( 'archetype_default_text_color', '#555' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_text_color', array(
			'label'        => __( 'Text color', 'archetype' ),
			'description'  => __( 'The main text color on your website.', 'archetype' ),
			'section'      => 'archetype_typography',
			'settings'     => 'archetype_text_color',
			'priority'     => 1,
		) ) );

		/**
		 * Heading Color
		 */
		$wp_customize->add_setting( 'archetype_heading_color', array(
			'default'            => apply_filters( 'archetype_default_heading_color', '#333' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_heading_color', array(
			'label'        => __( 'Heading color', 'archetype' ),
			'description'  => __( 'The heading text color for h1-h6.', 'archetype' ),
			'section'      => 'archetype_typography',
			'settings'     => 'archetype_heading_color',
			'priority'     => 2,
		) ) );

		/**
		 * Link Color
		 */
		$wp_customize->add_setting( 'archetype_link_color', array(
			'default'            => apply_filters( 'archetype_default_link_color', '#ee543f' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_link_color', array(
			'label'        => __( 'Link color', 'archetype' ),
			'description'  => __( 'The global link color.', 'archetype' ),
			'section'      => 'archetype_typography',
			'settings'     => 'archetype_link_color',
			'priority'     => 3,
		) ) );

		/**
		 * Link Color Hover
		 */
		$wp_customize->add_setting( 'archetype_link_color_hover', array(
			'default'            => apply_filters( 'archetype_default_link_color_hover', '#111' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_link_color_hover', array(
			'label'        => __( 'Link hover color', 'archetype' ),
			'description'  => __( 'The global link hover color.', 'archetype' ),
			'section'      => 'archetype_typography',
			'settings'     => 'archetype_link_color_hover',
			'priority'     => 4,
		) ) );

		/**
		 * Widget Link Color
		 */
		$wp_customize->add_setting( 'archetype_widget_link_color', array(
			'default'            => apply_filters( 'archetype_default_widget_link_color', '#333' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_widget_link_color', array(
			'label'        => __( 'Widget link color', 'archetype' ),
			'description'  => __( 'Overrides the global link color for sidebar widgets.', 'archetype' ),
			'section'      => 'archetype_typography',
			'settings'     => 'archetype_widget_link_color',
			'priority'     => 5,
		) ) );

		/**
		 * Widget Link Color Hover
		 */
		$wp_customize->add_setting( 'archetype_widget_link_color_hover', array(
			'default'            => apply_filters( 'archetype_default_widget_link_color_hover', '#ee543f' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_widget_link_color_hover', array(
			'label'        => __( 'Widget link hover color', 'archetype' ),
			'description'  => __( 'Overrides the global link hover color for sidebar widgets.', 'archetype' ),
			'section'      => 'archetype_typography',
			'settings'     => 'archetype_widget_link_color_hover',
			'priority'     => 6,
		) ) );

		/**
		 * Add the Search Widget section
		 */
		$wp_customize->add_section( 'archetype_search' , array(
			'title'        => __( 'Search Widget', 'archetype' ),
			'priority'     => 15,
			'panel'        => 'archetype_content',
		) );

		/**
		 * Search border radius
		 */
		$wp_customize->add_setting( 'archetype_search_radius', array(
			'default'            => apply_filters( 'archetype_default_search_radius', 0 ),
			'sanitize_callback'  => 'archetype_sanitize_number',
		) );

		$wp_customize->add_control( new Archetype_Number_Customizer_Control( $wp_customize, 'archetype_search_radius', array(
			'label'        => __( 'Border radius', 'archetype' ),
			'section'      => 'archetype_search',
			'settings'     => 'archetype_search_radius',
			'priority'     => 5,
		) ) );

		/**
		 * Search Widget Text Color
		 */
		$wp_customize->add_setting( 'archetype_search_text_color', array(
			'default'            => apply_filters( 'archetype_default_search_text_color', '#555' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_search_text_color', array(
			'label'        => __( 'Text color', 'archetype' ),
			'section'      => 'archetype_search',
			'settings'     => 'archetype_search_text_color',
			'priority'     => 10,
		) ) );

		/**
		 * Search Widget Background Color
		 */
		$wp_customize->add_setting( 'archetype_search_background_color', array(
			'default'            => apply_filters( 'archetype_default_search_background_color', '#fff' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_search_background_color', array(
			'label'        => __( 'Background color', 'archetype' ),
			'section'      => 'archetype_search',
			'settings'     => 'archetype_search_background_color',
			'priority'     => 15,
		) ) );

		/**
		 * Search shadow toggle
		 */
		$wp_customize->add_setting( 'archetype_search_shadow_toggle', array(
			'default'            => apply_filters( 'archetype_default_search_shadow_toggle', true ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_search_shadow_toggle', array(
			'label'        => __( 'Display the search box shadow', 'archetype' ),
			'description'  => __( 'Toggle the display of the search input box shadow.', 'archetype' ),
			'section'      => 'archetype_search',
			'settings'     => 'archetype_search_shadow_toggle',
			'type'         => 'checkbox',
			'priority'     => 20,
		) ) );

		/**
		 * Search Widget Shadow Color
		 */
		$wp_customize->add_setting( 'archetype_search_shadow_color', array(
			'default'            => apply_filters( 'archetype_default_search_shadow_color', '#8b949b' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_search_shadow_color', array(
			'label'        => __( 'Box shadow color', 'archetype' ),
			'section'      => 'archetype_search',
			'settings'     => 'archetype_search_shadow_color',
			'priority'     => 25,
		) ) );

		/**
		 * Add the Forms section
		 */
		$wp_customize->add_section( 'archetype_forms' , array(
			'title'        => __( 'Form Inputs & Textareas', 'archetype' ),
			'priority'     => 20,
			'panel'        => 'archetype_content',
		) );

		/**
		 * Form Text Color
		 */
		$wp_customize->add_setting( 'archetype_form_text_color', array(
			'default'            => apply_filters( 'archetype_default_form_text_color', '#555' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_form_text_color', array(
			'label'        => __( 'Text color', 'archetype' ),
			'section'      => 'archetype_forms',
			'settings'     => 'archetype_form_text_color',
			'priority'     => 10,
		) ) );

		/**
		 * Form Background Color
		 */
		$wp_customize->add_setting( 'archetype_form_background_color', array(
			'default'            => apply_filters( 'archetype_default_form_background_color', '#e4e4e4' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_form_background_color', array(
			'label'        => __( 'Background color', 'archetype' ),
			'section'      => 'archetype_forms',
			'settings'     => 'archetype_form_background_color',
			'priority'     => 15,
		) ) );

		/**
		 * Form Focus Text Color
		 */
		$wp_customize->add_setting( 'archetype_form_text_focus_color', array(
			'default'            => apply_filters( 'archetype_default_form_text_focus_color', '#3b3b3b' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_form_text_focus_color', array(
			'label'        => __( 'Text focus color', 'archetype' ),
			'section'      => 'archetype_forms',
			'settings'     => 'archetype_form_text_focus_color',
			'priority'     => 20,
		) ) );

		/**
		 * Form Focus Background Color
		 */
		$wp_customize->add_setting( 'archetype_form_background_focus_color', array(
			'default'            => apply_filters( 'archetype_default_form_background_focus_color', '#d7d7d7' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_form_background_focus_color', array(
			'label'        => __( 'Background focus color', 'archetype' ),
			'section'      => 'archetype_forms',
			'settings'     => 'archetype_form_background_focus_color',
			'priority'     => 25,
		) ) );

		/**
		 * Buttons section
		 */
		$wp_customize->add_section( 'archetype_buttons' , array(
			'title'        => __( 'Buttons', 'archetype' ),
			'priority'     => 25,
			'panel'        => 'archetype_content',
		) );

		/**
		 * Button 2D
		 */
		$wp_customize->add_setting( 'archetype_button_2d', array(
			'default'            => apply_filters( 'archetype_default_button_2d', false ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_button_2d', array(
			'label'        => __( '2D Buttons', 'archetype' ),
			'section'      => 'archetype_buttons',
			'settings'     => 'archetype_button_2d',
			'priority'     => 1,
			'type'         => 'checkbox',
		) ) );

		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_button_2d_text', array(
			'section'      => 'archetype_buttons',
			'type'         => 'text',
			'description'  => __( 'Checking 2D will remove the shadow effect.', 'archetype' ),
			'priority'     => 2,
		) ) );

		/**
		 * Button Radius
		 */
		$wp_customize->add_setting( 'archetype_button_radius', array(
			'default'            => apply_filters( 'archetype_default_button_radius', 3 ),
			'sanitize_callback'  => 'archetype_sanitize_number',
		) );

		$wp_customize->add_control( new Archetype_Number_Customizer_Control( $wp_customize, 'archetype_button_radius', array(
			'label'        => __( 'Border radius', 'archetype' ),
			'section'      => 'archetype_buttons',
			'settings'     => 'archetype_button_radius',
			'priority'     => 3,
		) ) );

		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_button_text', array(
			'section'      => 'archetype_buttons',
			'type'         => 'text',
			'description'  => __( "It's important to note that the default button colors are used in many places as an accent color.", 'archetype' ),
			'priority'     => 4,
		) ) );

		/**
		 * Button text color
		 */
		$wp_customize->add_setting( 'archetype_button_text_color', array(
			'default'            => apply_filters( 'archetype_default_button_text_color', '#fff' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_text_color', array(
			'label'        => __( 'Text color', 'archetype' ),
			'section'      => 'archetype_buttons',
			'settings'     => 'archetype_button_text_color',
			'priority'     => 10,
		) ) );

		/**
		 * Button background color
		 */
		$wp_customize->add_setting( 'archetype_button_background_color', array(
			'default'            => apply_filters( 'archetype_default_button_background_color', '#ed543f' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_background_color', array(
			'label'        => __( 'Background color', 'archetype' ),
			'section'      => 'archetype_buttons',
			'settings'     => 'archetype_button_background_color',
			'priority'     => 15,
		) ) );

		/**
		 * Button border color
		 */
		$wp_customize->add_setting( 'archetype_button_border_color', array(
			'default'            => apply_filters( 'archetype_default_button_border_color', '#d94834' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_border_color', array(
			'label'        => __( 'Border color', 'archetype' ),
			'section'      => 'archetype_buttons',
			'settings'     => 'archetype_button_border_color',
			'priority'     => 20,
		) ) );

		/**
		 * Button shadow color
		 */
		$wp_customize->add_setting( 'archetype_button_shadow_color', array(
			'default'            => apply_filters( 'archetype_default_button_shadow_color', '#d94834' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_shadow_color', array(
			'label'        => __( 'Box shadow color', 'archetype' ),
			'section'      => 'archetype_buttons',
			'settings'     => 'archetype_button_shadow_color',
			'priority'     => 25,
		) ) );

		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_button_hover_text', array(
			'section'      => 'archetype_buttons',
			'type'         => 'text',
			'description'  => sprintf( __( 'Adding the %s class to your buttons will inverse their styles. Which means the hover colors will become the default state, and vice versa.', 'archetype' ), '<code>.alt</code>' ),
			'priority'     => 29,
		) ) );

		/**
		 * Button text hover color
		 */
		$wp_customize->add_setting( 'archetype_button_text_hover_color', array(
			'default'            => apply_filters( 'archetype_default_button_text_hover_color', '#555' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_text_hover_color', array(
			'label'        => __( 'Text alt/hover color', 'archetype' ),
			'section'      => 'archetype_buttons',
			'settings'     => 'archetype_button_text_hover_color',
			'priority'     => 30,
		) ) );

		/**
		 * Button background hover color
		 */
		$wp_customize->add_setting( 'archetype_button_background_hover_color', array(
			'default'            => apply_filters( 'archetype_default_button_background_hover_color', '#fff' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_background_hover_color', array(
			'label'        => __( 'Background alt/hover color', 'archetype' ),
			'section'      => 'archetype_buttons',
			'settings'     => 'archetype_button_background_hover_color',
			'priority'     => 35,
		) ) );

		/**
		 * Button border hover color
		 */
		$wp_customize->add_setting( 'archetype_button_border_hover_color', array(
			'default'            => apply_filters( 'archetype_default_button_border_hover_color', '#8b949b' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_border_hover_color', array(
			'label'        => __( 'Border alt/hover color', 'archetype' ),
			'section'      => 'archetype_buttons',
			'settings'     => 'archetype_button_border_hover_color',
			'priority'     => 40,
		) ) );

		/**
		 * Button shadow hover color
		 */
		$wp_customize->add_setting( 'archetype_button_shadow_hover_color', array(
			'default'            => apply_filters( 'archetype_default_button_shadow_hover_color', '#8b949b' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_button_shadow_hover_color', array(
			'label'        => __( 'Box shadow alt/hover color', 'archetype' ),
			'section'      => 'archetype_buttons',
			'settings'     => 'archetype_button_shadow_hover_color',
			'priority'     => 45,
		) ) );

		/**
		 * Add the Footer panel
		 */
		$wp_customize->add_panel( 'archetype_footer' , array(
			'title'        => __( 'Footer', 'archetype' ),
			'description'  => __( 'Customize the look & feel of your footer.', 'archetype' ),
			'priority'     => 55,
		) );

		/**
		 * Footer widgets section
		 */
		$wp_customize->add_section( 'archetype_footer_widgets' , array(
			'title'        => __( 'Widgets', 'archetype' ),
			'priority'     => 10,
			'panel'        => 'archetype_footer',
		) );

		/**
		 * Footer heading color
		 */
		$wp_customize->add_setting( 'archetype_footer_heading_color', array(
			'default'            => apply_filters( 'archetype_default_footer_heading_color', '#f1f1f1' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_heading_color', array(
			'label'        => __( 'Heading color', 'archetype' ),
			'section'      => 'archetype_footer_widgets',
			'settings'     => 'archetype_footer_heading_color',
		) ) );

		/**
		 * Footer text color
		 */
		$wp_customize->add_setting( 'archetype_footer_text_color', array(
			'default'            => apply_filters( 'archetype_default_footer_text_color', '#888' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_text_color', array(
			'label'        => __( 'Text color', 'archetype' ),
			'section'      => 'archetype_footer_widgets',
			'settings'     => 'archetype_footer_text_color',
		) ) );

		/**
		 * Footer link color
		 */
		$wp_customize->add_setting( 'archetype_footer_link_color', array(
			'default'            => apply_filters( 'archetype_default_footer_link_color', '#aaa' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_link_color', array(
			'label'        => __( 'Link color', 'archetype' ),
			'section'      => 'archetype_footer_widgets',
			'settings'     => 'archetype_footer_link_color',
		) ) );

		/**
		 * Footer link hover color
		 */
		$wp_customize->add_setting( 'archetype_footer_link_hover_color', array(
			'default'            => apply_filters( 'archetype_default_footer_link_hover_color', '#fff' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_link_hover_color', array(
			'label'        => __( 'Link hover color', 'archetype' ),
			'section'      => 'archetype_footer_widgets',
			'settings'     => 'archetype_footer_link_hover_color',
		) ) );

		/**
		 * Footer Background
		 */
		$wp_customize->add_setting( 'archetype_footer_background_color', array(
			'default'            => apply_filters( 'archetype_default_footer_background_color', '#353b3f' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_background_color', array(
			'label'        => __( 'Background color', 'archetype' ),
			'section'      => 'archetype_footer_widgets',
			'settings'     => 'archetype_footer_background_color',
		) ) );

		/**
		 * Footer info section
		 */
		$wp_customize->add_section( 'archetype_footer_info' , array(
			'title'        => __( 'Site Info', 'archetype' ),
			'priority'     => 15,
			'panel'        => 'archetype_footer',
		) );

		/**
		 * Credits
		 */
		$wp_customize->add_setting( 'archetype_footer_info_credits_toggle', array(
			'default'            => true,
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_footer_info_credits_toggle', array(
			'label'        => __( 'Display the footer credits', 'archetype' ),
			'description'  => __( 'Toggle the display of the footer credits.', 'archetype' ),
			'section'      => 'archetype_footer_info',
			'settings'     => 'archetype_footer_info_credits_toggle',
			'type'         => 'checkbox',
			'priority'     => 10,
		) ) );

		/**
		 * Lower footer text color
		 */
		$wp_customize->add_setting( 'archetype_footer_info_text_color', array(
			'default'            => apply_filters( 'archetype_default_footer_info_text_color', '#888' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_info_text_color', array(
			'label'        => __( 'Text color', 'archetype' ),
			'section'      => 'archetype_footer_info',
			'settings'     => 'archetype_footer_info_text_color',
			'priority'     => 15,
		) ) );

		/**
		 * Lower footer link color
		 */
		$wp_customize->add_setting( 'archetype_footer_info_link_color', array(
			'default'            => apply_filters( 'archetype_default_footer_info_link_color', '#aaa' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_info_link_color', array(
			'label'        => __( 'Link color', 'archetype' ),
			'section'      => 'archetype_footer_info',
			'settings'     => 'archetype_footer_info_link_color',
			'priority'     => 20,
		) ) );

		/**
		 * Lower footer link hover color
		 */
		$wp_customize->add_setting( 'archetype_footer_info_link_hover_color', array(
			'default'            => apply_filters( 'archetype_default_footer_info_link_hover_color', '#fff' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_info_link_hover_color', array(
			'label'        => __( 'Link hover color', 'archetype' ),
			'section'      => 'archetype_footer_info',
			'settings'     => 'archetype_footer_info_link_hover_color',
			'priority'     => 25,
		) ) );

		/**
		 * Lower footer Background
		 */
		$wp_customize->add_setting( 'archetype_footer_info_background_color', array(
			'default'            => apply_filters( 'archetype_default_footer_info_background_color', '#292e31' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
			'transport'          => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_info_background_color', array(
			'label'        => __( 'Background color', 'archetype' ),
			'section'      => 'archetype_footer_info',
			'settings'     => 'archetype_footer_info_background_color',
			'priority'     => 30,
		) ) );

	}

endif;
