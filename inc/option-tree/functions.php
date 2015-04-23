<?php
/**
 * General functions used to integrate this theme with OptionTree.
 *
 * @package archetype
 */

if ( ! function_exists( 'archetype_hide_title_post_meta' ) ) {
  /**
   * Filter the visibility of the post title.
   *
   * @see archetype_hide_title()
   *
   * @since 1.0.0
   *
   * @param WP_Post $post WP_Post object.
   * @return bool
   */
  function archetype_hide_title_post_meta( $hide, $post ) {
    if ( get_post_meta( $post->ID, '_archetype_hide_title', true ) == 'on' ) {
      $hide = true;
    }
    return $hide;
  }
}

if ( ! function_exists( 'archetype_hide_author_bio_post_meta' ) ) {
  /**
   * Filter the visibility of the author bio.
   *
   * @see archetype_hide_author_bio()
   *
   * @since 1.0.0
   *
   * @param bool $hide Whether the title has been hidden.
   * @param WP_Post $post WP_Post object.
   * @return bool
   */
  function archetype_hide_author_bio_post_meta( $hide, $post ) {
    if ( get_post_meta( $post->ID, '_archetype_hide_author_bio', true ) == 'on' ) {
      $hide = true;
    }
    return $hide;
  }
}

if ( ! function_exists( 'archetype_link_has_title' ) ) {
  /**
   * Removes `link` from the array of post formats that do not have a title.
   *
   * @since 1.0.0
   *
   * @return array An array of post formats.
   */
  function archetype_link_has_title() {
    /**
     * Filter the array of post formats that do not have a title.
     *
     * @since 1.0.0
     *
     * @param array $post_formats An array of post formats.
     */
    $post_formats = apply_filters( 'archetype_link_has_title', array( 'aside', 'status' ) );

    return $post_formats;
  }
}

/**
 * Retrieve the title and URL for the link post format.
 *
 * Must be used inside the loop.
 *
 * @since 1.0.0
 *
 * @return  string
 */
if ( ! function_exists( 'archetype_post_format_title' ) ) {
  function archetype_post_format_title() {
    $title = '';
    $link_url = get_post_meta( get_the_ID(), '_format_link_url', true );
    $link_title = get_post_meta( get_the_ID(), '_format_link_title', true );

    // Set the title.
    if ( ! empty( $link_url ) && ! empty( $link_title ) ) {

      $title = sprintf( '<h1 class="entry-title" itemprop="name headline"><a href="%s" rel="bookmark nofollow" target="_blank">%s</a></h1>', esc_url( $link_url ), esc_attr( $link_title ) );

      // Remove the `hide-title` class by filtering the `archetype_hide_title_post_formats` array.
      add_filter( 'archetype_hide_title_post_formats', 'archetype_link_has_title' );

    // Remove the filter so it does not alter other posts
    } else {

      remove_filter( 'archetype_hide_title_post_formats', 'archetype_link_has_title' );

    }

    return $title;
  }
}

/**
 * Displays the audio
 *
 * Must be used inside the loop.
 *
 * @since 1.0.0
 *
 * @return  string
 */
if ( ! function_exists( 'archetype_post_format_audio' ) ) {
  function archetype_post_format_audio() {
    if ( has_post_format( 'audio' ) && $audio = get_post_meta( get_the_ID(), '_format_audio_embed', true ) ) {
      ?>
      <div class="post-audio">
        <?php 
        remove_filter( 'the_content', 'wpautop' );
        echo apply_filters( 'the_content', $audio );
        add_filter( 'the_content', 'wpautop' );
        ?>
      </div><!-- .post-audio -->
      <?php
    }
  }
}

/**
 * Displays the video
 *
 * Must be used inside the loop.
 *
 * @since 1.0.0
 *
 * @return  string
 */
if ( ! function_exists( 'archetype_post_format_video' ) ) {
  function archetype_post_format_video() {
    if ( has_post_format( 'video' ) && $video = get_post_meta( get_the_ID(), '_format_video_embed', true ) ) {
      ?>
      <div class="post-video">
        <?php 
        remove_filter( 'the_content', 'wpautop' );
        echo apply_filters( 'the_content', $video );
        add_filter( 'the_content', 'wpautop' );
        ?>
      </div><!-- .post-video -->
      <?php
    }
  }
}

/**
 * Returns an array of gallery images.
 *
 * @since 1.0.0
 *
 * @param int $post_id ID of the post.
 * @return  bool|array
 */
if ( ! function_exists( 'archetype_post_format_gallery_images' ) ) {
  function archetype_post_format_gallery_images( $post_id = 0 ) {
    if ( $gallery = get_post_meta( $post_id, '_format_gallery', true ) ) {

      // Search the string for the IDs
      preg_match( '/ids=\'(.*?)\'/', $gallery, $matches );

      // Turn the field value into an array of IDs
      if ( isset( $matches[1] ) ) {

        // Found the IDs in the shortcode
        $ids = explode( ',', $matches[1] );
      } else {

        // The string is only IDs
        $ids = ! empty( $gallery ) && $gallery != '' ? explode( ',', $gallery ) : array();
      }

      if ( ! empty( $ids ) ) {
        return $ids;
      }
    }
    return false;
  }
}

/**
 * Displays the gallery
 *
 * Must be used inside the loop.
 *
 * @since 1.0.0
 *
 * @return  string
 */
if ( ! function_exists( 'archetype_post_format_gallery' ) ) {
  function archetype_post_format_gallery() {
    $post_id = get_the_ID();

    if ( has_post_format( 'gallery' ) ) {

      // Get the gallery images
      $ids = archetype_post_format_gallery_images( $post_id );

      if ( ! empty( $ids ) ) {
        $content = '<ul class="bxslider">';
          foreach( $ids as $image_id ) {
            $attachments = get_posts( array(
             'post_type'      => 'attachment',
             'posts_per_page' => 1,
             'include'        => $image_id
            ) );
            if ( $attachments ) {
              foreach( $attachments as $attachment ) {
                $caption = ! empty( $attachment->post_excerpt ) ? '<div class="caption"><span class="caption-body">' . wpautop( $attachment->post_excerpt ) . '</span></div>' : '';
                if ( ! is_single() ) {
                  $content.= sprintf( '<li><a href="%s" rel="bookmark"><img src="%s" alt="%s" />%s</a></li>', esc_url( get_permalink() ), esc_url( $attachment->guid ), esc_attr( $attachment->post_title ), $caption );
                } else {
                  $content.= sprintf( '<li><a href="%s" rel="lightbox[gallery-main]" title="%s"><img src="%s" alt="%s" />%s</a></li>', esc_url( $attachment->guid ), esc_attr( $attachment->post_excerpt ), esc_url( $attachment->guid ), esc_attr( $attachment->post_title ), $caption );
                }
              }
            }
          }
        $content.= '</ul>';
      }

      // Display the gallery
      if ( ! empty( $content ) ) {
        echo '<div class="post-gallery">' . $content . '</div><!-- .post-gallery -->';
      }
    }
  }
}

/**
 * Displays the quote
 *
 * @since 1.0.0
 *
 * @return  string
 */
if ( ! function_exists( 'archetype_post_format_quote' ) ) {
  function archetype_post_format_quote( $content ) {
    if ( has_post_format( 'quote' ) ) {
      $_content = array();
      $post_id  = get_the_ID();
      $name     = get_post_meta( $post_id, '_format_quote_source_name', true );
      $url      = get_post_meta( $post_id, '_format_quote_source_url', true );
      $title    = get_post_meta( $post_id, '_format_quote_source_title', true );
      $date     = get_post_meta( $post_id, '_format_quote_source_date', true );

      // Add the name & url
      if ( $name ) {
        $open = $close = '';
        if ( ! $title ) {
          $open = '<cite>';
          $close = '</cite>';
        }
        $_content[] = $url ? sprintf( '%s<a href="%s" rel="nofollow" target="_blank">%s</a>%s', $open, esc_url( $url ), esc_html( $name ), $close ) : $open . esc_html( $name ) .$close;
      }

      // Add the comma
      if ( $name && ( $title || $date ) ) {
        $_content[] = ', ';
      }

      // Add the title
      if ( $title ) {
        $_content[] = sprintf( '%s%s%s ', '<cite>', esc_html( $title ), '</cite>' );
      }

      // Add the date
      if ( $date ) {
        $_content[] = esc_html( $date );
      }

      // Replace the content
      if ( ! empty( $_content ) ) {
        $cite = $url ? ' cite="' . esc_url( $url ) . '"' : '';
        $content = '<figure>' .
          '<blockquote' . $cite . '>' . $content . '</blockquote>' .
          '<figcaption>' . implode( $_content, '' ) . '</figcaption>' .
        '</figure>';
      }
    }
    return $content;
  }
}