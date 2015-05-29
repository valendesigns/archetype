<?php
/**
 * Welcome screen getting started template
 *
 * @package Archetype
 * @subpackage Welcome
 * @since 1.0.0
 */

// Get theme customizer url.
$url 	= admin_url() . 'customize.php?';
$url 	.= 'url=' . urlencode( site_url() . '?storefront-customizer=true' );
$url 	.= '&return=' . urlencode( admin_url() . 'themes.php?page=storefront-welcome' );
$url 	.= '&storefront-customizer=true';
?>
<div id="get_started" class="col two-col panel" style="margin-bottom: 1.618em; padding-top: 1.618em; overflow: hidden;">

	<h2><?php _e( 'Using Storefront', 'archetype' ); ?> <div class="dashicons dashicons-lightbulb"></div></h2>
	<p><?php _e( 'We\'ve purposely kept Storefront lean & mean so configuration is a breeze. Here are some common theme-setup tasks:', 'archetype' ); ?></p>

	<div class="col-1">
		<?php if ( ! class_exists( 'WooCommerce' ) ) { ?>
			<h4><?php _e( 'Install WooCommerce' ,'archetype' ); ?></h4>
			<p><?php _e( 'Although Storefront works fine as a standard WordPress theme, it really shines when used for an online store. Install WooCommerce and start selling now.', 'archetype' ); ?></p>

			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' ) ); ?>" class="button button-primary"><?php _e( 'Install WooCommerce', 'archetype' ); ?></a></p>
		<?php } ?>

		<h4><?php _e( 'Configure menu locations' ,'archetype' ); ?></h4>
		<p><?php _e( 'Storefront includes three menu locations for primary, secondary and handheld navigation. The primary navigation is perfect for your key pages like the shop and product categories. The secondary navigation is better suited to lower traffic pages such as terms and conditions. The handheld navigation gives you complete control over what menu items to serve to handheld devices.', 'archetype' ); ?></p>
		<p><a href="<?php echo esc_url( self_admin_url( 'nav-menus.php' ) ); ?>" class="button"><?php _e( 'Configure menus', 'archetype' ); ?></a></p>

		<h4><?php _e( 'Create a color scheme' ,'archetype' ); ?></h4>
		<p><?php _e( 'Using the WordPress Customizer you can tweak Storefront\'s appearance to match your brand.', 'archetype' ); ?></p>
		<p><a href="<?php echo esc_url( $url ); ?>" class="button"><?php _e( 'Open the Customizer', 'archetype' ); ?></a></p>

		<?php if ( ! class_exists( 'Jetpack' ) || ! class_exists( 'Archetype_Site_Logo' ) ) { ?>
			<h4><?php _e( 'Add your logo', 'archetype' ); ?></h4>
			<p><?php echo sprintf( esc_html__( 'Install and activate either %sJetpack%s or the to enable a custom logo option in the Customizer.', 'archetype' ), '<a href="https://wordpress.org/plugins/jetpack/">', '</a>' ); ?></p>
			<p>
				<?php if ( ! class_exists( 'Jetpack' ) ) { ?>
					<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=jetpack' ), 'install-plugin_jetpack' ) ); ?>" class="button button-primary"><?php _e( 'Install Jetpack', 'archetype' ); ?></a>
				<?php } ?>
			</p>
		<?php } ?>
	</div>

	<div class="col-2 last-feature">
		<h4><?php _e( 'Configure homepage template', 'archetype' ); ?></h4>
		<p><?php _e( 'Storefront includes a homepage template that displays a selection of products from your store.', 'archetype' ); ?></p>
		<p><?php echo sprintf( esc_html__( 'To set this up you will need to create a new page and assign the "Homepage" template to it. You can then set that as a static homepage in the %sReading%s settings.', 'archetype' ), '<a href="' . esc_url( self_admin_url( 'options-reading.php' ) ) . '">', '</a>' ); ?></p>
		<p><?php echo sprintf( esc_html__( 'Once set up you can toggle and re-order the homepage components using the %sHomepage Control%s plugin.', 'archetype' ), '<a href="https://wordpress.org/plugins/homepage-control/">', '</a>' ); ?></p>

		<?php if ( ! class_exists( 'Homepage_Control' ) ) { ?>
			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=homepage-control' ), 'install-plugin_homepage-control' ) ); ?>" class="button button-primary"><?php _e( 'Install Homepage Control', 'archetype' ); ?></a></p>
		<?php } ?>

		<h4><?php _e( 'View documentation', 'archetype' ); ?></h4>
		<p><?php _e( 'You can read detailed information on Storefronts features and how to develop on top of it in the documentation.', 'archetype' ); ?></p>
		<p><a href="http://docs.woothemes.com/documentation/themes/storefront/" class="button"><?php _e( 'View documentation &rarr;', 'archetype' ); ?></a></p>
	</div>
</div>
