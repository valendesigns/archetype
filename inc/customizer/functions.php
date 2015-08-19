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

		// Localize.
		wp_localize_script( 'archetype-customize', 'ArchetypeCustomizerl10n', array(
			'emptyImport' => __( 'Please choose a file to import.', 'archetype' ),
			'missingLogo' => __( 'The SVG will not display properly without adding a fallback first.', 'archetype' ),
		));

		// Config.
		wp_localize_script( 'archetype-customize', 'ArchetypeCustomizerConfig', array(
			'ajaxURL'       => admin_url( 'admin-ajax.php' ),
			'customizerURL' => admin_url( 'customize.php' ),
			'exportNonce'   => wp_create_nonce( 'customize-exporting' ),
			'logoNonce'     => wp_create_nonce( 'customize-logo-change' ),
		) );
	}
endif;

if ( ! function_exists( 'archetype_customize_print_js' ) ) :
	/**
	 * Displays import & export errors.
	 *
	 * @since 1.0.0
	 */
	function archetype_customize_print_js() {
		global $customize_error;

		if ( $customize_error ) {
			echo '<script> alert("' . $customize_error . '"); </script>';
		}
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

if ( ! function_exists( 'archetype_json_mime' ) ) :
	/**
	 * Adds the json mime type.
	 *
	 * @since 1.0.0
	 *
	 * @param array $mimes The available mime types.
	 * @return array The modified mime types.
	 */
	function archetype_json_mime( $mimes ) {
		$mimes['json'] = 'application/json';
		return $mimes;
	}
endif;

if ( ! function_exists( 'archetype_svg_mime' ) ) :
	/**
	 * Adds the svg mime type.
	 *
	 * @since 1.0.0
	 *
	 * @param array $mimes The available mime types.
	 * @return array The modified mime types.
	 */
	function archetype_svg_mime( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
endif;

if ( ! function_exists( 'archetype_site_logo_svg' ) ) :
	/**
	 * Filter the site logo and add the SVG version
	 *
	 * @since 1.0.0
	 *
	 * @param  string $html The logo html.
	 * @param  int    $logo The logo ID.
	 * @param  array  $size The logo sizes.
	 * @return string The modified logo html.
	 */
	function archetype_site_logo_svg( $html, $logo, $size ) {
		return str_replace( '</a>', '<span class="svg-site-logo"></span></a>', $html );
	}
endif;

if ( ! function_exists( 'archetype_get_logo_url' ) ) :
	/**
	 * Returns the logo URL in the customizer
	 *
	 * @since 1.0.0
	 */
	function archetype_get_logo_url() {
		if ( ! wp_verify_nonce( $_REQUEST['customize-logo'], 'customize-logo-change' ) ) {
			return;
		}

		$logo_svg = wp_get_attachment_image_src( $_REQUEST['id'], 'full', false );

		if ( isset( $logo_svg[0] ) ) {
			wp_send_json_success( $logo_svg[0] );
		}

		wp_send_json_error( array( 'message' => __( 'An unknown error occurred while setting your SVG logo.', 'archetype' ) ) );
	}
endif;

if ( ! function_exists( 'archetype_get_primary_navigation_classes' ) ) :
	/**
	 * Filter the Primary Navigation's CSS classes.
	 *
	 * @since 1.0.0
	 *
	 * @param array $classes Array of CSS classes.
	 */
	function archetype_get_primary_navigation_classes( $classes ) {
		if ( true === archetype_sanitize_checkbox( get_theme_mod( 'archetype_nav_pinned', apply_filters( 'archetype_default_nav_pinned', true ) ) ) ) {
			$classes[] = 'navigation-pin';
		}

		if ( true === archetype_sanitize_checkbox( get_theme_mod( 'archetype_nav_handheld_pinned', apply_filters( 'archetype_default_nav_handheld_pinned', true ) ) ) ) {
			$classes[] = 'handheld-pin';
		}

		return $classes;
	}
endif;

if ( ! function_exists( 'archetype_site_info_footer_branding' ) ) :
	/**
	 * Display Site Branding in the footer
	 *
	 * @since 1.0.0
	 */
	function archetype_site_info_footer_branding() {
		// Support Jetpack Site Logo.
		if ( current_theme_supports( 'site-logo' ) && class_exists( 'Site_Logo', false ) ) {
			jetpack_the_site_logo();
		}
	}
endif;

if ( ! function_exists( 'archetype_get_site_info_styles' ) ) :
	/**
	 * Filter the site info styles.
	 *
	 * @since 1.0.0
	 *
	 * @param array $styles Array of inline CSS styles.
	 */
	function archetype_get_site_info_styles( $styles ) {
		return archetype_get_background_styles( 'archetype_footer_info_background', $styles );
	}
endif;

if ( ! function_exists( 'archetype_get_site_footer_styles' ) ) :
	/**
	 * Filter the site footer styles.
	 *
	 * @since 1.0.0
	 *
	 * @param array $styles Array of inline CSS styles.
	 */
	function archetype_get_site_footer_styles( $styles ) {
		return archetype_get_background_styles( 'archetype_footer_background', $styles );
	}
endif;

if ( ! function_exists( 'archetype_get_background_styles' ) ) :
	/**
	 * Build the background styles array.
	 *
	 * @since 1.0.0
	 *
	 * @param string $base The control ID base.
	 * @param array  $styles Array of inline CSS styles.
	 */
	function archetype_get_background_styles( $base = 'archetype_footer_background', $styles = array() ) {
		// Background image.
		$background_img_id  = archetype_sanitize_integer( get_theme_mod( $base . '_image', '' ) );
		$background_img_src = wp_get_attachment_image_src( $background_img_id, 'full' );
		$background_img     = isset( $background_img_src[0] ) ? $background_img_src[0] : '';

		// Background image size.
		$background_img_size = esc_attr( get_theme_mod( $base . '_image_size', apply_filters( str_replace( 'archetype_', 'archetype_default_', $base ) . '_image_size', 'auto' ) ) );

		if ( ! empty( $background_img ) ) {
			$styles[] = "background-image: url($background_img);";
			$styles[] = "background-size: $background_img_size;";
			$styles[] = 'background-position: center;';
			$styles[] = 'background-repeat: no-repeat;';
		}

		return $styles;
	}
endif;


if ( ! function_exists( 'archetype_tools_init' ) ) :
	/**
	 * Listens for import & export events and filter hooks
	 *
	 * @since 1.0.0
	 */
	function archetype_tools_init() {
		if ( current_user_can( 'edit_theme_options' ) ) {

			if ( isset( $_REQUEST['customize-export'] ) ) {
				archetype_export_mods();
			}

			if ( isset( $_REQUEST['customize-import'] ) && isset( $_FILES['customize-import-file'] ) ) {
				archetype_import_mods();
			}
		}
	}
endif;

if ( ! function_exists( 'archetype_export_mods' ) ) :
	/**
	 * Exports customizer theme mods, active widgets & menus.
	 *
	 * @since 1.0.0
	 */
	function archetype_export_mods() {
		if ( ! wp_verify_nonce( $_REQUEST['customize-export'], 'customize-exporting' ) ) {
			return;
		}

		$theme    = get_option( 'stylesheet' );
		$template = get_option( 'template' );
		$charset  = get_option( 'blog_charset' );
		$mods     = get_theme_mods();

		header( 'Content-disposition: attachment; filename=' . $theme . '-customize.json' );
		header( 'Content-Type: application/octet-stream; charset=' . $charset );

		echo serialize( array(
			'template' => $template,
			'mods'     => $mods ? $mods : array(),
		) );

		die();
	}
endif;

if ( ! function_exists( 'archetype_import_mods' ) ) :
	/**
	 * Imports uploaded mods and calls WordPress core customize_save actions so
	 * themes that hook into them can act before mods are saved to the database.
	 *
	 * @since 1.0.0
	 */
	function archetype_import_mods() {
		if ( ! wp_verify_nonce( $_REQUEST['customize-import'], 'customize-importing' ) ) {
			return;
		}

		global $wp_customize;
		global $customize_error;

		$customize_error  = false;
		$template         = get_option( 'template' );

		// Check for function and require.
		if ( ! function_exists( 'wp_handle_sideload' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}

		// Override the sideload defaults.
		$overrides = array(
			'test_form'    => false,
			'test_size'    => true,
			'test_upload'  => true,
		);

		// Move the temporary file into the uploads directory.
		add_filter( 'upload_mimes', 'archetype_json_mime' );
		$results = wp_handle_sideload( $_FILES['customize-import-file'], $overrides );
		remove_filter( 'upload_mimes', 'archetype_json_mime' );

		// If error storing temporarily, return the error.
		if ( ! empty( $results['error'] ) ) {
			$customize_error = $results['error'];
			return;
		}

		if ( is_wp_error( $results ) ) {
			$customize_error = $results->get_error_message();
			return;
		}

		$raw	= wp_remote_fopen( $results['url'] );
		$data = maybe_unserialize( $raw );

		// Remove the file.
		unlink( $results['file'] );

		// Data checks.
		if ( 'array' != gettype( $data ) ) {
			$customize_error = __( 'Error importing settings! Please check that you uploaded a customizer export file.', 'archetype' );
			return;
		}
		if ( ! isset( $data['template'] ) || ! isset( $data['mods'] ) ) {
			$customize_error = __( 'Error importing settings! Please check that you uploaded a customizer export file.', 'archetype' );
			return;
		}
		if ( $data['template'] != $template ) {
			$customize_error = __( 'Error importing settings! The settings you uploaded are not for the current theme.', 'archetype' );
			return;
		}

		// Import images.
		if ( isset( $_REQUEST['customize-import-images'] ) ) {
			$data['mods'] = archetype_import_mod_images( $data['mods'] );
		}

		// Call the customize_save action.
		do_action( 'customize_save', $wp_customize );

		// Loop through the mods.
		foreach ( $data['mods'] as $key => $val ) {

			// Call the customize_save_ dynamic action.
			do_action( 'customize_save_' . $key, $wp_customize );

			// Save the mod.
			set_theme_mod( $key, $val );
		}

		// Call the customize_save_after action.
		do_action( 'customize_save_after', $wp_customize );
	}
endif;

if ( ! function_exists( 'archetype_import_mod_images' ) ) :
	/**
	 * Imports customizer images.
	 *
	 * @since 1.0.0
	 *
	 * @param array $mods The theme mods.
	 * @return array The theme mods.
	 */
	function archetype_import_mod_images( $mods ) {
		foreach ( $mods as $key => $val ) {

			$data = archetype_sideload_image( $val );

			if ( false !== $data && ! is_wp_error( $data ) ) {

				$mods[ $key ] = $data->url;

				// Handle header image controls.
				if ( isset( $mods[ $key . '_data' ] ) ) {
					$mods[ $key . '_data' ] = $data;
					update_post_meta( $data->attachment_id, '_wp_attachment_is_custom_header', get_stylesheet() );
				}
			}
		}

		return $mods;
	}
endif;

if ( ! function_exists( 'archetype_sideload_image' ) ) :
	/**
	 * Taken from the core `media_sideload_image` function and modified to return image data instead of html.
	 *
	 * @since 1.0.0
	 *
	 * @param string $file The image url.
	 * @return array The image data.
	 */
	function archetype_sideload_image( $file ) {
		if ( ! archetype_is_image_url( $file ) ) {
			return false;
		}

		$data = new stdClass();

		if ( ! function_exists( 'media_handle_sideload' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/media.php' );
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
		}

		if ( ! empty( $file ) ) {

			// Set variables for storage, fix file filename for query strings.
			preg_match( '/[^\?]+\.(jpg|jpe|jpeg|gif|png|bmp|tif|tiff|ico|svg)\b/i', $file, $matches );
			$file_array = array();
			$file_array['name'] = basename( $matches[0] );

			// Download file to temp location.
			$file_array['tmp_name'] = download_url( $file );

			// If error storing temporarily, return the error.
			if ( is_wp_error( $file_array['tmp_name'] ) ) {
				return $file_array['tmp_name'];
			}

			// Do the validation and storage stuff.
			$id = media_handle_sideload( $file_array, 0 );

			// If error storing permanently, unlink.
			if ( is_wp_error( $id ) ) {
				unlink( $file_array['tmp_name'] );
				return $id;
			}

			// Build the object to return.
			$meta                = wp_get_attachment_metadata( $id );
			$data->attachment_id = $id;
			$data->url           = wp_get_attachment_url( $id );
			$data->thumbnail_url = wp_get_attachment_thumb_url( $id );
			$data->height        = $meta['height'];
			$data->width         = $meta['width'];
		}

		return $data;
	}
endif;

if ( ! function_exists( 'archetype_is_image_url' ) ) :
	/**
	 * Check if the file extention is a valid image mime type.
	 *
	 * @since 1.0.0
	 *
	 * @param string $string The image url.
	 * @return bool Whether or not the url is a valid image.
	 */
	function archetype_is_image_url( $string = '' ) {
		if ( is_string( $string ) && preg_match( '/\.[^\.]+$/i', $string, $ext ) ) {
			$allowed_ext = array( '.jpg', '.jpe', '.jpeg', '.gif', '.png', '.bmp', '.tif', '.tiff', '.ico', '.svg' );
			if ( isset( $ext[0] ) && in_array( $ext[0], $allowed_ext ) ) {
				return true;
			}
		}

		return false;
	}
endif;

if ( ! function_exists( 'archetype_sanitize_import_export' ) ) :
	/**
	 * Sanitizes the import/export control value.
	 *
	 * This is to pass theme check and returns false.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	function archetype_sanitize_import_export() {
		return false;
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
