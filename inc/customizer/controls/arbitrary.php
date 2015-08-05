<?php
/**
 * Arbitrary control classes.
 *
 * @package Archetype
 * @subpackage Customize
 * @since 1.0.0
 */

/**
 * Class to create a custom arbitrary html control for text block, headings, and dividers.
 *
 * @since 1.0.0
 * @codeCoverageIgnore
 */
class Archetype_Arbitrary_Control extends WP_Customize_Control {
	/**
	 * Setting ID
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $settings = 'blogname';

	/**
	 * The description
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $description = '';

	/**
	 * Render the content on the theme customizer page
	 */
	public function render_content() {
		switch ( $this->type ) {
			default:
			case 'text' :
				echo '<p class="description">' . wp_kses_post( $this->description ) . '</p>';
			break;
			case 'heading':
				echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
			break;
			case 'divider' :
				echo '<hr style="margin: 1em 0;" />';
			break;
		}
	}
}
