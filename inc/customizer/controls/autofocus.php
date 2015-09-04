<?php
/**
 * Autofocus control classes.
 *
 * @package Archetype
 * @subpackage Customize
 * @since 1.0.0
 */

/**
 * Class to create an autofocus control to expand a Widget Sidebar section.
 *
 * @since 1.0.0
 * @codeCoverageIgnore
 */
class Archetype_Autofocus_Control extends WP_Customize_Control {
	/**
	 * Sidebar ID
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $data_id = '';

	/**
	 * Render the content on the theme customizer page
	 */
	public function render_content() {
		if ( empty( $this->id ) ) {
			return;
		}

		echo '<span class="button archetype-autofocus" data-id="' . esc_attr( $this->data_id ) . '">' . esc_attr__( 'Customize Widgets', 'archetype' ) . '</span>';
	}
}
