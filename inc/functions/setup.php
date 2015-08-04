<?php
/**
 * Archetype setup functions
 *
 * @package Archetype
 * @subpackage Functions
 * @since 1.0.0
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
$theme = wp_get_theme();
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

		// Global languages path - wp-content/languages/themes/archetype-it_IT.mo.
		load_theme_textdomain( 'archetype', trailingslashit( WP_LANG_DIR ) . 'themes/' );

		// Child theme languages path - wp-content/themes/child-theme-name/languages/it_IT.mo.
		load_theme_textdomain( 'archetype', get_stylesheet_directory() . '/languages' );

		// Parent theme languages path - wp-content/themes/archetype/languages/it_IT.mo.
		load_theme_textdomain( 'archetype', get_template_directory() . '/languages' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary'    => __( 'Primary Menu', 'archetype' ),
			'secondary'  => __( 'Secondary Menu', 'archetype' ),
			'handheld'   => __( 'Handheld Menu', 'archetype' ),
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
			'aside',
			'gallery',
			'link',
			'image',
			'quote',
			'status',
			'video',
			'audio',
			'chat',
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
			'default-color' => apply_filters( 'archetype_default_background_color', 'f1f1f1' ),
			'default-image' => '',
		) ) );

		/*
		 * Add support for the site logo functionality in JetPack
		 *
		 * @link http://jetpack.me/
		 */
		add_theme_support( 'site-logo', array( 'size' => 'full' ) );

		// Declare WooCommerce support.
		add_theme_support( 'woocommerce' );

		// Declare support for title theme feature.
		add_theme_support( 'title-tag' );

	}
endif;

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

	/**
	 * Filter the number of registered header widget regions.
	 *
	 * There is built-in support for up to 4 widget regions.
	 *
	 * @since 1.0.0
	 *
	 * @param int $header_widget_regions The number of widget regions. Default is '4'.
	 */
	$header_widget_regions = apply_filters( 'archetype_header_widget_regions', 4 );

	for ( $i = 1; $i <= intval( $header_widget_regions ); $i++ ) {
		register_sidebar( array(
			'name'           => sprintf( __( 'Header %d', 'archetype' ), $i ),
			'id'             => sprintf( 'header-%d', $i ),
			'description'    => sprintf( __( 'Widgetized Header Region %d.', 'archetype' ), $i ),
			'before_widget'  => '<section id="%1$s" class="widget %2$s">',
			'after_widget'   => '</section>',
			'before_title'   => '<h3 class="widget-title">',
			'after_title'    => '</h3>',
			)
		);
	}

	/**
	 * Filter the number of registered footer widget regions.
	 *
	 * There is built-in support for up to 4 widget regions.
	 *
	 * @since 1.0.0
	 *
	 * @param int $footer_widget_regions The number of widget regions. Default is '4'.
	 */
	$footer_widget_regions = apply_filters( 'archetype_footer_widget_regions', 4 );

	for ( $i = 1; $i <= intval( $footer_widget_regions ); $i++ ) {
		register_sidebar( array(
			'name'           => sprintf( __( 'Footer %d', 'archetype' ), $i ),
			'id'             => sprintf( 'footer-%d', $i ),
			'description'    => sprintf( __( 'Widgetized Footer Region %d.', 'archetype' ), $i ),
			'before_widget'  => '<section id="%1$s" class="widget %2$s">',
			'after_widget'   => '</section>',
			'before_title'   => '<h3 class="widget-title">',
			'after_title'    => '</h3>',
			)
		);
	}
}

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function archetype_scripts() {
	global $archetype_version;

	wp_enqueue_script( 'archetype-modernizr', get_template_directory_uri() . '/js/modernizr.min.js', null, '2.8.3', false );

	// We have our own.
	wp_dequeue_style( 'subscribe-and-connect' );

	// Load JetPack CSS one-off & deregister individually.
	add_filter( 'jetpack_implode_frontend_css', '__return_false' );
	wp_deregister_style( 'grunion.css' );

	wp_enqueue_style( 'archetype-style', get_template_directory_uri() . ( is_rtl() ? '/style-rtl.min.css' : '/style.min.css' ), '', $archetype_version );

	wp_enqueue_script( 'archetype-bxslider', get_template_directory_uri() . '/js/bxslider.min.js', array( 'jquery' ), '3.2', true );

	wp_enqueue_script( 'archetype', get_template_directory_uri() . '/js/archetype.min.js', array( 'jquery', 'archetype-bxslider' ), $archetype_version, true );

	wp_localize_script( 'archetype', '_archetype', array(
		'prev' => __( 'Previous', 'archetype' ),
		'next' => __( 'Next', 'archetype' ),
	) );

	wp_enqueue_script( 'archetype-fluid-media', get_template_directory_uri() . '/js/fluid-media.min.js', array( 'jquery' ), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/**
 * Denqueue Subscribe & Connecrt styles in the footer.
 *
 * @since 1.0.0
 */
function archetype_dequeue_footer_scripts() {
	if ( is_subscribe_and_connect_activated() ) {
		global $subscribe_and_connect;
		remove_action( 'wp_footer', array( $subscribe_and_connect->context, 'maybe_load_theme_stylesheets' ), 10 );
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

	$previous  = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next      = get_adjacent_post( false, '', false );
	$css       = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	$prev_gal = $previous ? has_post_format( 'gallery', $previous->ID ) : false;
	$next_gal = $next ? has_post_format( 'gallery', $next->ID ) : false;

	if ( $previous && ( has_post_thumbnail( $previous->ID ) || $prev_gal ) ) {
		if ( $prev_gal && $ids = archetype_post_format_gallery_images( $previous->ID ) ) {
			$prevthumb = wp_get_attachment_image_src( $ids[0], 'post-thumbnail' );
		} else if ( ! $prev_gal ) {
			$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		}
		if ( isset( $prevthumb[0] ) ) {
			$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
			.post-navigation .nav-previous a { padding-left: 1em; padding-right: 1em; }';
		}
	}

	if ( $next && ( has_post_thumbnail( $next->ID ) || $next_gal ) ) {
		if ( $next_gal && $ids = archetype_post_format_gallery_images( $next->ID ) ) {
			$nextthumb = wp_get_attachment_image_src( $ids[0], 'post-thumbnail' );
		} else if ( ! $next_gal ) {
			$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		}
		if ( isset( $nextthumb[0] ) ) {
			$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
			.post-navigation .nav-next a { padding-left: 1em; padding-right: 1em; }';
		}
	}

	wp_add_inline_style( 'archetype-style', $css );
}
