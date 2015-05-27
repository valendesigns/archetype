<?php
/**
 * The template used for displaying post content
 *
 * @package archetype
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="" itemtype="http://schema.org/BlogPosting">

	<?php
	/**
	 * Default hooks
	 *
	 * @hooked archetype_post_format_media() - 10
	 * @hooked archetype_post_header() - 20
	 * @hooked archetype_post_content() - 30
	 * @hooked archetype_post_meta() - 40
	 */
	do_action( 'archetype_loop_post' );
	?>

</article><!-- #post-## -->
