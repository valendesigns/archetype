<?php
/**
 * Schema functions.
 *
 * @package Archetype
 * @subpackage Schema
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_html_tag_schema' ) ) :
	/**
	 * Schema type
	 *
	 * @since 1.0.0
	 *
	 * @param bool $echo Whether to eco or return.
	 * @return string
	 */
	function archetype_html_tag_schema( $echo = true ) {
		$schema  = 'http://schema.org/';
		$type    = 'WebPage';

		if ( is_singular( 'post' ) ) { // Is single post.
			$type = 'Article';
		} elseif ( is_author() ) { // Is author page.
			$type = 'ProfilePage';
		} elseif ( is_search() ) { // Is search results page.
			$type = 'SearchResultsPage';
		}

		$content = 'itemscope="itemscope" itemtype="' . esc_attr( $schema ) . esc_attr( $type ) . '"';

		if ( $echo ) {
			echo $content;
		} else {
			return $content;
		}
	}
endif;
