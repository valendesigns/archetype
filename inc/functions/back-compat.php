<?php
/**
 * Archetype back compat functionality
 *
 * Prevents Archetype from running on WordPress versions prior to 4.1,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.1.
 *
 * @package WordPress
 * @subpackage Archetype
 * @since 1.0.0
 */

/**
 * Prevent switching to Archetype on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since 1.0.0
 */
function archetype_switch_theme() {
  switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
  unset( $_GET['activated'] );
  add_action( 'admin_notices', 'archetype_upgrade_notice' );
}
add_action( 'after_switch_theme', 'archetype_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Archetype on WordPress versions prior to 4.1.
 *
 * @since 1.0.0
 */
function archetype_upgrade_notice() {
  printf( '<div class="error"><p>%s</p></div>', archetype_back_compat_msg() );
}

/**
 * Prevent the Customizer from being loaded on WordPress versions prior to 4.1.
 *
 * @since 1.0.0
 */
function archetype_customize() {
  wp_die( archetype_back_compat_msg(), '', array(
    'back_link' => true
  ) );
}
add_action( 'load-customize.php', 'archetype_customize' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 4.1.
 *
 * @since 1.0.0
 */
function archetype_preview() {
  if ( isset( $_GET['preview'] ) ) {
    wp_die( archetype_back_compat_msg() );
  }
}
add_action( 'template_redirect', 'archetype_preview' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 4.1.
 *
 * @since 1.0.0
 */
function archetype_back_compat_msg() {
  return sprintf( __( 'Archetype requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'archetype' ), $GLOBALS['wp_version'] );
  }
}
