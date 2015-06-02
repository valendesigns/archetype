<?php
/**
 * Custom template tags for this theme.
 *
 * @package Archetype
 * @subpackage Template_Tags
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_homepage_content' ) ) :
	/**
	 * Display homepage content
	 *
	 * Hooked into the `homepage` action in the homepage template at priority 10
	 *
	 * @since 1.0.0
	 */
	function archetype_homepage_content() {
		if ( ! is_homepage_control_activated() && true != archetype_sanitize_checkbox( get_theme_mod( 'archetype_homepage_content_toggle', true ) ) ) {
			return false;
		}

		// Customizer content.
		$content_text_color 			= archetype_sanitize_hex_color( get_theme_mod( 'archetype_homepage_content_text_color', apply_filters( 'archetype_default_homepage_content_text_color', '#555' ) ) );
		$content_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_homepage_content_background_color', apply_filters( 'archetype_default_homepage_content_background_color', '#fff' ) ) );
		$content_alignment				= esc_attr( get_theme_mod( 'archetype_homepage_content_alignment', 'left' ) );

		// CSS classes.
		$classes = array();
		$classes[] = 'archetype-homepage-content';
		$classes[] = 'archetype-homepage-content-1';
		$classes[] = $content_alignment;
		$classes[] = 'expand-full-width';

		// CSS style attributes.
		$styles = array();
		$styles[] = "color: $content_text_color;";
		$styles[] = "background-color: $content_background_color;";

		// Page content.
		while ( have_posts() ) : the_post();

			if ( '' === get_the_content() ) {
				return;
			}

			echo '<section class="' . implode( ' ', $classes ) . '" style="' . implode( ' ', $styles ) . '">';
				echo '<div class="col-full">';

					do_action( 'archetype_homepage_before_content' );

					get_template_part( 'content', 'page' );

					do_action( 'archetype_homepage_after_content' );

				echo '</div>';
			echo '</section>';

		endwhile;
	}
endif;

if ( ! function_exists( 'archetype_homepage_content_2' ) ) :
	/**
	 * Display homepage content 2
	 *
	 * Hooked into the `homepage` action in the homepage template at priority 20
	 *
	 * @since 1.0.0
	 */
	function archetype_homepage_content_2() {
		if ( ! is_homepage_control_activated() && true != archetype_sanitize_checkbox( get_theme_mod( 'archetype_homepage_content_2_toggle', true ) ) ) {
			return false;
		}

		// Customizer content.
		$custom_content 					= wp_kses_post( trim( get_theme_mod( 'archetype_homepage_content_2', '' ) ) );
		$content_text_color 			= archetype_sanitize_hex_color( get_theme_mod( 'archetype_homepage_content_2_text_color', apply_filters( 'archetype_default_homepage_content_2_text_color', '#555' ) ) );
		$content_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_homepage_content_2_background_color', apply_filters( 'archetype_default_homepage_content_2_background_color', '#fff' ) ) );
		$content_alignment				= esc_attr( get_theme_mod( 'archetype_homepage_content_2_alignment', 'left' ) );

		// CSS classes.
		$classes = array();
		$classes[] = 'archetype-homepage-content';
		$classes[] = 'archetype-homepage-content-2';
		$classes[] = $content_alignment;
		$classes[] = 'expand-full-width';

		// CSS style attributes.
		$styles = array();
		$styles[] = "color: $content_text_color;";
		$styles[] = "background-color: $content_background_color;";

		if ( '' !== $custom_content ) {
			echo '<section class="' . implode( ' ', $classes ) . '" style="' . implode( ' ', $styles ) . '">';
				echo '<div class="col-full">';

					do_action( 'archetype_homepage_before_content_2' );

					echo do_shortcode( wpautop( $custom_content ) );

					do_action( 'archetype_homepage_after_content_2' );

				echo '</div>';
			echo '</section>';
		}
	}
endif;

if ( ! function_exists( 'archetype_homepage_content_3' ) ) :
	/**
	 * Display homepage content 3
	 *
	 * Hooked into the `homepage` action in the homepage template at priority 80
	 *
	 * @since 1.0.0
	 */
	function archetype_homepage_content_3() {
		if ( ! is_homepage_control_activated() && true != archetype_sanitize_checkbox( get_theme_mod( 'archetype_homepage_content_3_toggle', true ) ) ) {
			return false;
		}

		// Customizer content.
		$custom_content            = wp_kses_post( trim( get_theme_mod( 'archetype_homepage_content_3', '' ) ) );
		$content_text_color        = archetype_sanitize_hex_color( get_theme_mod( 'archetype_homepage_content_3_text_color', apply_filters( 'archetype_default_homepage_content_3_text_color', '#555' ) ) );
		$content_background_color  = archetype_sanitize_hex_color( get_theme_mod( 'archetype_homepage_content_3_background_color', apply_filters( 'archetype_default_homepage_content_3_background_color', '#fff' ) ) );
		$content_alignment         = esc_attr( get_theme_mod( 'archetype_homepage_content_3_alignment', 'left' ) );

		// CSS classes.
		$classes   = array();
		$classes[] = 'archetype-homepage-content';
		$classes[] = 'archetype-homepage-content-3';
		$classes[] = $content_alignment;
		$classes[] = 'expand-full-width';

		// CSS style attributes.
		$styles    = array();
		$styles[]  = "color: $content_text_color;";
		$styles[]  = "background-color: $content_background_color;";

		if ( '' !== $custom_content ) {
			echo '<section class="' . implode( ' ', $classes ) . '" style="' . implode( ' ', $styles ) . '">';
				echo '<div class="col-full">';

					do_action( 'archetype_homepage_before_content_3' );

					echo do_shortcode( wpautop( $custom_content ) );

					do_action( 'archetype_homepage_after_content_3' );

				echo '</div>';
			echo '</section>';
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
		if ( class_exists( 'Subscribe_And_Connect' ) ) {
			echo '<div class="subscribe-and-connect-connect">';
				echo '<div class="col-full">';
					subscribe_and_connect_connect();
				echo '</div>';
			echo '</div>';
		}
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
	 * @return bool
	 */
	function archetype_has_content( $post = 0 ) {
		$post = get_post( $post );
		return ( isset( $post->post_content ) && ! empty( $post->post_content ) );
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
