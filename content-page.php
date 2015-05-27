<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package archetype
 */

if ( is_page_template( 'template-homepage.php' ) && get_the_content() == '' ) {
	return;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Default hooks
	 *
	 * @hooked archetype_page_header - 10
	 * @hooked archetype_page_content - 20
	 */
	do_action( 'archetype_page' );
	?>
</article><!-- #post-## -->
