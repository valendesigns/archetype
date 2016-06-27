<?php
/**
 * Bootstrap the WordPress unit testing environment.
 *
 * @package Archetype
 */

if ( strpos( __FILE__, '/srv/www/archetype.com/docroot' ) !== false ) {
	define( 'WP_CONTENT_DIR', dirname( __DIR__ ) . '/../../' );
	define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . 'plugins/' );
}

$_tests_dir = getenv( 'WP_TESTS_DIR' );

// Travis CI & Vagrant SSH tests directory.
if ( empty( $_tests_dir ) ) {
	$_tests_dir = '/tmp/wordpress-tests';
}

// Relative path to Core tests directory.
if ( ! file_exists( $_tests_dir . '/includes/' ) ) {
	$_tests_dir = '../../../../tests/phpunit';
}

if ( ! file_exists( $_tests_dir . '/includes/' ) ) {
	trigger_error( 'Unable to locate wordpress-tests-lib', E_USER_ERROR );
}

// Require functions
require_once( $_tests_dir . '/includes/functions.php' );

/**
 * Activate the theme
 *
 * @since 1.0.0
 */
function _manually_load_theme() {
	if ( defined( 'WP_TEST_ACTIVATED_THEME' ) ) {
		switch_theme( WP_TEST_ACTIVATED_THEME );
	}
}
tests_add_filter( 'muplugins_loaded', '_manually_load_theme' );

/**
 * Activate the plugins
 *
 * @since 1.0.0
 */
function _manually_load_plugins() {
	if ( defined( 'WP_TEST_ACTIVATED_PLUGINS' ) ) {
		$active_plugins = get_option( 'active_plugins', array() );
		$force_plugins = explode( ',', WP_TEST_ACTIVATED_PLUGINS );
		foreach( $force_plugins as $plugin ) {
			require_once( str_replace( '/themes/' . WP_TEST_ACTIVATED_THEME . '/tests', '', dirname( __FILE__ ) ) . '/plugins/' . $plugin );
			$active_plugins[] = $plugin;
		}
		update_option( 'active_plugins', $active_plugins );
	}
}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugins' );

/**
 * Install WooCommerce
 *
 * @since 1.0.0
 */
function archetype_tests_install_wc() {
	// clean existing install first
	define( 'WP_UNINSTALL_PLUGIN', true );
	update_option( 'woocommerce_status_options', array( 'uninstall_data' => 1 ) );
	require_once( str_replace( '/themes/' . WP_TEST_ACTIVATED_THEME . '/tests', '', dirname( __FILE__ ) ) . '/plugins/woocommerce/uninstall.php' );

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
require_once( $_tests_dir . '/includes/bootstrap.php' );
