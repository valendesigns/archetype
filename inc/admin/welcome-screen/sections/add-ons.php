<?php
/**
 * Welcome screen add-ons template
 *
 * @package Archetype
 * @subpackage Welcome
 * @since 1.0.0
 */

?>
<div id="add_ons" class="archetype-add-ons panel" style="padding-top: 1.618em; clear: both;">
	<h2><?php _e( 'Extend your functionality', 'archetype' ); ?> <div class="dashicons dashicons-admin-plugins"></div></h2>

	<p>
		<?php _e( 'Browse Archetype\'s free and commercial extensions.', 'archetype' ); ?>
	</p>

	<div class="add-on">
		<h4><?php _e( 'Make your site instantly recognisable by adding your logo', 'archetype' ); ?> <span class="free"><?php _e( 'Free (Third Party)', 'archetype' ); ?></span></h4>
		<div class="content">
			<p><?php echo sprintf( __( 'Jetpack is probably a plugin you\'re already familiar with. Archetype fully supports Jetpacks site logo feature making it easy to upload and display your logo via the Customizer. %sMore info &rarr;%s', 'archetype' ), '<a href="https://wordpress.org/plugins/jetpack/">', '</a>' );?></p>

			<?php if ( class_exists( 'Jetpack' ) ) { ?>
				<p><span class="activated"><?php _e( 'Activated', 'archetype' ); ?></span></p>
			<?php } else { ?>
				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=jetpack' ), 'install-plugin_jetpack' ) ); ?>" class="button button-primary"><?php _e( 'Install Jetpack', 'archetype' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

	<div class="add-on image-vertical archetype-designer">
		<h4><?php _e( 'Further customise your store with the Archetype Designer', 'archetype' ); ?> <span class="premium"><?php _e( 'Premium', 'archetype' ); ?></span></h4>
		<div class="content">
			<p><?php _e( 'Archetype Designer adds a bunch of additional appearance settings allowing you to further tweak and perfect your Archetype design by changing the header layout, button styles, typographical schemes/scales and more.', 'archetype' ); ?></p>

			<?php if ( class_exists( 'Archetype_Designer' ) ) { ?>
				<p><span class="activated"><?php _e( 'Activated', 'archetype' ); ?></span></p>
			<?php } else { ?>
				<p><a href="https://www.woothemes.com/products/archetype-designer?utm_source=product&utm_medium=upsell&utm_campaign=archetypeaddons" class="button button-primary"><?php printf( __( 'Buy %sArchetype Designer%s now', 'archetype' ), '<span class="screen-reader-text">', '</span>' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

	<div class="add-on image-vertical product-hero">
		<h4><?php _e( 'Highlight a product of your choosing with the Archetype Product Hero', 'archetype' ); ?> <span class="premium"><?php _e( 'Premium', 'archetype' ); ?></span></h4>
		<div class="content">
			<p><?php _e( 'The Archetype Product Hero extension adds a parallax hero component to your homepage highlighting a specific product at your store. Use the shortcode to add attractive hero components to posts, pages or widgets.', 'archetype' ); ?></p>

			<?php if ( class_exists( 'Archetype_Product_Hero' ) ) { ?>
				<p><span class="activated"><?php _e( 'Activated', 'archetype' ); ?></span></p>
			<?php } else { ?>
				<p><a href="https://www.woothemes.com/products/archetype-product-hero?utm_source=product&utm_medium=upsell&utm_campaign=archetypeaddons" class="button button-primary"><?php printf( __( 'Buy %sArchetype Product Hero%s now', 'archetype' ), '<span class="screen-reader-text">', '</span>' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

	<div class="add-on image-vertical share">
		<h4><?php _e( 'Have your visitors market your store for you with Archetype Product Sharing', 'archetype' ); ?> <span class="free"><?php _e( 'Free', 'archetype' ); ?></span></h4>
		<div class="content">
			<p><?php echo sprintf( __( 'Archetype Product Sharing adds attractive social sharing icons for Facebook, Twitter, Pinterest and Email to your product pages. %sMore info &rarr;%s', 'archetype' ), '<a href="https://wordpress.org/plugins/archetype-product-sharing/">', '</a>' );?></p>

			<?php if ( class_exists( 'Archetype_Product_Sharing' ) ) { ?>
				<p><span class="activated"><?php _e( 'Activated', 'archetype' ); ?></span></p>
			<?php } else { ?>
				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=archetype-product-sharing' ), 'install-plugin_archetype-product-sharing' ) ); ?>" class="button button-primary"><?php _e( 'Install Archetype Product Sharing', 'archetype' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

	<div class="add-on image-horizontal footer-bar">
		<h4><?php _e( 'Add a site-wide call out to your footer with Archetype Footer Bar', 'archetype' ); ?> <span class="free"><?php _e( 'Free', 'archetype' ); ?></span></h4>
		<div class="content">
			<p><?php echo sprintf( __( 'Archetype Footer Bar adds a full width widgetised region above the default Archetype footer widget area. %sMore info &rarr;%s', 'archetype' ), '<a href="https://wordpress.org/plugins/archetype-footer-bar/">', '</a>' );?></p>

			<?php if ( class_exists( 'Archetype_Footer_Bar' ) ) { ?>
				<p><span class="activated"><?php _e( 'Activated', 'archetype' ); ?></span></p>
			<?php } else { ?>
				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=archetype-footer-bar' ), 'install-plugin_archetype-footer-bar' ) ); ?>" class="button button-primary"><?php _e( 'Install Archetype Footer Bar', 'archetype' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

	<div class="add-on image-horizontal product-pagination">
		<h4><?php _e( 'Archetype Product Pagination', 'archetype' ); ?> <span class="free"><?php _e( 'Free', 'archetype' ); ?></span></h4>
		<div class="content">
			<p><?php echo sprintf( __( 'Archetype Product Pagination adds unobtrusive links to next/previous products on your WooCommerce single product pages. %sMore info &rarr;%s', 'archetype' ), '<a href="https://wordpress.org/plugins/archetype-product-pagination/">', '</a>' );?></p>

			<?php if ( class_exists( 'Archetype_Product_Pagination' ) ) { ?>
				<p><span class="activated"><?php _e( 'Activated', 'archetype' ); ?></span></p>
			<?php } else { ?>
				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=archetype-product-pagination' ), 'install-plugin_archetype-product-pagination' ) ); ?>" class="button button-primary"><?php _e( 'Install Archetype Product Pagination', 'archetype' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

	<div class="add-on image-vertical wc-customiser">
		<h4><?php _e( 'Refine your shop archives and product pages with the Archetype WooCommerce Customiser', 'archetype' ); ?> <span class="premium"><?php _e( 'Premium', 'archetype' ); ?></span></h4>
		<div class="content">
			<p><?php _e( 'The Archetype WooCommerce Customiser extension gives you further control over the look and feel of your shop. Change the product archive and single layouts, toggle various shop components and more.', 'archetype' ); ?></p>

			<?php if ( class_exists( 'Archetype_WooCommerce_Customiser' ) ) { ?>
				<p><span class="activated"><?php _e( 'Activated', 'archetype' ); ?></span></p>
			<?php } else { ?>
				<p><a href="https://www.woothemes.com/products/archetype-woocommerce-customiser?utm_source=product&utm_medium=upsell&utm_campaign=archetypeaddons" class="button button-primary"><?php printf( __( 'Buy %sArchetype WooCommerce Customiser%s now', 'archetype' ), '<span class="screen-reader-text">', '</span>' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

	<div class="add-on">
		<h4><?php _e( 'Add practical information to your pages with Archetype Top Bar', 'archetype' ); ?> <span class="free"><?php _e( 'Free (Third Party)', 'archetype' ); ?></span></h4>
		<div class="content">
			<p><?php echo sprintf( __( 'Archetype Top Bar adds a widgetised content area at the top of your site and customise it\'s appearance in the Customizer. %sMore info &rarr;%s', 'archetype' ), '<a href="https://wordpress.org/plugins/archetype-top-bar/">', '</a>' ); ?></p>

			<?php if ( class_exists( 'Archetype_Top_Bar' ) ) { ?>
				<p><span class="activated"><?php _e( 'Activated', 'archetype' ); ?></span></p>
			<?php } else { ?>
				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=archetype-top-bar' ), 'install-plugin_archetype-top-bar' ) ); ?>" class="button button-primary"><?php _e( 'Install Archetype Top Bar', 'archetype' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

	<hr style="clear: both;" />

	<p style="font-size: 1.2em; margin: 2.618em 0;">
		<?php echo sprintf( esc_html__( 'There are literally hundreds of awesome extensions available for you to use. Looking for Table Rate Shipping? Subscriptions? Product Add-ons? You can find these and more in the WooCommerce extension shop. %sGo shopping%s.', 'archetype' ), '<a href="http://www.woothemes.com/product-category/woocommerce-extensions/">', '</a>' ); ?>
	</p>
</div>
