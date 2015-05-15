<?php
/**
 * Template functions used for the site header.
 *
 * @package archetype
 */

if ( ! function_exists( 'archetype_header_widget_region' ) ) {
  /**
   * Display header widget region
   * @since  1.0.0
   */
  function archetype_header_widget_region() {
    ?>
    <aside class="header-widget-region col-full" role="complementary">
      <?php dynamic_sidebar( 'header-1' ); ?>
    </aside>
    <?php
  }
}

if ( ! function_exists( 'archetype_site_branding' ) ) {
  /**
   * Display Site Branding
   * @since  1.0.0
   * @return void
   */
  function archetype_site_branding() {
    if ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
      jetpack_the_site_logo();
    } else { ?>
      <div class="site-branding">
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <p class="site-description"><?php bloginfo( 'description' ); ?></p>
      </div>
    <?php }
  }
}

if ( ! function_exists( 'archetype_primary_navigation' ) ) {
  /**
   * Display Primary Navigation
   * @since  1.0.0
   * @return void
   */
  function archetype_primary_navigation() {
    ?>
    <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php _e( 'Primary Navigation', 'archetype' ); ?>">
      <button class="menu-toggle"><?php echo esc_attr( apply_filters( 'archetype_menu_toggle_text', __( 'Navigation', 'archetype' ) ) ); ?></button>
      <?php
      do_action( 'archetype_primary_navigation' );
      
      wp_nav_menu(
        array(
          'theme_location'  => 'primary',
          'container_class' => 'primary-navigation',
        )
      );
      wp_nav_menu(
        array(
          'theme_location'  => 'handheld',
          'container_class' => 'handheld-navigation',
        )
      );
      ?>
    </nav><!-- #site-navigation -->
    <?php
  }
}

if ( ! function_exists( 'archetype_secondary_navigation' ) ) {
  /**
   * Display Secondary Navigation
   * @since  1.0.0
   * @return void
   */
  function archetype_secondary_navigation() {
    ?>
    <nav class="secondary-navigation" role="navigation" aria-label="<?php _e( 'Secondary Navigation', 'archetype' ); ?>">
      <?php
      do_action( 'archetype_secondary_navigation' );

      wp_nav_menu(
        array(
          'theme_location' => 'secondary',
          'fallback_cb'    => '',
        )
      );
      ?>
    </nav><!-- #site-navigation -->
    <?php
  }
}

if ( ! function_exists( 'archetype_skip_links' ) ) {
  /**
   * Skip links
   * @since  1.0.0
   * @return void
   */
  function archetype_skip_links() {
    ?>
    <a class="skip-link screen-reader-text" href="#site-navigation"><?php _e( 'Skip to navigation', 'archetype' ); ?></a>
    <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'archetype' ); ?></a>
    <?php
  }
}