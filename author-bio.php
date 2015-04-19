<?php
/**
 * The template for displaying Author bios
 *
 * @package archetype
 */
?>

<div class="author-info">
  <h2 class="author-heading"><?php _e( 'About the Author', 'archetype' ); ?></h2>
  <div class="author-avatar">
    <?php
    /**
     * Filter the author bio avatar size.
     *
     * @since 1.0.0
     *
     * @param int $size The avatar height and width size in pixels.
     */
    $author_bio_avatar_size = apply_filters( 'archetype_author_bio_avatar_size', 120 );

    echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
    ?>
  </div><!-- .author-avatar -->

  <div class="author-description">
    <h3 class="author-title"><?php echo get_the_author(); ?></h3>

    <div class="author-bio">
      <?php echo wpautop( get_the_author_meta( 'description' ) ); ?>
      <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
        <?php printf( __( 'View all posts by %s', 'archetype' ), get_the_author() ); ?>
      </a>
    </div><!-- .author-bio -->

  </div><!-- .author-description -->
</div><!-- .author-info -->
