<?php
/**
 * Component Order control classes.
 *
 * @package Archetype
 * @subpackage Customize
 * @since 1.0.0
 */

/**
 * Class to create a Component Order Customizer control.
 *
 * @since 1.0.0
 * @codeCoverageIgnore
 */
class Archetype_Component_Order_Customizer_Control extends WP_Customize_Control {

	/**
	 * Control type
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $type = 'component-order';

	/**
	 * Control toggle
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $toggle = '';

	/**
	 * Enqueue jQuery Sortable and its dependencies.
	 */
	public function enqueue() {
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-sortable' );
	}

	/**
	 * Display list of ordered components.
	 */
	public function render_content() {
		if ( ! is_array( $this->choices ) || ! count( $this->choices ) ) {
			esc_html_e( 'No components found.', 'archetype' );
			return;
		}

		$components = $this->get_order( $this->choices, $this->value() );
		$disabled   = $this->get_disabled( $this->choices, $this->value() );
		$display    = true;

		/**
		 * Filter the toggle button availability for all component.
		 *
		 * @since 1.0.0
		 *
		 * @param array $hide_toggles Component IDs that should not be toggled.
		 */
		$hide_toggles = apply_filters( 'archetype_component_order_hide_toggles', array( 'archetype_site_header', 'archetype_primary_navigation' ), $this->id );

		// Create toggle params.
		list( $toggle_id, $toggle_value ) = explode( ':' , $this->toggle );

		// Check if we should hide this control.
		if ( ! empty( $this->toggle ) && get_theme_mod( $toggle_id ) !== $toggle_value ) {
			$display = false;
		}
		?>
		<label style="display:<?php echo false === $display ? 'none': 'inline'; ?>">
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;?>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo $this->description ; ?></span>
			<?php endif; ?>
			<ul class="component-order" data-id="<?php echo esc_attr( $toggle_id ); ?>" data-value="<?php echo esc_attr( $toggle_value ); ?>">
				<?php foreach ( $components as $id => $title ) : ?>
					<?php
					// Nothing to display.
					if ( empty( $title ) ) {
						continue;
					}

					// All toggle buttons start as visible.
					$show_toggle = true;

					// Hiding this components will break the markup or have some other unknown side effect.
					if ( in_array( $id, $hide_toggles ) ) {
						$show_toggle = false;
					}

					$class = in_array( $id, $disabled ) ? 'disabled' : '';
					?>
					<li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
						<?php if ( $show_toggle ) { ?><button class="component-visibility" type="button" tabindex="0"><span class="screen-reader-text"><?php esc_html_e( 'Toggle Component', 'archetype' ); ?></span></button><?php } ?>
						<?php echo esc_html( $title ); ?>
					</li>
				<?php endforeach; ?>
			</ul>
			<input type="hidden" class="component-order-input" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>"/>
		</label>
		<?php
	}

	/**
	 * Return the re-ordered components.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param array  $components The hooked components. Default empty.
	 * @param string $order The stored component order. Default empty.
	 * @return array An array of re-ordered components.
	 */
	private function get_order( $components = array(), $order = '' ) {
		$saved_components = explode( ',', $order );

		// Re-order the components according to the stored order.
		if ( 0 < count( $saved_components ) ) {
			// Make a backup before we overwrite.
			$original_components = $components;

			// Make empty.
			$components = array();

			// Loop over the saved components & disable as needed.
			foreach ( $saved_components as $key => $component ) {
				if ( $this->is_disabled( $component ) ) {
					$component = str_replace( '[disabled]', '', $component );
				}

				// Only add to array if component still exists.
				if ( isset( $original_components[ $component ] ) ) {
					$components[ $component ] = $original_components[ $component ];
					unset( $original_components[ $component ] );
				}
			}

			// Merge the old and new array.
			if ( 0 < count( $original_components ) ) {
				$components = array_merge( $components, $original_components );
			}
		}

		return $components;
	}

	/**
	 * Return the disabled components.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param array  $components The hooked components. Default empty.
	 * @param string $order The stored component order. Default empty.
	 * @return array An array of disabled components.
	 */
	private function get_disabled( $components = array(), $order = '' ) {
		$disabled_components = array();
		$saved_components = explode( ',', $order );

		if ( 0 < count( $saved_components ) ) {
			foreach ( $saved_components as $key => $component ) {
				if ( $this->is_disabled( $component ) ) {
					$component = str_replace( '[disabled]', '', $component );
					$disabled_components[] = $component;
				}
				unset( $components[ $component ] );
			}
		}

		// Disable new components.
		if ( 0 < count( $components ) ) {
			foreach ( $components as $key => $component ) {
				$disabled_components[] = $key;
			}
		}

		return $disabled_components;
	}

	/**
	 * Check if a component is disabled.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param string $component The component state.
	 * @return boolean True if a component if disabled.
	 */
	private function is_disabled( $component ) {
		if ( false !== strpos( $component, '[disabled]' ) ) {
			return true;
		}
		return false;
	}

}
