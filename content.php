<?php
/**
 * @package archetype
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="" itemtype="http://schema.org/BlogPosting">

  <?php
  /**
    * @hooked  archetype_post_header() - 10
    * @hooked  archetype_post_meta() - 20
    * @hooked  archetype_post_content() - 30
   */
  do_action( 'archetype_loop_post' );
  ?>

</article><!-- #post-## -->