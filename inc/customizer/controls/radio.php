<?php
/**
 * Radio control classes.
 *
 * @package Archetype
 * @subpackage Customize
 * @since 1.0.0
 */

/**
 * Creates a Radio Image control
 *
 * You can pass a `columns` number to the `args` array and it will automagically
 * add a grid to your images. There is support for 1 to 4 columns of images.
 *
 * This class incorporates code from the Kirki Customizer Framework and from a tutorial
 * written by Otto Wood.
 *
 * The Kirki Customizer Framework, Copyright Aristeides Stathopoulos (@aristath),
 * is licensed under the terms of the GNU GPL, Version 2 (or later).
 *
 * @link https://github.com/reduxframework/kirki/
 * @link http://ottopress.com/2012/making-a-custom-control-for-the-theme-customizer/
 *
 * @since 1.0.0
 */
class Archetype_Radio_Image_Control extends WP_Customize_Control {

	/**
	 * Declare the control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'radio-image';

	/**
	 * Declare the columns.
	 *
	 * @access public
	 * @var int
	 */
	public $columns = 1;

	/**
	 * Enqueue scripts for the custom control.
	 */
	public function enqueue() {
		wp_enqueue_script( 'jquery-ui-button' );
	}

	/**
	 * Render the control to be displayed in the Customizer.
	 */
	public function render_content() {
		if ( empty( $this->choices ) ) {
			return;
		}

		$name = '_customize-radio-' . $this->id;
		?>
		<span class="customize-control-title">
			<?php echo esc_attr( $this->label ); ?>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>
		</span>
		<div id="input_<?php echo esc_attr( $this->id ); ?>" class="radio-image columns-<?php echo esc_attr( $this->columns ); ?>">
			<?php foreach ( $this->choices as $value => $label ) : ?>
				<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo $this->id . $value; ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
				<label for="<?php echo esc_attr( $this->id ) . esc_attr( $value ); ?>" tabindex="0">
					<img src="<?php echo esc_html( $label ); ?>" alt="<?php echo esc_attr( $value ); ?>" title="<?php echo esc_attr( $value ); ?>">
				</label>
			<?php endforeach; ?>
		</div>
		<?php
	}
}
