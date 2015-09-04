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
		$layout              = ( true === archetype_sanitize_checkbox( get_theme_mod( 'archetype_homepage_hero_layout', true ) ) ? 'expand-column' : '' );

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

		// Image ID.
		$image_id            = archetype_sanitize_integer( get_theme_mod( 'archetype_homepage_hero_image', 0 ) );

		// Image grid.
		$image_grid          = archetype_sanitize_integer( get_theme_mod( 'archetype_homepage_hero_image_columns', apply_filters( 'archetype_default_homepage_hero_image_columns', '12' ) ) );

		// Display buttons.
		$has_buttons         = (bool) $button_text && $button_url;

		// CSS classes.
		$classes = array();
		$classes[] = 'archetype-hero';
		$classes[] = 'archetype-homepage-hero';
		$classes[] = $alignment;
		$classes[] = $layout;

		if ( 0 !== $image_id && 12 !== $image_grid ) {
			$classes[] = 'archetype-hero-has-grid';
		}

		if ( true === archetype_sanitize_checkbox( get_theme_mod( 'archetype_homepage_hero_image_transition_toggle', apply_filters( 'archetype_default_homepage_hero_image_transition_toggle', true ) ) ) ) {
			$classes[] = 'archetype-hero-add-transition';
		}

		if ( true === archetype_sanitize_checkbox( get_theme_mod( 'archetype_homepage_hero_image_position_toggle', apply_filters( 'archetype_default_homepage_hero_image_position_toggle', false ) ) ) ) {
			$classes[] = 'archetype-hero-position-media';
		}

		if ( 'left' === esc_attr( get_theme_mod( 'archetype_homepage_hero_image_alignment', apply_filters( 'archetype_default_homepage_hero_image_alignment', 'right' ) ) ) ) {
			$classes[] = 'archetype-hero-transition-reverse';
		}

		// CSS style attributes.
		$styles = array();
		$styles[] = "color: $body_text_color;";
		$styles[] = "background-color: $background_color;";
		if ( ! empty( $background_img ) ) {
			$styles[] = "background-image: url($background_img);";
			$styles[] = "background-size: $background_img_size;";
			$styles[] = 'background-repeat: no-repeat;';
			$styles[] = 'background-position: center;';
		}

		/**
		 * Filter the CSS classes added to the homepage hero section tag.
		 *
		 * @since 1.0.0
		 *
		 * @param array $classes Array of CSS classes.
		 */
		$classes = apply_filters( 'archetype_homepage_hero_classes', $classes );

		/**
		 * Filter the inline CSS styles added to the homepage hero section tag.
		 *
		 * @since 1.0.0
		 *
		 * @param array $styles Array of inline CSS styles.
		 */
		$styles = apply_filters( 'archetype_homepage_hero_styles', $styles );

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

			<?php do_action( 'archetype_homepage_hero_overlay_before' ); ?>

			<div class="archetype-hero-overlay">

				<?php do_action( 'archetype_homepage_hero_column_before' ); ?>

				<div class="col-full">

					<?php do_action( 'archetype_homepage_hero_content_before' ); ?>

					<div class="archetype-hero-content">

						<?php do_action( 'archetype_homepage_hero_title_before' ); ?>

						<h1 style="color: <?php echo esc_attr( $heading_text_color ); ?>"><?php echo esc_html( $heading_text ); ?></h1>

						<?php do_action( 'archetype_homepage_hero_title_after' ); ?>

						<?php do_action( 'archetype_homepage_hero_body_before' ); ?>

						<div class="archetype-hero-body">

							<?php echo wpautop( $body_text ); ?>

							<?php do_action( 'archetype_homepage_hero_body' ); ?>

							<?php if ( $has_buttons ) { ?>

								<?php do_action( 'archetype_homepage_hero_buttons_before' ); ?>

								<div class="archetype-hero-buttons">

									<a href="<?php echo esc_attr( $button_url ); ?>" class="button"><?php echo esc_html( $button_text ); ?></a>

									<?php do_action( 'archetype_homepage_hero_buttons' ); ?>

								</div><!-- .archetype-hero-buttons -->

								<?php do_action( 'archetype_homepage_hero_buttons_after' ); ?>

							<?php } ?>

						</div><!-- .archetype-hero-body -->

						<?php do_action( 'archetype_homepage_hero_body_after' ); ?>

					</div><!-- .archetype-hero-content -->

					<?php do_action( 'archetype_homepage_hero_content_after' ); ?>

				</div><!-- .col-full -->

				<?php do_action( 'archetype_homepage_hero_column_after' ); ?>

			</div><!-- .archetype-hero-overlay -->

			<?php do_action( 'archetype_homepage_hero_overlay_after' ); ?>

		</section>
		<?php
	}

endif;

if ( ! function_exists( 'archetype_homepage_hero_media' ) ) :
	/**
	 * Display the hero media.
	 *
	 * @since 1.0.0
	 */
	function archetype_homepage_hero_media() {
		// Image.
		$image_id = archetype_sanitize_integer( get_theme_mod( 'archetype_homepage_hero_image', 0 ) );

		if ( 0 !== $image_id ) {
			$image_src = wp_get_attachment_image_src( $image_id, 'full' );

			if ( isset( $image_src[0] ) ) {
				echo '<div class="archetype-hero-media"><img src="' . esc_url( $image_src[0] . ( is_customize_preview() ? '?v=' . rand() : '' ) ) . '" /></div>';
			}
		}
	}
endif;

if ( ! function_exists( 'archetype_homepage_hero_add_button' ) ) :
	/**
	 * Display the second hero button.
	 *
	 * @since 1.0.0
	 */
	function archetype_homepage_hero_add_button() {
		// Button text.
		$button_text = sanitize_text_field( get_theme_mod( 'archetype_homepage_hero_button_2_text', apply_filters( 'archetype_default_homepage_hero_button_2_text', '' ) ) );

		// Button URL.
		$button_url  = sanitize_text_field( get_theme_mod( 'archetype_homepage_hero_button_2_url', apply_filters( 'archetype_default_homepage_hero_button_2_url', '' ) ) );

		// Button class.
		$button_alt  = archetype_sanitize_checkbox( get_theme_mod( 'archetype_homepage_hero_button_2_alt_toggle', apply_filters( 'archetype_default_homepage_hero_button_2_alt_toggle', true ) ) );

		if ( $button_text && $button_url ) {
			$class = ( true === $button_alt ? 'button alt' : 'button' );
			echo '<a href="' . esc_attr( $button_url ) . '" class="' . $class . '">' . esc_html( $button_text ) . '</a>';
		}
	}
endif;

if ( ! function_exists( 'archetype_homepage_widgets_components' ) ) :
	/**
	 * Adds the homepage content components.
	 *
	 * Hooked into the `init` action at priority 0
	 *
	 * @since 1.0.0
	 */
	function archetype_homepage_widgets_components() {
		/**
		 * Filter the number of component sections displayed in the Customizer.
		 *
		 * It is important to note that when adding additional components you must create a new function.
		 * The function name must be `archetype_homepage_widgets_x` where `x` is the component number.
		 * There is already support for 1-3, though if you added 2 more section you would need to create
		 * `archetype_homepage_widgets_4` & `archetype_homepage_widgets_5`. The function must contain the
		 * `archetype_homepage_widgets_component` function which is passed the component number.
		 *
		 * Example:
		 *
		 * function archetype_homepage_widgets_4() {
		 *   archetype_homepage_widgets_component( 4 );
		 * }
		 *
		 * @since 1.0.0
		 *
		 * @param int $components The number of components. The default is '3'.
		 */
		$components = apply_filters( 'archetype_homepage_widgets_components', 3 );

		for ( $id = 1; $id <= absint( $components ); $id++ ) {
			$modifier = 2 < $id ? 5 : 0;
			$priority = ( $id + $modifier ) * 10;
			add_action( 'homepage', 'archetype_homepage_widgets_' . $id, $priority );
		}
	}
endif;

if ( ! function_exists( 'archetype_homepage_widgets_component' ) ) :
	/**
	 * Displays the homepage content component by ID.
	 *
	 * @since 1.0.0
	 *
	 * @param int $id The component ID. Default is '1'.
	 */
	function archetype_homepage_widgets_component( $id = 1 ) {
		$sidebar_id = 'homepage-' . $id;

		if ( ! is_active_sidebar( $sidebar_id ) ) {
			return;
		}

		$full_width = archetype_sanitize_checkbox( get_theme_mod( 'archetype_homepage_widgets_' . $id . '_full_width_toggle', apply_filters( 'archetype_default_homepage_widgets_' . $id . '_full_width_toggle', false ) ) );

		$columns = esc_attr( get_theme_mod( 'archetype_homepage_widgets_' . $id . '_columns', apply_filters( 'archetype_default_homepage_widgets_' . $id . '_columns', 'widget-cols-4' ) ) );

		$gutters = archetype_sanitize_checkbox( get_theme_mod( 'archetype_homepage_widgets_' . $id . '_gutters_toggle', apply_filters( 'archetype_default_homepage_widgets_' . $id . '_gutters_toggle', true ) ) );

		$container_padding = archetype_sanitize_checkbox( get_theme_mod( 'archetype_homepage_widgets_' . $id . '_padding_toggle', apply_filters( 'archetype_default_homepage_widgets_' . $id . '_padding_toggle', true ) ) );

		$container_inner_padding = archetype_sanitize_checkbox( get_theme_mod( 'archetype_homepage_widgets_' . $id . '_inner_padding_toggle', apply_filters( 'archetype_default_homepage_widgets_' . $id . '_inner_padding_toggle', false ) ) );

		$heading_border = archetype_sanitize_checkbox( get_theme_mod( 'archetype_homepage_widgets_' . $id . '_heading_border_toggle', apply_filters( 'archetype_default_homepage_widgets_' . $id . '_heading_border_toggle', true ) ) );

		$bottom_margin = archetype_sanitize_checkbox( get_theme_mod( 'archetype_homepage_widgets_' . $id . '_bottom_margin_toggle', apply_filters( 'archetype_default_homepage_widgets_' . $id . '_bottom_margin_toggle', true ) ) );

		$alignment = esc_attr( get_theme_mod( 'archetype_homepage_widgets_' . $id . '_alignment', apply_filters( 'archetype_default_homepage_widgets_' . $id . '_alignment', 'left' ) ) );

		// CSS classes.
		$classes   = array();
		$classes[] = 'archetype-widgets-section';
		$classes[] = 'archetype-homepage-widgets-' . $id;
		$classes[] = $alignment;
		$classes[] = 'expand-column';

		if ( true === $full_width ) {
			$classes[] = 'full-width-column';
		}

		$classes[] = $columns;

		if ( false === $gutters ) {
			$classes[] = 'no-gutters';
		}

		if ( true === $container_padding ) {
			$classes[] = 'add-padding';
		}

		if ( true === $container_inner_padding ) {
			$classes[] = 'add-inner-padding';
		}

		if ( false === $heading_border ) {
			$classes[] = 'no-heading-border';
		}

		if ( true === $bottom_margin ) {
			$classes[] = 'add-bottom-margin';
		}

		/**
		 * Filter the CSS classes added to the section tag.
		 *
		 * @since 1.0.0
		 *
		 * @param array $classes Array of CSS classes.
		 * @param int   $id The component ID.
		 */
		$classes = apply_filters( 'archetype_homepage_widgets_component_classes', $classes, $id );
		?>
		<section class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

			<div class="col-full">

				<?php do_action( 'archetype_homepage_before_content_' . $id ); ?>

				<?php dynamic_sidebar( $sidebar_id ); ?>

				<?php do_action( 'archetype_homepage_after_content_' . $id ); ?>

			</div><!-- .col-full -->

		</section><!-- .archetype-homepage-content -->
		<?php
	}
endif;

if ( ! function_exists( 'archetype_homepage_widgets_1' ) ) :
	/**
	 * Displays homepage content 1.
	 *
	 * Hooked into the `homepage` action in the homepage template at priority 10
	 *
	 * @since 1.0.0
	 */
	function archetype_homepage_widgets_1() {
		archetype_homepage_widgets_component( 1 );
	}
endif;

if ( ! function_exists( 'archetype_homepage_widgets_2' ) ) :
	/**
	 * Displays homepage content 2.
	 *
	 * Hooked into the `homepage` action in the homepage template at priority 20
	 *
	 * @since 1.0.0
	 */
	function archetype_homepage_widgets_2() {
		archetype_homepage_widgets_component( 2 );
	}
endif;

if ( ! function_exists( 'archetype_homepage_widgets_3' ) ) :
	/**
	 * Displays homepage content 3.
	 *
	 * Hooked into the `homepage` action in the homepage template at priority 80
	 *
	 * @since 1.0.0
	 */
	function archetype_homepage_widgets_3() {
		archetype_homepage_widgets_component( 3 );
	}
endif;
