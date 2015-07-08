<?php
/**
 * Custom homepage function.
 *
 * @package Archetype
 * @subpackage Homepage
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_homepage_content_components' ) ) :
	/**
	 * Adds the homepage content components.
	 *
	 * Hooked into the `init` action at priority 0
	 *
	 * @since 1.0.0
	 */
	function archetype_homepage_content_components() {
		for ( $id = 1; $id <= apply_filters( 'archetype_homepage_content_components', 3 ); $id++ ) {
			$modifier = 2 < $id ? 5 : 0;
			$priority = ( $id + $modifier ) * 10;
			add_action( 'homepage', 'archetype_homepage_content_' . $id, $priority );
		}
	}
endif;

if ( ! function_exists( 'archetype_homepage_content_component' ) ) :
	/**
	 * Displays the homepage content component by ID.
	 *
	 * @since 1.0.0
	 *
	 * @param int $id The component ID. Default is '1'.
	 */
	function archetype_homepage_content_component( $id = 1 ) {
		if ( ! is_homepage_control_activated() && true != archetype_sanitize_checkbox( get_theme_mod( 'archetype_homepage_content_' . $id . '_toggle', true ) ) ) {
			return false;
		}

		// Customizer content.
		$content_page 					  = archetype_sanitize_integer( get_theme_mod( 'archetype_homepage_content_' . $id, ( 1 === $id ? get_option( 'page_on_front' ) : 0 ) ) );
		$content_text_color 			= archetype_sanitize_hex_color( get_theme_mod( 'archetype_homepage_content_' . $id . '_text_color', apply_filters( 'archetype_default_homepage_content_' . $id . '_text_color', '#555' ) ) );
		$content_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_homepage_content_' . $id . '_background_color', apply_filters( 'archetype_default_homepage_content_' . $id . '_background_color', '#fff' ) ) );
		$content_alignment				= esc_attr( get_theme_mod( 'archetype_homepage_content_' . $id . '_alignment', 'left' ) );

		// CSS classes.
		$classes = array();
		$classes[] = 'archetype-homepage-content';
		$classes[] = 'archetype-homepage-content-' . $id;
		$classes[] = $content_alignment;
		$classes[] = 'expand-full-width';

		// CSS style attributes.
		$styles = array();
		$styles[] = "color: $content_text_color;";
		$styles[] = "background-color: $content_background_color;";

		if ( 0 !== $content_page && $page_data = get_page( $content_page ) ) {
			/**
			 * Filter the CSS classes added to the section tag.
			 *
			 * @since 1.0.0
			 *
			 * @param array $classes Array of CSS classes.
			 * @param int   $id The component ID.
			 */
			$classes = apply_filters( 'archetype_homepage_content_component_classes', $classes, $id );

			/**
			 * Filter the inline CSS styles added to the section tag.
			 *
			 * @since 1.0.0
			 *
			 * @param array $styles Array of inline CSS styles.
			 * @param int   $id The component ID.
			 */
			$styles = apply_filters( 'aarchetype_homepage_content_component_styles', $styles, $id );

			echo '<section class="' . implode( ' ', $classes ) . '" style="' . implode( ' ', $styles ) . '">';
				echo '<div class="col-full">';

					do_action( 'archetype_homepage_before_content_' . $id );

					echo apply_filters( 'the_content', $page_data->post_content );

					do_action( 'archetype_homepage_after_content_' . $id );

				echo '</div>';
			echo '</section>';
		}
	}
endif;

if ( ! function_exists( 'archetype_homepage_content_1' ) ) :
	/**
	 * Displays homepage content 1.
	 *
	 * Hooked into the `homepage` action in the homepage template at priority 10
	 *
	 * @since 1.0.0
	 */
	function archetype_homepage_content_1() {
		archetype_homepage_content_component( 1 );
	}
endif;

if ( ! function_exists( 'archetype_homepage_content_2' ) ) :
	/**
	 * Displays homepage content 2.
	 *
	 * Hooked into the `homepage` action in the homepage template at priority 20
	 *
	 * @since 1.0.0
	 */
	function archetype_homepage_content_2() {
		archetype_homepage_content_component( 2 );
	}
endif;

if ( ! function_exists( 'archetype_homepage_content_3' ) ) :
	/**
	 * Displays homepage content 3.
	 *
	 * Hooked into the `homepage` action in the homepage template at priority 80
	 *
	 * @since 1.0.0
	 */
	function archetype_homepage_content_3() {
		archetype_homepage_content_component( 3 );
	}
endif;
