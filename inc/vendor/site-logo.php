<?php
if ( ! function_exists( 'archetype_site_logo_init' ) ) :
	/**
	 * Activate the Site Logo plugin.
	 *
	 * @uses current_theme_supports()
	 *
	 * @since 1.0.0
	 */
	function archetype_site_logo_init() {
		// Only load our code if our theme declares support, and the standalone plugin is not activated.
		if ( current_theme_supports( 'site-logo' ) && ! class_exists( 'Site_Logo', false ) ) {
			// Load our class for namespacing.
			require( dirname( __FILE__ ) . '/site-logo/inc/class-site-logo.php' );

			// Load template tags.
			require( dirname( __FILE__ ) . '/site-logo/inc/functions.php' );

			// Load backwards-compatible template tags.
			require( dirname( __FILE__ ) . '/site-logo/inc/compat.php' );
		}
	}

	add_action( 'init', 'archetype_site_logo_init' );

endif;
