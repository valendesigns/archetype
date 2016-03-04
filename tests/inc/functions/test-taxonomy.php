<?php
/**
 * Test taxonomy functions
 *
 * @package Archetype
 * @group taxonomy
 */
class Tests_Taxonomy extends WP_UnitTestCase {

	/**
	 * Check that `true` is returned when the blog has more than 1 category.
	 */
	function test_archetype_categorized_blog() {

		$this->assertFalse( archetype_categorized_blog() );

		wp_set_object_terms( $this->factory->post->create(), array(
			$this->factory->category->create(),
			$this->factory->category->create(),
		), 'category' );

		archetype_category_transient_flusher();

		$this->assertTrue( archetype_categorized_blog() );

	}

	/**
	 * Deletes the `archetype_categories` transients
	 */
	function test_archetype_category_transient_flusher() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

}
