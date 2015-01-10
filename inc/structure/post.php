<?php
/**
 * Template functions used for posts.
 *
 * @package archetype
 */

if ( ! function_exists( 'archetype_post_header' ) ) {
  /**
   * Display the post header with a link to the single post
   * @since 1.0.0
   */
  function archetype_post_header() { ?>
    <header class="entry-header">
    <?php
    if ( is_single() ) {
      the_title( '<h1 class="entry-title" itemprop="name headline">', '</h1>' );
    } else {
      the_title( sprintf( '<h1 class="entry-title" itemprop="name headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
    }
    ?>
    </header><!-- .entry-header -->
    <?php
  }
}

if ( ! function_exists( 'archetype_post_content' ) ) {
  /**
   * Display the post content with a link to the single post
   * @since 1.0.0
   */
  function archetype_post_content() {
    ?>
    <div class="entry-content" itemprop="articleBody">
    <?php
    if ( has_post_thumbnail() ) {
      the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) );
    }
    ?>
    <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'archetype' ) ); ?>
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

if ( ! function_exists( 'archetype_post_meta' ) ) {
  /**
   * Displays meta information for the author, categories, tags etc.
   * @since 1.0.0
   */
  function archetype_post_meta() {
    ?>
    <footer class="entry-footer">
      <?php
      if ( is_sticky() && is_home() && ! is_paged() ) {
        printf( '<span class="sticky-post">%s</span>', __( 'Featured', 'archetype' ) );
      }
    
      $format = get_post_format();
      if ( current_theme_supports( 'post-formats', $format ) ) {
        printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
          sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'archetype' ) ),
          esc_url( get_post_format_link( $format ) ),
          get_post_format_string( $format )
        );
      }
    
      if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
          $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }
    
        $time_string = sprintf( $time_string,
          esc_attr( get_the_date( 'c' ) ),
          get_the_date(),
          esc_attr( get_the_modified_date( 'c' ) ),
          get_the_modified_date()
        );
    
        printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
          _x( 'Posted on', 'Used before publish date.', 'archetype' ),
          esc_url( get_permalink() ),
          $time_string
        );
      }
    
      if ( 'post' == get_post_type() ) {
        if ( is_singular() || is_multi_author() ) {
          printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span>',
            _x( 'Author', 'Used before post author name.', 'archetype' ),
            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
            get_the_author()
          );
        }
    
        $categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'archetype' ) );
        if ( $categories_list && archetype_categorized_blog() ) {
          printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
            _x( 'Categories', 'Used before category names.', 'archetype' ),
            $categories_list
          );
        }
    
        $tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'archetype' ) );
        if ( $tags_list ) {
          printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
            _x( 'Tags', 'Used before tag names.', 'archetype' ),
            $tags_list
          );
        }
      }
    
      if ( is_attachment() && wp_attachment_is_image() ) {
        // Retrieve attachment metadata.
        $metadata = wp_get_attachment_metadata();
    
        printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
          _x( 'Full size', 'Used before full size attachment link.', 'archetype' ),
          esc_url( wp_get_attachment_url() ),
          $metadata['width'],
          $metadata['height']
        );
      }
    
      if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<span class="comments-link">';
        comments_popup_link( __( 'Leave a comment', 'archetype' ), __( '1 Comment', 'archetype' ), __( '% Comments', 'archetype' ) );
        echo '</span>';
      }
      ?>
    </footer>
    <?php
  }
}

if ( ! function_exists( 'archetype_paging_nav' ) ) {
  /**
   * Display navigation to next/previous set of posts when applicable.
   */
  function archetype_paging_nav() {
    // Don't print empty markup if there's only one page.
    if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
      return;
    }
    ?>
    <nav class="navigation paging-navigation" role="navigation">
      <h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'archetype' ); ?></h1>
      <div class="nav-links">

        <?php if ( get_next_posts_link() ) : ?>
        <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'archetype' ) ); ?></div>
        <?php endif; ?>

        <?php if ( get_previous_posts_link() ) : ?>
        <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'archetype' ) ); ?></div>
        <?php endif; ?>

      </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
  }
}

if ( ! function_exists( 'archetype_post_nav' ) ) {
  /**
   * Display navigation to next/previous post when applicable.
   */
  function archetype_post_nav() {
    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous ) {
      return;
    }
    ?>
    <nav class="navigation post-navigation" role="navigation">
      <h1 class="screen-reader-text"><?php _e( 'Post navigation', 'archetype' ); ?></h1>
      <div class="nav-links">
        <?php
          previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'archetype' ) );
          next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'archetype' ) );
        ?>
      </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
  }
}
