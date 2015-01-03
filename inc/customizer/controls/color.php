<?php
/**
 * Extends Customize Color Control Class
 *
 * @since 1.0.0
 */
if ( class_exists( 'WP_Customize_Color_Control' ) ) {

  class Archetype_Color_Control extends WP_Customize_Color_Control {

    /**
     * Check user capabilities and theme supports, and then save
     * the value of the setting.
     *
     * @since 1.0.0
     *
     * @return bool False if cap check fails or value isn't set.
     */
    public final function save() {
      $value = $this->post_value();
  
      if ( ! $this->check_capabilities() )
        return false;
  
      /**
       * Fires when the WP_Customize_Setting::save() method is called.
       *
       * The dynamic portion of the hook name, $this->id_data['base'] refers to
       * the base slug of the setting name.
       *
       * @since 1.0.0
       *
       * @param WP_Customize_Setting $this WP_Customize_Setting instance.
       */
      do_action( 'customize_save_' . $this->id_data[ 'base' ], $this );
  
      $this->update( $value );
    }
    
  }
  
}