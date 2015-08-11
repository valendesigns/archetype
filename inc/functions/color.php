<?php
/**
 * Archetype color functions
 *
 * @package Archetype
 * @subpackage Color
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_rgb_from_hex' ) ) :
	/**
	 * Converts HEX to RGB
	 *
	 * @since 1.0.0
	 *
	 * @param string $hex The hexidecimal color code.
	 * @param string $color Set to r, g, or b to return a specific color.
	 * @return mixed An array of color values or a single color when $color is set. False when it can't be converted.
	 */
	function archetype_rgb_from_hex( $hex, $color = '' ) {

		$hex = str_replace( '#', '', $hex );

		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ).substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ).substr( $hex, 2, 1 ) );
		} else if ( strlen( $hex ) == 6 ) {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		} else {
			return false;
		}

		$rgb = array();
		$rgb['r'] = $r;
		$rgb['g'] = $g;
		$rgb['b'] = $b;

		if ( isset( $rgb[ $color ] ) ) {
			return $rgb[ $color ];
		}

		return $rgb;
	}
endif;
