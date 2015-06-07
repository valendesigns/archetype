<?php
/**
 * Bootstrap the WordPress unit testing environment.
 *
 * @package Archetype
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );

// Travis testing.
if ( empty( $_tests_dir ) ) {
	$_tests_dir = '/tmp/wordpress-tests-lib';
}

// Command line testing in Core.
if ( ! file_exists( $_tests_dir . '/includes/' ) ) {
	$_tests_dir = '../../../../tests/phpunit';
	if ( ! file_exists( $_tests_dir . '/includes/' ) ) {
		trigger_error( 'Unable to locate wordpress-tests-lib', E_USER_ERROR );
	}
}

// Require functions
require_once $_tests_dir . '/includes/functions.php';

// Activate the plugins.
if ( defined( 'WP_TEST_ACTIVATED_PLUGINS' ) ) {
	$GLOBALS['wp_tests_options']['active_plugins'] = explode( ',', WP_TEST_ACTIVATED_PLUGINS );
}

// Activate the theme.
if ( defined( 'WP_TEST_ACTIVATED_THEME' ) ) {
	$GLOBALS['wp_tests_options']['stylesheet'] = WP_TEST_ACTIVATED_THEME;
	$GLOBALS['wp_tests_options']['template'] = WP_TEST_ACTIVATED_THEME;
}

/**
 * Install WooCommerce
 *
 * @since 1.0.0
 */
function archetype_tests_install_wc() {

	// clean existing install first
	define( 'WP_UNINSTALL_PLUGIN', true );
	include( str_replace( '/themes/' . WP_TEST_ACTIVATED_THEME . '/tests/phpunit/includes', '', dirname( __FILE__ ) ) . '/plugins/woocommerce/uninstall.php' );

	WC_Install::install();

	// reload capabilities after install, see https://core.trac.wordpress.org/ticket/28374
	$GLOBALS['wp_roles']->reinit();

	echo "Installing WooCommerce..." . PHP_EOL;
}
tests_add_filter( 'setup_theme', 'archetype_tests_install_wc' );

/**
 * Sets the filesystem method.
 *
 * @since 1.0.0
 */
function archetype_tests_filesystem_method() {
	return 'direct';
}
tests_add_filter( 'filesystem_method', 'archetype_tests_filesystem_method', 1, 10 );

// Require bootstrap
require $_tests_dir . '/includes/bootstrap.php';
