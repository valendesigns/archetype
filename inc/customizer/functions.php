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
if ( ! function_exists( 'archetype_customize_init' ) ) {
  function archetype_customize_init() {
    if ( current_user_can( 'edit_theme_options' ) ) {

      if ( isset( $_REQUEST['customize-export'] ) ) {
        archetype_customize_export();
      }
      
      if ( isset( $_REQUEST['widgets-export'] ) ) {
        archetype_widgets_export();
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

    $logo_svg = get_theme_mod( 'archetype_site_logo_svg' );

    // We have a logo. Logo is go.
    if ( ! jetpack_is_customize_preview() && jetpack_has_site_logo() && $logo_svg ) {
      $image = wp_get_attachment_image_src( $logo['id'], $size, false );

      if ( count( $image ) >= 3 ) {
        $html = sprintf( 
          '<a href="%1$s" class="site-logo-link" rel="home" itemprop="url"><img class="site-logo attachment-%2$s" width="%3$s" height="%4$s" itemprop="logo" data-size="%2$s" alt="%5$s" src="%6$s" onerror="this.src=%7$s;this.onerror=null;"></a>',
          esc_url( home_url( '/' ) ),
          esc_attr( $size ),
          esc_attr( $image[1] ),
          esc_attr( $image[2] ),
          esc_attr( get_bloginfo( 'name' ) ),
          esc_url( $logo_svg ),
          esc_url( $image[0] )
        );
      }
    }

    return $html;
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
    wp_localize_script( 'archetype_customize', 'Archetype_Customizerl10n', array(
      'emptyImport' => __( 'Please choose a file to import.', 'archetype' )
    ));
    
    // Config
    wp_localize_script( 'archetype_customize', 'Archetype_CustomizerConfig', array(
      'customizerURL'        => admin_url( 'customize.php' ),
      'exportCustomizeNonce' => wp_create_nonce( 'customize-exporting' ),
      'exportWidgetsNonce'   => wp_create_nonce( 'widgets-exporting' ),
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
    wp_enqueue_script( 'archetype_customize_preview', get_template_directory_uri() . '/inc/customizer/js/preview.js', array( 'customize-preview' ), $archetype_version, true );
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
 * Exports customizer theme mods, active widgets & menus.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_widgets_export' ) ) {
  function archetype_widgets_export() {
    if ( ! wp_verify_nonce( $_REQUEST['widgets-export'], 'widgets-exporting' ) ) {
      return;
    }
    
    $theme             = get_option( 'stylesheet' );
    $template          = get_option( 'template' );
    $charset           = get_option( 'blog_charset' );
    $sidebars_widgets  = get_option( 'sidebars_widgets' );
    $available_widgets = archetype_active_widgets();
    $widget_instances  = array();
    $active_widgets    = array();
  
    // Get all widget instances
    foreach ( $available_widgets as $widget_data ) {
  
      // Get all instances for this ID base
      $instances = get_option( 'widget_' . $widget_data['id_base'] );
  
      // Have instances
      if ( ! empty( $instances ) ) {
  
        // Loop instances
        foreach ( $instances as $instance_id => $instance_data ) {
  
          // Key is ID (not _multiwidget)
          if ( is_numeric( $instance_id ) ) {
            $unique_instance_id = $widget_data['id_base'] . '-' . $instance_id;
            $widget_instances[$unique_instance_id] = $instance_data;
          }
  
        }
  
      }
  
    }
  
    // Set active widgets instances
    foreach ( $sidebars_widgets as $sidebar_id => $widget_ids ) {
  
      // Skip inactive widgets
      if ( 'wp_inactive_widgets' == $sidebar_id ) {
        continue;
      }
  
      // Skip if no data or not an array (array_version)
      if ( ! is_array( $widget_ids ) || empty( $widget_ids ) ) {
        continue;
      }
  
      // Loop widget IDs for this sidebar
      foreach ( $widget_ids as $widget_id ) {
  
        // Is there an instance for this widget ID?
        if ( isset( $widget_instances[$widget_id] ) ) {
  
          // Add to array
          $active_widgets[$sidebar_id][$widget_id] = $widget_instances[$widget_id];
  
        }
  
      }
  
    }
  
    header( 'Content-disposition: attachment; filename=' . $theme . '-widgets.json' );
    header( 'Content-Type: application/octet-stream; charset=' . $charset );
    
    echo serialize( array(
      'template'         => $template,
      'sidebars_widgets' => $active_widgets
    ) );
    
    die();
  }
}

/**
 * Active widgets
 *
 * Gathers active widgets into an array with ID base, name, etc.
 * Used by export and import functions.
 *
 * @global array $wp_registered_widget_updates
 * @return array Widget information
 * @since 1.0.0
 */
if ( ! function_exists( 'archetype_active_widgets' ) ) {
  function archetype_active_widgets() {
    global $wp_registered_widget_controls;
    
    $available_widgets = array();
    $widget_controls   = $wp_registered_widget_controls;
    
    // Get all available widgets the site supports
    foreach ( $widget_controls as $widget ) {
  
      if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) { // no dupes
  
        $available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
        $available_widgets[$widget['id_base']]['name'] = $widget['name'];
  
      }
  
    }
    
    // Filter and return active widgets array
    return apply_filters( 'archetype_active_widgets', $available_widgets );
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
    $raw             = file_get_contents( $_FILES['customize-import-file']['tmp_name'] );
    $data            = @unserialize( $raw );
    
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