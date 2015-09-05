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
		 * comments, galleries, captions.
		 */
		add_theme_support( 'html5', array(
			'comment-list',
			'comment-form',
			'search-form',
			'gallery',
			'caption',
		) );

		// Setup the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'archetype_custom_background_args', array(
			'default-color' => apply_filters( 'archetype_default_background_color', 'f1f1f1' ),
			'default-image' => '',
		) ) );

		// Declare WooCommerce support.
		add_theme_support( 'woocommerce' );

		// Declare support for title theme feature.
		if ( 0 === did_action( 'wp_loaded' ) ) {
			add_theme_support( 'title-tag' );
		}

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

	register_sidebar( array(
		'name'           => __( 'Header', 'archetype' ),
		'id'             => 'header-1',
		'description'    => __( 'Widgetized Header Region.', 'archetype' ),
		'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'   => '</aside>',
		'before_title'   => '<h3 class="widget-title">',
		'after_title'    => '</h3>',
		)
	);

	/** This filter is documented in inc/structure/homepage.php */
	$widgets = apply_filters( 'archetype_homepage_widgets', 5 );

	for ( $id = 1; $id <= absint( $widgets ); $id++ ) {
		register_sidebar( array(
			'name'           => sprintf( __( 'Homepage %d', 'archetype' ), $id ),
			'id'             => sprintf( 'homepage-%d', $id ),
			'description'    => sprintf( __( 'Widgetized Homepage Content Region %d.', 'archetype' ), $id ),
			'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'   => '</aside>',
			'before_title'   => '<h3 class="widget-title">',
			'after_title'    => '</h3>',
			)
		);
	}

	register_sidebar( array(
		'name'           => __( 'Footer', 'archetype' ),
		'id'             => 'footer-1',
		'description'    => __( 'Widgetized Footer Region.', 'archetype' ),
		'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'   => '</aside>',
		'before_title'   => '<h3 class="widget-title">',
		'after_title'    => '</h3>',
		)
	);
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

	wp_localize_script( 'archetype', 'Archetypel10n', array(
		'prev' => __( 'Previous', 'archetype' ),
		'next' => __( 'Next', 'archetype' ),
	) );

	wp_enqueue_script( 'archetype-fluid-media', get_template_directory_uri() . '/js/fluid-media.min.js', array( 'jquery' ), '1.0.0', true );

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

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since 1.0.0
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function archetype_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @since 1.0.0
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function archetype_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-wc-breadcrumb when WooCommerce isn't activated or has been filtered off.
	if ( ! function_exists( 'woocommerce_breadcrumb' ) || false === archetype_sanitize_checkbox( get_theme_mod( 'archetype_breadcrumb_toggle', true ) ) ) {
		$classes[]	= 'no-wc-breadcrumb';
	}

	/** This filter is documented in sidebar.php */
	$id = apply_filters( 'archetype_sidebar_widget_region_id', 'sidebar-1' );

	// Add full width on 404 or inactive sidebar.
	if ( is_404() || ! is_active_sidebar( $id ) ) {
		$classes[] = 'archetype-full-width-content';
	}

	// Active header widgets.
	if ( is_active_sidebar( 'header-1' ) ) {
		$classes[] = 'archetype-has-header-widgets';
	}

	/**
	 * What is this?!
	 *
	 * Take the blue pill, close this file and forget you saw the following code.
	 * Or take the red pill, filter `archetype_make_me_cute` and see how deep the rabbit hole goes...
	 *
	 * @since 1.0.0
	 */
	$cute = apply_filters( 'archetype_make_me_cute', false );
	if ( true === $cute ) {
		$classes[] = 'archetype-cute';
	}

	// 4 out of 12 columns.
	if ( 4 == get_theme_mod( 'archetype_columns', apply_filters( 'archetype_default_columns', '3' ) ) ) {
		$classes[] = 'grid-alt';
	}

	// Full width.
	if ( true === archetype_sanitize_checkbox( get_theme_mod( 'archetype_full_width', apply_filters( 'archetype_default_full_width', false ) ) ) ) {
		$classes[] = 'is-full-width';
	}

	// Boxed.
	if ( true === archetype_sanitize_checkbox( get_theme_mod( 'archetype_boxed', apply_filters( 'archetype_default_boxed', false ) ) ) ) {
		$classes[] = 'is-boxed';
	}

	// Padding.
	if ( true === archetype_sanitize_checkbox( get_theme_mod( 'archetype_padded', apply_filters( 'archetype_default_padded', true ) ) ) ) {
		$classes[] = 'is-padded';
	}

	return $classes;
}
