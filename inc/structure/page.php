<?php
/**
 * Template functions used for pages.
 *
 * @package archetype
 */

if ( ! function_exists( 'archetype_page_header' ) ) {
  /**
   * Display the post header with a link to the single post
   * @since 1.0.0
   */
  function archetype_page_header() {
    if ( is_page_template( 'template-homepage.php' ) )
      return;
    ?>
    <header class="entry-header">
      <?php the_title( '<h1 class="entry-title" itemprop="name">', '</h1>' ); ?>
    </header><!-- .entry-header -->
    <?php
  }
}

if ( ! function_exists( 'archetype_page_content' ) ) {
  /**
   * Display the post content with a link to the single post
   * @since 1.0.0
   */
  function archetype_page_content() {
    ?>
    <div class="entry-content" itemprop="mainContentOfPage">
      <?php the_content(); ?>
      <?php
        wp_link_pages( array(
          'before' => '<div class="page-links">' . __( 'Pages:', 'archetype' ),
          'after'  => '</div>',
        ) );
      ?>
    </div><!-- .entry-content -->
    <?php
  }
}