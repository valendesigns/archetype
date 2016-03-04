<?php
/**
 * Archetype taxonomy functions
 *
 * @package Archetype
 * @subpackage Search
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_categorized_blog' ) ) :
	/**
	 * Returns true if a blog has more than 1 category.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	function archetype_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'archetype_categories' ) ) ) {
			$args = array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				'number'     => 2, // We only need to know if there is more than one category.
			);

			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( $args );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'archetype_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {

			// This blog has more than 1 category so archetype_categorized_blog should return true.
			return true;
		} else {

			// This blog has only 1 category so archetype_categorized_blog should return false.
			return false;
		}
	}
endif;

if ( ! function_exists( 'archetype_category_transient_flusher' ) ) :
	/**
	 * Flush out the transients used in archetype_categorized_blog.
	 *
	 * @since 1.0.0
	 */
	function archetype_category_transient_flusher() {
		// Like, beat it. Dig?
		delete_transient( 'archetype_categories' );
	}
endif;
