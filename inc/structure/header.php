<?php
/**
 * Template functions used for the site header.
 *
 * @package archetype
 */

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function archetype_wp_title( $title, $sep ) {
  if ( is_feed() ) {
    return $title;
  }

  global $page, $paged;

  // Add the blog name
  $title .= get_bloginfo( 'name', 'display' );

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= " $sep $site_description";
  }

  // Add a page number if necessary:
  if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
    $title .= " $sep " . sprintf( __( 'Page %s', 'archetype' ), max( $paged, $page ) );
  }

  return $title;
}

if ( ! function_exists( 'archetype_header_widget_region' ) ) {
  /**
   * Display header widget region
   * @since  1.0.0
   */
  function archetype_header_widget_region() {
    ?>
    <div class="header-widget-region">
      <div class="col-full">
        <?php dynamic_sidebar( 'header-1' ); ?>
      </div>
    </div>
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
    <nav id="site-navigation" class="main-navigation" role="navigation">
      <button class="menu-toggle"><?php _e( 'Primary Menu', 'archetype' ); ?></button>
      <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
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
    <nav class="secondary-navigation" role="navigation">
      <?php wp_nav_menu( array( 'theme_location' => 'secondary', 'fallback_cb' => '' ) ); ?>
    </nav><!-- #site-navigation -->
    <?php
  }
}