<?php
/**
 * Welcome classes.
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

		add_action( 'archetype_welcome', array( $this, 'archetype_welcome_intro' ), 10 );
		add_action( 'archetype_welcome', array( $this, 'archetype_welcome_getting_started' ), 	20 );
		add_action( 'archetype_welcome', array( $this, 'archetype_welcome_addons' ), 				30 );
		add_action( 'archetype_welcome', array( $this, 'archetype_welcome_who' ), 				40 );

	} // end constructor

	/**
	 * Adds an admin notice upon successful activation.
	 *
	 * @since 1.0.0
	 */
	public function archetype_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) { // Input var okay.
			add_action( 'admin_notices', array( $this, 'archetype_welcome_admin_notice' ), 99 );
		}
	}

	/**
	 * Display an admin notice linking to the welcome screen
	 *
	 * @since 1.0.0
	 */
	public function archetype_welcome_admin_notice() {
		?>
			<div class="updated fade">
				<p><?php echo sprintf( esc_html__( 'Thanks for choosing Archetype! You can read hints and tips on how get the most out of your new theme on the %swelcome screen%s.', 'archetype' ), '<a href="' . esc_url( admin_url( 'themes.php?page=archetype-welcome' ) ) . '">', '</a>' ); ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=archetype-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php _e( 'Get started with Archetype', 'archetype' ); ?></a></p>
			</div>
		<?php
	}

	/**
	 * Creates the dashboard page
	 *
	 * @see	add_theme_page()
	 *
	 * @since 1.0.0
	 */
	public function archetype_welcome_register_menu() {
		add_theme_page( 'Archetype', 'Archetype', 'read', 'archetype-welcome', array( $this, 'archetype_welcome_screen' ) );
	}

	/**
	 * The welcome screen
	 *
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
			 * Default hooks
			 *
			 * @hooked archetype_welcome_intro - 10
			 * @hooked archetype_welcome_getting_started - 20
			 * @hooked archetype_welcome_addons - 30
			 * @hooked archetype_welcome_who - 40
			 */
			do_action( 'archetype_welcome' ); ?>

		</div>
		<?php
	}

	/**
	 * Welcome screen intro
	 *
	 * @since 1.0.0
	 */
	public function archetype_welcome_intro() {
		$archetype = wp_get_theme( 'archetype' );

		?>
		<div class="feature-section col two-col" style="margin-bottom: 1.618em; padding-top: 1.618em; overflow: hidden;">
			<div class="col-1">
				<h1 style="margin-right: 0;"><?php echo '<strong>Archetype</strong> <sup style="font-weight: bold; font-size: 50%; padding: 5px 10px; color: #666; background: #fff;">' . esc_attr( $archetype['Version'] ) . '</sup>'; ?></h1>

				<p style="font-size: 1.2em;"><?php _e( 'Awesome! You\'ve decided to use Archetype to enrich your WooCommerce store design.', 'archetype' ); ?></p>
				<p><?php _e( 'Whether you\'re a store owner, WordPress developer, or both - we hope you enjoy Archetype\'s deep integration with WooCommerce core (including several popular WooCommerce extensions), plus the flexible design and extensible codebase that this theme provides.', 'archetype' ); ?>
			</div>

			<div class="col-2 last-feature">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" class="image-50" width="440" />
			</div>
		</div>

		<hr />
		<?php
	}

	/**
	 * Welcome screen about section
	 *
	 * @since 1.0.0
	 */
	public function archetype_welcome_who() {
		?>
		<div class="feature-section col three-col" style="margin-bottom: 1.618em; padding-top: 1.618em; overflow: hidden;">
			<div class="col-1">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/woothemes.png'; ?>" class="image-50" width="440" />
				<h4><?php _e( 'Who are WooThemes?', 'archetype' ); ?></h4>
				<p><?php _e( 'WooCommerce creators WooThemes is an international team of WordPress superstars building products for a passionate community of hundreds of thousands of users.', 'archetype' ); ?></p>
				<p><a href="http://woothemes.com" class="button"><?php _e( 'Visit WooThemes', 'archetype' ); ?></a></p>
			</div>

			<?php if ( ! class_exists( 'WooCommerce' ) ) { ?>

			<div class="col-2">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/woocommerce.png'; ?>" class="image-50" width="440" />
				<h4><?php _e( 'What is WooCommerce?', 'archetype' ); ?></h4>
				<p><?php _e( 'WooCommerce is the most popular WordPress eCommerce plugin. Packed full of intuitive features and surrounded by a thriving community - it\'s the perfect solution for building an online store with WordPress.', 'archetype' ); ?></p>
				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' ) ); ?>" class="button button-primary"><?php _e( 'Download & Install WooCommerce', 'archetype' ); ?></a></p>
				<p><a href="http://docs.woothemes.com/documentation/plugins/woocommerce/" class="button"><?php _e( 'View WooCommerce Documentation', 'archetype' ); ?></a></p>
			</div>

			<?php } ?>

			<div class="col-3 last-feature">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/github.png'; ?>" class="image-50" width="440" />
				<h4><?php _e( 'Can I Contribute?', 'archetype' ); ?></h4>
				<p><?php _e( 'Found a bug? Want to contribute a patch or create a new feature? GitHub is the place to go! Or would you like to translate Archetype in to your language? Get involved at Transifex.', 'archetype' ); ?></p>
				<p><a href="http://github.com/valendesigns/archetype/" class="button"><?php _e( 'Archetype at GitHub', 'archetype' ); ?></a> <a href="https://www.transifex.com/projects/p/archetype/" class="button"><?php _e( 'Archetype at Transifex', 'archetype' ); ?></a></p>
			</div>
		</div>

		<hr style="clear: both;">
		<?php
	}

	/**
	 * Welcome screen getting started section
	 *
	 * @since 1.0.0
	 */
	public function archetype_welcome_getting_started() {
		// Get theme customizer url.
		$url  = admin_url() . 'customize.php?';
		$url .= '&return=' . urlencode( admin_url() . 'themes.php?page=archetype-welcome' );
		?>
		<div class="feature-section col two-col" style="margin-bottom: 1.618em; padding-top: 1.618em; overflow: hidden;">

			<h2><?php _e( 'Using Archetype', 'archetype' ); ?> <div class="dashicons dashicons-lightbulb"></div></h2>
			<p><?php _e( 'We\'ve purposely kept Archetype lean & mean so configuration is a breeze. Here are some common theme-setup tasks:', 'archetype' ); ?></p>

			<div class="col-1">
				<?php if ( ! class_exists( 'WooCommerce' ) ) { ?>
					<h4><?php _e( 'Install WooCommerce' ,'archetype' ); ?></h4>
					<p><?php _e( 'Although Archetype works fine as a standard WordPress theme, it really shines when used for an online store. Install WooCommerce and start selling now.', 'archetype' ); ?></p>

					<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' ) ); ?>" class="button"><?php _e( 'Install WooCommerce', 'archetype' ); ?></a></p>
				<?php } ?>

				<h4><?php _e( 'Configure menu locations' ,'archetype' ); ?></h4>
				<p><?php _e( 'Archetype includes two menu locations for primary and secondary navigation. The primary navigation is perfect for your key pages like the shop and product categories. The secondary navigation is better suited to lower traffic pages such as terms and conditions.', 'archetype' ); ?></p>
				<p><a href="<?php echo esc_url( self_admin_url( 'nav-menus.php' ) ); ?>" class="button"><?php _e( 'Configure menus', 'archetype' ); ?></a></p>

				<h4><?php _e( 'Create a color scheme' ,'archetype' ); ?></h4>
				<p><?php _e( 'Using the WordPress Customizer you can tweak Archetype\'s appearance to match your brand.', 'archetype' ); ?></p>
				<p><a href="<?php echo esc_url( $url ); ?>" class="button"><?php _e( 'Open the Customizer', 'archetype' ); ?></a></p>
			</div>

			<div class="col-2 last-feature">
				<h4><?php _e( 'Configure homepage template', 'archetype' ); ?></h4>
				<p><?php _e( 'Archetype includes a homepage template that displays a selection of products from your store.', 'archetype' ); ?></p>
				<p><?php echo sprintf( esc_html__( 'To set this up you will need to create a new page and assign the "Homepage" template to it. You can then set that as a static homepage in the %sReading%s settings.', 'archetype' ), '<a href="' . esc_url( self_admin_url( 'options-reading.php' ) ) . '">', '</a>' ); ?></p>
				<p><?php echo sprintf( esc_html__( 'Once set up you can toggle and re-order the homepage components using the %sHomepage Control%s plugin.', 'archetype' ), '<a href="https://wordpress.org/plugins/homepage-control/">', '</a>' ); ?></p>

				<h4><?php _e( 'Add your logo', 'archetype' ); ?></h4>
				<p><?php echo sprintf( esc_html__( 'Activate %sJetpack%s to enable a custom logo option in the Customizer.', 'archetype' ), '<a href="https://wordpress.org/plugins/jetpack/">', '</a>' ); ?></p>

				<h4><?php _e( 'View documentation', 'archetype' ); ?></h4>
				<p><?php _e( 'You can read detailed information on Archetypes features and how to develop on top of it in the documentation.', 'archetype' ); ?></p>
				<p><a href="http://docs.woothemes.com/documentation/themes/archetype/" class="button"><?php _e( 'View documentation', 'archetype' ); ?></a></p>
			</div>

		</div>

		<hr style="clear: both;">
		<?php
	}

	/**
	 * Welcome screen add ons
	 *
	 * @since 1.0.0
	 */
	public function archetype_welcome_addons() {
		?>
		<div class="feature-section col three-col" style="padding-top: 1.618em; clear: both;">
			<h2><?php _e( 'Enhance your site', 'archetype' ); ?> <div class="dashicons dashicons-admin-plugins"></div></h2>

			<p>
				<?php _e( 'Below you will find a selection of hand-picked WooCommerce and Archetype extensions that could help improve your online store. Each WooCommerce extension integrates seamlessly with Archetype for enhanced performance.', 'archetype' ); ?>
			</p>

			<div class="col-1">
				<h4><?php _e( 'WooCommerce Extensions', 'archetype' ); ?></h4>
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/bookings.png'; ?>" class="image-50" width="440" />
				<h4><?php _e( 'WooCommerce Bookings', 'archetype' ); ?></h4>
				<p><?php _e( 'Allows you to sell your time or date based bookings, adding a new product type to your WooCommerce site. Perfect for those wanting to offer appointments, services or rentals.', 'archetype' ); ?></p>
				<p style="margin-bottom: 2.618em;"><a href="http://www.woothemes.com/products/woocommerce-bookings/" class="button"><?php _e( 'Buy now', 'archetype' ); ?></a></p>

				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/gallery-slider.png'; ?>" class="image-50" width="440" />
				<h4><?php _e( 'WooCommerce Product Gallery Slider', 'archetype' ); ?></h4>
				<p><?php _e( 'The Product Gallery Slider is a nifty extension which transforms your product galleries into a fully responsive, jQuery powered slideshow.', 'archetype' ); ?></p>
				<p style="margin-bottom: 2.618em;"><a href="http://www.woothemes.com/products/product-gallery-slider/" class="button"><?php _e( 'Buy now', 'archetype' ); ?></a></p>

				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/wishlists.png'; ?>" class="image-50" width="440" />
				<h4><?php _e( 'WooCommerce Wishlists', 'archetype' ); ?></h4>
				<p><?php _e( 'Allows you to sell your time or date based bookings, adding a new product type to your WooCommerce site. Perfect for those wanting to offer appointments, services or rentals.', 'archetype' ); ?></p>
				<p style="margin-bottom: 2.618em;"><a href="http://www.woothemes.com/products/woocommerce-wishlists/" class="button"><?php _e( 'Buy now', 'archetype' ); ?></a></p>

			</div>

			<div class="col-2">
				<h4><?php _e( 'Archetype Extensions', 'archetype' ); ?></h4>
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/designer.jpg'; ?>" class="image-50" width="440" />
				<h4><?php _e( 'Archetype Designer', 'archetype' ); ?></h4>
				<p><?php _e( 'Adds a bunch of additional appearance settings allowing you to further tweak and perfect your Archetype design by changing the header layout, button styles, typographical schemes/scales and more.', 'archetype' ); ?></p>
				<p style="margin-bottom: 2.618em;"><a href="https://www.woothemes.com/products/archetype-designer/" class="button"><?php _e( 'Buy now', 'archetype' ); ?></a></p>

				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/wc-customiser.png'; ?>" class="image-50" width="440" />
				<h4><?php _e( 'Archetype WooCommerce Customiser', 'archetype' ); ?></h4>
				<p><?php _e( 'Gives you further control over the look and feel of your shop. Change the product archive and single layouts, toggle various shop components, enable a distraction free checkout design and more.', 'archetype' ); ?></p>
				<p style="margin-bottom: 2.618em;"><a href="https://www.woothemes.com/products/archetype-woocommerce-customizer/" class="button"><?php _e( 'Buy now', 'archetype' ); ?></a></p>

				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/hero.png'; ?>" class="image-50" width="440" />
				<h4><?php _e( 'Archetype Parallax Hero', 'archetype' ); ?></h4>
				<p><?php _e( 'Adds a parallax hero component to your homepage. Easily change the colors / copy and give your visitors a warm welcome!', 'archetype' ); ?></p>
				<p style="margin-bottom: 2.618em;"><a href="https://www.woothemes.com/products/archetype-parallax-hero/" class="button"><?php _e( 'Buy now', 'archetype' ); ?></a></p>

			</div>

			<div class="col-3 last-feature">
				<h4><?php _e( 'Can\'t find a feature?', 'archetype' ); ?></h4>
				<p><?php echo sprintf( esc_html__( 'Please suggest and vote on ideas / feature requests at the %sArchetype Ideasboard%s. The most popular ideas will see prioritised development.', 'archetype' ), '<a href="http://ideas.woothemes.com/forums/275029-archetype">', '</a>' ); ?></p>
			</div>

		</div>

		<hr style="clear: both;" />

		<p style="font-size: 1.2em; margin: 2.618em 0;">
			<?php echo sprintf( esc_html__( 'There are literally hundreds of awesome extensions available for you to use. Looking for Table Rate Shipping? Subscriptions? Product Add-ons? You can find these and more in the WooCommerce extension shop. %sGo shopping%s.', 'archetype' ), '<a href="http://www.woothemes.com/product-category/woocommerce-extensions/">', '</a>'	); ?>
		</p>

		<hr style="clear: both;" />
		<?php
	}
}

$GLOBALS['Archetype_Welcome'] = new Archetype_Welcome();
