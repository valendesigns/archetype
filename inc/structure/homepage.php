<?php
/**
 * Custom homepage function.
 *
 * @package Archetype
 * @subpackage Homepage
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_homepage_hero' ) ) :

	/**
	 * Display the Homepage Hero
	 *
	 * @since 1.0.0
	 */
	function archetype_homepage_hero() {
		if ( false === archetype_sanitize_checkbox( get_theme_mod( 'archetype_homepage_hero_toggle', true ) ) ) {
			return false;
		}

		// Layout.
		$layout              = ( true === archetype_sanitize_checkbox( get_theme_mod( 'archetype_homepage_hero_layout', true ) ) ? 'expand-full-width' : '' );

		// Alignment.
		$alignment           = esc_attr( get_theme_mod( 'archetype_homepage_hero_alignment', 'center' ) );

		// Background image.
		$background_img_src  = wp_get_attachment_image_src( archetype_sanitize_integer( get_theme_mod( 'archetype_homepage_hero_background_image', '' ) ), 'full' );
		$background_img      = isset( $background_img_src[0] ) ? $background_img_src[0] : '';

		// Background image size.
		$background_img_size = esc_attr( get_theme_mod( 'archetype_homepage_hero_background_image_size', 'auto' ) );

		// Background color.
		$background_color    = sanitize_text_field( get_theme_mod( 'archetype_homepage_hero_background_color', apply_filters( 'archetype_default_homepage_hero_background_color', '#353b3f' ) ) );

		// Heading color.
		$heading_text_color  = archetype_sanitize_hex_color( get_theme_mod( 'archetype_homepage_hero_heading_color', apply_filters( 'archetype_default_homepage_hero_heading_color', '#fff' ) ) );

		// Body color.
		$body_text_color     = archetype_sanitize_hex_color( get_theme_mod( 'archetype_homepage_hero_text_color', apply_filters( 'archetype_default_homepage_hero_text_color', '#888' ) ) );

		// Heading text.
		$heading_text        = sanitize_text_field( get_theme_mod( 'archetype_homepage_hero_heading_text', __( 'Heading Text', 'archetype' ) ) );

		// Body Text.
		$body_text           = wp_kses_post( get_theme_mod( 'archetype_homepage_hero_text', __( 'Body Text', 'archetype' ) ) );

		// Button text.
		$button_text         = sanitize_text_field( get_theme_mod( 'archetype_homepage_hero_button_text', __( 'Call to Action', 'archetype' ) ) );

		// Button URL.
		$button_url          = sanitize_text_field( get_theme_mod( 'archetype_homepage_hero_button_url', home_url() ) );

		// Display buttons.
		$has_buttons         = (bool) $button_text && $button_url;

		// CSS classes.
		$classes = array( 'archetype-homepage-hero' );
		$classes[] = $alignment;
		$classes[] = $layout;

		// CSS style attributes.
		$styles = array();
		$styles[] = "color: $body_text_color;";
		$styles[] = "background-color: $background_color;";
		$styles[] = "background-image: url($background_img);";
		$styles[] = "background-size: $background_img_size;";
		$styles[] = 'background-repeat: no-repeat;';

		/**
		 * Filter the buttons display.
		 *
		 * @since 1.0.0
		 *
		 * @param bool $has_buttons Whether to display the buttons.
		 */
		$has_buttons = apply_filters( 'archetype_homepage_hero_has_buttons', $has_buttons );
		?>
		<section class="<?php echo implode( ' ', $classes ); ?>" style="<?php echo implode( ' ', $styles ); ?>">

			<div class="col-full">

				<?php do_action( 'archetype_homepage_hero_content_before' ); ?>

				<div class="archetype-homepage-hero-content">

					<?php do_action( 'archetype_homepage_hero_title_before' ); ?>

					<h1 style="color: <?php echo esc_attr( $heading_text_color ); ?>"><?php echo esc_html( $heading_text ); ?></h1>

					<?php do_action( 'archetype_homepage_hero_title_after' ); ?>

					<?php do_action( 'archetype_homepage_hero_body_before' ); ?>

					<div class="archetype-homepage-hero-body">

						<?php echo wpautop( $body_text ); ?>

						<?php do_action( 'archetype_homepage_hero_body' ); ?>

						<?php if ( $has_buttons ) { ?>

							<?php do_action( 'archetype_homepage_hero_buttons_before' ); ?>

							<div class="archetype-homepage-hero-buttons">

								<a href="<?php echo esc_attr( $button_url ); ?>" class="button"><?php echo esc_html( $button_text ); ?></a>

								<?php do_action( 'archetype_homepage_hero_buttons' ); ?>

							</div><!-- .archetype-homepage-hero-buttons -->

							<?php do_action( 'archetype_homepage_hero_buttons_after' ); ?>

						<?php } ?>

					</div><!-- .archetype-homepage-hero-body -->

					<?php do_action( 'archetype_homepage_hero_body_after' ); ?>

				</div><!-- .archetype-homepage-hero-content -->

				<?php do_action( 'archetype_homepage_hero_content_after' ); ?>

			</div>

		</section>
		<?php
	}

endif;

if ( ! function_exists( 'archetype_homepage_content_components' ) ) :
	/**
	 * Adds the homepage content components.
	 *
	 * Hooked into the `init` action at priority 0
	 *
	 * @since 1.0.0
	 */
	function archetype_homepage_content_components() {
		/**
		 * Filter the number of component sections displayed in the Customizer.
		 *
		 * It is important to note that when adding additional components you must create a new function.
		 * The function name must be `archetype_homepage_content_x` where `x` is the component number.
		 * There is already support for 1-3, though if you added 2 more section you would need to create
		 * `archetype_homepage_content_4` & `archetype_homepage_content_5`. The function must contain the
		 * `archetype_homepage_content_component` function which is passed the component number.
		 *
		 * Example:
		 *
		 * function archetype_homepage_content_4() {
		 *   archetype_homepage_content_component( 4 );
		 * }
		 *
		 * @since 1.0.0
		 *
		 * @param int $components The number of components. The default is '3'.
		 */
		$components = apply_filters( 'archetype_homepage_content_components', 3 );

		for ( $id = 1; $id <= absint( $components ); $id++ ) {
			$modifier = 2 < $id ? 5 : 0;
			$priority = ( $id + $modifier ) * 10;
			add_action( 'homepage', 'archetype_homepage_content_' . $id, $priority );
		}
	}
endif;

if ( ! function_exists( 'archetype_homepage_content_component' ) ) :
	/**
	 * Displays the homepage content component by ID.
	 *
	 * @since 1.0.0
	 *
	 * @param int $id The component ID. Default is '1'.
	 */
	function archetype_homepage_content_component( $id = 1 ) {
		if ( ! is_homepage_control_activated() && false === archetype_sanitize_checkbox( get_theme_mod( 'archetype_homepage_content_' . $id . '_toggle', true ) ) ) {
			return false;
		}

		// Customizer content.
		$content_page 					  = archetype_sanitize_integer( get_theme_mod( 'archetype_homepage_content_' . $id, ( 1 === $id ? get_option( 'page_on_front' ) : 0 ) ) );
		$content_text_color 			= archetype_sanitize_hex_color( get_theme_mod( 'archetype_homepage_content_' . $id . '_text_color', apply_filters( 'archetype_default_homepage_content_' . $id . '_text_color', '#555' ) ) );
		$content_background_color = archetype_sanitize_hex_color( get_theme_mod( 'archetype_homepage_content_' . $id . '_background_color', apply_filters( 'archetype_default_homepage_content_' . $id . '_background_color', '#fff' ) ) );
		$content_alignment				= esc_attr( get_theme_mod( 'archetype_homepage_content_' . $id . '_alignment', 'left' ) );

		// CSS classes.
		$classes = array();
		$classes[] = 'archetype-homepage-content';
		$classes[] = 'archetype-homepage-content-' . $id;
		$classes[] = $content_alignment;
		$classes[] = 'expand-full-width';

		// CSS style attributes.
		$styles = array();
		$styles[] = "color: $content_text_color;";
		$styles[] = "background-color: $content_background_color;";

		if ( 0 !== $content_page && $page_data = get_page( $content_page ) ) {
			/**
			 * Filter the CSS classes added to the section tag.
			 *
			 * @since 1.0.0
			 *
			 * @param array $classes Array of CSS classes.
			 * @param int   $id The component ID.
			 */
			$classes = apply_filters( 'archetype_homepage_content_component_classes', $classes, $id );

			/**
			 * Filter the inline CSS styles added to the section tag.
			 *
			 * @since 1.0.0
			 *
			 * @param array $styles Array of inline CSS styles.
			 * @param int   $id The component ID.
			 */
			$styles = apply_filters( 'aarchetype_homepage_content_component_styles', $styles, $id );
			?>
			<section class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" style="<?php echo esc_attr( implode( ' ', $styles ) ); ?>">

				<div class="col-full">

					<?php do_action( 'archetype_homepage_before_content_' . $id ); ?>

					<?php echo apply_filters( 'the_content', $page_data->post_content ); ?>

					<?php do_action( 'archetype_homepage_after_content_' . $id ); ?>

				</div><!-- .col-full -->

			</section><!-- .archetype-homepage-content -->
			<?php
		}
	}
endif;

if ( ! function_exists( 'archetype_homepage_content_1' ) ) :
	/**
	 * Displays homepage content 1.
	 *
	 * Hooked into the `homepage` action in the homepage template at priority 10
	 *
	 * @since 1.0.0
	 */
	function archetype_homepage_content_1() {
		archetype_homepage_content_component( 1 );
	}
endif;

if ( ! function_exists( 'archetype_homepage_content_2' ) ) :
	/**
	 * Displays homepage content 2.
	 *
	 * Hooked into the `homepage` action in the homepage template at priority 20
	 *
	 * @since 1.0.0
	 */
	function archetype_homepage_content_2() {
		archetype_homepage_content_component( 2 );
	}
endif;

if ( ! function_exists( 'archetype_homepage_content_3' ) ) :
	/**
	 * Displays homepage content 3.
	 *
	 * Hooked into the `homepage` action in the homepage template at priority 80
	 *
	 * @since 1.0.0
	 */
	function archetype_homepage_content_3() {
		archetype_homepage_content_component( 3 );
	}
endif;
