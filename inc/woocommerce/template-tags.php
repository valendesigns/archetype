<?php
/**
 * Custom template tags used to integrate this theme with WooCommerce.
 *
 * @package archetype
 */

/**
 * Cart Link
 * Displayed a link to the cart including the number of items present and the cart total
 * @param  array $settings Settings
 * @return array           Settings
 * @since  1.0.0
 */
if ( ! function_exists( 'archetype_cart_link' ) ) {
  function archetype_cart_link() {
    ?>
    <a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart', 'archetype' ); ?>">
      <?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'archetype' ), WC()->cart->get_cart_contents_count() ) );?></span>
    </a>
    <?php
  }
}

/**
 * Display Product Search
 * @since  1.0.0
 * @uses  is_woocommerce_activated() check if WooCommerce is activated
 * @return void
 */
if ( ! function_exists( 'archetype_product_search' ) ) {
  function archetype_product_search() {
    if ( is_woocommerce_activated() ) { ?>
      <div class="site-search">
        <?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
      </div>
    <?php
    }
  }
}

/**
 * Display Header Cart
 * @since  1.0.0
 * @uses  is_woocommerce_activated() check if WooCommerce is activated
 * @return void
 */
if ( ! function_exists( 'archetype_header_cart' ) ) {
  function archetype_header_cart() {
    if ( is_woocommerce_activated() ) { 
      if ( is_cart() ) {
        $class = 'current-menu-item';
      } else {
        $class = '';
      }
      ?>
      <ul class="site-header-cart menu">
        <li class="<?php echo esc_attr( $class ); ?>">
          <?php archetype_cart_link(); ?>
        </li>
        <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
      </ul>
    <?php
    }
  }
}

/**
 * Upsells
 * Replace the default upsell function with our own which displays the correct number product columns
 * @since   1.0.0
 * @return  void
 * @uses    woocommerce_upsell_display()
 */
if ( ! function_exists( 'archetype_upsell_display' ) ) {
  function archetype_upsell_display() {
    woocommerce_upsell_display( -1, 3 );
  }
}

/**
 * Sorting wrapper
 * @since   1.0.0
 * @return  void
 */
function archetype_sorting_wrapper() {
  echo '<div class="archetype-sorting">';
}

/**
 * Sorting wrapper close
 * @since   1.0.0
 * @return  void
 */
function archetype_sorting_wrapper_close() {
  echo '</div>';
}