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
			<h4><?php esc_html_e( 'The Customizer' ,'archetype' ); ?></h4>
			<p><?php esc_html_e( 'Not a web development guru? Not a Problem.  Archetype\'s Customizer integration allows you to effortlessly match the color scheme and layout of your brand. Point, click, and admire.', 'archetype' ); ?></p>
			<p><?php esc_html_e( 'With our built-in Component Order control you can arrange homepage content components in the order you see fit, which is done from within the Customizer.', 'archetype' ); ?></p>
			<p><?php esc_html_e( 'To order homepage components, just assign the "Homepage" template to a new or existing page. Then set that page as the static front page and use the Customizer to re-order the components.', 'archetype' ); ?></p>
			<p><?php esc_html_e( 'Component Ordering is an indispensable tool that is used for more than ordering just the homepage components. You can additionally order the components in the header, and footer of your site and this functionality can be extended to other hooks which need to be visually ordered or hidden.', 'archetype' ); ?></p>
			<p><?php esc_html_e( 'Take a moment to read the rest of the features and install the plugins before you begin customizing your web site. Afterwards, click the button below and get started building your masterpiece.', 'archetype' ); ?></p>
			<p><a href="<?php echo esc_url( $url ); ?>" class="button"><?php esc_html_e( 'Customize', 'archetype' ); ?></a></p>

			<h4><?php esc_html_e( 'Menu configuration' ,'archetype' ); ?></h4>
			<p><?php esc_html_e( 'Archetype includes three menus which are used to navigate your web site. The Primary menu is typically used for more commonly visited pages. The Secondary menu is typically used for pages you expect to see less traffic. The Handheld menu displays on handheld devices below 768px.', 'archetype' ); ?></p>
			<p><a href="<?php echo esc_url( $url ); ?>" class="button"><?php esc_html_e( 'Configure', 'archetype' ); ?></a></p>

			<h4><?php esc_html_e( 'WooCommerce' ,'archetype' ); ?></h4>
			<p><?php esc_html_e( 'Looking to include a online store? Then WooCommerce is your first stop. It\'s the most popular WordPress eCommerce plugin, which is packed full of intuitive features and a thriving community.', 'archetype' ); ?></p>

			<?php if ( ! class_exists( 'WooCommerce' ) ) { ?>
				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install WooCommerce', 'archetype' ); ?></a></p>
			<?php } ?>
		</div>

		<div class="col">
			<h4><?php esc_html_e( 'OptionTree', 'archetype' ); ?></h4>
			<p><?php echo sprintf( esc_html__( 'Install and activate %sOptionTree%s to add meta box functionality which extends the post formats on your blog for a more custom appearance. This integration also gives you the ability to hide post & page titles, as well as, author descriptions on a per-post basis. Additionally, support for Revolution Slider & LayerSlider are added by activating OptionTree.', 'archetype' ), '<a href="https://wordpress.org/plugins/option-tree/">', '</a>' ); ?></p>
			<p><?php echo esc_html__( 'Since we built OptionTree, you can rest easy knowing it will always be compatible with Archetype.', 'archetype' ); ?></p>

			<?php if ( ! class_exists( 'OT_Loader' ) ) { ?>
				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=option-tree' ), 'install-plugin_option-tree' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install OptionTree', 'archetype' ); ?></a></p>
			<?php } ?>

			<h4><?php esc_html_e( 'Jetpack', 'archetype' ); ?></h4>
			<p><?php echo esc_html__( 'Archetype supports the Contact Form, Infinite Scroll, Custom CSS, and Site Logo features which come with Jetpack. However, the Site Logo feature is actually bundled in the Core of Archetype as a fall back, because it\'s just to important to rely on Jetpack for.', 'archetype' ); ?></p>
			<p><?php echo esc_html__( 'We will also test and add to this list of supported features in the future when they are requested.', 'archetype' ); ?></p>

			<?php if ( ! class_exists( 'Jetpack' ) ) { ?>
				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=jetpack' ), 'install-plugin_jetpack' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install JetPack', 'archetype' ); ?></a></p>
			<?php } ?>

			<h4><?php esc_html_e( 'Subscribe & Connect', 'archetype' ); ?></h4>
			<p><?php esc_html_e( 'Help your visitors subscribe to your content, as well as share it across various social networks by adding subscribe icon links to your posts, and to the header and footer of your website.', 'archetype' ); ?></p>

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
