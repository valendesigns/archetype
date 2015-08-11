<?php
/**
 * Archetype shortcode functions
 *
 * @package Archetype
 * @subpackage Shortcode
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_do_shortcode_func' ) ) :
	/**
	 * Call a shortcode function by tag name.
	 *
	 * @since  1.0.0
	 *
	 * @param string $tag     The shortcode tag.
	 * @param array  $atts    The attributes to pass to the shortcode function. Optional.
	 * @param array  $content The shortcode's content. Default is null (none).
	 *
	 * @return string|bool False on failure, the result of the shortcode on success.
	 */
	function archetype_do_shortcode_func( $tag, array $atts = array(), $content = null ) {
		global $shortcode_tags;

		if ( ! isset( $shortcode_tags[ $tag ] ) ) {
			return false;
		}

		return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
	}
endif;
