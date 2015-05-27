<?php
/**
 * Class to create a Customizer import control
 */
class Archetype_Import_Customizer_Control extends WP_Customize_Control {
	
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
		<div class="customize-import-controls">
			<input type="file" name="customize-import-file" class="customize-import-file" />
			<label class="customize-import-images">
				<input type="checkbox" name="customize-import-images" value="1" /> <?php _e( 'Download and import image files?', 'archetype' ); ?>
			</label>
			<?php wp_nonce_field( 'customize-importing', 'customize-import' ); ?>
		</div>
		<div class="customize-import-uploading"><?php _e( 'Uploading...', 'archetype' ); ?></div>
		<input type="button" class="button" name="customize-import-button" value="<?php esc_attr_e( 'Import', 'archetype' ); ?>" />
		<?php
	}
}