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
	<h2><?php _e( 'Extend your functionality', 'archetype' ); ?> <div class="dashicons dashicons-admin-plugins" style="margin-top: .25em;"></div></h2>

	<p>
		<?php _e( 'Browse Archetype\'s free and commercial extensions.', 'archetype' ); ?>
	</p>

	<div class="add-on">
		<h4><?php _e( 'Make your site instantly recognizable by adding your logo', 'archetype' ); ?> <span class="free"><?php _e( 'Free (Third Party)', 'archetype' ); ?></span></h4>
		<div class="content">
			<p><?php echo sprintf( __( 'Jetpack is probably a plugin you\'re already familiar with. Archetype fully supports Jetpacks site logo feature making it easy to upload and display your logo via the Customizer. %sMore info &rarr;%s', 'archetype' ), '<a href="https://wordpress.org/plugins/jetpack/">', '</a>' );?></p>

			<?php if ( class_exists( 'Jetpack' ) ) { ?>
				<p><span class="button disabled"><?php _e( 'Activated', 'archetype' ); ?></span></p>
			<?php } else { ?>
				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=jetpack' ), 'install-plugin_jetpack' ) ); ?>" class="button button-primary"><?php _e( 'Install Jetpack', 'archetype' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

	<div class="add-on image-vertical archetype-designer">
		<h4><?php _e( 'Further customize your store with the Archetype Designer', 'archetype' ); ?> <span class="premium"><?php _e( 'Premium', 'archetype' ); ?></span></h4>
		<div class="content">
			<p><?php _e( 'Archetype Designer adds a bunch of additional appearance settings allowing you to further tweak and perfect your Archetype design by changing the header layout, additional button styles, typographical schemes/scales and more.', 'archetype' ); ?></p>

			<?php if ( class_exists( 'Archetype_Designer' ) ) { ?>
				<p><span class="button disabled"><?php _e( 'Activated', 'archetype' ); ?></span></p>
			<?php } else { ?>
				<p><a href="https://valen.co/products/archetype-designer?utm_source=product&utm_medium=upsell&utm_campaign=archetypeaddons" class="button button-primary"><?php printf( __( 'Buy %sArchetype Designer%s now', 'archetype' ), '<span class="screen-reader-text">', '</span>' ); ?></a></p>
			<?php } ?>
		</div>
	</div>
</div>
