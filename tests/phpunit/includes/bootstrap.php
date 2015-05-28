<?php
/**
 * Bootstrap the WordPress unit testing environment.
 *
 * @package Archetype
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );

if ( ! file_exists( $_tests_dir . '/includes/' ) ) {
	trigger_error( 'Unable to locate wordpress-tests-lib', E_USER_ERROR );
}

require_once $_tests_dir . '/includes/functions.php';

$basename = basename( dirname( __DIR__ ) );

$GLOBALS['wp_tests_options'] = array(
	'stylesheet' => $basename,
	'template' => $basename
);

tests_add_filter( 'set_current_user', function( $arg ) {
	$user = wp_get_current_user();
	$user->set_role( 'administrator' );
	return $arg;
}, 1, 10 );

tests_add_filter( 'filesystem_method', function( $arg ) {
	return 'direct';
}, 1, 10 );

require $_tests_dir . '/includes/bootstrap.php';