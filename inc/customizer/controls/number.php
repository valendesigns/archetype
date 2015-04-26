<?php
/**
 * Class to create an input[type=number] Customizer control
 *
 * @since 1.0.0
 */
class Archetype_Number_Customizer_Control extends WP_Customize_Control {
  public $type = 'number';
  
  public function render_content() {
  ?>
    <label>
      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
      <input type="number" <?php $this->link(); ?> value="<?php echo intval( $this->value() ); ?>" />
    </label>
  <?php
  }
  
}