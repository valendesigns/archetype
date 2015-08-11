<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * @package Archetype
 * @subpackage Functions
 * @since 1.0.0
 */

if ( ! function_exists( 'is_archetype_customizer_enabled' ) ) :
	/**
	 * Check whether the Archetype Customizer settings ar enabled
	 *
	 * @since 1.0.0
	 *
	 * @return boolean
	 */
	function is_archetype_customizer_enabled() {
		return (bool) apply_filters( 'archetype_customizer_enabled', true );
	}
endif;

if ( ! function_exists( 'is_woocommerce_activated' ) ) :
	/**
	 * Query WooCommerce activation
	 *
	 * @since 1.0.0
	 */
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce', false ) ? true : false;
	}
endif;

if ( ! function_exists( 'is_homepage_control_activated' ) ) :
	/**
	 * Query Homepage Control activation
	 *
	 * @since 1.0.0
	 */
	function is_homepage_control_activated() {
		return class_exists( 'Homepage_Control', false ) ? true : false;
	}
endif;

if ( ! function_exists( 'is_subscribe_and_connect_activated' ) ) :
	/**
	 * Query Subscribe & Connect activation
	 *
	 * @since 1.0.0
	 */
	function is_subscribe_and_connect_activated() {
		return class_exists( 'Subscribe_And_Connect', false ) ? true : false;
	}
endif;
