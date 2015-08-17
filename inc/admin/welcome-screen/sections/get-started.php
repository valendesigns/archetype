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
<div id="get_started" class="panel" style="padding-top: 1.618em; clear: both;">
	<div class="two-col" style="margin-bottom: 1.618em; overflow: hidden;">
		<h2><?php esc_html_e( 'Using Archetype', 'archetype' ); ?> <div class="dashicons dashicons-heart" style="margin-top: .25em;"></div></h2>
		<div class="col">
			<h4><?php esc_html_e( 'Customizer' ,'archetype' ); ?></h4>
			<p><?php esc_html_e( 'Not a web developement guru? Not a Problem.  Archetype\'s Customizer integration allows you to effortlessly match the color scheme and layout of your brand. Point, click, and admire.', 'archetype' ); ?></p>
			<p><a href="<?php echo esc_url( $url ); ?>" class="button"><?php esc_html_e( 'Customize', 'archetype' ); ?></a></p>

			<h4><?php esc_html_e( 'WooCommerce' ,'archetype' ); ?></h4>
			<p><?php esc_html_e( 'Looking to include a online store? Then WooCommerce is your first stop. It\'s the most popular WordPress eCommerce plugin, which is packed full of intuitive features and a thriving community.', 'archetype' ); ?></p>
			
			<?php if ( ! class_exists( 'WooCommerce' ) ) { ?>
				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install WooCommerce', 'archetype' ); ?></a></p>
			<?php } ?>

			<h4><?php esc_html_e( 'Jetpack', 'archetype' ); ?></h4>
			<p><?php echo sprintf( esc_html__( 'Looking to add a custom logo? Install and activate %sJetpack%s. Archetype also supports the infinite scroll feature that comes with Jetpack.', 'archetype' ), '<a href="https://wordpress.org/plugins/jetpack/">', '</a>' ); ?></p>
			<?php if ( ! class_exists( 'Jetpack' ) ) { ?>
				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=jetpack' ), 'install-plugin_jetpack' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install JetPack', 'archetype' ); ?></a></p>
			<?php } ?>

			<h4><?php esc_html_e( 'Menu configuration' ,'archetype' ); ?></h4>
			<p><?php esc_html_e( 'Archetype includes three menu options used for navigating your web site. The Primary menu is used for your more commonly visited pages. The Secondary menu is used for pages you expect to see less traffic. The Handheld menu is used to select the pages you wish users to see when visiting your site on a handheld device.', 'archetype' ); ?></p>
			<p><a href="<?php echo esc_url( $url ); ?>" class="button"><?php esc_html_e( 'Configure', 'archetype' ); ?></a></p>
		</div>

		<div class="col">
			<h4><?php esc_html_e( 'OptionTree', 'archetype' ); ?></h4>
			<p><?php echo sprintf( esc_html__( 'Install and activate %sOptionTree%s to add meta box functionality which extends the post formats on your blog for a more custom appearance. This integration also gives you the ability to hide post & page titles, as well as, author descriptions on a per-post basis.', 'archetype' ), '<a href="https://wordpress.org/plugins/option-tree/">', '</a>' ); ?></p>
			<p><?php echo esc_html__( 'Since we built OptionTree too, you can rest easy knowing it will always be compatible with Archetype.', 'archetype' ); ?></p>
			<?php if ( ! class_exists( 'OT_Loader' ) ) { ?>
				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=option-tree' ), 'install-plugin_option-tree' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install OptionTree', 'archetype' ); ?></a></p>
			<?php } ?>

			<h4><?php esc_html_e( 'Component Order', 'archetype' ); ?></h4>
			<p><?php esc_html_e( 'This indispensable tool was created to order components in the header, homepage, and footer of your site and is extendable to any hook that could be ordered visually.', 'archetype' ); ?></p>
			<p><?php esc_html_e( 'For example, with our built-in Component Order control you can arrange homepage content components in the order you see fit, which is done from within the customizer.', 'archetype' ); ?></p>
			<p><?php esc_html_e( 'To order homepage components, just assign the "Homepage" template to a new or existing page. Then set that page as the static front page and use the Customizer to re-order the components.', 'archetype' ); ?></p>

			<h4><?php esc_html_e( 'Subscribe & Connect', 'archetype' ); ?></h4>
			<p><?php esc_html_e( 'Help your visitors subscribe to your content, as well as share it across various social networks by adding subscribe icon links to the header and footer of your website.', 'archetype' ); ?></p>

			<?php if ( ! is_plugin_active( 'subscribe-and-connect/subscribe-and-connect.php' ) ) { ?>
				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=subscribe-and-connect' ), 'install-plugin_subscribe-and-connect' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Subscribe & Connect', 'archetype' ); ?></a></p>
			<?php } ?>
			
			<h4><?php esc_html_e( 'Easy Google Fonts', 'archetype' ); ?></h4>
			<p><?php esc_html_e( 'Integrates Google fonts into the Customizer and allows you to fine tune your typography even more. All you will need is a Google fonts API key to get it set up.', 'archetype' ); ?></p>

			<?php if ( ! is_plugin_active( 'easy-google-fonts/easy-google-fonts.php' ) ) { ?>
				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=easy-google-fonts' ), 'install-plugin_easy-google-fonts' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Easy Google Fonts', 'archetype' ); ?></a></p>
			<?php } ?>
		</div>
	</div>
</div>
