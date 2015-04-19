<?php
/**
 * Custom template tags for this theme.
 *
 * @package archetype
 */

if ( ! function_exists( 'archetype_product_categories' ) ) {
  /**
   * Display Product Categories
   * Hooked into the `homepage` action in the homepage template
   * @since  1.0.0
   * @return void
   */
  function archetype_product_categories( $args ) {

    if ( is_woocommerce_activated() ) {

      $args = apply_filters( 'archetype_product_categories_args', array(
        'limit'            => 3,
        'columns'          => 3,
        'child_categories' => 0,
        'orderby'          => 'name',
        'title'            => __( 'Product Categories', 'archetype' ),
      ) );

      $products = do_shortcode( '[product_categories number="' . $args['limit'] . '" columns="' . $args['columns'] . '" orderby="' . $args['orderby'] . '" parent="' . $args['child_categories'] . '"]' );

      $empty = '<div class="woocommerce columns-' . intval( $args['columns'] ) . '"></div>';

      if ( ! empty( $products ) && $empty !== $products ) {

        echo '<section class="archetype-product-section archetype-product-categories">';

          echo '<h2 class="section-title">' . esc_attr( $args['title'] ) . '</h2>';
          echo $products;

        echo '</section>';

      }
    }
  }
}

if ( ! function_exists( 'archetype_recent_products' ) ) {
  /**
   * Display Recent Products
   * Hooked into the `homepage` action in the homepage template
   * @since  1.0.0
   * @return void
   */
  function archetype_recent_products( $args ) {

    if ( is_woocommerce_activated() ) {

      $args = apply_filters( 'archetype_recent_products_args', array(
        'limit'   => 4,
        'columns' => 4,
        'title'   => __( 'Recent Products', 'archetype' ),
      ) );

      $products = do_shortcode( '[recent_products per_page="' . intval( $args['limit'] ) . '" columns="' . intval( $args['columns'] ) . '"]' );

      $empty = '<div class="woocommerce columns-' . intval( $args['columns'] ) . '"></div>';

      if ( ! empty( $products ) && $empty !== $products ) {

        echo '<section class="archetype-product-section archetype-recent-products">';

          echo '<h2 class="section-title">' . esc_attr( $args['title'] ) . '</h2>';
          echo $products;

        echo '</section>';

      }
    }
  }
}

if ( ! function_exists( 'archetype_featured_products' ) ) {
  /**
   * Display Featured Products
   * Hooked into the `homepage` action in the homepage template
   * @since  1.0.0
   * @return void
   */
  function archetype_featured_products( $args ) {

    if ( is_woocommerce_activated() ) {

      $args = apply_filters( 'archetype_featured_products_args', array(
        'limit'   => 4,
        'columns' => 4,
        'title'   => __( 'Featured Products', 'archetype' ),
      ) );

      $products = do_shortcode( '[featured_products per_page="' . intval( $args['limit'] ) . '" columns="' . intval( $args['columns'] ) . '"]' );

      $empty = '<div class="woocommerce columns-' . intval( $args['columns'] ) . '"></div>';

      if ( ! empty( $products ) && $empty !== $products ) {

        echo '<section class="archetype-product-section archetype-featured-products">';

          echo '<h2 class="section-title">' . esc_attr( $args['title'] ) . '</h2>';
          echo $products;

        echo '</section>';

      }
    }
  }
}

if ( ! function_exists( 'archetype_popular_products' ) ) {
  /**
   * Display Popular Products
   * Hooked into the `homepage` action in the homepage template
   * @since  1.0.0
   * @return void
   */
  function archetype_popular_products( $args ) {

    if ( is_woocommerce_activated() ) {

      $args = apply_filters( 'archetype_popular_products_args', array(
        'limit'   => 4,
        'columns' => 4,
        'title'   => __( 'Top Rated Products', 'archetype' ),
      ) );

      $products = do_shortcode( '[top_rated_products per_page="' . intval( $args['limit'] ) . '" columns="' . intval( $args['columns'] ) . '"]' );

      $empty = '<div class="woocommerce columns-' . intval( $args['columns'] ) . '"></div>';

      if ( ! empty( $products ) && $empty !== $products ) {

        echo '<section class="archetype-product-section archetype-popular-products">';

          echo '<h2 class="section-title">' . esc_attr( $args['title'] ) . '</h2>';
          echo $products;

        echo '</section>';

      }
    }
  }
}

if ( ! function_exists( 'archetype_on_sale_products' ) ) {
  /**
   * Display On Sale Products
   * Hooked into the `homepage` action in the homepage template
   * @since  1.0.0
   * @return void
   */
  function archetype_on_sale_products( $args ) {

    if ( is_woocommerce_activated() ) {

      $args = apply_filters( 'archetype_on_sale_products_args', array(
        'limit'   => 4,
        'columns' => 4,
        'title'   => __( 'On Sale', 'archetype' ),
      ) );

      $products = do_shortcode( '[sale_products per_page="' . intval( $args['limit'] ) . '" columns="' . intval( $args['columns'] ) . '"]' );

      $empty = '<div class="woocommerce columns-' . intval( $args['columns'] ) . '"></div>';

      if ( ! empty( $products ) && $empty !== $products ) {

        echo '<section class="archetype-product-section archetype-on-sale-products">';

          echo '<h2 class="section-title">' . esc_attr( $args['title'] ) . '</h2>';
          echo $products;

        echo '</section>';

      }
    }
  }
}

if ( ! function_exists( 'archetype_homepage_content' ) ) {
  /**
   * Display homepage content
   * Hooked into the `homepage` action in the homepage template
   * @since  1.0.0
   * @return  void
   */
  function archetype_homepage_content() {
    while ( have_posts() ) : the_post();

      get_template_part( 'content', 'page' );

    endwhile; // end of the loop.
  }
}

if ( ! function_exists( 'archetype_social_icons' ) ) {
  /**
   * Display social icons
   * If the subscribe and connect plugin is active, display the icons.
   * @link http://wordpress.org/plugins/subscribe-and-connect/
   * @since 1.0.0
   */
  function archetype_social_icons() {
    if ( class_exists( 'Subscribe_And_Connect' ) ) {
      echo '<div class="subscribe-and-connect-connect">';
        echo '<div class="col-full">';
          subscribe_and_connect_connect();
        echo '</div>';
      echo '</div>';
    }
  }
}

if ( ! function_exists( 'archetype_get_sidebar' ) ) {
  /**
   * Display archetype sidebar
   * @uses get_sidebar()
   * @since 1.0.0
   */
  function archetype_get_sidebar() {
    get_sidebar();
  }
}

if ( ! function_exists( 'archetype_hide_title_post_formats' ) ) {
  /**
   * Returns an array of post formats that do not have a title.
   *
   * @since 1.0.0
   *
   * @return array An array of post formats.
   */
  function archetype_hide_title_post_formats() {
    /**
     * Filter the array of post formats that do not have a title.
     *
     * @since 1.0.0
     *
     * @param array $post_formats An array of post formats.
     */
    $post_formats = apply_filters( 'archetype_hide_title_post_formats', array( 'aside', 'link', 'status' ) );

    return $post_formats;
  }
}

if ( ! function_exists( 'archetype_has_content' ) ) {
  /**
   * Check for the existence of post content.
   *
   * @uses get_post()
   *
   * @since 1.0.0
   *
   * @param int|WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
   * @return bool
   */
  function archetype_has_content( $post = 0 ) {
    $post = get_post( $post );
    return ( isset( $post->post_content ) && ! empty( $post->post_content ) );
  }
}

if ( ! function_exists( 'archetype_has_title' ) ) {
  /**
   * Check for the existence of a post title.
   *
   * @uses get_post()
   *
   * @since 1.0.0
   *
   * @param int|WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
   * @return bool
   */
  function archetype_has_title( $post = 0 ) {
    $post = get_post( $post );
    return ( isset( $post->post_title ) && ! empty( $post->post_title ) );
  }
}

if ( ! function_exists( 'archetype_hide_title' ) ) {
  /**
   * Check for a hidden post title.
   *
   * @uses get_post()
   *
   * @since 1.0.0
   *
   * @param int|WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
   * @return bool
   */
  function archetype_hide_title( $post = 0 ) {
    $post = get_post( $post );
    return apply_filters( 'archetype_hide_title', false, $post );
  }
}

if ( ! function_exists( 'archetype_hide_author_bio' ) ) {
  /**
   * Check for a hidden author bio.
   *
   * @uses get_post()
   *
   * @since 1.0.0
   *
   * @param int|WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
   * @return bool
   */
  function archetype_hide_author_bio( $post = 0 ) {
    $post = get_post( $post );
    return apply_filters( 'archetype_hide_author_bio', false, $post );
  }
}

if ( ! function_exists( 'archetype_entry_header_class' ) ) {
  /**
   * Setup the entry-header classes.
   *
   * @uses archetype_has_title()
   *
   * @since 1.0.0
   *
   * @return string
   */
  function archetype_entry_header_class() {
    // Default class
    $classes = array( 'entry-header' );

    /*
     * Add the `hide-title` class when the title is missing or we're viewing certain post formats.
     */
    if ( archetype_hide_title() || ! archetype_has_title() || has_post_format( archetype_hide_title_post_formats() ) ) {
      $classes[] = 'hide-title';
    }

    /**
     * Filter the array of classes to return for the entry header.
     *
     * @since 1.0.0
     *
     * @param array $classes An array of classes to return for the entry header.
     */
    $classes = apply_filters( 'archetype_entry_header_class', $classes );

    // Return a string of classes each separated by an empty space
    return implode( $classes, ' ' );
  }
}