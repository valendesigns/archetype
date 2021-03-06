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
		require_once dirname( __FILE__ ) . '/controls/autofocus.php';
		require_once dirname( __FILE__ ) . '/controls/export.php';
		require_once dirname( __FILE__ ) . '/controls/import.php';
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

		/**
		 * Add the General panel
		 */
		$wp_customize->add_panel( 'archetype_general', array(
			'title'        => __( 'General', 'archetype' ),
			'description'  => __( 'Customize the look & feel of your website.', 'archetype' ),
			'priority'     => 1,
		) );

		/**
		 * Layout
		 */
		$wp_customize->add_section( 'archetype_layout', array(
			'title'        => __( 'Layout', 'archetype' ),
			'priority'     => 21,
			'panel'        => 'archetype_general',
		) );

		$wp_customize->add_setting( 'archetype_layout', array(
			'default'            => 'right',
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( new Archetype_Sidebar_Layout_Control( $wp_customize, 'archetype_layout', array(
			'label'        => __( 'Sidebar Position', 'archetype' ),
			'section'      => 'archetype_layout',
			'settings'     => 'archetype_layout',
			'priority'     => 5,
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

		/**
		 * Header layout
		 */
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
		 * Site header padding title
		 */
		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_site_header_padding_title', array(
			'section'      => 'archetype_header_layout',
			'type'         => 'heading',
			'label'        => __( 'Site Header Padding', 'archetype' ),
			'priority'     => 15,
		) ) );

		/**
		 * Site header padding text
		 */
		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_site_header_padding_text', array(
			'section'      => 'archetype_header_layout',
			'type'         => 'text',
			'description' => __( 'Padding top & bottom will only add padding to the inside of the Site Header component, which contains the logo. The value must be numeric like .5 or 1 and will have em automatically added to the end.', 'archetype' ),
			'priority'     => 20,
		) ) );

		/**
		 * Site header padding top
		 */
		$wp_customize->add_setting( 'archetype_site_header_padding_top', array(
			'sanitize_callback' => 'archetype_sanitize_number',
		) );

		$wp_customize->add_control( new Archetype_Number_Customizer_Control( $wp_customize, 'archetype_site_header_padding_top', array(
			'label'       => __( 'Top', 'archetype' ),
			'section'     => 'archetype_header_layout',
			'settings'    => 'archetype_site_header_padding_top',
			'priority'    => 25,
		) ) );

		/**
		 * Site header padding bottom
		 */
		$wp_customize->add_setting( 'archetype_site_header_padding_bottom', array(
			'sanitize_callback' => 'archetype_sanitize_number',
		) );

		$wp_customize->add_control( new Archetype_Number_Customizer_Control( $wp_customize, 'archetype_site_header_padding_bottom', array(
			'label'       => __( 'Bottom', 'archetype' ),
			'section'     => 'archetype_header_layout',
			'settings'    => 'archetype_site_header_padding_bottom',
			'priority'    => 30,
		) ) );

		if ( class_exists( 'Subscribe_And_Connect', false ) ) {
			/**
			 * Add the header Subscribe & Connect section
			 */
			$wp_customize->add_section( 'archetype_header_subscribe_and_connect' , array(
				'title'        => __( 'Subscribe & Connect', 'archetype' ),
				'description'  => __( 'Customize the look & feel of Subscribe & Connect in the header.', 'archetype' ),
				'priority'     => 5,
				'panel'        => 'archetype_header',
			) );

			/**
			 * Header Subscribe & Connect theme override
			 */
			$wp_customize->add_setting( 'archetype_header_subscribe_and_connect_theme_override', array(
				'default'            => apply_filters( 'archetype_default_header_subscribe_and_connect_theme_override', false ),
				'sanitize_callback'  => 'archetype_sanitize_checkbox',
			) );

			$wp_customize->add_control( 'archetype_header_subscribe_and_connect_theme_override', array(
				'label'        => __( 'Override icon style', 'archetype' ),
				'section'      => 'archetype_header_subscribe_and_connect',
				'settings'     => 'archetype_header_subscribe_and_connect_theme_override',
				'type'         => 'checkbox',
			) );

			/**
			 * Header Subscribe & Connect theme
			 */
			$wp_customize->add_setting( 'archetype_header_subscribe_and_connect_theme', array(
				'default'            => apply_filters( 'archetype_default_header_subscribe_and_connect_theme', 'none' ),
				'sanitize_callback'  => 'archetype_sanitize_choices',
			) );

			$wp_customize->add_control( 'archetype_header_subscribe_and_connect_theme', array(
				'label'        => __( 'Icon style', 'archetype' ),
				'section'      => 'archetype_header_subscribe_and_connect',
				'settings'     => 'archetype_header_subscribe_and_connect_theme',
				'type'         => 'select',
				'choices'      => array(
					'none'        => __( 'No style', 'archetype' ),
					'icons'       => __( 'Icons Only', 'archetype' ),
					'boxed'       => __( 'Boxed', 'archetype' ),
					'rounded'     => __( 'Rounded', 'archetype' ),
					'circular'    => __( 'Circular', 'archetype' ),
				),
			) );

			/**
			 * Header Subscribe & Connect background color
			 */
			$wp_customize->add_setting( 'archetype_header_subscribe_and_connect_background_color', array(
				'default'            => apply_filters( 'archetype_default_header_subscribe_and_connect_background_color', '' ),
				'sanitize_callback'  => 'archetype_sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_header_subscribe_and_connect_background_color', array(
				'label'        => __( 'Background color', 'archetype' ),
				'section'      => 'archetype_header_subscribe_and_connect',
				'settings'     => 'archetype_header_subscribe_and_connect_background_color',
			) ) );
		}

		if ( current_theme_supports( 'site-logo' ) && class_exists( 'Site_Logo', false ) ) {
			// Add tagline description.
			$wp_customize->get_section( 'title_tagline' )->description = __( 'Site Title & Tagline do not display when a logo is added.', 'archetype' );

			// Add the setting for our svg logo.
			$wp_customize->add_setting( 'archetype_site_logo_svg', array(
				'capability'        => 'manage_options',
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			) );

			// Add our image uploader.
			$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'archetype_site_logo_svg', array(
				'label'       => __( 'Logo SVG (Scalable Vector Graphics)', 'archetype' ),
				'description' => __( 'You must add the logo above. The logo acts as a fallback for browsers that do not support SVG images.', 'archetype' ),
				'section'     => 'title_tagline',
				'settings'    => 'archetype_site_logo_svg',
				'mime_type'   => 'image',
				'priority'    => 40,
			) ) );

			/**
			 * Logo Top Margin
			 */
			$wp_customize->add_setting( 'archetype_site_logo_margin_top', array(
				'capability'        => 'manage_options',
				'sanitize_callback' => 'archetype_sanitize_number',
				'transport'         => 'postMessage',
			) );

			$wp_customize->add_control( new Archetype_Number_Customizer_Control( $wp_customize, 'archetype_site_logo_margin_top', array(
				'label'       => __( 'Logo Margin Top', 'archetype' ),
				'description' => __( 'Margin top must be numeric, and an em value like .5 or 1', 'archetype' ),
				'section'     => 'title_tagline',
				'settings'    => 'archetype_site_logo_margin_top',
				'priority'    => 50,
			) ) );

			/**
			 * Logo Bottom Margin
			 */
			$wp_customize->add_setting( 'archetype_site_logo_margin_bottom', array(
				'capability'        => 'manage_options',
				'sanitize_callback' => 'archetype_sanitize_number',
				'transport'         => 'postMessage',
			) );

			$wp_customize->add_control( new Archetype_Number_Customizer_Control( $wp_customize, 'archetype_site_logo_margin_bottom', array(
				'label'       => __( 'Logo Margin Bottom', 'archetype' ),
				'description' => __( 'Margin bottom must be numeric, and an em value like .5 or 1', 'archetype' ),
				'section'     => 'title_tagline',
				'settings'    => 'archetype_site_logo_margin_bottom',
				'priority'    => 55,
			) ) );
		}

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
		 * Primary Navigation alignment
		 */
		$wp_customize->add_setting( 'archetype_nav_alignment', array(
			'default'            => apply_filters( 'archetype_default_nav_alignment', 'left' ),
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_nav_alignment', array(
			'label'        => __( 'Alignment', 'archetype' ),
			'section'      => 'archetype_nav_styles',
			'settings'     => 'archetype_nav_alignment',
			'priority'     => 5,
			'type'         => 'radio',
			'choices'      => array(
				'left'        => 'Left',
				'right'       => 'Right',
			),
		) );

		/**
		 * Primary Navigation pinned toggle
		 */
		$wp_customize->add_setting( 'archetype_nav_pinned', array(
			'default'            => apply_filters( 'archetype_default_nav_pinned', true ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_nav_pinned', array(
			'label'        => __( 'Toggle pinned', 'archetype' ),
			'description'  => __( 'Toggle if the primary menu should be pinned to the top of the screen as you scroll past. Screen must be 768px or above.', 'archetype' ),
			'section'      => 'archetype_nav_styles',
			'settings'     => 'archetype_nav_pinned',
			'type'         => 'checkbox',
			'priority'     => 6,
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
		 * Handheld Navigation pinned toggle
		 */
		$wp_customize->add_setting( 'archetype_nav_handheld_pinned', array(
			'default'            => apply_filters( 'archetype_default_nav_handheld_pinned', true ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_nav_handheld_pinned', array(
			'label'        => __( 'Toggle pinned', 'archetype' ),
			'description'  => __( 'Toggle if the handheld menu & logo should be pinned to the top of the screen as you scroll past. Screen must be greater than 600px and less than 768px.', 'archetype' ),
			'section'      => 'archetype_nav_handheld_styles',
			'settings'     => 'archetype_nav_handheld_pinned',
			'type'         => 'checkbox',
			'priority'     => 6,
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
		 * Add the Header Widgets section
		 */
		archetype_widgets_controls( $wp_customize, array(
			'title'                 => __( 'Widgets', 'archetype' ),
			'priority'              => 45,
			'panel'                 => 'archetype_header',
			'mod_base'              => 'header_widgets',
			'sidebar_id'            => 'header-1',
		) );

		/**
		 * Add the Homepage panel
		 */
		$wp_customize->add_panel( 'archetype_homepage' , array(
			'title'            => __( 'Homepage', 'archetype' ),
			'description'      => __( 'Customize the look & feel of your homepage.', 'archetype' ),
			'priority'         => 45,
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
		 * Hero Layout
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
		 * Hero Alignment
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
		 * Hero Background image
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
		 * Hero Background size
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
		 * Hero Background Color
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
		 * Hero overlay background color
		 */
		$wp_customize->add_setting( 'archetype_homepage_hero_overlay_background_color', array(
			'default'            => apply_filters( 'archetype_default_homepage_hero_overlay_background_color', '#000000' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_homepage_hero_overlay_background_color', array(
			'label'        => __( 'Overlay background color', 'archetype' ),
			'section'      => 'archetype_homepage_hero',
			'settings'     => 'archetype_homepage_hero_overlay_background_color',
			'priority'     => 31,
		) ) );

		/**
		 * Hero overlay opacity
		 */
		$wp_customize->add_setting( 'archetype_homepage_hero_overlay_opacity', array(
			'default'            => apply_filters( 'archetype_default_homepage_hero_overlay_opacity', '2' ),
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_homepage_hero_overlay_opacity', array(
			'label'        => __( 'Overlay opacity', 'archetype' ),
			'section'      => 'archetype_homepage_hero',
			'settings'     => 'archetype_homepage_hero_overlay_opacity',
			'priority'     => 32,
			'type'         => 'select',
			'choices'  		 => array(
				'0'           => '0%',
				'1'           => '10%',
				'2'           => '20%',
				'3'           => '30%',
				'4'           => '40%',
				'5'           => '50%',
				'6'           => '60%',
				'7'           => '70%',
				'8'           => '80%',
				'9'           => '90%',
			),
		) );

		/**
		 * Hero Heading text color
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
		 * Hero Text color
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
		 * Hero custom image
		 */
		$wp_customize->add_setting( 'archetype_homepage_hero_image', array(
			'default'            => '',
			'sanitize_callback'  => 'archetype_sanitize_integer',
		) );

		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'archetype_homepage_hero_image', array(
			'label'        => __( 'Custom image', 'archetype' ),
			'section'      => 'archetype_homepage_hero',
			'settings'     => 'archetype_homepage_hero_image',
			'mime_type'    => 'image',
			'priority'     => 45,
		) ) );

		/**
		 * Hero custom image position toggle
		 */
		$wp_customize->add_setting( 'archetype_homepage_hero_image_position_toggle', array(
			'default'            => apply_filters( 'archetype_default_homepage_hero_image_position_toggle', false ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_homepage_hero_image_position_toggle', array(
			'label'        => __( 'Toggle position', 'archetype' ),
			'description'  => __( 'Toggle the position of the image. This will add negative bottom and top margins. As well as, make the image touch the bottom of the hero container.', 'archetype' ),
			'section'      => 'archetype_homepage_hero',
			'settings'     => 'archetype_homepage_hero_image_position_toggle',
			'type'         => 'checkbox',
			'priority'     => 46,
		) );

		/**
		 * Hero custom image transition toggle
		 */
		$wp_customize->add_setting( 'archetype_homepage_hero_image_transition_toggle', array(
			'default'            => apply_filters( 'archetype_default_homepage_hero_image_transition_toggle', true ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_homepage_hero_image_transition_toggle', array(
			'label'        => __( 'Toggle transition', 'archetype' ),
			'description'  => __( 'Toggle the transition effects of the text and image.', 'archetype' ),
			'section'      => 'archetype_homepage_hero',
			'settings'     => 'archetype_homepage_hero_image_transition_toggle',
			'type'         => 'checkbox',
			'priority'     => 46,
		) );

		/**
		 * Hero custom image columns
		 */
		$wp_customize->add_setting( 'archetype_homepage_hero_image_columns', array(
			'default'            => apply_filters( 'archetype_default_homepage_hero_image_columns', '12' ),
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_homepage_hero_image_columns', array(
			'label'        => __( 'Custom image columns', 'archetype' ),
			'description'  => __( 'Choose the number of columns, out of a 12 column grid, that the image will occupy.', 'archetype' ),
			'section'      => 'archetype_homepage_hero',
			'settings'     => 'archetype_homepage_hero_image_columns',
			'type'         => 'select',
			'priority'     => 47,
			'choices'      => array(
				'3'           => '3',
				'4'           => '4',
				'5'           => '5',
				'6'           => '6',
				'7'           => '7',
				'8'           => '8',
				'9'           => '9',
				'12'          => '12',
			),
		) );

		/**
		 * Hero custom image alignment
		 */
		$wp_customize->add_setting( 'archetype_homepage_hero_image_alignment', array(
			'default'            => apply_filters( 'archetype_default_homepage_hero_image_alignment', 'right' ),
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_homepage_hero_image_alignment', array(
			'label'        => __( 'Custom image alignment', 'archetype' ),
			'section'      => 'archetype_homepage_hero',
			'settings'     => 'archetype_homepage_hero_image_alignment',
			'type'         => 'select',
			'priority'     => 48,
			'choices'      => array(
				'left'        => 'Left',
				'right'       => 'Right',
			),
		) );

		$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_homepage_hero_image_divider', array(
			'section'      => 'archetype_homepage_hero',
			'type'         => 'divider',
			'priority'     => 49,
		) ) );

		/**
		 * Hero Heading Text
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
		 * Hero Body Text
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
		 * Hero Button Text
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
		 * Hero Button URL
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

		/**
		 * Hero button #2 text
		 */
		$wp_customize->add_setting( 'archetype_homepage_hero_button_2_text', array(
			'default'            => apply_filters( 'archetype_default_homepage_hero_button_2_text', '' ),
			'sanitize_callback'  => 'sanitize_text_field',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_homepage_hero_button_2_text', array(
			'label'        => __( 'Button #2 text', 'archetype' ),
			'section'      => 'archetype_homepage_hero',
			'settings'     => 'archetype_homepage_hero_button_2_text',
			'priority'     => 65,
			'type'         => 'text',
		) ) );

		/**
		 * Hero button #2 URL
		 */
		$wp_customize->add_setting( 'archetype_homepage_hero_button_2_url', array(
			'default'            => apply_filters( 'archetype_default_homepage_hero_button_2_url', '' ),
			'sanitize_callback'  => 'sanitize_text_field',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_homepage_hero_button_2_url', array(
			'label'        => __( 'Button #2 url', 'archetype' ),
			'section'      => 'archetype_homepage_hero',
			'settings'     => 'archetype_homepage_hero_button_2_url',
			'priority'     => 70,
			'type'         => 'text',
		) ) );

		/**
		 * Hero button #2 alt toggle
		 */
		$wp_customize->add_setting( 'archetype_homepage_hero_button_2_alt_toggle', array(
			'default'            => apply_filters( 'archetype_default_homepage_hero_button_2_alt_toggle', true ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'archetype_homepage_hero_button_2_alt_toggle', array(
			'label'        => __( 'Button #2 inverse', 'archetype' ),
			'description'  => sprintf( __( 'Toggle the %s class, which will inverse the button styles.', 'archetype' ), '<code>.alt</code>' ),
			'section'      => 'archetype_homepage_hero',
			'settings'     => 'archetype_homepage_hero_button_2_alt_toggle',
			'type'         => 'checkbox',
			'priority'     => 75,
		) );

		/** This filter is documented in inc/structure/homepage.php */
		$widgets = apply_filters( 'archetype_homepage_widgets', 5 );

		// Loop over the homepage widgets.
		for ( $id = 1; $id <= absint( $widgets ); $id++ ) {
			$modifier = 2 < $id ? 5 : 0;
			$args = array(
				'title'      => sprintf( __( 'Widgets (%s)', 'archetype' ), $id ),
				'priority'   => ( $id + $modifier ) * 10,
				'panel'      => 'archetype_homepage',
				'mod_base'   => 'homepage_widgets_' . $id,
				'sidebar_id' => 'homepage-' . $id,
			);
			archetype_widgets_controls( $wp_customize, $args );
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
		 * Search padding
		 */
		$wp_customize->add_setting( 'archetype_search_padding', array(
			'default'            => apply_filters( 'archetype_default_search_padding', '0.75em 1em 0.75em 2.625em' ),
			'sanitize_callback'  => 'sanitize_text_field',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_search_padding', array(
			'label'        => __( 'Padding', 'archetype' ),
			'section'      => 'archetype_search',
			'settings'     => 'archetype_search_padding',
			'priority'     => 1,
			'type'         => 'text',
		) ) );

		/**
		 * Search icon toggle
		 */
		$wp_customize->add_setting( 'archetype_search_icon_toggle', array(
			'default'            => apply_filters( 'archetype_default_search_icon_toggle', true ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_search_icon_toggle', array(
			'label'        => __( 'Toggle search icon', 'archetype' ),
			'description'  => __( 'Toggle the display of the search icon.', 'archetype' ),
			'section'      => 'archetype_search',
			'settings'     => 'archetype_search_icon_toggle',
			'priority'     => 2,
			'type'         => 'checkbox',
		) ) );

		/**
		 * Search icon top
		 */
		$wp_customize->add_setting( 'archetype_search_icon_top', array(
			'default'            => apply_filters( 'archetype_default_search_icon_top', '.813em' ),
			'sanitize_callback'  => 'sanitize_text_field',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_search_icon_top', array(
			'label'        => __( 'Icon top', 'archetype' ),
			'section'      => 'archetype_search',
			'settings'     => 'archetype_search_icon_top',
			'priority'     => 3,
			'type'         => 'text',
		) ) );

		/**
		 * Search icon indent
		 */
		$wp_customize->add_setting( 'archetype_search_icon_indent', array(
			'default'            => apply_filters( 'archetype_default_search_icon_indent', '1em' ),
			'sanitize_callback'  => 'sanitize_text_field',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_search_icon_indent', array(
			'label'        => __( 'Icon indent', 'archetype' ),
			'section'      => 'archetype_search',
			'settings'     => 'archetype_search_icon_indent',
			'priority'     => 3,
			'type'         => 'text',
		) ) );

		/**
		 * Search border size
		 */
		$wp_customize->add_setting( 'archetype_search_border_size', array(
			'default'            => apply_filters( 'archetype_default_search_border_size', 0 ),
			'sanitize_callback'  => 'archetype_sanitize_number',
		) );

		$wp_customize->add_control( new Archetype_Number_Customizer_Control( $wp_customize, 'archetype_search_border_size', array(
			'label'        => __( 'Border size', 'archetype' ),
			'section'      => 'archetype_search',
			'settings'     => 'archetype_search_border_size',
			'priority'     => 6,
		) ) );

		/**
		 * Search border color
		 */
		$wp_customize->add_setting( 'archetype_search_border_color', array(
			'default'            => apply_filters( 'archetype_default_search_border_color', '' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_search_border_color', array(
			'label'        => __( 'Border color', 'archetype' ),
			'section'      => 'archetype_search',
			'settings'     => 'archetype_search_border_color',
			'priority'     => 9,
		) ) );

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
		 * Form padding
		 */
		$wp_customize->add_setting( 'archetype_form_padding', array(
			'default'            => apply_filters( 'archetype_default_form_padding', '.75em' ),
			'sanitize_callback'  => 'sanitize_text_field',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_form_padding', array(
			'label'        => __( 'Padding', 'archetype' ),
			'section'      => 'archetype_forms',
			'settings'     => 'archetype_form_padding',
			'priority'     => 1,
			'type'         => 'text',
		) ) );

		/**
		 * Form border radius
		 */
		$wp_customize->add_setting( 'archetype_form_radius', array(
			'default'            => apply_filters( 'archetype_default_form_radius', 0 ),
			'sanitize_callback'  => 'archetype_sanitize_number',
		) );

		$wp_customize->add_control( new Archetype_Number_Customizer_Control( $wp_customize, 'archetype_form_radius', array(
			'label'        => __( 'Border radius', 'archetype' ),
			'section'      => 'archetype_forms',
			'settings'     => 'archetype_form_radius',
			'priority'     => 2,
		) ) );

		/**
		 * Form border size
		 */
		$wp_customize->add_setting( 'archetype_form_border_size', array(
			'default'            => apply_filters( 'archetype_default_form_border_size', 0 ),
			'sanitize_callback'  => 'archetype_sanitize_number',
		) );

		$wp_customize->add_control( new Archetype_Number_Customizer_Control( $wp_customize, 'archetype_form_border_size', array(
			'label'        => __( 'Border size', 'archetype' ),
			'section'      => 'archetype_forms',
			'settings'     => 'archetype_form_border_size',
			'priority'     => 3,
		) ) );

		/**
		 * Form border color
		 */
		$wp_customize->add_setting( 'archetype_form_border_color', array(
			'default'            => apply_filters( 'archetype_default_form_border_color', '' ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_form_border_color', array(
			'label'        => __( 'Border color', 'archetype' ),
			'section'      => 'archetype_forms',
			'settings'     => 'archetype_form_border_color',
			'priority'     => 9,
		) ) );

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
		 * Button border size
		 */
		$wp_customize->add_setting( 'archetype_button_border_size', array(
			'default'            => apply_filters( 'archetype_default_button_border_size', 1 ),
			'sanitize_callback'  => 'archetype_sanitize_number',
		) );

		$wp_customize->add_control( new Archetype_Number_Customizer_Control( $wp_customize, 'archetype_button_border_size', array(
			'label'        => __( 'Border size', 'archetype' ),
			'section'      => 'archetype_buttons',
			'settings'     => 'archetype_button_border_size',
			'priority'     => 5,
		) ) );

		/**
		 * Button border toggle
		 */
		$wp_customize->add_setting( 'archetype_button_border_toggle', array(
			'default'            => apply_filters( 'archetype_default_button_border_toggle', false ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_button_border_toggle', array(
			'label'        => __( 'Toggle transparent borders', 'archetype' ),
			'description'  => __( 'Toggle the transparency of borders for all buttons.', 'archetype' ),
			'section'      => 'archetype_buttons',
			'settings'     => 'archetype_button_border_toggle',
			'priority'     => 6,
			'type'         => 'checkbox',
		) ) );

		/**
		 * Button italic toggle
		 */
		$wp_customize->add_setting( 'archetype_button_italic_toggle', array(
			'default'            => apply_filters( 'archetype_default_button_italic_toggle', false ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_button_italic_toggle', array(
			'label'        => __( 'Toggle italic', 'archetype' ),
			'description'  => __( 'Toggle the italic font style for all buttons.', 'archetype' ),
			'section'      => 'archetype_buttons',
			'settings'     => 'archetype_button_italic_toggle',
			'priority'     => 7,
			'type'         => 'checkbox',
		) ) );

		/**
		 * Button small-caps toggle
		 */
		$wp_customize->add_setting( 'archetype_button_small_caps_toggle', array(
			'default'            => apply_filters( 'archetype_default_button_small_caps_toggle', false ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_button_small_caps_toggle', array(
			'label'        => __( 'Toggle small-caps', 'archetype' ),
			'description'  => __( 'Toggle the small-caps font variant for all buttons.', 'archetype' ),
			'section'      => 'archetype_buttons',
			'settings'     => 'archetype_button_small_caps_toggle',
			'priority'     => 8,
			'type'         => 'checkbox',
		) ) );

		/**
		 * Button font-weight
		 */
		$wp_customize->add_setting( 'archetype_buttons_font_weight', array(
			'default'            => apply_filters( 'archetype_default_buttons_font_weight', '400' ),
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_buttons_font_weight', array(
			'label'        => __( 'Font weight', 'archetype' ),
			'description'  => __( '400 is the same as normal, and 700 is the same as bold.', 'archetype' ),
			'section'      => 'archetype_buttons',
			'settings'     => 'archetype_buttons_font_weight',
			'type'         => 'select',
			'priority'     => 9,
			'choices'      => array(
				'100'         => '100',
				'200'         => '200',
				'300'         => '300',
				'400'         => '400',
				'500'         => '500',
				'600'         => '600',
				'700'         => '700',
				'800'         => '800',
				'900'         => '900',
			),
		) );

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
		 * Add the Footer widgets section
		 */
		archetype_widgets_controls( $wp_customize, array(
			'title'                 => __( 'Widgets', 'archetype' ),
			'priority'              => 10,
			'panel'                 => 'archetype_footer',
			'mod_base'              => 'footer_widgets',
			'sidebar_id'            => 'footer-1',
			'heading_border_toggle' => false,
			'heading_color'         => '#f1f1f1',
			'text_color'            => '#888',
			'link_color'            => '#aaa',
			'link_color_hover'      => '#fff',
			'background_color'      => '#353b3f',
		) );

		if ( class_exists( 'Subscribe_And_Connect', false ) ) {
			/**
			 * Add the footer Subscribe & Connect section
			 */
			$wp_customize->add_section( 'archetype_footer_subscribe_and_connect' , array(
				'title'        => __( 'Subscribe & Connect', 'archetype' ),
				'description'  => __( 'Customize the look & feel of Subscribe & Connect in the footer.', 'archetype' ),
				'priority'     => 14,
				'panel'        => 'archetype_footer',
			) );

			/**
			 * Footer Subscribe & Connect theme override
			 */
			$wp_customize->add_setting( 'archetype_footer_subscribe_and_connect_theme_override', array(
				'default'            => apply_filters( 'archetype_default_footer_subscribe_and_connect_theme_override', false ),
				'sanitize_callback'  => 'archetype_sanitize_checkbox',
			) );

			$wp_customize->add_control( 'archetype_footer_subscribe_and_connect_theme_override', array(
				'label'        => __( 'Override icon style', 'archetype' ),
				'section'      => 'archetype_footer_subscribe_and_connect',
				'settings'     => 'archetype_footer_subscribe_and_connect_theme_override',
				'type'         => 'checkbox',
			) );

			/**
			 * Footer Subscribe & Connect theme
			 */
			$wp_customize->add_setting( 'archetype_footer_subscribe_and_connect_theme', array(
				'default'            => apply_filters( 'archetype_default_footer_subscribe_and_connect_theme', 'none' ),
				'sanitize_callback'  => 'archetype_sanitize_choices',
			) );

			$wp_customize->add_control( 'archetype_footer_subscribe_and_connect_theme', array(
				'label'        => __( 'Icon style', 'archetype' ),
				'section'      => 'archetype_footer_subscribe_and_connect',
				'settings'     => 'archetype_footer_subscribe_and_connect_theme',
				'type'         => 'select',
				'choices'      => array(
					'none'        => __( 'No style', 'archetype' ),
					'icons'       => __( 'Icons Only', 'archetype' ),
					'boxed'       => __( 'Boxed', 'archetype' ),
					'rounded'     => __( 'Rounded', 'archetype' ),
					'circular'    => __( 'Circular', 'archetype' ),
				),
			) );

			/**
			 * Footer Subscribe & Connect background color
			 */
			$wp_customize->add_setting( 'archetype_footer_subscribe_and_connect_background_color', array(
				'default'            => apply_filters( 'archetype_default_footer_subscribe_and_connect_background_color', '#24282a' ),
				'sanitize_callback'  => 'archetype_sanitize_hex_color',
				'transport'          => 'postMessage',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_footer_subscribe_and_connect_background_color', array(
				'label'        => __( 'Background color', 'archetype' ),
				'section'      => 'archetype_footer_subscribe_and_connect',
				'settings'     => 'archetype_footer_subscribe_and_connect_background_color',
			) ) );
		}

		/**
		 * Footer info section
		 */
		$wp_customize->add_section( 'archetype_footer_info' , array(
			'title'        => __( 'Site Info', 'archetype' ),
			'priority'     => 15,
			'panel'        => 'archetype_footer',
		) );

		if ( current_theme_supports( 'site-logo' ) && class_exists( 'Site_Logo', false ) ) {
			/**
			 * Footer info site logo toggle
			 */
			$wp_customize->add_setting( 'archetype_footer_info_site_logo_toggle', array(
				'default'            => true,
				'sanitize_callback'  => 'archetype_sanitize_checkbox',
			) );

			$wp_customize->add_control( 'archetype_footer_info_site_logo_toggle', array(
				'label'        => __( 'Display the site logo', 'archetype' ),
				'description'  => __( 'Toggle the display of the site logo.', 'archetype' ),
				'section'      => 'archetype_footer_info',
				'settings'     => 'archetype_footer_info_site_logo_toggle',
				'type'         => 'checkbox',
				'priority'     => 1,
			) );
		}

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
		 * Footer info line-height
		 */
		$wp_customize->add_setting( 'archetype_footer_info_line_height', array(
			'sanitize_callback' => 'archetype_sanitize_number',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( new Archetype_Number_Customizer_Control( $wp_customize, 'archetype_footer_info_line_height', array(
			'label'        => __( 'Credits line-height', 'archetype' ),
			'description'  => __( 'Override the default line-height for the credits text. Must be a numeric unit-less value like 1.5 or 2.', 'archetype' ),
			'section'      => 'archetype_footer_info',
			'settings'     => 'archetype_footer_info_line_height',
			'priority'     => 11,
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

		/**
		 * Footer info background image
		 */
		$wp_customize->add_setting( 'archetype_footer_info_background_image', array(
			'default'            => '',
			'sanitize_callback'  => 'archetype_sanitize_integer',
		) );

		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'archetype_footer_info_background_image', array(
			'label'        => __( 'Background image', 'archetype' ),
			'section'      => 'archetype_footer_info',
			'settings'     => 'archetype_footer_info_background_image',
			'mime_type'    => 'image',
			'priority'     => 35,
		) ) );

		/**
		 * Footer info background size
		 */
		$wp_customize->add_setting( 'archetype_footer_info_background_image_size', array(
			'default'           => apply_filters( 'archetype_default_footer_info_background_image_size', 'auto' ),
			'sanitize_callback' => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_footer_info_background_image_size', array(
			'label'        => __( 'Background image size', 'archetype' ),
			'section'      => 'archetype_footer_info',
			'settings'     => 'archetype_footer_info_background_image_size',
			'type'         => 'select',
			'priority'     => 40,
			'choices'      => array(
				'auto'        => 'Auto',
				'cover'       => 'Cover',
			),
		) );

		/**
		 * Add the Tools panel
		 */
		$wp_customize->add_panel( 'archetype_tools' , array(
			'title'        => __( 'Tools', 'archetype' ),
			'description'  => __( 'Customizer tools for administering your website.', 'archetype' ),
			'priority'     => 10000000,
		) );

		/**
		 * Import Section
		 */
		$wp_customize->add_section( 'archetype_tools_import', array(
			'title'        => __( 'Import', 'archetype' ),
			'priority'     => 10,
			'panel'        => 'archetype_tools',
		) );

		/**
		 * Add an empty import setting.
		 */
		$wp_customize->add_setting( 'archetype_tools_import', array(
			'capability'        => 'manage_options',
			'default'           => '',
			'sanitize_callback' => 'archetype_sanitize_import_export',
			'type'              => 'none',
		) );

		if ( ! current_user_can( 'manage_options' ) ) {
			/**
			 * Add the import Customizer control.
			 */
			$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_tools_import_text', array(
				'section'      => 'archetype_tools_import',
				'settings'     => 'archetype_tools_import',
				'type'         => 'text',
				'description'  => __( 'You do not have the capability role to import customizer settings.', 'archetype' ),
			) ) );
		}

		/**
		 * Add the import Customizer control.
		 */
		$wp_customize->add_control( new Archetype_Import_Control( $wp_customize, 'archetype_import_customizer', array(
			'label'        => __( 'Import', 'archetype' ),
			'section'      => 'archetype_tools_import',
			'settings'     => 'archetype_tools_import',
			'description'  => __( 'Upload a file to import customization settings for this theme.', 'archetype' ),
		) ) );

		/**
		 * Export Section
		 */
		$wp_customize->add_section( 'archetype_tools_export', array(
			'title'        => __( 'Export', 'archetype' ),
			'priority'     => 15,
			'panel'        => 'archetype_tools',
		) );

		/**
		 * Add an empty export setting.
		 */
		$wp_customize->add_setting( 'archetype_tools_export', array(
			'capability'        => 'manage_options',
			'default'           => '',
			'sanitize_callback' => 'archetype_sanitize_import_export',
			'type'              => 'none',
		) );

		if ( ! current_user_can( 'manage_options' ) ) {
			/**
			 * Add the import Customizer control.
			 */
			$wp_customize->add_control( new Archetype_Arbitrary_Control( $wp_customize, 'archetype_tools_export_text', array(
				'section'     => 'archetype_tools_export',
				'settings'    => 'archetype_tools_export',
				'type'        => 'text',
				'description' => __( 'You do not have the capability role to import or export customizer settings.', 'archetype' ),
			) ) );
		}

		/**
		 * Add the export Customizer control.
		 */
		$wp_customize->add_control( new Archetype_Export_Control( $wp_customize, 'archetype_export_customizer', array(
			'label'        => __( 'Export', 'archetype' ),
			'section'      => 'archetype_tools_export',
			'settings'     => 'archetype_tools_export',
			'description'  => __( 'Click the button below to export the customization settings for this theme.', 'archetype' ),
			'priority'     => 3,
		) ) );

	}

endif;
