<?php
/**
 * Class to create a custom export control
 */
class Archetype_Export_Control extends WP_Customize_Control {
  
  /**
   * Render the content on the theme customizer page
   */
  public function render_content() {
    ?>
    <span class="customize-control-title">
      <?php echo esc_attr( $this->label ); ?>
    </span>
    <span class="description customize-control-description">
      <?php echo esc_attr( $this->description ); ?>
    </span>
    <input type="button" class="button" name="customize-export-button" value="<?php esc_attr_e( 'Export', 'archetype' ); ?>" />
    <?php
  }
}