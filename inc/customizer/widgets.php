<?php
/**
 * Archetype Customizer widget functions
 *
 * @package Archetype
 * @subpackage Customize
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_widgets_classes' ) ) :
	/**
	 * Builds a widget area CSS classes array.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args An array of arguments that override the defaults.
	 */
	function archetype_widgets_classes( $args = array() ) {
		$classes = array();

		$defaults = array(
			'mod_base'              => '',
			'class_name'            => '',
			'full_width_toggle'     => false,
			'columns'               => 'widget-cols-3',
			'gutters_toggle'        => true,
			'padding_toggle'        => true,
			'inner_padding_toggle'  => false,
			'heading_border_toggle' => true,
			'bottom_margin_toggle'  => true,
			'alignment'             => 'left',
			'expand'                => false,
		);

		$args = wp_parse_args( $args, $defaults );
		extract( $args, EXTR_SKIP );

		if ( empty( $mod_base ) ) {
			return $classes;
		}

		$get_full_width = archetype_sanitize_checkbox( get_theme_mod( 'archetype_' . $mod_base . '_full_width_toggle', apply_filters( 'archetype_default_' . $mod_base . '_full_width_toggle', $full_width_toggle ) ) );

		$get_columns = esc_attr( get_theme_mod( 'archetype_' . $mod_base . '_columns', apply_filters( 'archetype_default_' . $mod_base . '_columns', $columns ) ) );

		$get_gutters_toggle = archetype_sanitize_checkbox( get_theme_mod( 'archetype_' . $mod_base . '_gutters_toggle', apply_filters( 'archetype_default_' . $mod_base . '_gutters_toggle', $gutters_toggle ) ) );

		$get_padding_toggle = archetype_sanitize_checkbox( get_theme_mod( 'archetype_' . $mod_base . '_padding_toggle', apply_filters( 'archetype_default_' . $mod_base . '_padding_toggle', $padding_toggle ) ) );

		$get_inner_padding_toggle = archetype_sanitize_checkbox( get_theme_mod( 'archetype_' . $mod_base . '_inner_padding_toggle', apply_filters( 'archetype_default_' . $mod_base . '_inner_padding_toggle', $inner_padding_toggle ) ) );

		$get_heading_border_toggle = archetype_sanitize_checkbox( get_theme_mod( 'archetype_' . $mod_base . '_heading_border_toggle', apply_filters( 'archetype_default_' . $mod_base . '_heading_border_toggle', $heading_border_toggle ) ) );

		$get_bottom_margin_toggle = archetype_sanitize_checkbox( get_theme_mod( 'archetype_' . $mod_base . '_bottom_margin_toggle', apply_filters( 'archetype_default_' . $mod_base . '_bottom_margin_toggle', $bottom_margin_toggle ) ) );

		$get_alignment = esc_attr( get_theme_mod( 'archetype_' . $mod_base . '_alignment', apply_filters( 'archetype_default_' . $mod_base . '_alignment', $alignment ) ) );

		// CSS classes.
		$classes[] = 'archetype-widgets-section';
		$classes[] = $class_name;
		$classes[] = $get_alignment;

		if ( true === $expand ) {
			$classes[] = 'expand-column';
		}

		if ( true === $get_full_width ) {
			$classes[] = 'full-width-column';
		}

		$classes[] = $get_columns;

		if ( false === $get_gutters_toggle ) {
			$classes[] = 'no-gutters';
		}

		if ( true === $get_padding_toggle ) {
			$classes[] = 'add-padding';
		}

		if ( true === $get_inner_padding_toggle ) {
			$classes[] = 'add-inner-padding';
		}

		if ( false === $get_heading_border_toggle ) {
			$classes[] = 'no-heading-border';
		}

		if ( true === $get_bottom_margin_toggle ) {
			$classes[] = 'add-bottom-margin';
		}

		/**
		 * Filter the CSS classes added to the section tag.
		 *
		 * @since 1.0.0
		 *
		 * @param array $classes Array of CSS classes.
		 * @param array $args The arguments array.
		 */
		$classes = apply_filters( 'archetype_widgets_classes', $classes, $args );

		return $classes;
	}
endif;

if ( ! function_exists( 'archetype_widgets_display' ) ) :
	/**
	 * Builds CSS display styles for a widget area.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args An array of arguments that override the defaults.
	 * @return string CSS styles.
	 */
	function archetype_widgets_display( $args = array() ) {
		$style = '';

		$defaults = array(
			'mod_base'                  => '',
			'class_name'                => '',
			'heading_color'             => '#333',
			'text_color'                => '#555',
			'link_color'                => '#ee543f',
			'link_color_hover'          => '#111',
			'background_color'          => '#f1f1f1',
			'background_image_repeat'   => 'no-repeat',
			'background_image_position' => 'center',
			'background_image_size'     => 'auto',
		);

		$args = wp_parse_args( $args, $defaults );
		extract( $args, EXTR_SKIP );

		if ( empty( $mod_base ) || empty( $class_name ) ) {
			return $style;
		}

		// Heading color.
		$get_heading_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_' . $mod_base . '_heading_color', apply_filters( 'archetype_default_' . $mod_base . '_heading_color', $heading_color ) ) );

		// Text color.
		$get_text_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_' . $mod_base . '_text_color', apply_filters( 'archetype_default_' . $mod_base . '_text_color', $text_color ) ) );

		// Link color.
		$get_link_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_' . $mod_base . '_link_color', apply_filters( 'archetype_default_' . $mod_base . '_link_color', $link_color ) ) );

		// Link hover color.
		$get_link_color_hover = archetype_sanitize_hex_color( get_theme_mod( 'archetype_' . $mod_base . '_link_color_hover', apply_filters( 'archetype_default_' . $mod_base . '_link_color_hover', $link_color_hover ) ) );

		// Background color.
		$get_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_' . $mod_base . '_background_color', apply_filters( 'archetype_default_' . $mod_base . '_background_color', $background_color ) ) );

		// Background image.
		$get_background_image_src = wp_get_attachment_image_src( archetype_sanitize_integer( get_theme_mod( 'archetype_' . $mod_base . '_background_image', '' ) ), 'full' );
		$get_background_image = isset( $get_background_image_src[0] ) ? $get_background_image_src[0] : '';

		// Background image repeat.
		$get_background_image_repeat = esc_attr( get_theme_mod( 'archetype_' . $mod_base . '_background_image_repeat', apply_filters( 'archetype_default_' . $mod_base . '_background_image_repeat', $background_image_repeat ) ) );

		// Background image position.
		$get_background_image_position = esc_attr( get_theme_mod( 'archetype_' . $mod_base . '_background_image_position', apply_filters( 'archetype_default_' . $mod_base . '_background_image_position', $background_image_position ) ) );

		// Background image size.
		$get_background_image_size = esc_attr( get_theme_mod( 'archetype_' . $mod_base . '_background_image_size', apply_filters( 'archetype_default_' . $mod_base . '_background_image_size', $background_image_size ) ) );

		// CSS style attributes.
		$attrs = '';
		$title_attrs = '';

		if ( $heading_color !== $get_heading_color ) {
			$title_attrs .= "color: $get_heading_color;";
		}

		if ( $text_color !== $get_text_color ) {
			$attrs .= "color: $get_text_color;";
			$title_attrs .= "border-color: $get_text_color;";
		}

		if ( $background_color !== $get_background_color ) {
			$attrs .= "background-color: $get_background_color;";
		}

		if ( ! empty( $get_background_image ) ) {
			$attrs .= "background-image: url($get_background_image);";

			$positions = explode( '-', $get_background_image_position );
			if ( 1 === count( $positions ) ) {
				$positions = array( 'center', 'center' );
			}
			list( $x, $y ) = $positions;

			if ( is_numeric( $get_background_image_size ) ) {
				if ( 'left' === $x || 'right' === $x ) {
					$new_x = ( 'left' === $x ? 'right' : 'left' );
					$style .= "
					.$class_name {
							background-position: $x $y;
							background-size: cover;
							background-repeat: no-repeat;
					}
					@media screen and (min-width: 768px) {
						.$class_name {
							background-position: $new_x 50vw $y;
							background-size: auto;
						}
					}";
				}
			} else {
				$attrs .= "background-size: $get_background_image_size;";
				$attrs .= "background-position: $x $y;";
				$attrs .= "background-repeat: $get_background_image_repeat;";
			}
		}

		if ( ! empty( $attrs ) ) {
			$style .= "
			.$class_name {
				$attrs
			}";
		}

		if ( ! empty( $title_attrs ) ) {
			$style .= "
			.$class_name .widget h3.widget-title {
				$title_attrs
			}";
		}

		if ( $link_color !== $get_link_color ) {
			$style .= "
			.$class_name a:not(.button) {
				color: $get_link_color;
			}
			.$class_name a:not(.button):focus {
				outline-color: $get_link_color;
			}";
		}

		if ( $link_color_hover !== $get_link_color_hover ) {
			$style .= "
			.$class_name a:not(.button):hover {
				color: $get_link_color_hover;
			}";
		}

		/**
		 * Filter the CSS styles.
		 *
		 * @since 1.0.0
		 *
		 * @param string $style The CSS styles.
		 * @param array  $args The arguments array.
		 */
		$style = apply_filters( 'archetype_widgets_display', $style, $args );

		return $style;
	}
endif;

if ( ! function_exists( 'archetype_widgets_controls' ) ) :
	/**
	 * Builds widget area Customizer controls.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param array                $args An array of arguments that override the defaults.
	 */
	function archetype_widgets_controls( $wp_customize, $args = array() ) {
		if ( false === $wp_customize instanceof WP_Customize_Manager ) {
			return;
		}

		$defaults = array(
			'title'                     => __( 'Widgets', 'archetype' ),
			'description'               => __( 'Customize the look & feel of this widget area.', 'archetype' ),
			'priority'                  => 10,
			'panel'                     => '',
			'mod_base'                  => '',
			'sidebar_id'                => '',
			'full_width_toggle'         => false,
			'columns'                   => 'widget-cols-3',
			'gutters_toggle'            => true,
			'padding_toggle'            => true,
			'inner_padding_toggle'      => false,
			'heading_border_toggle'     => true,
			'bottom_margin_toggle'      => true,
			'alignment'                 => 'left',
			'heading_color'             => '#333',
			'text_color'                => '#555',
			'link_color'                => '#ee543f',
			'link_color_hover'          => '#111',
			'background_color'          => '#f1f1f1',
			'background_image_repeat'   => 'no-repeat',
			'background_image_position' => 'center',
			'background_image_size'     => 'auto',
		);

		$args = wp_parse_args( $args, $defaults );
		extract( $args, EXTR_SKIP );

		if ( empty( $mod_base ) || empty( $sidebar_id ) ) {
			return;
		}

		/**
		 * Section
		 */
		$wp_customize->add_section( 'archetype_' . $mod_base, array(
			'title'        => $title,
			'description'  => $description,
			'priority'     => $priority,
			'panel'        => $panel,
		) );

		/**
		 * Full width toggle
		 */
		$wp_customize->add_setting( 'archetype_' . $mod_base . '_full_width_toggle', array(
			'default'            => apply_filters( 'archetype_default_' . $mod_base . '_full_width_toggle', $full_width_toggle ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_' . $mod_base . '_full_width_toggle', array(
			'label'        => __( 'Full Width', 'archetype' ),
			'description'  => __( 'Expand the column width to fill all of the browser window space.', 'archetype' ),
			'section'      => 'archetype_' . $mod_base,
			'settings'     => 'archetype_' . $mod_base . '_full_width_toggle',
			'type'         => 'checkbox',
		) ) );

		/**
		 * Widgets button (no setting required, control does not save)
		 */
		$wp_customize->add_control( new Archetype_Autofocus_Control( $wp_customize, 'archetype_' . $mod_base, array(
			'section'      => 'archetype_' . $mod_base,
			'settings'     => 'archetype_' . $mod_base . '_full_width_toggle',
			'data_id'      => 'sidebar-widgets-' . $sidebar_id,
			'priority'     => 1,
		) ) );

		/**
		 * Columns
		 */
		$wp_customize->add_setting( 'archetype_' . $mod_base . '_columns', array(
			'default'            => apply_filters( 'archetype_default_' . $mod_base . '_columns', $columns ),
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_' . $mod_base . '_columns', array(
			'label'        => __( 'Columns', 'archetype' ),
			'section'      => 'archetype_' . $mod_base,
			'settings'     => 'archetype_' . $mod_base . '_columns',
			'type'         => 'select',
			'choices'      => array(
				'widget-cols-3'   => '4 Columns 3-3-3-3',
				'widget-cols-4'   => '3 Columns 4-4-4',
				'widget-cols-6'   => '2 Columns 6-6',
				'widget-cols-9-3' => '2 Columns 9-3',
				'widget-cols-3-9' => '2 Columns 3-9',
				'widget-cols-8-4' => '2 Columns 8-4',
				'widget-cols-4-8' => '2 Columns 4-8',
				'widget-cols-12'  => '1 Column',
			),
		) );

		/**
		 * Gutters toggle
		 */
		$wp_customize->add_setting( 'archetype_' . $mod_base . '_gutters_toggle', array(
			'default'            => apply_filters( 'archetype_default_' . $mod_base . '_gutters_toggle', $gutters_toggle ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_' . $mod_base . '_gutters_toggle', array(
			'label'        => __( 'Column Gutters', 'archetype' ),
			'description'  => __( 'Toggle the display of column gutters.', 'archetype' ),
			'section'      => 'archetype_' . $mod_base,
			'settings'     => 'archetype_' . $mod_base . '_gutters_toggle',
			'type'         => 'checkbox',
		) ) );

		/**
		 * Padding toggle
		 */
		$wp_customize->add_setting( 'archetype_' . $mod_base . '_padding_toggle', array(
			'default'            => apply_filters( 'archetype_default_' . $mod_base . '_padding_toggle', $padding_toggle ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_' . $mod_base . '_padding_toggle', array(
			'label'        => __( 'Container Padding', 'archetype' ),
			'description'  => __( 'Toggle the display of padding around the columns container.', 'archetype' ),
			'section'      => 'archetype_' . $mod_base,
			'settings'     => 'archetype_' . $mod_base . '_padding_toggle',
			'type'         => 'checkbox',
		) ) );

		/**
		 * Inner padding toggle
		 */
		$wp_customize->add_setting( 'archetype_' . $mod_base . '_inner_padding_toggle', array(
			'default'            => apply_filters( 'archetype_default_' . $mod_base . '_inner_padding_toggle', $inner_padding_toggle ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_' . $mod_base . '_inner_padding_toggle', array(
			'label'        => __( 'Container Inner Padding', 'archetype' ),
			'description'  => __( 'Toggle the display of double left & right padding inside the columns container.', 'archetype' ),
			'section'      => 'archetype_' . $mod_base,
			'settings'     => 'archetype_' . $mod_base . '_inner_padding_toggle',
			'type'         => 'checkbox',
		) ) );

		/**
		 * Heading border toggle
		 */
		$wp_customize->add_setting( 'archetype_' . $mod_base . '_heading_border_toggle', array(
			'default'            => apply_filters( 'archetype_default_' . $mod_base . '_heading_border_toggle', $heading_border_toggle ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_' . $mod_base . '_heading_border_toggle', array(
			'label'        => __( 'Widget Heading Border', 'archetype' ),
			'description'  => __( 'Toggle the display of heading borders for all widgets.', 'archetype' ),
			'section'      => 'archetype_' . $mod_base,
			'settings'     => 'archetype_' . $mod_base . '_heading_border_toggle',
			'type'         => 'checkbox',
		) ) );

		/**
		 * Bottom margin toggle
		 */
		$wp_customize->add_setting( 'archetype_' . $mod_base . '_bottom_margin_toggle', array(
			'default'            => apply_filters( 'archetype_default_' . $mod_base . '_bottom_margin_toggle', $bottom_margin_toggle ),
			'sanitize_callback'  => 'archetype_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archetype_' . $mod_base . '_bottom_margin_toggle', array(
			'label'        => __( 'Widget Bottom Margin', 'archetype' ),
			'description'  => __( 'Toggle the display of bottom margins for all widgets.', 'archetype' ),
			'section'      => 'archetype_' . $mod_base,
			'settings'     => 'archetype_' . $mod_base . '_bottom_margin_toggle',
			'type'         => 'checkbox',
		) ) );

		/**
		 * Alignment
		 */
		$wp_customize->add_setting( 'archetype_' . $mod_base . '_alignment', array(
			'default'            => apply_filters( 'archetype_default_' . $mod_base . '_alignment', $alignment ),
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_' . $mod_base . '_alignment', array(
			'label'        => __( 'Text alignment', 'archetype' ),
			'section'      => 'archetype_' . $mod_base,
			'settings'     => 'archetype_' . $mod_base . '_alignment',
			'type'         => 'radio',
			'choices'      => array(
				'left'        => 'Left',
				'center'      => 'Center',
				'right'       => 'Right',
			),
		) );

		/**
		 * Heading color
		 */
		$wp_customize->add_setting( 'archetype_' . $mod_base . '_heading_color', array(
			'default'            => apply_filters( 'archetype_default_' . $mod_base . '_heading_color', $heading_color ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_' . $mod_base . '_heading_color', array(
			'label'        => __( 'Heading color', 'archetype' ),
			'section'      => 'archetype_' . $mod_base,
			'settings'     => 'archetype_' . $mod_base . '_heading_color',
		) ) );

		/**
		 * Text color
		 */
		$wp_customize->add_setting( 'archetype_' . $mod_base . '_text_color', array(
			'default'            => apply_filters( 'archetype_default_' . $mod_base . '_text_color', $text_color ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_' . $mod_base . '_text_color', array(
			'label'        => __( 'Text color', 'archetype' ),
			'section'      => 'archetype_' . $mod_base,
			'settings'     => 'archetype_' . $mod_base . '_text_color',
		) ) );

		/**
		 * Link Color
		 */
		$wp_customize->add_setting( 'archetype_' . $mod_base . '_link_color', array(
			'default'            => apply_filters( 'archetype_default_' . $mod_base . '_link_color', $link_color ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_' . $mod_base . '_link_color', array(
			'label'        => __( 'Link color', 'archetype' ),
			'description'  => __( 'The link color.', 'archetype' ),
			'section'      => 'archetype_' . $mod_base,
			'settings'     => 'archetype_' . $mod_base . '_link_color',
		) ) );

		/**
		 * Link Color Hover
		 */
		$wp_customize->add_setting( 'archetype_' . $mod_base . '_link_color_hover', array(
			'default'            => apply_filters( 'archetype_default_' . $mod_base . '_link_color_hover', $link_color_hover ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_' . $mod_base . '_link_color_hover', array(
			'label'        => __( 'Link hover color', 'archetype' ),
			'description'  => __( 'The link hover color.', 'archetype' ),
			'section'      => 'archetype_' . $mod_base,
			'settings'     => 'archetype_' . $mod_base . '_link_color_hover',
		) ) );

		/**
		 * Content background color
		 */
		$wp_customize->add_setting( 'archetype_' . $mod_base . '_background_color', array(
			'default'            => apply_filters( 'archetype_default_' . $mod_base . '_background_color', $background_color ),
			'sanitize_callback'  => 'archetype_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archetype_' . $mod_base . '_background_color', array(
			'label'        => __( 'Background color', 'archetype' ),
			'section'      => 'archetype_' . $mod_base,
			'settings'     => 'archetype_' . $mod_base . '_background_color',
		) ) );

		/**
		 * Background image
		 */
		$wp_customize->add_setting( 'archetype_' . $mod_base . '_background_image', array(
			'default'            => '',
			'sanitize_callback'  => 'archetype_sanitize_integer',
		) );

		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'archetype_' . $mod_base . '_background_image', array(
			'label'        => __( 'Background image', 'archetype' ),
			'section'      => 'archetype_' . $mod_base,
			'settings'     => 'archetype_' . $mod_base . '_background_image',
			'mime_type'    => 'image',
		) ) );

		/**
		 * Background repeat
		 */
		$wp_customize->add_setting( 'archetype_' . $mod_base . '_background_image_repeat', array(
			'default'            => apply_filters( 'archetype_default_' . $mod_base . '_background_image_repeat', $background_image_repeat ),
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( new Archetype_Background_Repeat_Control( $wp_customize, 'archetype_' . $mod_base . '_background_image_repeat', array(
			'label'        => __( 'Background Repeat', 'archetype' ),
			'section'      => 'archetype_' . $mod_base,
			'settings'     => 'archetype_' . $mod_base . '_background_image_repeat',
		) ) );

		/**
		 * Background position
		 */
		$wp_customize->add_setting( 'archetype_' . $mod_base . '_background_image_position', array(
			'default'            => apply_filters( 'archetype_default_' . $mod_base . '_background_image_position', $background_image_position ),
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( new Archetype_Background_Position_Control( $wp_customize, 'archetype_' . $mod_base . '_background_image_position', array(
			'label'        => __( 'Background Position', 'archetype' ),
			'section'      => 'archetype_' . $mod_base,
			'settings'     => 'archetype_' . $mod_base . '_background_image_position',
		) ) );

		/**
		 * Background size
		 */
		$wp_customize->add_setting( 'archetype_' . $mod_base . '_background_image_size', array(
			'default'            => apply_filters( 'archetype_default_' . $mod_base . '_background_image_size', $background_image_size ),
			'sanitize_callback'  => 'archetype_sanitize_choices',
		) );

		$wp_customize->add_control( 'archetype_' . $mod_base . '_background_image_size', array(
			'label'        => __( 'Background image size', 'archetype' ),
			'section'      => 'archetype_' . $mod_base,
			'settings'     => 'archetype_' . $mod_base . '_background_image_size',
			'type'         => 'select',
			'choices'      => array(
				'auto'        => 'Auto',
				'cover'       => 'Cover',
				'50'          => '50%',
			),
		) );
	}
endif;
