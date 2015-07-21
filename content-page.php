<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Archetype
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Default hooks
	 *
	 * @hooked archetype_page_media() - 10
	 * @hooked archetype_page_header - 20
	 * @hooked archetype_page_content - 30
	 */
	do_action( 'archetype_page' );
	?>
</article><!-- #post-## -->
