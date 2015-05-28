<?php
/**
 * Custom template tags used to integrate this theme with WooCommerce.
 *
 * @package Archetype
 * @subpackage WooCommerce
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_cart_link' ) ) :
/**
 * Cart Link
 *
 * Displayed a link to the cart including the number of items present and the cart total
 *
 * @since 1.0.0
 */
	function archetype_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart', 'archetype' ); ?>">
			<?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'archetype' ), WC()->cart->get_cart_contents_count() ) );?></span>
		</a>
		<?php
	}
endif;

if ( ! function_exists( 'archetype_header_cart' ) ) :
	/**
	 * Display Header Cart
	 *
	 * @uses is_woocommerce_activated() check if WooCommerce is activated
	 *
	 * @since 1.0.0
	 */
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
endif;

if ( ! function_exists( 'archetype_upsell_display' ) ) :
	/**
	 * Upsells
	 *
	 * Replace the default upsell function with our own which displays the correct number product columns
	 *
	 * @uses woocommerce_upsell_display()
	 *
	 * @since 1.0.0
	 */
	function archetype_upsell_display() {
		woocommerce_upsell_display( -1, 3 );
	}
endif;

if ( ! function_exists( 'archetype_woocommerce_pagination' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 * @since 1.0.0
	 */
	function archetype_woocommerce_pagination() {
		global $wp_query;
		$term = get_queried_object();

		if ( is_product_category() ) {
			$display_type = get_woocommerce_term_meta( $term->term_id, 'display_type', true );

			switch ( $display_type ) {
				case 'subcategories' :
					$wp_query->max_num_pages = 0;
				break;
				case '' :
					if ( 'subcategories' == get_option( 'woocommerce_category_archive_display' ) ) {
						$wp_query->max_num_pages = 0;
					}
				break;
			}
		}

		if ( is_shop() && 'subcategories' == get_option( 'woocommerce_shop_page_display' ) ) {
			$wp_query->max_num_pages = 0;
		}

		if ( $wp_query->max_num_pages <= 1 ) {
			return;
		}

		echo '<nav class="woocommerce-pagination" role="navigation">';
			echo '<h2 class="screen-reader-text">Shop navigation</h2>';
			echo '<div class="nav-links">';
				echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
					'base'               => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
					'format'             => '',
					'add_args'           => '',
					'current'            => max( 1, get_query_var( 'paged' ) ),
					'total'              => $wp_query->max_num_pages,
					'prev_text'          => '&larr;',
					'next_text'          => '&rarr;',
					'type'               => 'plain',
					'end_size'           => 3,
					'mid_size'           => 3,
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'archetype' ) . ' </span>',
					'after_page_number'  => '',
				) ) );
			echo '</div>';
		echo '</nav>';
	}
endif;

/**
 * Shop heading markup
 *
 * You can also remove the heading by filtering `archetype_shop_heading`.
 *
 * @see archetype_shop_heading_wrapper()
 * @see archetype_shop_heading_wrapper_close()
 *
 * @since 1.0.0
 */
function archetype_shop_heading() {
	if ( ! is_product() ) {
		add_action( 'woocommerce_before_main_content',    'archetype_shop_heading_wrapper',        1001 );
		add_action( 'woocommerce_archive_description',    'archetype_shop_heading_wrapper_close',  1001 );
	}

	if ( true === apply_filters( 'archetype_shop_heading', false ) ) {
		add_filter( 'woocommerce_show_page_title', '__return_false' );
		remove_action( 'woocommerce_before_main_content', 'archetype_shop_heading_wrapper',         1001 );
		remove_action( 'woocommerce_archive_description', 'archetype_shop_heading_wrapper_close',   1001 );
	}
}

/**
 * Shop heading wrapper
 *
 * @since 1.0.0
 */
function archetype_shop_heading_wrapper() {
	echo '<header class="page-header">';
}

/**
 * Shop heading wrapper close
 *
 * @since 1.0.0
 */
function archetype_shop_heading_wrapper_close() {
	echo '</header>';
}

/**
 * Sorting wrapper
 *
 * @since 1.0.0
 */
function archetype_sorting_wrapper() {
	echo '<div class="archetype-sorting">';
}

/**
 * Sorting wrapper close
 *
 * @since 1.0.0
 */
function archetype_sorting_wrapper_close() {
	echo '</div>';
}

/**
 * Storefront shop messages
 *
 * @uses do_shortcode
 *
 * @since 1.0.0
 */
function archetype_shop_messages() {
	if ( ! is_checkout() ) {
		echo wp_kses_post( do_shortcode( '[woocommerce_messages]' ) );
	}
}
