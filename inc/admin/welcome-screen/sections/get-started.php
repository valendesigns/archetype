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
$url 	.= '&return=' . urlencode( admin_url() . 'themes.php?page=archetype-welcome' );
?>
<div id="get_started" class="col two-col panel" style="margin-bottom: 1.618em; padding-top: 1.618em; overflow: hidden;">

	<h2><?php _e( 'Using Archetype', 'archetype' ); ?> <div class="dashicons dashicons-heart" style="margin-top: .25em;"></div></h2>
	<p><?php _e( 'To keep the simplicity alive, here\'s some common theme tasks.', 'archetype' ); ?></p>

	<div class="col-1">
		<h4><?php _e( 'WooCommerce' ,'archetype' ); ?></h4>
		<p><?php _e( 'Looking to include a online store for your project? Then WooCommerce is your first stop.', 'archetype' ); ?></p>
		<?php if ( ! class_exists( 'WooCommerce' ) ) { ?>
			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' ) ); ?>" class="button button-primary"><?php _e( 'Install WooCommerce', 'archetype' ); ?></a></p>
		<?php } ?>

		<h4><?php _e( 'Jetpack', 'archetype' ); ?></h4>
		<p><?php echo sprintf( esc_html__( 'Looking to add a custom logo? Install and activate %sJetpack%s. Archetype also supports the infinite scroll feature that comes with Jetpack.', 'archetype' ), '<a href="https://wordpress.org/plugins/jetpack/">', '</a>' ); ?></p>
		<?php if ( ! class_exists( 'Jetpack' ) ) { ?>
			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=jetpack' ), 'install-plugin_jetpack' ) ); ?>" class="button button-primary"><?php _e( 'Install JetPack', 'archetype' ); ?></a></p>
		<?php } ?>

		<h4><?php _e( 'Menu configuration' ,'archetype' ); ?></h4>
		<p><?php _e( 'Archetype includes three menu options used for navigating your web site. The Primary menu is used for your more commonly visited pages. The Secondary menu is used for pages you expect to see less traffic. The Handheld menu is used to select the pages you wish users to see when visiting your site on a handheld device.', 'archetype' ); ?></p>
		<p><a href="<?php echo esc_url( self_admin_url( 'nav-menus.php' ) ); ?>" class="button"><?php _e( 'Configure', 'archetype' ); ?></a></p>

		<h4><?php _e( 'Customizer' ,'archetype' ); ?></h4>
		<p><?php _e( 'Not a CSS or HTML guru? Not a Problem.  Archetype\'s customizer provides effortless tact to match the color scheme and layout to your brand. Point, click, and admire.', 'archetype' ); ?></p>
		<p><a href="<?php echo esc_url( $url ); ?>" class="button"><?php _e( 'Customize', 'archetype' ); ?></a></p>
	</div>

	<div class="col-2 last-feature">
		<h4><?php _e( 'OptionTree', 'archetype' ); ?></h4>
		<p><?php echo sprintf( esc_html__( 'Install and activate %sOptionTree%s to add meta box functionality which extends the post formats on your blog for a more custom appearance. This integration also gives you the ability to hide post & page titles, as well as, author descriptions on a per-post basis.', 'archetype' ), '<a href="https://wordpress.org/plugins/option-tree/">', '</a>' ); ?></p>
		<p><?php echo esc_html__( 'Since we built OptionTree too, you can rest easy knowing it will always be compatible with Archetype.', 'archetype' ); ?></p>
		<?php if ( ! class_exists( 'OT_Loader' ) ) { ?>
			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=option-tree' ), 'install-plugin_option-tree' ) ); ?>" class="button button-primary"><?php _e( 'Install OptionTree', 'archetype' ); ?></a></p>
		<?php } ?>

		<h4><?php _e( 'Homepage Control', 'archetype' ); ?></h4>
		<p><?php _e( 'This is a fantastic tool for ordering content on the homepage of your site.', 'archetype' ); ?></p>
		<p><?php echo sprintf( esc_html__( 'Assign the "Homepage" template to a new or existing page. Then set that as a static homepage in the Reading settings.', 'archetype' ), '<a href="' . esc_url( self_admin_url( 'options-reading.php' ) ) . '">', '</a>' ); ?></p>
		<p><?php echo sprintf( esc_html__( 'Once Homepage Control is installed and activated, you can arrange content components in the order you see fit. This can be done from within the customizer.', 'archetype' ), '<a href="https://wordpress.org/plugins/homepage-control/">', '</a>' ); ?></p>

		<?php if ( ! class_exists( 'Homepage_Control' ) ) { ?>
			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=homepage-control' ), 'install-plugin_homepage-control' ) ); ?>" class="button button-primary"><?php _e( 'Install Homepage Control', 'archetype' ); ?></a></p>
		<?php } ?>

		<h4><?php _e( 'Subscribe & Connect', 'archetype' ); ?></h4>
		<p><?php _e( 'Help your visitors subscribe to your content, as well as share it across various social networks by adding subscribe icon links to the header and footer of your website.', 'archetype' ); ?></p>

		<?php if ( ! is_plugin_active( 'subscribe-and-connect/subscribe-and-connect.php' ) ) { ?>
			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=subscribe-and-connect' ), 'install-plugin_subscribe-and-connect' ) ); ?>" class="button button-primary"><?php _e( 'Install Subscribe & Connect', 'archetype' ); ?></a></p>
		<?php } ?>
	</div>
</div>
