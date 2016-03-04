<?php
/**
 * Test search functions
 *
 * @package Archetype
 * @group search
 */
class Tests_Search extends WP_UnitTestCase {

	/**
	 * Check that the markup in `get_search_form()` is replaced.
	 */
	function test_archetype_post_search_form() {

		add_filter( 'archetype_post_search_form', '__return_false' );
		$this->assertNotContains( '<input type="hidden" name="post_type" value="post" />', archetype_post_search_form( '' ) );
		add_filter( 'archetype_post_search_form', '__return_true' );

		$this->assertContains( '<input type="hidden" name="post_type" value="post" />', archetype_post_search_form( '' ) );

	}

}
