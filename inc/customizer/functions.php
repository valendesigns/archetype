<?php
/**
 * archetype Theme Customizer functions
 *
 * @package archetype
 */

/**
 * Listens for import & export events.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customizer_init' ) ) {
  function archetype_customizer_init() {
    if ( current_user_can( 'edit_theme_options' ) ) {

      if ( isset( $_REQUEST['customizer-export'] ) ) {
        archetype_customizer_export();
      }
      
      if ( isset( $_REQUEST['customizer-import'] ) && isset( $_FILES['customizer-import-file'] ) ) {
        archetype_customizer_import();
      }
    }
  }
}

/**
 * Loads the Customizer import and export scripts.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customizer_js' ) ) {
  function archetype_customizer_js() {
    global $archetype_version;
    wp_enqueue_script( 'archetype_customizer', get_template_directory_uri() . '/inc/customizer/js/customizer.min.js', array( 'jquery' ), $archetype_version, true );
    
    // Localize
    wp_localize_script( 'archetype_customizer', 'Archetype_Customizerl10n', array(
      'emptyImport' => __( 'Please choose a file to import.', 'archetype' )
    ));
    
    // Config
    wp_localize_script( 'archetype_customizer', 'Archetype_CustomizerConfig', array(
      'customizerURL' => admin_url( 'customize.php' ),
      'exportNonce'   => wp_create_nonce( 'customizer-exporting' )
    ));
  }
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customizer_preview_js' ) ) {
  function archetype_customizer_preview_js() {
    global $archetype_version;
    wp_enqueue_script( 'archetype_customizer_preview', get_template_directory_uri() . '/inc/customizer/js/preview.min.js', array( 'customize-preview' ), $archetype_version, true );
  }
}

/**
 * Displays import & export errors.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customizer_print_js' ) ) {
  function archetype_customizer_print_js() {
    global $customizer_error;
    
    if ( $customizer_error ) {
      echo '<script> alert("' . $customizer_error . '"); </script>';
    }
  }
}

/**
 * Adds Customizer CSS for custom controls.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customizer_css' ) ) {
  function archetype_customizer_css() {
    global $archetype_version;
    wp_enqueue_style( 'archetype_customizer', get_template_directory_uri() . '/inc/customizer/css/customizer.css', array(), $archetype_version );
  }
}

/**
 * Exports customizer theme mods.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customizer_export' ) ) {
  function archetype_customizer_export() {
    if ( ! wp_verify_nonce( $_REQUEST['customizer-export'], 'customizer-exporting' ) ) {
      return;
    }
    
    $theme    = get_option( 'stylesheet' );
    $template = get_option( 'template' );
    $charset  = get_option( 'blog_charset' );
    $mods     = get_theme_mods();
    
    header( 'Content-disposition: attachment; filename=' . $theme . '-export.json' );
    header( 'Content-Type: application/octet-stream; charset=' . $charset );
    
    echo serialize( array(
      'template' => $template,
      'mods'   => $mods ? $mods : array()
    ));
    
    die();
  }
}

/**
 * Imports uploaded mods and calls WordPress core customize_save actions so
 * themes that hook into them can act before mods are saved to the database.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customizer_import' ) ) {
  function archetype_customizer_import() {
    if ( ! wp_verify_nonce( $_REQUEST['customizer-import'], 'customizer-importing' ) ) {
      return;
    }
    
    global $wp_customize;
    global $customizer_error;
    
    $customizer_error = false;
    $template         = get_option( 'template' );
    $raw              = file_get_contents( $_FILES['customizer-import-file']['tmp_name'] );
    $data             = @unserialize( $raw );
    
    // Data checks.
    if ( 'array' != gettype( $data ) ) {
      $customizer_error = __( 'Error importing settings! Please check that you uploaded a customizer export file.', 'archetype' );
      return;
    }
    if ( ! isset( $data['template'] ) || ! isset( $data['mods'] ) ) {
      $customizer_error = __( 'Error importing settings! Please check that you uploaded a customizer export file.', 'archetype' );
      return;
    }
    if ( $data['template'] != $template ) {
      $customizer_error = __( 'Error importing settings! The settings you uploaded are not for the current theme.', 'archetype' );
      return;
    }
    
    // Import images.
    if ( isset( $_REQUEST['customizer-import-images'] ) ) {
      $data['mods'] = archetype_customizer_import_images( $data['mods'] );
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
if ( ! function_exists( 'archetype_customizer_import_images' ) ) {
  function archetype_customizer_import_images( $mods ) {
    foreach ( $mods as $key => $val ) {
      
      if ( archetype_customizer_is_image_url( $val ) ) {
        
        $data = archetype_customizer_sideload_image( $val );
        
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
if ( ! function_exists( 'archetype_customizer_sideload_image' ) ) {
  function archetype_customizer_sideload_image( $file ) {
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
if ( ! function_exists( 'archetype_customizer_is_image_url' ) ) {
  function archetype_customizer_is_image_url( $string = '' ) {
    if ( is_string( $string ) ) {
      
      if ( preg_match( '/\.(jpg|jpeg|jpe|gif|png|bmp|tif|tiff|ico|svg)/i', $string ) ) {
        return true;
      }
    }
    
    return false;
  }
}

/**
 * Adds the svg mime type.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_customizer_upload_mimes' ) ) {
  function archetype_customizer_upload_mimes( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
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
    if ( '' === $color )
      return '';

    // 3 or 6 hex digits, or the empty string.
    if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
      return $color;

    return null;
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
    $layout = get_theme_mod( 'archetype_layout' );
  
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

    if ( strlen( $hex ) == 3 ) {
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