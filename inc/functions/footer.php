<?php
/**
 * Template functions used for the site footer.
 *
 * @package Archetype
 * @subpackage Footer
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_site_footer' ) ) :
	/**
	 * Build the site footer with widgets.
	 *
	 * @since 1.0.0
	 */
	function archetype_site_footer() {
		?>
		<div class="<?php archetype_site_footer_classes(); ?>" style="<?php archetype_site_footer_styles(); ?>">

			<div class="col-full">

				<?php
				/**
				 * Default hooks
				 *
				 * @hooked archetype_footer_widgets - 10
				 */
				do_action( 'archetype_footer_widgets' ); ?>

			</div><!-- .col-full -->

		</div><!-- .site-footer -->
		<?php
	}
endif;

if ( ! function_exists( 'archetype_site_info' ) ) :
	/**
	 * Build the site info footer with credits.
	 *
	 * @since 1.0.0
	 */
	function archetype_site_info() {
		?>
		<div class="<?php archetype_site_info_classes(); ?>" style="<?php archetype_site_info_styles(); ?>">

			<div class="col-full">

				<?php
				/**
				 * Default hooks
				 *
				 * @hooked archetype_credit - 20
				 */
				do_action( 'archetype_site_info_footer' ); ?>

			</div><!-- .col-full -->

		</div><!-- .site-info -->
		<?php
	}
endif;

if ( ! function_exists( 'archetype_footer_widgets' ) ) :
	/**
	 * Display the footer widget regions
	 *
	 * @since 1.0.0
	 */
	function archetype_footer_widgets() {
		if ( ! is_active_sidebar( 'footer-1' ) ) {
			return;
		}

		// CSS classes.
		$classes = array();
		$classes[] = 'footer-widgets';

		// CSS style attributes.
		$styles = array();

		/**
		 * Filter the CSS classes added to the section tag.
		 *
		 * @since 1.0.0
		 *
		 * @param array $classes Array of CSS classes.
		 */
		$classes = apply_filters( 'archetype_footer_widgets_classes', $classes );

		/**
		 * Filter the inline CSS styles added to the section tag.
		 *
		 * @since 1.0.0
		 *
		 * @param array $styles Array of inline CSS styles.
		 */
		$styles = apply_filters( 'archetype_footer_widgets_styles', $styles );

		?>
		<section class="<?php echo implode( ' ', $classes ); ?>" style="<?php echo implode( ' ', $styles ); ?>">
			<?php dynamic_sidebar( 'footer-1' ); ?>
		</section><!-- .footer-widgets	-->
		<?php
	}
endif;

if ( ! function_exists( 'archetype_credit' ) ) :
	/**
	 * Display the theme credit
	 *
	 * @since 1.0.0
	 */
	function archetype_credit() {
		?>
		<div class="credit">
			<?php
			// Copyright text.
			$content = sprintf( '&copy; %s <span class="footer-site-title">%s</span>. ', date( 'Y' ), get_bloginfo( 'name' ) );
			echo wp_kses_post( apply_filters( 'archetype_copyright_text', $content ) );

			// Credits.
			if ( true == get_theme_mod( 'archetype_footer_info_credits_toggle', true ) && apply_filters( 'archetype_credit_link', true ) ) {
				printf( __( '%1$s theme by %2$s.', 'archetype' ), 'Archetype', '<a href="http://valendesigns.com" title="Premium WordPress Themes by Valen Designs">Valen Designs</a>' );
			}
			?>
		</div><!-- .credit	-->
		<?php
	}
endif;

if ( ! function_exists( 'archetype_site_footer_classes' ) ) :
	/**
	 * Build the site footer classes.
	 *
	 * @since 1.0.0
	 *
	 * @param array $classes Array of additional CSS classes.
	 */
	function archetype_site_footer_classes( $classes = array() ) {
		// CSS classes.
		$classes[] = 'site-footer';

		/**
		 * Filter the CSS classes added to the site footer.
		 *
		 * @since 1.0.0
		 *
		 * @param array $classes Array of CSS classes.
		 */
		$classes = apply_filters( 'archetype_site_footer_classes', $classes );

		echo esc_attr( implode( ' ', $classes ) );
	}
endif;

if ( ! function_exists( 'archetype_site_footer_styles' ) ) :
	/**
	 * Build the site footer styles.
	 *
	 * @since 1.0.0
	 *
	 * @param array $styles Array of inline CSS styles.
	 */
	function archetype_site_footer_styles( $styles = array() ) {
		/**
		 * Filter the CSS styles added to the site footer.
		 *
		 * @since 1.0.0
		 *
		 * @param array $styles Array of inline CSS styles.
		 */
		$styles = apply_filters( 'archetype_site_footer_styles', $styles );

		echo esc_attr( implode( ' ', $styles ) );
	}
endif;

if ( ! function_exists( 'archetype_site_info_classes' ) ) :
	/**
	 * Build the site info classes.
	 *
	 * @since 1.0.0
	 *
	 * @param array $classes Array of additional CSS classes.
	 */
	function archetype_site_info_classes( $classes = array() ) {
		// CSS classes.
		$classes[] = 'site-info';

		/**
		 * Filter the CSS classes added to the site info.
		 *
		 * @since 1.0.0
		 *
		 * @param array $classes Array of CSS classes.
		 */
		$classes = apply_filters( 'archetype_site_info_classes', $classes );

		echo esc_attr( implode( ' ', $classes ) );
	}
endif;

if ( ! function_exists( 'archetype_site_info_styles' ) ) :
	/**
	 * Build the site info styles.
	 *
	 * @since 1.0.0
	 *
	 * @param array $styles Array of inline CSS styles.
	 */
	function archetype_site_info_styles( $styles = array() ) {
		/**
		 * Filter the CSS styles added to the site info.
		 *
		 * @since 1.0.0
		 *
		 * @param array $styles Array of inline CSS styles.
		 */
		$styles = apply_filters( 'archetype_site_info_styles', $styles );

		echo esc_attr( implode( ' ', $styles ) );
	}
endif;
