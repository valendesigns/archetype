<?php
/**
 * Welcome screen child themes template
 *
 * @package Archetype
 * @subpackage Welcome
 * @since 1.0.0
 */

$theme = wp_get_theme();
?>
<div id="child_themes" class="archetype-add-ons panel" style="padding-top: 1.618em; clear: both;">

	<h2><?php esc_html_e( 'Upgrade your look', 'archetype' ); ?> <div class="dashicons dashicons-admin-appearance" style="margin-top: .25em;"></div></h2>

	<p>
		<?php esc_html_e( 'Browse Archetype\'s beautiful child themes to add some curb appeal to your website.', 'archetype' ); ?>
	</p>

	<div class="two-col" style="margin-bottom: 1.618em; overflow: hidden;">

		<div class="col">
			<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/child-theme.png'; ?>" alt="<?php esc_html_e( 'Child Theme', 'archetype' ); ?>" class="image-50" />
			<h4><?php esc_html_e( 'Child Theme', 'archetype' ); ?></h4>
			<p><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'archetype' ); ?></p>
			<p style="margin-bottom: 2.618em;">
				<?php if ( 'Child Theme' != $theme['Name'] ) { ?>
					<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-theme&theme=child-theme' ), 'install-theme_child_theme' ) ); ?>" class="button button-primary"><?php printf( esc_html__( 'Install %s now', 'archetype' ), '<span class="screen-reader-text">Child Theme</span>' ); ?></a>
				<?php } ?>
				<a href="https://valen.co/products/child-theme/" class="button"><?php printf( esc_html__( 'Read more %sabout Child Theme%s &rarr;', 'archetype' ), '<span class="screen-reader-text">', '</span>' ); ?></a>
			</p>
		</div>

		<div class="col">
			<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/child-theme.png'; ?>" alt="<?php esc_html_e( 'Child Theme', 'archetype' ); ?>" class="image-50" />
			<h4><?php esc_html_e( 'Child Theme', 'archetype' ); ?></h4>
			<p><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'archetype' ); ?></p>
			<p style="margin-bottom: 2.618em;">
				<?php if ( 'Child Theme' != $theme['Name'] ) { ?>
					<a href="https://valen.co/products/child-theme/" class="button button-primary"><?php printf( esc_html__( 'Buy %s now', 'archetype' ), '<span class="screen-reader-text">Child Theme</span>' ); ?></a>
				<?php } ?>
				<a href="https://valen.co/products/child-theme/" class="button"><?php printf( esc_html__( 'Read more %sabout Child Theme%s &rarr;', 'archetype' ), '<span class="screen-reader-text">', '</span>' ); ?></a>
			</p>
		</div>

	</div>
</div>
