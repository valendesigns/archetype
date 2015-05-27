<?php
/**
 * archetype Theme Customizer functions
 *
 * @package archetype
 */

/**
 * Listens for import & export events and filter hooks
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customize_init' ) ) {
  function archetype_customize_init() {
    if ( current_user_can( 'edit_theme_options' ) ) {

      if ( isset( $_REQUEST['customize-export'] ) ) {
        archetype_customize_export();
      }

      if ( isset( $_REQUEST['customize-import'] ) && isset( $_FILES['customize-import-file'] ) ) {
        archetype_customize_import();
      }
    }
  }
}

/**
 * Filter the site logo and add the SVG version
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_site_logo_svg' ) ) {
  function archetype_site_logo_svg( $html, $logo, $size ) {
    return str_replace( '</a>', '<span class="svg-site-logo"></span></a>', $html );
  }
}

/**
 * Loads the Customizer import and export scripts.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customize_js' ) ) {
  function archetype_customize_js() {
    global $archetype_version;
    wp_enqueue_script( 'archetype_customize', get_template_directory_uri() . '/inc/customizer/js/customizer.min.js', array( 'jquery' ), $archetype_version, true );

    // Localize
    wp_localize_script( 'archetype_customize', 'ArchetypeCustomizerl10n', array(
      'emptyImport' => __( 'Please choose a file to import.', 'archetype' ),
      'missingLogo' => __( 'The SVG will not display properly without adding a fallback first.', 'archetype' ) ,
    ));

    // Config
    wp_localize_script( 'archetype_customize', 'ArchetypeCustomizerConfig', array(
      'ajaxURL'               => admin_url( 'admin-ajax.php' ),
      'customizerURL'         => admin_url( 'customize.php' ),
      'customizerExportNonce' => wp_create_nonce( 'customize-exporting' ),
      'customizerLogoNonce'   => wp_create_nonce( 'customize-logo-change' ),
    ) );
  }
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customize_preview_js' ) ) {
  function archetype_customize_preview_js() {
    global $archetype_version;
    wp_enqueue_script( 'archetype_customize_preview', get_template_directory_uri() . '/inc/customizer/js/preview.min.js', array( 'customize-preview' ), $archetype_version, true );
  }
}

/**
 * Displays import & export errors.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customize_print_js' ) ) {
  function archetype_customize_print_js() {
    global $customize_error;

    if ( $customize_error ) {
      echo '<script> alert("' . $customize_error . '"); </script>';
    }
  }
}

/**
 * Adds Customizer CSS for custom controls.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customize_css' ) ) {
  function archetype_customize_css() {
    global $archetype_version;
    wp_enqueue_style( 'archetype_customize', get_template_directory_uri() . '/inc/customizer/css/customizer.css', array(), $archetype_version );
  }
}

/**
 * Returns the logo URL in the customizer
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customize_get_logo_url' ) ) {
  function archetype_customize_get_logo_url() {
    if ( ! wp_verify_nonce( $_REQUEST['customize-logo'], 'customize-logo-change' ) ) {
      return;
    }

    $logo_svg = wp_get_attachment_image_src( $_REQUEST['id'], 'full', false );

    if ( isset( $logo_svg[0] ) ) {
      wp_send_json_success( $logo_svg[0] );
    }

    wp_send_json_error( array( 'message' => __( 'An unknown error occurred while setting your SVG logo.', 'archetype' ) ) );
  }
}

/**
 * Exports customizer theme mods, active widgets & menus.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customize_export' ) ) {
  function archetype_customize_export() {
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
      'mods'     => $mods ? $mods : array()
    ) );

    die();
  }
}

/**
 * Imports uploaded mods and calls WordPress core customize_save actions so
 * themes that hook into them can act before mods are saved to the database.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customize_import' ) ) {
  function archetype_customize_import() {
    if ( ! wp_verify_nonce( $_REQUEST['customize-import'], 'customize-importing' ) ) {
      return;
    }

    global $wp_customize;
    global $customize_error;

    $customize_error = false;
    $template        = get_option( 'template' );

    // Check for function and require
    if ( ! function_exists( 'wp_handle_sideload' ) ) {
      require_once( ABSPATH . 'wp-admin/includes/file.php' );
    }

    // Override the sideload defaults
    $overrides = array(
      'test_form' => false,
      'test_size' => true,
      'test_upload' => true, 
    );

    // move the temporary file into the uploads directory
    add_filter( 'upload_mimes', 'archetype_customize_json_mime' );
    $results = wp_handle_sideload( $_FILES['customize-import-file'], $overrides );
    remove_filter( 'upload_mimes', 'archetype_customize_json_mime' );

    // If error storing temporarily, return the error.
    if ( ! empty( $results['error'] ) ) {
      $customize_error = $results['error'];
      return;
    }

    if ( is_wp_error( $results ) ) {
      $customize_error = $results->get_error_message();
      return;
    }

    $raw  = wp_remote_fopen( $results['url'] );
    $data = maybe_unserialize( $raw );

    // Remove the file
    @unlink( $results['file'] );

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
      $data['mods'] = archetype_customize_import_images( $data['mods'] );
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
}

/**
 * Imports customizer images.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customize_import_images' ) ) {
  function archetype_customize_import_images( $mods ) {
    foreach ( $mods as $key => $val ) {

      if ( archetype_customize_is_image_url( $val ) ) {

        $data = archetype_customize_sideload_image( $val );

        if ( ! is_wp_error( $data ) ) {

          $mods[ $key ] = $data->url;

          // Handle header image controls.
          if ( isset( $mods[ $key . '_data' ] ) ) {
            $mods[ $key . '_data' ] = $data;
            update_post_meta( $data->attachment_id, '_wp_attachment_is_custom_header', get_stylesheet() );
          }
        }
      }
    }

    return $mods;
  }
}

/**
 * Taken from the core media_sideload_image function and
 * modified to return the url instead of html.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customize_sideload_image' ) ) {
  function archetype_customize_sideload_image( $file ) {
    $data = new stdClass();

    if ( ! function_exists( 'media_handle_sideload' ) ) {
      require_once( ABSPATH . 'wp-admin/includes/media.php' );
      require_once( ABSPATH . 'wp-admin/includes/file.php' );
      require_once( ABSPATH . 'wp-admin/includes/image.php' );
    }
    if ( ! empty( $file ) ) {

      // Set variables for storage, fix file filename for query strings.
      preg_match( '/[^\?]+\.(jpe?g|jpe|gif|png)\b/i', $file, $matches );
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
        @unlink( $file_array['tmp_name'] );
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
}

/**
 * Check if the file extention is a valid image mime type.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customize_is_image_url' ) ) {
  function archetype_customize_is_image_url( $string = '' ) {
    if ( is_string( $string ) ) {

      if ( preg_match( '/\.(jpg|jpeg|jpe|gif|png|bmp|tif|tiff|ico|svg)/i', $string ) ) {
        return true;
      }
    }

    return false;
  }
}

/**
 * Adds the json mime type.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customize_json_mime' ) ) {
  function archetype_customize_json_mime( $mimes ) {
    $mimes['json'] = 'application/json';
    return $mimes;
  }
}

/**
 * Adds the svg mime type.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customize_upload_mimes' ) ) {
  function archetype_customize_upload_mimes( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
}

/**
 * Sanitizes an integer value.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_sanitize_integer' ) ) {
  function archetype_sanitize_integer( $input ) {
    return absint( $input );
  }
}

/**
 * Sanitizes an integer value or return empty.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_sanitize_number' ) ) {
  function archetype_sanitize_number( $input ) {
    if ( is_numeric( $input ) ) {
      return $input;
    }

    return 0;
  }
}

/**
 * Sanitizes a checkbox value.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_sanitize_checkbox' ) ) {
  function archetype_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
      return 1;
    }

    return '';
  }
}

/**
 * Sanitizes the import/export control value.
 *
 * This is to pass theme check and returns false.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_sanitize_import_export' ) ) {
  function archetype_sanitize_import_export( $input ) {
    return false;
  }
}

/**
 * Sanitizes a hex color. Identical to core's sanitize_hex_color(), which is not available on the wp_head hook.
 *
 * Returns either '', a 3 or 6 digit hex color (with #), or null.
 * For sanitizing values without a #, see sanitize_hex_color_no_hash().
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'archetype_sanitize_hex_color' ) ) {
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
}

/**
 * Sanitizes choices (selects / radios)
 * Checks that the input matches one of the available choices
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_sanitize_choices' ) ) {
  function archetype_sanitize_choices( $input, $setting ) {
    global $wp_customize;

    $control = $wp_customize->get_control( $setting->id );

    if ( array_key_exists( $input, $control->choices ) ) {
      return $input;
    } else {
      return $setting->default;
    }
  }
}

/**
 * Sanitizes the layout setting
 *
 * Ensures only array keys matching the original settings specified in add_control() are valid
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'archetype_sanitize_layout' ) ) {
  function archetype_sanitize_layout( $input ) {
    $valid = array(
      'right' => 'Right',
      'left'  => 'Left',
    );

    if ( array_key_exists( $input, $valid ) ) {
      return $input;
    } else {
      return '';
    }
  }
}

/**
 * Layout classes
 * Adds 'right-sidebar' and 'left-sidebar' classes to the body tag
 * @param  array $classes current body classes
 * @return array Modified body classes
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_layout_class' ) ) {
  function archetype_layout_class( $classes ) {
    $layout = archetype_sanitize_layout( get_theme_mod( 'archetype_layout' ) );

    if ( '' == $layout ) {
      $layout = 'right';
    }

    $classes[] = $layout . '-sidebar';

    return $classes;
  }
}

/**
 * Adjust a hex color brightness
 * Allows us to create hover styles for custom link colors
 * @param  strong $hex   hex color e.g. #111111
 * @param  integer $steps factor by which to brighten/darken ranging from -255 (darken) to 255 (brighten)
 * @return string brightened/darkened hex color
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_adjust_color_brightness' ) ) {
  function archetype_adjust_color_brightness( $hex, $steps ) {
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps  = max( -255, min( 255, $steps ) );

    // Format the hex color string
    $hex    = str_replace( '#', '', $hex );

    if ( 3 == strlen( $hex ) ) {
      $hex  = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
    }

    // Get decimal values
    $r  = hexdec( substr( $hex, 0, 2 ) );
    $g  = hexdec( substr( $hex, 2, 2 ) );
    $b  = hexdec( substr( $hex, 4, 2 ) );

    // Adjust number of steps and keep it inside 0 to 255
    $r  = max( 0, min( 255, $r + $steps ) );
    $g  = max( 0, min( 255, $g + $steps ) );
    $b  = max( 0, min( 255, $b + $steps ) );

    $r_hex  = str_pad( dechex( $r ), 2, '0', STR_PAD_LEFT );
    $g_hex  = str_pad( dechex( $g ), 2, '0', STR_PAD_LEFT );
    $b_hex  = str_pad( dechex( $b ), 2, '0', STR_PAD_LEFT );

    return '#' . $r_hex . $g_hex . $b_hex;
  }
}