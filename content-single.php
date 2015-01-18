<?php
/**
 * @package archetype
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="" itemtype="http://schema.org/BlogPosting">

  <?php
  /**
   * @hooked archetype_post_format_media() - 10
   * @hooked archetype_post_header() - 20
   * @hooked archetype_post_content() - 30
   * @hooked archetype_post_author_bio() - 40
   * @hooked archetype_post_meta() - 50
   */
  do_action( 'archetype_single_post' );
  ?>

</article><!-- #post-## -->
