<?php
/**
 * Test schema functions
 *
 * @package Archetype
 * @group schema
 */
class Tests_Schema extends WP_UnitTestCase {

	/**
	 * Check that the Schema type is correct for the default context.
	 */
	function test_archetype_html_tag_schema_default() {

		$this->assertSame( 'itemscope="itemscope" itemtype="http://schema.org/WebPage"', archetype_html_tag_schema( false ) );

	}
	
	/**
	 * Check that the Schema type is correct for the default context during echo.
	 */
	function test_archetype_html_tag_schema_default_echo() {

		ob_start();
		archetype_html_tag_schema( true );
		$buffer = ob_get_contents();
		ob_end_clean();

		$this->assertSame( 'itemscope="itemscope" itemtype="http://schema.org/WebPage"', $buffer );

	}

	/**
	 * Check that the Schema type is correct for the post context.
	 */
	function test_archetype_html_tag_schema_post() {

		$this->go_to( get_permalink( $this->factory->post->create() ) );

		$this->assertSame( 'itemscope="itemscope" itemtype="http://schema.org/Article"', archetype_html_tag_schema( false ) );

	}

	/**
	 * Check that the Schema type is correct for the author context.
	 */
	function test_archetype_html_tag_schema_author() {

		$this->go_to( get_author_posts_url( 1 ) );

		$this->assertSame( 'itemscope="itemscope" itemtype="http://schema.org/ProfilePage"', archetype_html_tag_schema( false ) );

	}

	/**
	 * Check that the Schema type is correct for the search context.
	 */
	function test_archetype_html_tag_schema_search() {

		$this->go_to( '/?s=a' );

		$this->assertSame( 'itemscope="itemscope" itemtype="http://schema.org/SearchResultsPage"', archetype_html_tag_schema( false ) );

	}

}
