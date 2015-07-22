<?php
/**
 * Custom template tags for this theme.
 *
 * @package Archetype
 * @subpackage Template_Tags
 * @since 1.0.0
 */

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
			$context = ( 'archetype_inside_header' === current_filter() ? 'header' : 'footer' );
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

if ( ! function_exists( 'archetype_get_sidebar' ) ) :
	/**
	 * Display archetype sidebar
	 *
	 * @uses get_sidebar()
	 *
	 * @since 1.0.0
	 */
	function archetype_get_sidebar() {
		get_sidebar();
	}
endif;

if ( ! function_exists( 'archetype_hide_title_post_formats' ) ) :
	/**
	 * Returns an array of post formats that do not have a title.
	 *
	 * @since 1.0.0
	 *
	 * @return array An array of post formats.
	 */
	function archetype_hide_title_post_formats() {
		/**
		 * Filter the array of post formats that do not have a title.
		 *
		 * @since 1.0.0
		 *
		 * @param array $post_formats An array of post formats.
		 */
		$post_formats = apply_filters( 'archetype_hide_title_post_formats', array( 'aside', 'link', 'status' ) );

		return $post_formats;
	}
endif;

if ( ! function_exists( 'archetype_has_content' ) ) :
	/**
	 * Check for the existence of post content.
	 *
	 * @uses get_post()
	 *
	 * @since 1.0.0
	 *
	 * @param int|WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
	 * @param string      $key  Optional. WP_Post object key. Default is 'post_content'.
	 * @return bool
	 */
	function archetype_has_content( $post = 0, $key = 'post_content' ) {
		$post = get_post( $post );
		return ( isset( $post->$key ) && ! empty( $post->$key ) );
	}
endif;

if ( ! function_exists( 'archetype_has_title' ) ) :
	/**
	 * Check for the existence of a post title.
	 *
	 * @uses get_post()
	 *
	 * @since 1.0.0
	 *
	 * @param int|WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
	 * @return bool
	 */
	function archetype_has_title( $post = 0 ) {
		$post = get_post( $post );
		return ( isset( $post->post_title ) && ! empty( $post->post_title ) );
	}
endif;

if ( ! function_exists( 'archetype_hide_title' ) ) :
	/**
	 * Check for a hidden post title.
	 *
	 * @uses get_post()
	 *
	 * @since 1.0.0
	 *
	 * @param int|WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
	 * @return bool
	 */
	function archetype_hide_title( $post = 0 ) {
		$post = get_post( $post );
		return apply_filters( 'archetype_hide_title', false, $post );
	}
endif;

if ( ! function_exists( 'archetype_hide_author_bio' ) ) :
	/**
	 * Check for a hidden author bio.
	 *
	 * @uses get_post()
	 *
	 * @since 1.0.0
	 *
	 * @param int|WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
	 * @return bool
	 */
	function archetype_hide_author_bio( $post = 0 ) {
		$post = get_post( $post );
		return apply_filters( 'archetype_hide_author_bio', false, $post );
	}
endif;

if ( ! function_exists( 'archetype_entry_header_class' ) ) :
	/**
	 * Setup the entry-header classes.
	 *
	 * @uses archetype_has_title()
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	function archetype_entry_header_class() {
		// Default class.
		$classes = array( 'entry-header' );

		/*
		 * Add the `hide-title` class when the title is missing or we're viewing certain post formats.
		 */
		if ( archetype_hide_title() || ! archetype_has_title() || has_post_format( archetype_hide_title_post_formats() ) ) {
			$classes[] = 'hide-title';
		}

		/**
		 * Filter the array of classes to return for the entry header.
		 *
		 * @since 1.0.0
		 *
		 * @param array $classes An array of classes to return for the entry header.
		 */
		$classes = apply_filters( 'archetype_entry_header_class', $classes );

		// Return a string of classes each separated by an empty space.
		return implode( $classes, ' ' );
	}
endif;
