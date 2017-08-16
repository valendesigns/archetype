<?php
/**
 * Welcome tabs template
 *
 * @package Archetype
 * @subpackage Welcome
 * @since 1.0.0
 */

?>
<h2 class="nav-tab-wrapper">
	<a href="#get_started" class="nav-tab nav-tab-active"><?php esc_html_e( 'Get Started', 'archetype' ); ?></a>
	<a href="#add_ons" class="nav-tab"><?php esc_html_e( 'Extend Archetype', 'archetype' ); ?></a>
	<a href="#child_themes" class="nav-tab"><?php esc_html_e( 'Child Themes', 'archetype' ); ?></a>
</h2>

<script>
/**
 * Script for tabbed navigation.
 *
 * @since 1.0.0
 */
( function( $ ) {
	'use strict';

	$( document ).ready( function() {
		var wrap = $( '.about-wrap' );

		// Hide all panels except the first
		$( 'div.panel', wrap ).hide();
		$( 'div#get_started', wrap ).show();

		// Listen for the click event.
		$( '.nav-tab-wrapper a', wrap ).click( function() {

			// Deactivate and hide all tabs & panels.
			$( '.nav-tab-wrapper a', wrap ).removeClass( 'nav-tab-active' );
			$( 'div.panel', wrap ).hide();

			// Activate and show the selected tab and panel.
			$( this ).addClass( 'nav-tab-active' );
			$( 'div' + $( this ).attr( 'href' ), wrap ).show();

			return false;
		} );
	} );
} )( jQuery );
</script>
