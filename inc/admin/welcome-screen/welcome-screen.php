<?php
/**
 * Welcome API.
 *
 * @package Archetype
 * @subpackage Welcome
 * @since 1.0.0
 */

/**
 * Welcome Screen Class
 *
 * Sets up the welcome screen page, hides the menu item
 * and contains the screen content.
 *
 * @since 1.0.0
 */
class Archetype_Welcome {

	/**
	 * Constructor
	 * Sets up the welcome screen
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'archetype_welcome_register_menu' ) );
		add_action( 'load-themes.php', array( $this, 'archetype_activation_admin_notice' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'archetype_welcome_style' ) );

		add_action( 'archetype_welcome', array( $this, 'archetype_welcome_intro' ), 				10 );
		add_action( 'archetype_welcome', array( $this, 'archetype_welcome_tabs' ), 				20 );
		add_action( 'archetype_welcome', array( $this, 'archetype_welcome_get_started' ), 	30 );
		add_action( 'archetype_welcome', array( $this, 'archetype_welcome_addons' ), 				40 );
		add_action( 'archetype_welcome', array( $this, 'archetype_welcome_child_themes' ), 		50 );
		add_action( 'archetype_welcome', array( $this, 'archetype_welcome_who' ), 				60 );

	}

	/**
	 * Adds an admin notice upon successful activation.
	 * @since 1.0.3
	 */
	public function archetype_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) { // Input var okay.
			add_action( 'admin_notices', array( $this, 'archetype_welcome_admin_notice' ), 99 );
		}
	}

	/**
	 * Display an admin notice linking to the welcome screen
	 * @since 1.0.3
	 */
	public function archetype_welcome_admin_notice() {
		?>
			<div class="updated notice is-dismissible">
				<p><?php echo sprintf( esc_html__( 'Thanks for choosing Archetype! You can read hints and tips on how get the most out of your new theme on the %swelcome screen%s.', 'archetype' ), '<a href="' . esc_url( admin_url( 'themes.php?page=archetype-welcome' ) ) . '">', '</a>' ); ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=archetype-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php _e( 'Get started with Archetype', 'archetype' ); ?></a></p>
			</div>
		<?php
	}

	/**
	 * Load welcome screen css
	 * @return void
	 * @since  1.4.4
	 */
	public function archetype_welcome_style() {
		global $archetype_version;

		wp_enqueue_style( 'archetype-welcome-screen', get_template_directory_uri() . ( is_rtl() ? '/inc/admin/css/welcome-rtl.css' : '/inc/admin/css/welcome.css' ), null, $archetype_version );
	}

	/**
	 * Creates the dashboard page
	 * @see  add_theme_page()
	 * @since 1.0.0
	 */
	public function archetype_welcome_register_menu() {
		add_theme_page( 'Archetype', 'Archetype', 'activate_plugins', 'archetype-welcome', array( $this, 'archetype_welcome_screen' ) );
	}

	/**
	 * The welcome screen
	 * @since 1.0.0
	 */
	public function archetype_welcome_screen() {
		require_once( ABSPATH . 'wp-load.php' );
		require_once( ABSPATH . 'wp-admin/admin.php' );
		require_once( ABSPATH . 'wp-admin/admin-header.php' );
		?>
		<div class="wrap about-wrap">

			<?php
			/**
			 * Default hooks.
			 *
			 * @hooked archetype_welcome_intro - 10
			 * @hooked archetype_welcome_get_started - 20
			 * @hooked archetype_welcome_addons - 30
			 * @hooked archetype_welcome_who - 40
			 */
			do_action( 'archetype_welcome' ); ?>

		</div>
		<?php
	}

	/**
	 * Welcome screen intro
	 * @since 1.0.0
	 */
	public function archetype_welcome_intro() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/intro.php' );
	}

	/**
	 * Welcome screen intro
	 * @since 1.4.4
	 */
	public function archetype_welcome_tabs() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/tabs.php' );
	}

	/**
	 * Welcome screen about section
	 * @since 1.0.0
	 */
	public function archetype_welcome_who() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/who.php' );
	}

	/**
	 * Welcome screen get started section
	 * @since 1.0.0
	 */
	public function archetype_welcome_get_started() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/get-started.php' );
	}

	/**
	 * Welcome screen add ons
	 * @since 1.0.0
	 */
	public function archetype_welcome_addons() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/add-ons.php' );
	}

	/**
	 * Welcome screen child themes
	 * @since 1.4.4
	 */
	public function archetype_welcome_child_themes() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/child-themes.php' );
	}
}

$GLOBALS['Archetype_Welcome'] = new Archetype_Welcome();
