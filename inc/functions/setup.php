<?php
/**
 * archetype setup functions
 *
 * @package archetype
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
  $content_width = 980; /* pixels */
}

/**
 * Assign the Archetype version to a var
 */
$theme           = wp_get_theme();
$archetype_version   = $theme['Version'];

if ( ! function_exists( 'archetype_setup' ) ) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function archetype_setup() {

    /*
     * Load Localisation files.
     *
     * Note: the first-loaded translation file overrides any following ones if the same translation is present.
     */

    // wp-content/languages/theme-name/it_IT.mo
    load_theme_textdomain( 'archetype', trailingslashit( WP_LANG_DIR ) . 'themes/' );

    // wp-content/themes/child-theme-name/languages/it_IT.mo
    load_theme_textdomain( 'archetype', get_stylesheet_directory() . '/languages' );

    // wp-content/themes/theme-name/languages/it_IT.mo
    load_theme_textdomain( 'archetype', get_template_directory() . '/languages' );

    /**
     * Add default posts and comments RSS feed links to head.
     */
    add_theme_support( 'automatic-feed-links' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus( array(
      'primary'    => __( 'Primary Menu', 'archetype' ),
      'secondary'    => __( 'Secondary Menu', 'archetype' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
      'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ) );

    // Setup the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'archetype_custom_background_args', array(
      'default-color' => apply_filters( 'archetype_default_background_color', '25292c' ),
      'default-image' => '',
    ) ) );

    // Add support for the Site Logo plugin and the site logo functionality in JetPack
    // https://github.com/automattic/site-logo
    // http://jetpack.me/
    add_theme_support( 'site-logo', array( 'size' => 'full' ) );

    // Declare WooCommerce support
    add_theme_support( 'woocommerce' );

    // Declare support for title theme feature
    add_theme_support( 'title-tag' );
  }
endif; // archetype_setup

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function archetype_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Sidebar', 'archetype' ),
    'id'            => 'sidebar-1',
    'description'   => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h1 class="widget-title">',
    'after_title'   => '</h1>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Header', 'archetype' ),
    'id'            => 'header-1',
    'description'   => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h1 class="widget-title">',
    'after_title'   => '</h1>',
  ) );

  $footer_widget_regions = apply_filters( 'archetype_footer_widget_regions', 4 );

  for ( $i = 1; $i <= intval( $footer_widget_regions ); $i++ ) {
    register_sidebar( array(
      'name'         => sprintf( __( 'Footer %d', 'archetype' ), $i ),
      'id'         => sprintf( 'footer-%d', $i ),
      'description'     => sprintf( __( 'Widgetized Footer Region %d.', 'archetype' ), $i ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'     => '</aside>',
      'before_title'     => '<h3>',
      'after_title'     => '</h3>',
      )
    );
  }
}

/**
 * Enqueue scripts and styles.
 * @since  1.0.0
 */
function archetype_scripts() {
  global $archetype_version;

  wp_enqueue_style( 'archetype-style', get_stylesheet_uri(), '', $archetype_version );

  wp_enqueue_script( 'archetype-navigation', get_template_directory_uri() . '/js/navigation.min.js', array(), '20120206', true );

  wp_enqueue_script( 'archetype-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array(), '20130115', true );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}