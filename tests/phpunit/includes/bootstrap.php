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

require_once $_tests_dir . '/includes/functions.php';

// Activate the theme.
if ( defined( 'WP_TEST_ACTIVATED_THEME' ) ) {
	$GLOBALS['wp_tests_options'] = array(
		'stylesheet' => WP_TEST_ACTIVATED_THEME,
		'template' => WP_TEST_ACTIVATED_THEME
	);
}

/**
 * Set the current user.
 *
 * @since 1.0.0
 */
function archetype_tests_set_current_user() {
	$user = wp_get_current_user();
	$user->set_role( 'administrator' );
}
tests_add_filter( 'set_current_user', 'archetype_tests_set_current_user', 1, 10 );

/**
 * Sets the filesystem method.
 *
 * @since 1.0.0
 */
function archetype_tests_filesystem_method() {
	return 'direct';
}
tests_add_filter( 'filesystem_method', 'archetype_tests_filesystem_method', 1, 10 );

require $_tests_dir . '/includes/bootstrap.php';
