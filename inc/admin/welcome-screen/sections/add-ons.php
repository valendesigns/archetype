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
	<h2><?php esc_html_e( 'Extend your functionality', 'archetype' ); ?> <div class="dashicons dashicons-admin-plugins" style="margin-top: .25em;"></div></h2>

	<p>
		<?php esc_html_e( 'Browse Archetype\'s free and commercial extensions.', 'archetype' ); ?>
	</p>

	<div class="two-col" style="margin-bottom: 1.618em; overflow: hidden;">
		<div class="add-on col">
			<h4><?php esc_html_e( 'Make your site instantly recognizable by adding your logo', 'archetype' ); ?> <span class="free"><?php esc_html_e( 'Free (Third Party)', 'archetype' ); ?></span></h4>
			<div class="content">
				<p><?php echo sprintf( esc_html__( 'Jetpack is probably a plugin you\'re already familiar with. Archetype fully supports Jetpacks site logo feature making it easy to upload and display your logo via the Customizer. %sMore info &rarr;%s', 'archetype' ), '<a href="https://wordpress.org/plugins/jetpack/">', '</a>' );?></p>
	
				<?php if ( class_exists( 'Jetpack' ) ) { ?>
					<p><span class="button disabled"><?php esc_html_e( 'Activated', 'archetype' ); ?></span></p>
				<?php } else { ?>
					<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=jetpack' ), 'install-plugin_jetpack' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Jetpack', 'archetype' ); ?></a></p>
				<?php } ?>
			</div>
		</div>

		<div class="add-on col image-vertical archetype-designer">
			<h4><?php esc_html_e( 'Further customize your site with the Archetype Developer', 'archetype' ); ?> <span class="premium"><?php esc_html_e( 'Premium', 'archetype' ); ?></span></h4>
			<div class="content">
				<p><?php esc_html_e( 'Archetype Developer adds additional appearance & functional settings which allowing you to further tweak and perfect your web site by changing the header layout, additional button styles, typographical schemes/scales and more.', 'archetype' ); ?></p>
	
				<?php if ( class_exists( 'Archetype_Developer' ) ) { ?>
					<p><span class="button disabled"><?php esc_html_e( 'Activated', 'archetype' ); ?></span></p>
				<?php } else { ?>
					<p><a href="https://valen.co/products/archetype-designer?utm_source=product&utm_medium=upsell&utm_campaign=archetypeaddons" class="button button-primary"><?php printf( esc_html__( 'Buy %sArchetype Designer%s now', 'archetype' ), '<span class="screen-reader-text">', '</span>' ); ?></a></p>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
