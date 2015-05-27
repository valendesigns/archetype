<?php
/**
 * Bootstrap the WordPress unit testing environment.
 *
 * @package archetype
 */

// Activates this theme in WordPress so it can be tested.
$GLOBALS['wp_tests_options'] = array(
	'template'   => 'archetype',
	'stylesheet' => 'archetype'
);

// Load the WordPress test suite.
require '../../../../tests/phpunit/includes/bootstrap.php';