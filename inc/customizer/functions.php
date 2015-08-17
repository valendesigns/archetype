<?php
/**
 * Archetype Theme Customizer functions
 *
 * @package Archetype
 * @subpackage Customize
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_customize_css' ) ) :
	/**
	 * Loads Customizer CSS for custom controls.
	 *
	 * @since 1.0.0
	 */
	function archetype_customize_css() {
		global $archetype_version;
		wp_enqueue_style( 'archetype-customize', get_template_directory_uri() . '/inc/customizer/css/' . ( is_rtl() ? 'customizer-rtl.css' : 'customizer.css' ), '', $archetype_version );
	}
endif;

if ( ! function_exists( 'archetype_customize_js' ) ) :
	/**
	 * Loads the Customizer import and export scripts.
	 *
	 * @since 1.0.0
	 */
	function archetype_customize_js() {
		global $archetype_version;
		wp_enqueue_script( 'archetype-customize', get_template_directory_uri() . '/inc/customizer/js/customizer.min.js', array( 'jquery' ), $archetype_version, true );
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
		wp_enqueue_script( 'archetype-customize-preview', get_template_directory_uri() . '/inc/customizer/js/preview.min.js', array( 'jquery', 'customize-preview' ), $archetype_version, true );
	}
endif;

if ( ! function_exists( 'archetype_emojis' ) ) :
	/**
	 * Removes Emoji Support.
	 *
	 * @since 1.0.0
	 */
	function archetype_emojis() {
		if ( true === archetype_sanitize_checkbox( get_theme_mod( 'archetype_no_emoji', apply_filters( 'archetype_default_no_emoji', false ) ) ) ) {
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );
			remove_action( 'admin_print_styles', 'print_emoji_styles' );
		}
	}
endif;

if ( ! function_exists( 'archetype_sanitize_integer' ) ) :
	/**
	 * Sanitizes an integer value.
	 *
	 * Sanitization callback for 'number' type text inputs. This callback sanitizes `$number`
	 * as an absolute integer (whole number, zero or greater).
	 *
	 * @see absint() https://developer.wordpress.org/reference/functions/absint/
	 *
	 * @since 1.0.0
	 *
	 * @param int                  $number Number value to sanitize.
	 * @param WP_Customize_Setting $setting Setting instance. Default is 'null' to avoid PHP warnings.
	 * @return int The sanitized absolute number value.
	 */
	function archetype_sanitize_integer( $number, $setting = null ) {
		// Ensure $number is an absolute integer (whole number, zero or greater).
		$number = absint( $number );

		// If the input is an absolute integer, return it; otherwise, return the default.
		if ( $number ) {
			return $number;
		} else if ( isset( $setting->default ) ) {
			return $setting->default;
		}

		return 0;
	}
endif;

if ( ! function_exists( 'archetype_sanitize_number' ) ) :
	/**
	 * Sanitizes a numeric value.
	 *
	 * @since 1.0.0
	 *
	 * @param int                  $number Number value to sanitize.
	 * @param WP_Customize_Setting $setting Setting instance. Default is 'null' to avoid PHP warnings.
	 * @return int The sanitized number value.
	 */
	function archetype_sanitize_number( $number, $setting = null ) {
		if ( is_numeric( $number ) ) {
			return $number;
		} else if ( isset( $setting->default ) ) {
			return $setting->default;
		}

		return 0;
	}
endif;

if ( ! function_exists( 'archetype_sanitize_checkbox' ) ) :
	/**
	 * Checkbox sanitization callback.
	 *
	 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
	 * as a boolean value, either TRUE or FALSE.
	 *
	 * @since 1.0.0
	 *
	 * @param int $checked The checkbox value.
	 * @return bool Whether the checkbox is checked.
	 */
	function archetype_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
endif;

if ( ! function_exists( 'archetype_sanitize_image' ) ) :
	/**
	 * Image sanitization callback.
	 *
	 * Checks the image's file extension and mime type against a whitelist. If they're allowed,
	 * send back the filename, otherwise, return the setting default.
	 *
	 * @see wp_check_filetype() https://developer.wordpress.org/reference/functions/wp_check_filetype/
	 *
	 * @since  1.0.0
	 *
	 * @param string               $image   Image filename.
	 * @param WP_Customize_Setting $setting Setting instance. Default is 'null' to avoid PHP warnings.
	 * @return string The image filename if the extension is allowed; otherwise, the setting default.
	 */
	function archetype_sanitize_image( $image, $setting = null ) {
		// Array of valid image file types that are included in wp_get_mime_types().
		$mimes = array(
			'jpg|jpeg|jpe' => 'image/jpeg',
			'gif'          => 'image/gif',
			'png'          => 'image/png',
			'bmp'          => 'image/bmp',
			'tif|tiff'     => 'image/tiff',
			'ico'          => 'image/x-icon',
		);
		// Return an array with file extension and mime_type.
		$file = wp_check_filetype( $image, $mimes );

		// If $image has a valid mime_type, return $image; otherwise, return the default.
		if ( $file['ext'] ) {
			return $image;
		} else if ( isset( $setting->default ) ) {
			return $setting->default;
		}

		return '';
	}
endif;

if ( ! function_exists( 'archetype_sanitize_url' ) ) :
	/**
	 * URL sanitization callback.
	 *
	 * Sanitization callback for 'url' type text inputs. This callback sanitizes `$url` as a valid URL.
	 *
	 * @see esc_url_raw() https://developer.wordpress.org/reference/functions/esc_url_raw/
	 *
	 * @since 1.0.0
	 *
	 * @param string $url URL to sanitize.
	 * @return string Sanitized URL.
	 */
	function archetype_sanitize_url( $url ) {
		return esc_url_raw( $url );
	}
endif;

if ( ! function_exists( 'archetype_sanitize_html' ) ) :
	/**
	 * HTML sanitization callback.
	 *
	 * Sanitization callback for 'html' type text inputs. This callback sanitizes `$html`
	 * for HTML allowable in posts.
	 *
	 * @see wp_filter_post_kses() https://developer.wordpress.org/reference/functions/wp_filter_post_kses/
	 *
	 * @since 1.0.0
	 *
	 * @param string $html HTML to sanitize.
	 * @return string Sanitized HTML.
	 */
	function archetype_sanitize_html( $html ) {
		return wp_filter_post_kses( $html );
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
	 * @return array  The sanitized choice.
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
			'left'  => 'left',
			'right' => 'right',
			'none'  => 'none',
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
	 * Adds the 'right-sidebar', 'left-sidebar', or 'full-width' class to the body tag,
	 * which is based on what the user has chosen in the Customizer.
	 *
	 * @since 1.0.0
	 *
	 * @param  array $classes current body classes.
	 * @return array Modified body classes.
	 */
	function archetype_layout_class( $classes ) {
		$layout = archetype_sanitize_layout( get_theme_mod( 'archetype_layout', 'right' ) );

		if ( 'none' === $layout ) {
			$classes[] = 'archetype-full-width-content';
			remove_action( 'archetype_get_sidebar', 'archetype_get_sidebar', 10 );
		} else {
			$classes[] = $layout . '-sidebar';
		}

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
