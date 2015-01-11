<?php
/**
 * Template functions used for images.
 *
 * @package archetype
 */

if ( ! function_exists( 'archetype_image_attachment' ) ) {
  /**
   * Display the image attachment.
   *
   * @since 1.0.0
   */
  function archetype_image_attachment() { ?>
    <div class="post-thumbnail">
      <?php
        /**
         * Filter the default Archetype image attachment size.
         *
         * @since 1.0.0
         *
         * @param string $image_size Image size. Default 'large'.
         */
        $image_size = apply_filters( 'archetype_attachment_size', 'large' );

        echo wp_get_attachment_image( get_the_ID(), $image_size, '', array( 'itemprop' => 'contentUrl' ) );
      ?>
    </div><!-- .post-thumbnail -->
    <?php
  }
}

if ( ! function_exists( 'archetype_image_header' ) ) {
  /**
   * Display the image header
   *
   * @since 1.0.0
   */
  function archetype_image_header() { ?>
    <header class="entry-header">
      <?php the_title( '<h1 class="entry-title" itemprop="name">', '</h1>' ); ?>
    </header><!-- .entry-header -->
    <?php
  }
}

if ( ! function_exists( 'archetype_image_content' ) ) {
  /**
   * Display the image
   *
   * @since 1.0.0
   */
  function archetype_image_content() {
    ?>
    <div class="entry-content">

      <div class="entry-attachment">

        <?php if ( has_excerpt() ) : ?>
          <div class="entry-caption" itemprop="caption">
            <?php the_excerpt(); ?>
          </div><!-- .entry-caption -->
        <?php endif; ?>

      </div><!-- .entry-attachment -->

    <?php the_content(); ?>
    <?php archetype_page_navigation(); ?>
    </div><!-- .entry-content -->
    <?php
  }
}

if ( ! function_exists( 'archetype_image_meta' ) ) {
  /**
   * Displays meta information for the date, original image etc.
   *
   * Wrapper for the `archetype_post_meta()` function.
   *
   * @uses archetype_post_meta()
   *
   * @since 1.0.0
   */
  function archetype_image_meta() {
  
    archetype_post_meta();
    
  }
}
