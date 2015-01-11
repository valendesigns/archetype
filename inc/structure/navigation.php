<?php
/**
 * Template functions used for navigation.
 *
 * @package archetype
 */

if ( ! function_exists( 'archetype_posts_navigation' ) ) {
  /**
   * Display navigation to next/previous set of posts when applicable.
   *
   * @since 1.0.0
   */
  function archetype_posts_navigation() {
    // Previous/next page navigation.
    the_posts_pagination( array(
      'prev_text'          => __( 'Previous page', 'archetype' ),
      'next_text'          => __( 'Next page', 'archetype' ),
      'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'archetype' ) . ' </span>',
    ) );
  }
}

if ( ! function_exists( 'archetype_post_navigation' ) ) {
  /**
   * Display navigation to next/previous post when applicable.
   *
   * @since 1.0.0
   */
  function archetype_post_navigation() {
    // Previous/next post navigation.
    if ( is_attachment() ) {
      the_post_navigation( array(
        'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'archetype' ),
      ) );
    } else {
      the_post_navigation( array(
        'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'archetype' ) . '</span> ' .
          '<span class="screen-reader-text">' . __( 'Next post:', 'archetype' ) . '</span> ' .
          '<span class="post-title">%title</span>',
        'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'archetype' ) . '</span> ' .
          '<span class="screen-reader-text">' . __( 'Previous post:', 'archetype' ) . '</span> ' .
          '<span class="post-title">%title</span>',
      ) );
    }
  }
}

if ( ! function_exists( 'archetype_page_navigation' ) ) {
  /**
   * Display navigation to next/previous set of posts when applicable.
   *
   * @since 1.0.0
   */
  function archetype_page_navigation() {
    // Previous/next page navigation.
    wp_link_pages( array(
      'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'archetype' ) . '</span>',
      'after'       => '</div>',
      'link_before' => '<span>',
      'link_after'  => '</span>',
      'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'archetype' ) . ' </span>%',
      'separator'   => '<span class="screen-reader-text">, </span>',
    ) );
  }
}

if ( ! function_exists( 'archetype_image_navigation' ) ) {
  /**
   * Display navigation to next/previous image when applicable.
   *
   * @since 1.0.0
   */
  function archetype_image_navigation() {
    $attachments = array_values( get_children( array( 
      'post_parent'     => get_post()->post_parent, 
      'post_status'     => 'inherit', 
      'post_type'       => 'attachment', 
      'post_mime_type'  => 'image' 
    ) ) );
    if ( count( $attachments ) > 1 ) {
    ?>
    <nav class="navigation image-navigation" role="navigation">
      <h2 class="screen-reader-text"><?php __( 'Image navigation', 'archetype' ); ?></h2>
      <div class="nav-links">
        <div class="nav-previous"><?php previous_image_link( false, __( 'Previous Image', 'archetype' ) ); ?></div>
        <div class="nav-next"><?php next_image_link( false, __( 'Next Image', 'archetype' ) ); ?></div>
      </div><!-- .nav-links -->
    </nav><!-- .image-navigation -->
    <?php
    }
  }
}

if ( ! function_exists( 'archetype_comment_navigation' ) ) {
  /**
   * Display navigation to next/previous comments when applicable.
   *
   * @since 1.0.0
   */
  function archetype_comment_navigation() {
    
    // Are there comments to navigate through?
    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
    ?>
    <nav class="navigation comment-navigation" role="navigation">
      <h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'archetype' ); ?></h2>
      <div class="nav-links">
        <?php
          paginate_comments_links( array(
            'prev_text'          => __( 'Previous page', 'archetype' ),
            'next_text'          => __( 'Next page', 'archetype' ),
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'archetype' ) . ' </span>',
          ) );
        ?>
      </div><!-- .nav-links -->
    </nav><!-- .comment-navigation -->
    <?php
    }
  }
}
