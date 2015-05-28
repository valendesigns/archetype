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
 * Adds breadcrumbs depending on the value set in the customizer.
 *
 * @uses woocommerce_breadcrumb() to create the breadcrumb markup.
 *
 * @since 1.0.0
 *
 * @return string
 */
if ( ! function_exists( 'archetype_breadcrumb' ) ) {
	function archetype_breadcrumb() {
		if ( true == archetype_sanitize_checkbox( get_theme_mod( 'archetype_breadcrumb_toggle', true ) ) ) {
			woocommerce_breadcrumb();
		}
	}
}

/**
 * Product review arguments passed to the comments list.
 *
 * @see wp_list_comments()
 *
 * @since 1.0.0
 *
 * @param array $args A list of arguments.
 * @return array
 */
if ( ! function_exists( 'archetype_product_review_list_args' ) ) {
	function archetype_product_review_list_args( $args ) {
		return array( 'callback' => 'archetype_comment', 'max_depth' => 0 );
	}
}

/**
 * Before Content
 *
 * Wraps all WooCommerce content in wrappers which match the theme markup
 *
 * @since 1.0.0
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
 *
 * Closes the wrapping divs
 *
 * @since 1.0.0
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
 * Before product loop
 *
 * Inserts a wrapper for the product loop on product pages.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'archetype_before_product_loop' ) ) {
	function archetype_before_product_loop() {
		if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) {
			echo '<div class="columns-' . archetype_sanitize_integer( get_theme_mod( 'archetype_products_columns', '3' ) ) . '">';
		}
	}
}

/**
 * After product loop
 *
 * Closes the product loop wrapper on product pages.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'archetype_after_product_loop' ) ) {
	function archetype_after_product_loop() {
		if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) {
			echo '</div>';
		}
	}
}

/**
 * Before product loop item
 *
 * Inserts a wrapper for the product loop item.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'archetype_before_product_loop_item' ) ) {
	function archetype_before_product_loop_item() {
		echo '<div class="product-item-content">';
	}
}

/**
 * After product loop item
 *
 * Closes the product loop item wrapper.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'archetype_after_product_loop_item' ) ) {
	function archetype_after_product_loop_item() {
		echo '</div>';
	}
}

/**
 * Before product loop item buttons
 *
 * Inserts a wrapper for the product loop item buttons.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'archetype_before_product_loop_item_buttons' ) ) {
	function archetype_before_product_loop_item_buttons() {
		echo '<div class="product-item-buttons">';
	}
}

/**
 * After product loop item buttons
 *
 * Closes the product loop item wrapper buttons.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'archetype_after_product_loop_item_buttons' ) ) {
	function archetype_after_product_loop_item_buttons() {
		echo '</div>';
	}
}

/**
 * Default loop columns on product archives
 *
 * @since 1.0.0
 *
 * @return integer products per row
 */
function archetype_loop_columns() {
	$columns = 3;

	if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) {
		$columns = archetype_sanitize_integer( get_theme_mod( 'archetype_products_columns', '3' ) );
	}

	if ( is_product() ) {
		$columns = archetype_sanitize_integer( get_theme_mod( 'archetype_related_products_columns', '3' ) );
	}

	return apply_filters( 'archetype_loop_columns', $columns ); // Products per row
}

/**
 * Adds various classes to the body tag
 *
 * @sine 1.0.0
 *
 * @param array $classes
 * @return array $classes modified array of classes
 */
function archetype_woocommerce_body_class( $classes ) {
	if ( is_woocommerce_activated() ) {
		$classes[] = 'woocommerce-active';
	}

	if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) {
		if ( 1 === archetype_sanitize_checkbox( get_theme_mod( 'archetype_products_full_width', apply_filters( 'archetype_default_products_full_width', false ) ) ) ) {
			$classes[] = 'archetype-full-width-content';
			remove_action( 'archetype_sidebar', 'archetype_get_sidebar' );
		}
	}

	if ( is_product() ) {
		if ( 1 === archetype_sanitize_checkbox( get_theme_mod( 'archetype_product_full_width', apply_filters( 'archetype_default_product_full_width', false ) ) ) ) {
			$classes[] = 'archetype-full-width-content';
			remove_action( 'archetype_sidebar', 'archetype_get_sidebar' );
		}

		if ( 1 === archetype_sanitize_checkbox( get_theme_mod( 'archetype_product_gallery_full_width', apply_filters( 'archetype_default_product_gallery_full_width', false ) ) ) ) {
			$classes[] = 'archetype-full-width-product-gallery';
		}

		if ( 1 !== archetype_sanitize_checkbox( get_theme_mod( 'archetype_product_gallery_toggle', apply_filters( 'archetype_default_product_gallery_toggle', true ) ) ) ) {
			$classes[] = 'archetype-full-width-product-summary';
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
		}

		if ( 1 !== archetype_sanitize_checkbox( get_theme_mod( 'archetype_product_meta_toggle', apply_filters( 'archetype_default_product_meta_toggle', true ) ) ) ) {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		}

		if ( 1 !== archetype_sanitize_checkbox( get_theme_mod( 'archetype_product_tabs_toggle', apply_filters( 'archetype_default_product_tabs_toggle', true ) ) ) ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
		}

		if ( 1 !== archetype_sanitize_checkbox( get_theme_mod( 'archetype_related_products_toggle', apply_filters( 'archetype_default_related_products_toggle', true ) ) ) ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		}

	}

	$image_only = false;

	if ( 1 !== archetype_sanitize_checkbox( get_theme_mod( 'archetype_products_image_toggle', apply_filters( 'archetype_default_products_image_toggle', true ) ) ) ) {
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
		$classes[] = 'archetype-products-no-image';
	} else {
		$image_only = true;
	}

	if ( 1 !== archetype_sanitize_checkbox( get_theme_mod( 'archetype_products_title_toggle', apply_filters( 'archetype_default_products_title_toggle', true ) ) ) ) {
		$classes[] = 'archetype-hide-products-title';
	} else {
		$image_only = false;
	}

	if ( 1 !== archetype_sanitize_checkbox( get_theme_mod( 'archetype_products_sale_toggle', apply_filters( 'archetype_default_products_sale_toggle', true ) ) ) ) {
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 6	);
	}

	if ( 1 !== archetype_sanitize_checkbox( get_theme_mod( 'archetype_products_rating_toggle', apply_filters( 'archetype_default_products_rating_toggle', true ) ) ) ) {
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	} else {
		$image_only = false;
	}

	if ( 1 !== archetype_sanitize_checkbox( get_theme_mod( 'archetype_products_price_toggle', apply_filters( 'archetype_default_products_price_toggle', true ) ) ) ) {
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	} else {
		$image_only = false;
	}

	if ( 1 !== archetype_sanitize_checkbox( get_theme_mod( 'archetype_products_add_to_cart_toggle', apply_filters( 'archetype_default_products_add_to_cart_toggle', true ) ) ) ) {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	} else {
		$image_only = false;
	}
	
	if ( true === $image_only ) {
		$classes[] = 'archetype-products-image-only';
	}

	return $classes;
}

/**
 * Adds a column class to the post tag
 *
 * @sine 1.0.0
 *
 * @param array $classes
 * @return array $classes modified array of classes
 */
function archetype_woocommerce_post_class( $classes ) {
	if ( is_product() ) {
		$classes[] = 'columns-' . archetype_sanitize_integer( get_theme_mod( 'archetype_related_products_columns', '3' ) );
	}

	return $classes;
}

/**
 * Replaces the placeholder image.
 *
 * @since 1.0.0
 *
 * @return string
 */
function archetype_fix_thumbnail() {
	add_filter( 'woocommerce_placeholder_img_src', 'archetype_woocommerce_placeholder_img_src', 0 );

	function archetype_woocommerce_placeholder_img_src( $src ) {
		return get_template_directory_uri() . '/inc/woocommerce/images/placeholder.png';
	}
}

/**
 * Replaces `get_search_form()` with Product Search.
 *
 * @since 1.0.0
 *
 * @param string $form The form markup.
 * @return string
 */
if ( ! function_exists( 'archetype_product_search_form' ) ) {
	function archetype_product_search_form( $form ) {
		if ( archetype_is_woocommerce() ) {
			$form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
				<label>
					<span class="screen-reader-text">' . _x( 'Search for:', 'label', 'archetype' ) . '</span>
					<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search Products &hellip;', 'placeholder', 'archetype' ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Search for:', 'label', 'archetype' ) . '" />
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
 *
 * Ensure cart contents update when products are added to the cart via AJAX
 *
 * @since 1.0.0
 *
 * @param array $fragments Fragments to refresh via AJAX
 * @return array Fragments to refresh via AJAX
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
 *
 * @since 1.0.0
 */
function archetype_woocommerce_scripts() {
	global $archetype_version;

	$rtl = is_rtl() ? '-rtl' : '';
	wp_enqueue_style( 'archetype-woocommerce-style', get_template_directory_uri() . '/inc/woocommerce/css/woocommerce' . $rtl . '.css', $archetype_version );
}

/**
 * Related Products Args
 *
 * @since 1.0.0
 *
 * @param array $args related products args
 * @return array $args related products args
 */
function archetype_related_products_args( $args ) {
	$limit = archetype_sanitize_integer( get_theme_mod( 'archetype_related_products_limit', '3' ) );
	$columns = archetype_sanitize_integer( get_theme_mod( 'archetype_related_products_columns', '3' ) );

	$args = apply_filters( 'archetype_related_products_args', array(
		'posts_per_page'  => $limit,
		'columns'         => $columns,
	) );

	return $args;
}

/**
 * Breadcrumb Defaults
 *
 * @since 1.0.0
 *
 * @param array $args default breadcrumb args
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
 *
 * @since 1.0.0
 *
 * @return integer number of columns
 */
function archetype_thumbnail_columns() {
	$product_page = get_theme_mod( 'archetype_product_full_width', apply_filters( 'archetype_default_product_full_width', false ) );

	$product_gallery = get_theme_mod( 'archetype_product_gallery_full_width', apply_filters( 'archetype_default_product_gallery_full_width', false ) );

	$columns = 3;

	if ( 1 === $product_gallery ) {
		$columns = 4;
	}

	if ( 1 === $product_page && 1 === $product_gallery ) {
		$columns = 6;
	}

	/**
 	* Filter the number of image columns for each gallery row.
 	*
 	* Built-in support for 1, 2, 3, 4, 6, and 12 columns.
 	*/
	return intval( apply_filters( 'archetype_product_thumbnail_columns', $columns ) );
}

/**
 * Products per page
 *
 * @since 1.0.0
 *
 * @return integer number of products
 */
function archetype_products_per_page() {
	$products_per_page = archetype_sanitize_integer( get_theme_mod( 'archetype_products_per_page', apply_filters( 'archetype_default_products_per_page', '12' ) ) );

	return intval( $products_per_page );
}

/**
 * Query WooCommerce Extension Activation.
 *
 * @since 1.0.0
 *
 * @param $extension main extension class name
 * @return boolean
 */
function is_woocommerce_extension_activated( $extension = 'WC_Bookings' ) {
	return class_exists( $extension ) ? true : false;
}