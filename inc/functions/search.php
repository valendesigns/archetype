<?php
/**
 * Archetype search functions
 *
 * @package Archetype
 * @subpackage Search
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_post_search_form' ) ) :
	/**
	 * Replaces `get_search_form()` with post only search.
	 *
	 * @since 1.0.0
	 *
	 * @param string $form The form markup.
	 * @return string
	 */
	function archetype_post_search_form( $form ) {
		if ( true === apply_filters( 'archetype_post_search_form', true ) ) {
			$form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
				<label>
					<span class="screen-reader-text">' . _x( 'Search for:', 'label', 'archetype' ) . '</span>
					<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder', 'archetype' ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Search for:', 'label', 'archetype' ) . '" />
				</label>
				<input type="submit" class="search-submit" value="'. esc_attr_x( 'Search', 'submit button', 'archetype' ) .'" />
				<input type="hidden" name="post_type" value="post" />
			</form>';
		}
		return $form;
	}
endif;
