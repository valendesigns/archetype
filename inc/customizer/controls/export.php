<?php
/**
 * Class to create an export Customizer control
 */
class Archetype_Export_Customizer_Control extends WP_Customize_Control {
  
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

/**
 * Class to create an export widgets control
 */
class Archetype_Export_Widgets_Control extends WP_Customize_Control {
  
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
    <input type="button" class="button" name="widgets-export-button" value="<?php esc_attr_e( 'Export', 'archetype' ); ?>" />
    <?php
  }
}