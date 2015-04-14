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
  $content_width = 784; /* pixels */
}

/**
 * Archetype only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) {
  require get_template_directory() . '/inc/functions/back-compat.php';
}

/**
 * Assign the Archetype version to a var
 */
$theme             = wp_get_theme();
$archetype_version = $theme['Version'];

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

    // wp-content/languages/themes/archetype-it_IT.mo
    load_theme_textdomain( 'archetype', trailingslashit( WP_LANG_DIR ) . 'themes/' );

    // wp-content/themes/child-theme-name/languages/it_IT.mo
    load_theme_textdomain( 'archetype', get_stylesheet_directory() . '/languages' );

    // wp-content/themes/archetype/languages/it_IT.mo
    load_theme_textdomain( 'archetype', get_template_directory() . '/languages' );

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus( array(
      'primary'   => __( 'Primary Menu', 'archetype' ),
      'secondary' => __( 'Secondary Menu', 'archetype' ),
      'handheld'  => __( 'Handheld Menu', 'archetype' ),
    ) );
    
    /*
     * Add default posts and comments RSS feed links to head.
     */
    add_theme_support( 'automatic-feed-links' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support( 'post-thumbnails' );
    
    /*
     * Enable support for Post Formats.
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Formats
     */
    add_theme_support( 'post-formats', array( 
      'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' 
    ) );
    
    /*
     * Switch default core markup to output valid HTML5 for search form, comment form, 
     * comments, galleries, captions and widgets.
     */
    add_theme_support( 'html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery', 
      'caption',
      'widgets',
    ) );

    // Setup the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'archetype_custom_background_args', array(
      'default-color' => apply_filters( 'archetype_default_background_color', '25292c' ),
      'default-image' => '',
    ) ) );

    /*
     * Add support for the Site Logo plugin and the site logo functionality in JetPack
     *
     * @link https://github.com/automattic/site-logo
     * @link http://jetpack.me/
     */
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
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Header', 'archetype' ),
    'id'            => 'header-1',
    'description'   => '',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
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
 *
 * @since  1.0.0
 */
function archetype_scripts() {
  global $archetype_version;
  
  wp_enqueue_style( 'archetype-style', get_template_directory_uri() . ( is_rtl() ? '/style-rtl.min.css' : '/style.min.css' ), '', $archetype_version );
  
  wp_enqueue_script( 'archetype', get_template_directory_uri() . '/js/archetype.min.js', array( 'jquery' ), '20150118', true );
  
  wp_enqueue_script( 'archetype-fluid-media', get_template_directory_uri() . '/js/fluid-media.min.js', array( 'jquery' ), '20120206', true );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since 1.0.0
 *
 * @see wp_add_inline_style()
 */
function archetype_post_nav_background() {
  if ( ! is_single() ) {
    return;
  }

  $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
  $next     = get_adjacent_post( false, '', false );
  $css      = '';

  if ( is_attachment() && 'attachment' == $previous->post_type ) {
    return;
  }

  if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
    $prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
    $css .= '
      .post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
      .post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
      .post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
    ';
  }

  if ( $next && has_post_thumbnail( $next->ID ) ) {
    $nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
    $css .= '
      .post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); }
      .post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
      .post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
    ';
  }

  wp_add_inline_style( 'archetype-style', $css );
}
