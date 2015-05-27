<?php
/**
 * @package archetype
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="" itemtype="http://schema.org/ImageObject">
	
	<?php
	/**
	 * @hooked archetype_image_attachment() - 10
	 * @hooked archetype_image_header() - 20
	 * @hooked archetype_image_content() - 30
	 * @hooked archetype_image_meta() - 40
	 */
	do_action( 'archetype_single_image' );
	?>
	
</article><!-- #post-## -->