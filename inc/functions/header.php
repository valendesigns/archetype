<?php
/**
 * Template functions used for the site header.
 *
 * @package Archetype
 * @subpackage Header
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_site_header' ) ) :
	/**
	 * Display site header
	 *
	 * @since 1.0.0
	 */
	function archetype_site_header() {
		?>
		<div class="col-full">

			<?php
			/**
			 * Default hooks
			 *
			 * @hooked archetype_site_branding - 10
			 * @hooked archetype_secondary_navigation - 20
			 */
			do_action( 'archetype_site_header' ); ?>

		</div><!-- .col-full -->
		<?php
	}
endif;

if ( ! function_exists( 'archetype_header_widget_region' ) ) :
	/**
	 * Display header widget region
	 *
	 * @since 1.0.0
	 */
	function archetype_header_widget_region() {
		?>
		<div class="<?php archetype_site_header_classes(); ?>" style="<?php archetype_site_header_styles(); ?>">

			<div class="col-full">

				<?php
				/**
				 * Default hooks
				 *
				 * @hooked archetype_header_widgets - 10
				 */
				do_action( 'archetype_header_widgets' ); ?>

			</div><!-- .col-full -->

		</div><!-- .header-widget-region -->
		<?php
	}
endif;

if ( ! function_exists( 'archetype_site_branding' ) ) :
	/**
	 * Display Site Branding
	 *
	 * @since 1.0.0
	 */
	function archetype_site_branding() {
		// Default branding markup.
		$branding = '<div class="site-branding">
			<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . get_bloginfo( 'name', 'display' ) . '</a></h1>
			<p class="site-description">' . get_bloginfo( 'description', 'display' ) . '</p>
		</div>';

		// Support Jetpack Site Logo.
		if ( function_exists( 'jetpack_has_site_logo' ) ) {
			jetpack_the_site_logo();

			if ( jetpack_has_site_logo() ) {
				if ( is_customize_preview() ) {
					$branding = str_replace( '<div class="site-branding">', '<div class="site-branding" style="display:none">', $branding );
				} else {
					return;
				}
			}
		}

		// Display default.
		echo $branding;
	}
endif;

if ( ! function_exists( 'archetype_primary_navigation' ) ) :
	/**
	 * Display Primary Navigation
	 *
	 * @since 1.0.0
	 */
	function archetype_primary_navigation() {
		/**
		 * Filter the classes added to the navigation wrapper.
		 *
		 * @since 1.0.0
		 *
		 * @param array $classes Array of CSS classes.
		 */
		$classes = apply_filters( 'archetype_primary_navigation_classes', array() );
		?>
		<div id="navigation" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<div class="col-full">
				<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php _e( 'Primary Navigation', 'archetype' ); ?>">
					<button class="menu-toggle"><span class="screen-reader-text"><?php echo esc_attr( apply_filters( 'archetype_menu_toggle_text', __( 'Navigation', 'archetype' ) ) ); ?></span></button>
					<?php
					do_action( 'archetype_primary_navigation' );

					wp_nav_menu(
						array(
							'theme_location'	=> 'primary',
							'container_class' => 'primary-navigation',
						)
					);

					wp_nav_menu(
						array(
							'theme_location'	=> 'handheld',
							'container_class' => 'handheld-navigation',
						)
					);
					?>
				</nav><!-- #site-navigation -->
			</div><!-- .col-full -->
		</div><!-- #navigation -->
		<?php
	}
endif;

if ( ! function_exists( 'archetype_secondary_navigation' ) ) :
	/**
	 * Display Secondary Navigation
	 *
	 * @since 1.0.0
	 */
	function archetype_secondary_navigation() {
		$current = current_filter();

		// The markup changes for alternative headers.
		if ( 'archetype_header' === $current ) {
			echo '<div class="secondary-navigation-wrap"><div class="col-full">';
		}
		?>
		<nav class="secondary-navigation" role="navigation" aria-label="<?php _e( 'Secondary Navigation', 'archetype' ); ?>">
			<?php
			do_action( 'archetype_secondary_navigation' );

			wp_nav_menu(
				array(
					'theme_location' => 'secondary',
					'fallback_cb'		=> '',
				)
			);
			?>
		</nav><!-- #site-navigation -->
		<?php
		if ( 'archetype_header' === $current ) {
			echo '</div></div>';
		}
	}
endif;

if ( ! function_exists( 'archetype_skip_links' ) ) :
	/**
	 * Skip links
	 *
	 * @since 1.0.0
	 */
	function archetype_skip_links() {
		?>
		<a class="skip-link screen-reader-text" href="#site-navigation"><?php _e( 'Skip to navigation', 'archetype' ); ?></a>
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'archetype' ); ?></a>
		<?php
	}
endif;

if ( ! function_exists( 'archetype_header_widgets' ) ) :
	/**
	 * Display the header widget regions
	 *
	 * @since 1.0.0
	 */
	function archetype_header_widgets() {
		/** This filter is documented in inc/functions/setup.php */
		$header_widget_regions = apply_filters( 'archetype_header_widget_regions', 4 );
		$widget_columns = 0;

		for ( $i = 1; $i <= intval( $header_widget_regions ); $i++ ) {
			if ( is_active_sidebar( 'header-' . $i ) ) {
				$widget_columns++;
				$last = $i;
			}
		}

		// CSS classes.
		$classes = array();
		$classes[] = 'header-widgets';
		$classes[] = 'dynamic-widget-regions';
		$classes[] = 'col-' . intval( $widget_columns );

		// CSS style attributes.
		$styles = array();

		/**
		 * Filter the CSS classes added to the aside tag.
		 *
		 * @since 1.0.0
		 *
		 * @param array $classes Array of CSS classes.
		 * @param int   $widget_columns The number of widget columns.
		 */
		$classes = apply_filters( 'archetype_header_widget_regions_classes', $classes, $widget_columns );

		/**
		 * Filter the inline CSS styles added to the section tag.
		 *
		 * @since 1.0.0
		 *
		 * @param array $styles Array of inline CSS styles.
		 * @param int   $widget_columns The number of widget columns.
		 */
		$styles = apply_filters( 'archetype_header_widget_regions_styles', $styles, $widget_columns );

		if ( $widget_columns > 0 ) : ?>

			<div class="<?php echo implode( ' ', $classes ); ?>" style="<?php echo implode( ' ', $styles ); ?>">

				<?php $i = 0; while ( $i < $header_widget_regions ) : $i++; ?>

					<?php if ( is_active_sidebar( 'header-' . $i ) ) : ?>

						<div class="header-widget-area-<?php echo intval( $i ); ?> <?php echo $i === $last ? 'dynamic-widget-region last' : 'dynamic-widget-region'; ?>">
							<?php dynamic_sidebar( 'header-' . intval( $i ) ); ?>
						</div>

					<?php endif; ?>

				<?php endwhile; ?>

			</div><!-- .header-widgets	-->

		<?php endif;
	}
endif;

if ( ! function_exists( 'archetype_site_header_classes' ) ) :
	/**
	 * Build the site header classes.
	 *
	 * @since 1.0.0
	 *
	 * @param array $classes Array of additional CSS classes.
	 */
	function archetype_site_header_classes( $classes = array() ) {
		// CSS classes.
		$classes[] = 'header-widget-region';

		/**
		 * Filter the CSS classes added to the site header.
		 *
		 * @since 1.0.0
		 *
		 * @param array $classes Array of CSS classes.
		 */
		$classes = apply_filters( 'archetype_site_header_classes', $classes );

		echo esc_attr( implode( ' ', $classes ) );
	}
endif;

if ( ! function_exists( 'archetype_site_header_styles' ) ) :
	/**
	 * Build the site header styles.
	 *
	 * @since 1.0.0
	 *
	 * @param array $styles Array of inline CSS styles.
	 */
	function archetype_site_header_styles( $styles = array() ) {
		/**
		 * Filter the CSS styles added to the site header.
		 *
		 * @since 1.0.0
		 *
		 * @param array $styles Array of inline CSS styles.
		 */
		$styles = apply_filters( 'archetype_site_header_styles', $styles );

		echo esc_attr( implode( ' ', $styles ) );
	}
endif;
