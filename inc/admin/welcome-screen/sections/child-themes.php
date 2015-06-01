<?php
/**
 * Welcome screen child themes template
 *
 * @package Archetype
 * @subpackage Welcome
 * @since 1.0.0
 */

?>
<div id="child_themes" class="archetype-add-ons panel" style="padding-top: 1.618em; clear: both;">
	<?php
		$theme = wp_get_theme();
	?>

	<h2><?php _e( 'Upgrade your look', 'archetype' ); ?> <div class="dashicons dashicons-admin-appearance"></div></h2>

	<p>
		<?php _e( 'Browse Archetype\'s beautiful child themes to add some curb appeal to your website.', 'archetype' ); ?>
	</p>

	<div class="feature-section col two-col">

		<div class="col-1">
			<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/boutique.jpg'; ?>" alt="<?php _e( 'Boutique Child Theme', 'archetype' ); ?>" class="image-50" />
			<h4><?php _e( 'Boutique', 'archetype' ); ?></h4>
			<p><?php _e( 'Boutique is a simple, traditionally designed Archetype child theme, ideal for small stores or boutiques. Add your logo, create a unique color scheme and start selling!', 'archetype' ); ?></p>
			<p style="margin-bottom: 2.618em;">
				<?php if ( 'Boutique' != $theme['Name'] ) { ?>
					<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-theme&theme=boutique' ), 'install-theme_boutique' ) ); ?>" class="button button-primary"><?php printf( __( 'Install %s now', 'archetype' ), '<span class="screen-reader-text">Boutique</span>' ); ?></a>
				<?php } ?>
				<a href="http://www.woothemes.com/products/boutique/" class="button"><?php printf( __( 'Read more %sabout Boutique%s &rarr;', 'archetype' ), '<span class="screen-reader-text">', '</span>' ); ?></a>
			</p>
		</div>

		<div class="col-2 last-feature">
			<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/deli.jpg'; ?>" alt="<?php _e( 'Deli Child Theme', 'archetype' ); ?>" class="image-50" />
			<h4><?php _e( 'Deli', 'archetype' ); ?></h4>
			<p><?php _e( 'Deli features a texturised, earthy design, perfect for stores selling natural, organic or hand made goods.', 'archetype' ); ?></p>
			<p style="margin-bottom: 2.618em;">
				<?php if ( 'Deli' != $theme['Name'] ) { ?>
					<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-theme&theme=deli' ), 'install-theme_deli' ) ); ?>" class="button button-primary"><?php printf( __( 'Install %s now', 'archetype' ), '<span class="screen-reader-text">Deli</span>' ); ?></a>
				<?php } ?>
				<a href="http://www.woothemes.com/products/deli/" class="button"><?php printf( __( 'Read more %sabout Deli%s &rarr;', 'archetype' ), '<span class="screen-reader-text">', '</span>' ); ?></a>
			</p>
		</div>

	</div>
</div>
