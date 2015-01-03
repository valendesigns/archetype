<?php
/**
 * Class to create a custom import control
 */
class Archetype_Import_Control extends WP_Customize_Control {
  
  /**
   * Render the content on the theme customizer page
   */
  public function render_content() {
    ?>
    <span class="customize-control-title">
      <?php echo esc_html( $this->label ); ?>
    </span>
    <span class="description customize-control-description">
      <?php echo esc_attr( $this->description ); ?>
    </span>
    <div class="customizer-import-controls">
      <input type="file" name="customizer-import-file" class="customizer-import-file" />
      <label class="customizer-import-images">
        <input type="checkbox" name="customizer-import-images" value="1" /> <?php _e( 'Download and import image files?', 'archetype' ); ?>
      </label>
      <?php wp_nonce_field( 'customizer-importing', 'customizer-import' ); ?>
    </div>
    <div class="customizer-import-uploading"><?php _e( 'Uploading...', 'archetype' ); ?></div>
    <input type="button" class="button" name="customizer-import-button" value="<?php esc_attr_e( 'Import', 'archetype' ); ?>" />
    <?php
  }
}