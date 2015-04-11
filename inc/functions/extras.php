<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package archetype
 */

/**
 * Check whether the Archetype Customizer settings ar enabled
 * @return boolean
 * @since  1.0.0
 */
function is_archetype_customizer_enabled() {
  return apply_filters( 'archetype_customizer_enabled', true );
}

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function archetype_page_menu_args( $args ) {
  $args['show_home'] = true;
  return $args;
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function archetype_body_classes( $classes ) {
  // Adds a class of group-blog to blogs with more than 1 published author.
  if ( is_multi_author() ) {
    $classes[] = 'group-blog';
  }

  /**
   * What is this?!
   * Take the blue pill, close this file and forget you saw the following code.
   * Or take the red pill, filter `archetype_make_me_cute` and see how deep the rabbit hole goes...
   *
   * @since  1.0.0
   */
  $cute = apply_filters( 'archetype_make_me_cute', false );
  if ( true == $cute ) {
    $classes[] = 'archetype-cute';
  }

  return $classes;
}

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function archetype_setup_author() {
  global $wp_query;

  if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
    $GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
  }
}

/**
 * Query WooCommerce activation
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
  function is_woocommerce_activated() {
    return class_exists( 'woocommerce' ) ? true : false;
  }
}

/**
 * Schema type
 * @return string schema itemprop type
 */
function archetype_html_tag_schema() {
  $schema   = 'http://schema.org/';
  $type     = 'WebPage';

  // Is single post
  if ( is_singular( 'post' ) ) {
    $type   = 'Article';
  }

  // Is author page
  elseif ( is_author() ) {
    $type   = 'ProfilePage';
  }

  // Is search results page
  elseif ( is_search() ) {
    $type   = 'SearchResultsPage';
  }

  echo 'itemscope="itemscope" itemtype="' . esc_attr( $schema ) . esc_attr( $type ) . '"';
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function archetype_categorized_blog() {
  if ( false === ( $all_the_cool_cats = get_transient( 'archetype_categories' ) ) ) {
    // Create an array of all the categories that are attached to posts.
    $all_the_cool_cats = get_categories( array(
      'fields'     => 'ids',
      'hide_empty' => 1,

      // We only need to know if there is more than one category.
      'number'     => 2,
    ) );

    // Count the number of categories that are attached to the posts.
    $all_the_cool_cats = count( $all_the_cool_cats );

    set_transient( 'archetype_categories', $all_the_cool_cats );
  }

  if ( $all_the_cool_cats > 1 ) {
    // This blog has more than 1 category so archetype_categorized_blog should return true.
    return true;
  } else {
    // This blog has only 1 category so archetype_categorized_blog should return false.
    return false;
  }
}

/**
 * Flush out the transients used in archetype_categorized_blog.
 */
function archetype_category_transient_flusher() {
  // Like, beat it. Dig?
  delete_transient( 'archetype_categories' );
}
add_action( 'edit_category', 'archetype_category_transient_flusher' );
add_action( 'save_post',     'archetype_category_transient_flusher' );
