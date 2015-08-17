<?php
/**
 * Social icon functions.
 *
 * @package Archetype
 * @subpackage Social
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_subscribe_and_connect' ) ) :
	/**
	 * Remove the Subscribe & Connect content filter.
	 *
	 * @since 1.0.0
	 */
	function archetype_subscribe_and_connect() {
		remove_filter( 'the_content', 'subscribe_and_connect_content_filter' );
	}
endif;

if ( ! function_exists( 'archetype_dequeue_subscribe_and_connect' ) ) :
	/**
	 * Denqueue Subscribe & Connect styles in the footer.
	 *
	 * @since 1.0.0
	 */
	function archetype_dequeue_subscribe_and_connect() {
		if ( is_subscribe_and_connect_activated() ) {
			global $subscribe_and_connect;
			remove_action( 'wp_footer', array( $subscribe_and_connect->context, 'maybe_load_theme_stylesheets' ), 10 );
		}
	}
endif;

if ( ! function_exists( 'archetype_social_icons' ) ) :
	/**
	 * Display social icons
	 *
	 * If the subscribe and connect plugin is active, display the icons.
	 *
	 * @link http://wordpress.org/plugins/subscribe-and-connect/
	 *
	 * @since 1.0.0
	 */
	function archetype_social_icons() {
		if ( is_subscribe_and_connect_activated() ) {
			$context = ( 'archetype_header' === current_filter() ? 'header' : 'footer' );
			?>
			<div class="<?php echo archetype_social_icons_classes( $context ); ?>">
				<div class="col-full">
					<?php echo subscribe_and_connect_connect(); ?>
				</div>
			</div>
			<?php
		}
	}
endif;

if ( ! function_exists( 'archetype_social_icons_post' ) ) :
	/**
	 * Displays HTML markup for the "subscribe" and "connect" sections, below the given content.
	 *
	 * @since 1.0.0
	 */
	function archetype_social_icons_post() {
		if ( is_singular( 'post' ) && is_subscribe_and_connect_activated() ) {
			global $subscribe_and_connect;
			$settings = $subscribe_and_connect->get_settings();

			// Display is on.
			if ( 'the_content' === $settings['display']['auto_integration'] ) {
				?>
				<div class="<?php echo archetype_social_icons_classes( 'the_content', $settings ); ?>">
					<?php
					echo subscribe_and_connect_get_welcome_text();
					echo subscribe_and_connect_get_subscribe();
					echo subscribe_and_connect_get_connect();
					?>
				</div>
				<?php
			}
		}
	}
endif;

if ( ! function_exists( 'archetype_social_icons_classes' ) ) :
	/**
	 * Return the social icon container classes.
	 *
	 * @since 1.0.0
	 *
	 * @param string $context The placement context. The default is 'header'.
	 * @param array  $settings The Subscribe & Connect settings.
	 * @return string
	 */
	function archetype_social_icons_classes( $context = 'header', $settings = array() ) {
		if ( is_subscribe_and_connect_activated() ) {
			if ( empty( $settings ) ) {
				global $subscribe_and_connect;
				$settings = $subscribe_and_connect->get_settings();
			}

			// Get the theme.
			$theme = isset( $settings['display']['theme'] ) ? $settings['display']['theme'] : 'none';

			/**
			 * Filter the theme for the social icons.
			 *
			 * @since 1.0.0
			 *
			 * @param string $theme The current icon theme.
			 * @param string $context The placement context.
			 */
			$theme = apply_filters( 'archetype_social_icons_theme', $theme, $context );

			$classes = array();
			$classes[] = 'subscribe-and-connect-connect';
			$classes[] = 'theme-' . $theme;

			if ( in_array( $theme, array( 'boxed', 'rounded', 'circular' ) ) ) {
				$classes[] = 'has-background-color';
				$classes[] = 'has-large-icons';
			}

			/**
			 * Filter the classes for the social icons container.
			 *
			 * @since 1.0.0
			 *
			 * @param array  $classes The classes array.
			 * @param string $theme The current icon theme.
			 * @param string $context The placement context.
			 */
			$classes = apply_filters( 'archetype_social_icons_classes', $classes, $theme, $context );

			return esc_attr( implode( ' ', $classes ) );
		}
	}
endif;
