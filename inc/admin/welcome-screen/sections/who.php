<?php
/**
 * Welcome screen who are woo template
 * @package Archetype
 * @subpackage Welcome
 * @since 1.0.0
 */

$woo_activated = class_exists( 'WooCommerce', false );
?>
<div id="who" class="feature-section col three-col" style="margin-bottom: 1.618em; padding-top: 1.618em; overflow: hidden;">
	<div class="col-1">
		<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/valen.png'; ?>" alt="<?php _e( 'The Valen Team', 'archetype' ); ?>" class="image-50" width="440" />
		<h4><?php _e( 'Who is Valen?', 'archetype' ); ?></h4>
		<p><?php _e( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'archetype' ); ?></p>
		<p><a href="http://woothemes.com" class="button"><?php _e( 'Come Visit Us', 'archetype' ); ?></a></p>
	</div>

	<?php if ( ! $woo_activated ) { ?>

	<div class="col-2">
		<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/woocommerce.png'; ?>" alt="<?php _e( 'WooCommerce logo', 'archetype' ); ?>" class="image-50" width="440" />
		<h4><?php _e( 'What is WooCommerce?', 'archetype' ); ?></h4>
		<p><?php _e( 'WooCommerce is the most popular WordPress eCommerce plugin, and was purchase by WordPress recently. It\'s packed full of intuitive features and surrounded by a thriving community.', 'archetype' ); ?></p>
		<p>
			<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' ) ); ?>" class="button button-primary"><?php _e( 'Install WooCommerce', 'archetype' ); ?></a>
			<a href="http://docs.woothemes.com/documentation/plugins/woocommerce/" class="button"><?php _e( 'Documentation', 'archetype' ); ?></a>
		</p>
	</div>

	<?php } ?>

	<div class="<?php echo ! $woo_activated ? 'col-3 last-feature' : 'col-2'; ?>">
		<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/github.png'; ?>" alt="<?php _e( 'Can I contribute to Archetype?', 'archetype' ); ?>" class="image-50" width="440" />
		<h4><?php _e( 'Can I Contribute?', 'archetype' ); ?></h4>
		<p><?php _e( 'Found a bug? Want to contribute a patch or create a new feature? GitHub is the place to go! Or would you like to translate Archetype into your language? Get involved at Transifex.', 'archetype' ); ?></p>
		<p>
			<a href="http://github.com/valendesigns/archetype/" class="button"><?php _e( 'Archetype at GitHub', 'archetype' ); ?></a>
			<a href="https://www.transifex.com/projects/p/archetype/" class="button"><?php _e( 'Archetype at Transifex', 'archetype' ); ?></a>
		</p>
	</div>

	<div class="<?php echo ! $woo_activated ? 'col-1' : 'col-3 last-feature'; ?>">
		<h4><?php _e( 'Are you enjoying Archetype?', 'archetype' ); ?></h4>
		<p><?php echo sprintf( esc_html__( 'Why not leave a review on %sWordPress.org%s? We\'d really appreciate it! :-)', 'archetype' ), '<a href="https://wordpress.org/themes/archetype">', '</a>' ); ?></p>
	</div>
</div>
