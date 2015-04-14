<?php
/**
 * General functions used to integrate this theme with WooCommerce.
 *
 * @package archetype
 */

/**
 * Check if viewing a WooCommerce page.
 *
 * @uses is_admin() check if WordPress admin.
 * @uses is_woocommerce_activated() check if WooCommerce is activated.
 * @uses is_woocommerce() check if displaying a WooCommerce template.
 * @uses is_cart() check if dislaying the WooCommerce cart.
 * @uses is_checkout() check if dislaying the WooCommerce checkout.
 *
 * @since 1.0.0
 *
 * @return bool
 */
if ( ! function_exists( 'archetype_is_woocommerce' ) ) {
  function archetype_is_woocommerce() {
    if ( ! is_admin() && is_woocommerce_activated() && ( is_woocommerce() || is_cart() || is_checkout() ) ) {
      return true;
    }
    return false;
  }
}

/**
 * Before Content
 * Wraps all WooCommerce content in wrappers which match the theme markup
 * @since   1.0.0
 * @return  void
 */
if ( ! function_exists( 'archetype_before_content' ) ) {
  function archetype_before_content() {
    ?>
    <div id="primary" class="content-area">
      <main id="main" class="site-main" role="main">
        <?php
  }
}

/**
 * After Content
 * Closes the wrapping divs
 * @since   1.0.0
 * @return  void
 */
if ( ! function_exists( 'archetype_after_content' ) ) {
  function archetype_after_content() {
    ?>
      </main><!-- #main -->
    </div><!-- #primary -->

    <?php do_action( 'archetype_sidebar' );
  }
}

/**
 * Default loop columns on product archives
 * @return integer products per row
 * @since  1.0.0
 */
function archetype_loop_columns() {
  return apply_filters( 'archetype_loop_columns', 3 ); // 3 products per row
}

/**
 * Add 'woocommerce-active' class to the body tag
 * @param  array $classes
 * @return array $classes modified to include 'woocommerce-active' class
 */
function archetype_woocommerce_body_class( $classes ) {
  if ( is_woocommerce_activated() ) {
    $classes[] = 'woocommerce-active';
  }

  return $classes;
}

/**
 * Replaces `get_search_form()` with Product Search.
 *
 * @since 1.0.0
 *
 * @param string $form Optional separator.
 * @return string The form markup.
 */
if ( ! function_exists( 'archetype_product_search_form' ) ) {
  function archetype_product_search_form( $form ) {
    if ( archetype_is_woocommerce() ) {
      $form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
        <label>
          <span class="screen-reader-text">' . _x( 'Search for:', 'label', 'archetype' ) . '</span>
          <input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search Products &hellip;', 'placeholder' ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Search for:', 'label', 'archetype' ) . '" />
        </label>
        <input type="submit" class="search-submit" value="'. esc_attr_x( 'Search', 'submit button', 'archetype' ) .'" />
        <input type="hidden" name="post_type" value="product" />
      </form>';
    }
    return $form;
  }
}

/**
 * Cart Fragments
 * Ensure cart contents update when products are added to the cart via AJAX
 * @param  array $fragments Fragments to refresh via AJAX
 * @return array            Fragments to refresh via AJAX
 */
if ( ! function_exists( 'archetype_cart_link_fragment' ) ) {
  function archetype_cart_link_fragment( $fragments ) {
    global $woocommerce;

    ob_start();

    archetype_cart_link();

    $fragments['a.cart-contents'] = ob_get_clean();

    return $fragments;
  }
}

/**
 * WooCommerce specific scripts & stylesheets
 * @since 1.0.0
 */
function archetype_woocommerce_scripts() {
  global $archetype_version;

  wp_enqueue_style( 'archetype-woocommerce-style', get_template_directory_uri() . '/inc/woocommerce/css/woocommerce.css', $archetype_version );
}

/**
 * Related Products Args
 * @param  array $args related products args
 * @since 1.0.0
 * @return  array $args related products args
 */
function archetype_related_products_args( $args ) {
  $args = apply_filters( 'archetype_related_products_args', array(
    'posts_per_page' => 3,
    'columns'        => 3,
  ) );

  return $args;
}

/**
 * Breadcrumb Defaults
 * @param array $args default breadcrumb args
 * @since 1.0.0
 * @return array $args default breadcrumb args
 */
function archetype_breadcrumbs_defaults( $args ) {
  $args = apply_filters( 'archetype_breadcrumbs_defaults', array(
    'delimiter'   => '<li class="breadcrumb-delimiter" aria-hidden="true">/</li>',
    'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><ul>',
    'wrap_after'  => '</ul></nav>',
    'before'      => '<li>',
    'after'       => '</li>',
    'home'        => _x( 'Home', 'breadcrumb', 'archetype' ),
  ) );

  return $args;
}

/**
 * Product gallery thumnail columns
 * @return integer number of columns
 * @since  1.0.0
 */
function archetype_thumbnail_columns() {
  return intval( apply_filters( 'archetype_product_thumbnail_columns', 4 ) );
}

/**
 * Products per page
 * @return integer number of products
 * @since  1.0.0
 */
function archetype_products_per_page() {
  return intval( apply_filters( 'archetype_products_per_page', 12 ) );
}

/**
 * Query WooCommerce Extension Activation.
 * @var  $extension main extension class name
 * @return boolean
 */
function is_woocommerce_extension_activated( $extension = 'WC_Bookings' ) {
  return class_exists( $extension ) ? true : false;
}