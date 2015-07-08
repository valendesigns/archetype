<?php
/**
 * Archetype Theme Customizer functions
 *
 * @package Archetype
 * @subpackage Customize
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_customize_js' ) ) :
	/**
	 * Loads the Customizer import and export scripts.
	 *
	 * @since 1.0.0
	 */
	function archetype_customize_js() {
		global $archetype_version;
		wp_enqueue_script( 'archetype_customize', get_template_directory_uri() . '/inc/customizer/js/customizer.min.js', array( 'jquery' ), $archetype_version, true );
	}
endif;

if ( ! function_exists( 'archetype_customize_preview_js' ) ) :
	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @since 1.0.0
	 */
	function archetype_customize_preview_js() {
		global $archetype_version;
		wp_enqueue_script( 'archetype_customize_preview', get_template_directory_uri() . '/inc/customizer/js/preview.min.js', array( 'customize-preview' ), $archetype_version, true );
	}
endif;

if ( ! function_exists( 'archetype_homepage_control_title' ) ) :
	/**
	 * Filter the Homepage Control title
	 *
	 * @since 1.0.0
	 *
	 * @param string $title The control title.
	 * @param string $id The action hook function ID.
	 * @return string The modified title.
	 */
	function archetype_homepage_control_title( $title, $id ) {
		$title = trim( str_replace( array( 'Archetype', 'Homepage' ), '', $title ) );
		if ( strpos( $title, 'Content ' ) !== false ) {
			$title = str_replace( 'Content ', 'Content (', $title );
			$title .= ')';
		}
		return $title;
	}
endif;

if ( ! function_exists( 'archetype_sanitize_integer' ) ) :
	/**
	 * Sanitizes an integer value.
	 *
	 * @since 1.0.0
	 *
	 * @param int $input The integer value.
	 * @return int The sanitized integer value.
	 */
	function archetype_sanitize_integer( $input ) {
		return absint( $input );
	}
endif;

if ( ! function_exists( 'archetype_sanitize_number' ) ) :
	/**
	 * Sanitizes an integer value or return empty.
	 *
	 * @since 1.0.0
	 *
	 * @param numeric $input The number value.
	 * @return numeric The sanitized number value.
	 */
	function archetype_sanitize_number( $input ) {
		if ( is_numeric( $input ) ) {
			return $input;
		}

		return 0;
	}
endif;

if ( ! function_exists( 'archetype_sanitize_checkbox' ) ) :
	/**
	 * Sanitizes a checkbox value.
	 *
	 * @since 1.0.0
	 *
	 * @param int $input The checkbox value.
	 * @return bool Whether the checkbox is checked.
	 */
	function archetype_sanitize_checkbox( $input ) {
		return ( ( isset( $input ) && true == $input ) ? true : false );
	}
endif;

if ( ! function_exists( 'archetype_sanitize_hex_color' ) ) :
	/**
	 * Sanitizes a hex color. Identical to core's sanitize_hex_color(), which is not available on the wp_head hook.
	 *
	 * Returns either '', a 3 or 6 digit hex color (with #), or null.
	 * For sanitizing values without a #, see sanitize_hex_color_no_hash().
	 *
	 * @since 1.0.0
	 *
	 * @param string $color The hexidecimal color value.
	 * @return string The sanitized hexidecimal color value.
	 */
	function archetype_sanitize_hex_color( $color ) {
		if ( '' === $color ) {
			return '';
		}

		// 3 or 6 hex digits, or the empty string.
		if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
			return $color;
		}

		return null;
	}
endif;

if ( ! function_exists( 'archetype_sanitize_choices' ) ) :
	/**
	 * Sanitizes choices (selects / radios)
	 *
	 * Checks that the input matches one of the available choices
	 *
	 * @since 1.0.0
	 *
	 * @param  array  $input The choices.
	 * @param  object $setting The Customizer setting.
	 * @return array  The sanitized choices.
	 */
	function archetype_sanitize_choices( $input, $setting ) {
		// Ensure input is a slug.
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
endif;

if ( ! function_exists( 'archetype_sanitize_layout' ) ) :
	/**
	 * Sanitizes the layout setting
	 *
	 * Ensures only array keys matching the original settings specified in add_control() are valid
	 *
	 * @since 1.0.0
	 *
	 * @param  array $input The layout choices.
	 * @return array The sanitized layout choices.
	 */
	function archetype_sanitize_layout( $input ) {
		$valid = array(
			'right'  => 'Right',
			'left'   => 'Left',
		);

		if ( array_key_exists( $input, $valid ) ) {
			return $input;
		} else {
			return '';
		}
	}
endif;

if ( ! function_exists( 'archetype_layout_class' ) ) :
	/**
	 * Layout classes
	 *
	 * Adds 'right-sidebar' and 'left-sidebar' classes to the body tag
	 *
	 * @since 1.0.0
	 *
	 * @param  array $classes current body classes.
	 * @return array Modified body classes.
	 */
	function archetype_layout_class( $classes ) {
		$layout = archetype_sanitize_layout( get_theme_mod( 'archetype_layout', 'right' ) );

		$classes[] = $layout . '-sidebar';

		return $classes;
	}
endif;

if ( ! function_exists( 'archetype_adjust_color_brightness' ) ) :
	/**
	 * Adjust a hex color brightness
	 *
	 * Allows us to create hover styles for custom link colors
	 *
	 * @since 1.0.0
	 *
	 * @param  string  $hex Hexidecimal color e.g. #111111.
	 * @param  integer $steps factor by which to brighten/darken ranging from -255 (darken) to 255 (brighten).
	 * @return string  Brightened or darkened hex color.
	 */
	function archetype_adjust_color_brightness( $hex, $steps ) {
		// Steps should be between -255 and 255. Negative = darker, positive = lighter.
		$steps = max( -255, min( 255, $steps ) );

		// Format the hex color string.
		$hex = str_replace( '#', '', $hex );

		if ( 3 === strlen( $hex ) ) {
			$hex	= str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
		}

		// Get decimal values.
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );

		// Adjust number of steps and keep it inside 0 to 255.
		$r = max( 0, min( 255, $r + $steps ) );
		$g = max( 0, min( 255, $g + $steps ) );
		$b = max( 0, min( 255, $b + $steps ) );

		$r_hex = str_pad( dechex( $r ), 2, '0', STR_PAD_LEFT );
		$g_hex = str_pad( dechex( $g ), 2, '0', STR_PAD_LEFT );
		$b_hex = str_pad( dechex( $b ), 2, '0', STR_PAD_LEFT );

		return '#' . $r_hex . $g_hex . $b_hex;
	}
endif;
